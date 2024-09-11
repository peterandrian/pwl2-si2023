<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
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
}
