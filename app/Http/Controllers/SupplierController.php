<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /* 
    * index
    * @return void
    */

    public function index() : View
    {
        $supplier = new Supplier;
        $suppliers = $supplier->get_supplier()
                            ->latest()
                            ->paginate(10);
    
        return view('suppliers.index', compact('suppliers'));    
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
            'alamat_supplier'     => 'required|min:5',
            'supplier_name'       => 'required|min:1',
            'no_hp_pic_supplier'  => 'required|numeric',
            'pic_supplier'        => 'required|min:1',
        ]);

        try {
            // Simpan data supplier ke database
            Supplier::create([
                'alamat_supplier'     => $request->alamat_supplier,
                'supplier_name'       => $request->supplier_name,
                'no_hp_pic_supplier'  => $request->no_hp_pic_supplier,
                'pic_supplier'        => $request->pic_supplier,
            ]);
    

        // Redirect to index
            return redirect()->route('supplier.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }  catch (\Exception $e) {
        return redirect()->route('supplier.index')->with(['error' => 'Failed to upload image.']);        
        }
    }


    /* 
    * create
    *
    * @return View
    */

    public function create() : View
    {
        $supplier = new Supplier;
        $data['supplier'] = $supplier->get_supplier()->get();

        return view('suppliers.create', compact('data'));    
    }


    /**
     * show
     * 
     * @param mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        $supplier_model = new Supplier;
        $supplier = $supplier_model->get_supplier()->where("suppliers.id", $id)->firstOrFail();

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * edit
     * 
     * @param mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $supplier_model = new Supplier();
        $data['supplier'] = $supplier_model->get_supplier()->where("suppliers.id", $id)->firstOrFail();

        $data['suppliers'] = $supplier_model->get_supplier()->get();

        return view('suppliers.edit', compact('data'));
    }



    /**
    * update
    * 
    * @param  mixed $request
    * @param  mixed $id
    * @return RedirectResponse
    */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'alamat_supplier'     => 'required|min:5',
            'supplier_name'       => 'required|min:1',
            'no_hp_pic_supplier'  => 'required|numeric',
            'pic_supplier'        => 'required|min:1',
        ]);

        //get supplier by ID
        $supplier_model = new Supplier();
        $supplier = $supplier_model->get_supplier()->where("suppliers.id", $id)->firstOrFail();


        $supplier->update([
            'alamat_supplier'     => $request->alamat_supplier,
            'supplier_name'       => $request->supplier_name,
            'no_hp_pic_supplier'  => $request->no_hp_pic_supplier,
            'pic_supplier'        => $request->pic_supplier,
        ]);

        return redirect()->route('supplier.index')->with(['success' => 'Data Berhasil Diubah!']);
    }


    /**
    * destroy
    * 
    * @param mixed $id
    * @return RedirectResponse
    */
    public function destroy($id): RedirectResponse
    {
        // get supplier by ID
        $supplier_model = new Supplier();
        $supplier = $supplier_model->get_supplier()->where("suppliers.id", $id)->firstOrFail();


        // delete supplier
        $supplier->delete();

        // redirect to index
        return redirect()->route('supplier.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }


}