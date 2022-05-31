<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function search()
    {
        $users=[];
        if(\request()->has('search'))
        {
            $users=User::search(\request()->search)->get();
        }

//dd($users);
        return view('frontend.search',compact('users'));
    }
    public function home()
    {
        $products=Product::all();
        return view('frontend.pages.home',compact('products'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function customerRegistration(Request $request)//typeHint
    {
        $request->validate([
           'name'=>'required',
           'email'=>'required|email',
           'password'=>'required',
        ]);

        User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password),
           'role'=>'customer',
        ]);

        return redirect()->back();

    }

    public function showProduct($product_id)
    {
        //eloquent query- Model
        //raw query or query builder
        //find, first, get, all, where(), with, whereHas,
        //bootstrap grid
        $product=Product::find($product_id);
        return view('frontend.pages.product',compact('product'));
    }
}
