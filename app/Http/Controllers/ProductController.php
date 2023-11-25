<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(ProductRequest $request)
    {
        Product::create($request->validated());

        return redirect()->route('dashboard');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard');
    }
}
