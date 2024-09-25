<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /* 
    * index
    * @return void
    */

    public function index() : View
    {
        $product = new Product;
        $products = $product->get_product()
                            ->latest()
                            ->paginate(10);
    
        return view('products.index', compact('products'));    
    }

    /* 
    * create
    *
    * @return View
    */

    public function create() : View
    {
        $product = new Product;
        $supplier = new Supplier;

        $data['categories'] = $product->get_category_product()->get();
        $data['suppliers'] = $supplier->get_supplier()->get();

        return view('products.create', compact('data'));    
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
            'image'               => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'               => 'required|min:5',
            'product_category_id' => 'required|integer',
            'id_supplier'         => 'required|integer',
            'description'         => 'required|min:10',
            'price'               => 'required|numeric',
            'stock'               => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->store('public/images'); // Simpan gambar ke folder penyimpanan
        
            // Create product
            Product::create([
                'image'               => $image->hashName(),
                'title'               => $request->title,
                'product_category_id' => $request->product_category_id,
                'id_supplier'         => $request->id_supplier,
                'description'         => $request->description,
                'price'               => $request->price,
                'stock'               => $request->stock,
            ]);
        
            // Redirect to index
            return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }
        
        return redirect()->route('products.index')->with(['error' => 'Failed to upload image.']);
    }
}

