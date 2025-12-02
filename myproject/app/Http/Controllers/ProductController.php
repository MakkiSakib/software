<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController 
{
    public function show_products()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }
}
