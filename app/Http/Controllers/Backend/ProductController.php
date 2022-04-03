<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product(){
        // $items = Product::with('category')->get();
        $items = Product::with('category')->get();
        return view('backend.pages.product.productList',compact('items'));
    }

    public function productCreate(){
        $categories=Category::all();

        return view('backend.pages.product.create',compact('categories'));
    }

    public function productStore(Request $request){

            $request->validate(
                [
                'name'=>'required',
                'category_id'=>'required',
                'weight'=>'required',
                'quantity'=>'required|integer' ,
                'price'=>'required|numeric',
                'details'=>'required',
                'image'=>'image'
            ]
            );
//        dd($request->all());
    $filename = null;
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            // dd($file);
            // dd(date('Ymdhis'));
            $filename = date('Ymdhis').'.'.$file->getClientOriginalExtension();
            // dd($filename);
            $file ->storeAs('/uploads',$filename);
        }
        Product::create([
            // coloum name of db || name of input field
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'weight'=> $request->weight,
            'quantity'=> $request->quantity,
            'price'=>$request->price,
            'details'=>$request->details,
            'image'=>$filename
        ]);
        return redirect()->route('admin.product.show');
    }

    public function productEdit($id){
        $categories = Category::all();
        $product = Product::find($id);
        if ($product) {
        return view('backend.pages.product.edit',compact('categories','product'));
        } else {
            return redirect()->back();
        }

    }

    public function productUpdate(Request $request){
        // dd($request->all());
        $product = Product::find($request->product_id);
        $filename = $product->image;
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            // dd($file);
            // dd(date('Ymdhis'));
            $filename = date('Ymdhis').'.'.$file->getClientOriginalExtension();
            // dd($filename);
            $file ->storeAs('/uploads',$filename);
        }
        if ($product) {
            $product->update([
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'weight'=> $request->weight,
            'quantity'=> $request->quantity,
            'price'=>$request->price,
            'details'=>$request->details,
            'image'=>$filename
            ]);
            return redirect()->route('admin.product.show');
        } else {
            return redirect()->back();
        }


    }

    public function productDelete($id){
        $product =Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->back();

        } else {
        return redirect()->back();
        }

    }
}
