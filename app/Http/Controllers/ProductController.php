<?php

namespace App\Http\Controllers;

use App\Filament\Resources\ProductResource;
use App\Http\Controllers\Auth\BaseController as AuthBaseController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends AuthBaseController
{

    public function index()
    {
        // Product::where(['user_id','=',auth()->user()->id]);
        $product = Product::all();
        return $this->sendResponse(
            $product,
            "All Product Sent"
        );
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
