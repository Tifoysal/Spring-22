<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products=Product::all();
        return view('frontend.pages.home',compact('products'));
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
}
