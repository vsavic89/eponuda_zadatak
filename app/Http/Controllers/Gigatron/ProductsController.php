<?php

namespace App\Http\Controllers\Gigatron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $gigatronProducts = \App\Gigatron\Product::paginate(20)->load('brand');

        return view('gigatron.products.index', compact('gigatronProducts'));
    }
}