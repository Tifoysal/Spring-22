<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $items = Product::all();
        return view('backend.pages.product.productList',compact('items'));
    }

    public function productCreate(){
        return view('backend.pages.product.create');
    }

    public function productStore(Request $request){
        Product::create([
            // coloum name of db || name of input field
            'name'=> $request->name,
            'category_id'=> 1 ,
            'quantity'=> $request->quantity,
            'price'=>$request->price,
            'details'=>$request->details
        ]);
        return redirect()->route('admin.product.show');
    }
}
