<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        $items = Product::with('category')->get();
//        dd($items);
        return view('backend.pages.product.productList',compact('items'));
    }

    public function productCreate(){
        $categories=Category::all();

        return view('backend.pages.product.create',compact('categories'));
    }

    public function productStore(Request $request){
//        dd($request->all());
        Product::create([
            // coloum name of db || name of input field
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'quantity'=> $request->quantity,
            'price'=>$request->price,
            'details'=>$request->details
        ]);
        return redirect()->route('admin.product.show');
    }
}
