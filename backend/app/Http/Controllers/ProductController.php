<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('name')
            ->get();

        return ProductResource::collection($products);
    }
}
