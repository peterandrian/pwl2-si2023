<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    /* 
    * index
    * @return void
    */

    public function index() : View
    {
        $transaction = new Transaction;
        $transactions = $transaction->get_transaction()
                            ->latest()
                            ->paginate(10);
    
        return view('transactions.index', compact('transactions'));    
    }
    
    /* 
    * create
    *
    * @return View
    */

    public function create() : View
    {
        $transaction = new Transaction;
        $product = new Product;

        $data['cashiers'] = $transaction->get_cashier()->get();
        $data['products'] = $product->get_product()->get();

        return view('transactions.create', compact('data'));    
    }

    /**
     * Store a new transaction and reduce product stock.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request, including the buyer's email
        $request->validate([
            'nama_kasir_id' => 'required|exists:kasir,id',
            'id_product' => 'required|array|min:1',
            'id_product.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
            'email_pembeli' => 'required|email', // Validate buyer's email
        ]);
    
        DB::beginTransaction(); // Start a transaction to ensure all operations succeed or fail together
        try {
            // Create the transaction in the transaksi_penjualan table
            $transaction = new Transaction();
            $transaction->id_kasir = $request->nama_kasir_id;
            $transaction->email_pembeli = $request->email_pembeli; // Save buyer's email
            $transaction->save();
    
            // Loop through each product and its quantity
            foreach ($request->id_product as $index => $productId) {
                $product = Product::findOrFail($productId);
    
                // Check if stock is sufficient
                if ($product->stock < $request->quantity[$index]) {
                    return redirect()->back()->withErrors(['error' => 'Stock for ' . $product->title . ' is insufficient.']);
                }
    
                // Update product stock
                $product->stock -= $request->quantity[$index];
                $product->save();
    
                // Insert into detail_transaksi_penjualan
                DB::table('detail_transaksi_penjualan')->insert([
                    'id_transaksi_penjualan' => $transaction->id,
                    'id_product' => $productId,
                    'jumlah_pembelian' => $request->quantity[$index],
                ]);
            }
    
            DB::commit(); // Commit the transaction
    
            // Send the email to the buyer
            $this->sendEmail($request->email_pembeli, $transaction->id);
    
            return redirect()->route('transaction.index')->with(['success' => 'Transaction successfully created, stock updated, and email sent!']);
        
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
            return redirect()->back()->withErrors(['error' => 'Failed to create transaction.']);
        }
    }
    
    /**
     * show
     * 
     * @param mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        // Fetch the transaction by ID
        $transaction = new Transaction;
        $data = $transaction->get_transaction()->where('transaksi_penjualan.id', $id)->firstOrFail();
    
        return view('transactions.show', compact('data'));
    }
    
    /**
     * edit
     * 
     * @param mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $transaction = new Transaction;
        $product = new Product;
        $data['transactions'] = $transaction->get_transaction()->where('transaksi_penjualan.id', $id)->firstOrFail();
        $data['cashiers'] = $transaction->get_cashier()->get();
        $data['products'] = $product->get_product()->get();

        return view('transactions.edit', compact('data'));
    }

    
    /**
     * Update
     * 
     * @param  Request $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama_kasir_id' => 'required|exists:kasir,id',
            'email_pembeli' => 'required|email',
            'id_product' => 'required|array|min:1',
            'id_product.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);
    
        DB::beginTransaction();
    
        try {
            $transaction = Transaction::findOrFail($id);
            
            // Fetch current details to adjust stock
            $currentDetails = DB::table('detail_transaksi_penjualan')
                                ->where('id_transaksi_penjualan', $id)
                                ->get();
    
            // Restore stock for existing products in transaction
            foreach ($currentDetails as $detail) {
                $product = Product::findOrFail($detail->id_product);
                $product->stock += $detail->jumlah_pembelian;
                $product->save();
            }
    
            // Delete old transaction details
            DB::table('detail_transaksi_penjualan')->where('id_transaksi_penjualan', $id)->delete();
    
            // Update transaction information, including buyer email
            $transaction->update([
                'id_kasir' => $request->input('nama_kasir_id'),
                'email_pembeli' => $request->input('email_pembeli'),
                'updated_at' => now(),
            ]);
    
            // Update product stock and add new transaction details
            foreach ($request->id_product as $index => $productId) {
                $product = Product::findOrFail($productId);
                
                // Ensure stock is sufficient for the updated quantity
                if ($product->stock < $request->quantity[$index]) {
                    return redirect()->back()->withErrors(['error' => 'Insufficient stock for ' . $product->title . '.']);
                }
    
                // Deduct stock and save
                $product->stock -= $request->quantity[$index];
                $product->save();
    
                // Insert updated transaction detail
                DB::table('detail_transaksi_penjualan')->insert([
                    'id_transaksi_penjualan' => $id,
                    'id_product' => $productId,
                    'jumlah_pembelian' => $request->quantity[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
            // Send the email regardless of changes
            $this->sendEmail($request->input('email_pembeli'), $transaction->id);
    
            DB::commit();
    
            return redirect()->route('transaction.index')->with(['success' => 'Transaction successfully updated, stock adjusted, and email sent!']);
        
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('transaction.index')->with(['error' => 'Failed to update.']);
        }
    }
         
    /**
    * destroy
    * 
    * @param mixed $id
    * @return RedirectResponse
    */

    public function destroy($id): RedirectResponse
    {
        $transaction = Transaction::findOrFail($id);
        DB::table('detail_transaksi_penjualan')->where('id_transaksi_penjualan', $transaction->id)->delete();
        $transaction->delete();

        return redirect()->route('transaction.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function sendEmail($to, $id)
    {
        // Fetch the transaction data using the provided ID
        $transaction = new Transaction;
        $data = $transaction->get_transaction()->where('transaksi_penjualan.id', $id)->firstOrFail();
    
        // Prepare the email data
        $emailData = [
            'data' => $data,
        ];
    
        // Send the email
        Mail::send('transactions.show', $emailData, function ($message) use ($to, $data) {
            $message->to($to)
                    ->subject("Your Transaction Details: {$data->email_pembeli} - Total Rp. " . number_format($data->total_transaction, 0, ',', '.'));
        });
    
        return response()->json(['message' => 'Email sent successfully!']);
    }    
        
}