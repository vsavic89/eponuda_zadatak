<?php

namespace App\Http\Controllers\Gigatron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $gigatronProducts = \App\Gigatron\Product::with('brand')->paginate(20);

        return view('gigatron.products.index', compact('gigatronProducts'));
    }
}
