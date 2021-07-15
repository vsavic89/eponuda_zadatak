<?php

namespace App\Http\Controllers\Gigatron;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $gigatronProducts = \App\Gigatron\Product::with('brand')->paginate(20);

        if($request->wantsJson()){
            return response()->json($gigatronProducts);
        }

        return view('gigatron.products.index', compact('gigatronProducts'));
    }
}
