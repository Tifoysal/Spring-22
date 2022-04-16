<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function dashboard()
    {
        $total_order=Order::all()->count();
        $total_customer=User::where('role','customer')->count();

        return view('backend.pages.dashboard',compact('total_order','total_customer'));
    }
    public function login()
    {
        return view('backend.pages.login');
    }

    public function doLogin(Request $request)
    {
//        dd($request->all());
        $request->validate([
           'email'=>'required|email',
           'password'=>'required|min:5'
        ]);

        $credentials=$request->except('_token');

        if(auth()->attempt($credentials))
        {
           return redirect()->route('dashboard');
        }
       return redirect()->back()->with('message','Invalid Credentials.');

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login')->with('message','Logout Successful');
    }

    public function list()
    {
        $users=User::all();
        return view('backend.pages.user.list',compact('users'));
    }
}
