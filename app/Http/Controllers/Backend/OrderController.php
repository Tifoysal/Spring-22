<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        $orders=Order::all();
        return view('backend.pages.order.list',compact('orders'));
    }

    public function view($id)
    {
        $order=Order::with('details','details.item')->find($id);
//dd($order);
        return view('backend.pages.order.invoice',compact('order'));
    }
}
