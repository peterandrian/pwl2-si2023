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

    /* 
    * store
    *
    * @param mixed $request
    * @return RedirectedResponse
    */

    public function store(Request $request) : RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_kasir_id' => 'required|exists:kasir,id',
            'id_product' => 'required|array|min:1',
            'id_product.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);
    
        // Begin a transaction
        DB::beginTransaction();
    
        try {
            // 1. Insert into the 'transactions' table
            $transaction = DB::table('transaksi_penjualan')->insertGetId([
                'id_kasir' => $request->input('nama_kasir_id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // 2. Loop through the products and insert into 'transaction_details'
            $products = $request->input('id_product');
            $quantities = $request->input('quantity');
    
            foreach ($products as $index => $product_id) {
                DB::table('detail_transaksi_penjualan')->insert([
                    'id_transaksi_penjualan' => $transaction,
                    'id_product' => $product_id,
                    'jumlah_pembelian' => $quantities[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
            // Commit the transaction if everything is successful
            DB::commit();
    
            return redirect()->route('transaction.index')->with(['success' => 'Data Berhasil Disimpan!']);
        
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('transaction.index')->with(['error' => 'Failed to save data.']);
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
        // Validate the form input
        $request->validate([
            'nama_kasir_id' => 'required|exists:kasir,id',
            'id_product' => 'required|array|min:1',
            'id_product.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction(); // Start the transaction

        try {
            DB::table('transaksi_penjualan')->where('id', $id)->update([
                'id_kasir' => $request->input('nama_kasir_id'),
                'updated_at' => now(),
            ]);

            DB::table('detail_transaksi_penjualan')->where('id_transaksi_penjualan', $id)->delete();

            $products = $request->input('id_product');
            $quantities = $request->input('quantity');

            foreach ($products as $index => $product_id) {
                DB::table('detail_transaksi_penjualan')->insert([
                    'id_transaksi_penjualan' => $id,
                    'id_product' => $product_id,
                    'jumlah_pembelian' => $quantities[$index],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit(); 

            return redirect()->route('transaction.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            DB::rollback(); 
            Log::error($e->getMessage());

            return redirect()->route('transaction.index')->with(['error' => 'Failed to save data.']);
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

        
}