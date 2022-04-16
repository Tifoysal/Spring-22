<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function viewCart()
    {
        return view('frontend.pages.cart');
    }

    public function addToCart($product_id)
    {
        //get product from database
        $product=Product::find($product_id);

            // get cart from session if has
            $getCart=session()->get('cart');

            //check if cart is empty step 1
            if($getCart==null)
            {

                if($product->quantity>=1)
                {
                    $newCart=[
                        $product->id=>[
                            'name'=>$product->name,
                            'price'=>$product->price,
                            'quantity'=>1,
                            'image'=>$product->image,
                            'subtotal'=>$product->price,
                            'discount'=>5,
                        ]
                    ];

                    session()->put('cart',$newCart);
                    return redirect()->back()->with('message','Product Added to Cart');
                }
                return redirect()->back()->with('message','Product stock out.');

            }


            //if not empty but product exist step 2
            if(array_key_exists($product_id,$getCart))
            {

                //increment quantity of existing product.
                ++$getCart[$product_id]['quantity'];
                if($product->quantity>=$getCart[$product_id]['quantity'])
                {
                    $getCart[$product_id]['subtotal']=$getCart[$product_id]['quantity']*$getCart[$product_id]['price'];
                    session()->put('cart',$getCart);
                    return redirect()->back()->with('message','Product Quantity Updated.');
                }
                return redirect()->back()->with('message','Product Stock out.');
            }else
            {
                //if not empty but product is different step 3
                if($product->quantity>=1)
                {
                    $getCart[$product->id]=[
                        'name'=>$product->name,
                        'price'=>$product->price,
                        'quantity'=>1,
                        'image'=>$product->image,
                        'subtotal'=>$product->price,
                        'discount'=>5,
                    ];
                    session()->put('cart',$getCart);
                    return redirect()->back()->with('message','Product Added to Cart.');
                }
                return redirect()->back()->with('message','Product Stock Out.');
            }




    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back()->with('message','Cart Clear');
    }

    public function deleteCart($product_id)
    {
        $updatedCart=session()->get('cart');
        unset($updatedCart[$product_id]);
        session()->put('cart',$updatedCart);

        return redirect()->back()->with('message','Item deleted.');
    }

    public function updateCart(Request $request,$product_id)
    {
        $getCart=session()->get('cart');

        $product=Product::find($product_id);
        if($product->quantity>=$request->quantity)
        {
            $getCart[$product_id]['quantity']=$request->quantity;
            $getCart[$product_id]['subtotal']=$request->quantity *$getCart[$product_id]['price'];

            session()->put('cart',$getCart);
            return redirect()->back()->with('message','Product Quantity Updated');
        }
        return redirect()->back()->with('message','Product Stock Out.');
    }


    public function checkout()
    {
        return view('frontend.pages.checkout');
    }

    public function orderPlace(Request  $request)
    {
//        dd($request->all());

        //step 1 create order

        $order=Order::create([
//           'user_id' =>auth()->user()->id,
           'user_id' =>1,
           'receiver_first_name' =>$request->first_name,
           'receiver_last_name' =>$request->last_name,
           'receiver_email' =>$request->email,
           'receiver_address' =>$request->address,
           'total' =>array_sum(array_column(session()->get('cart'),'subtotal')),
        ]);


        // step 2 insert product into order details
        foreach(session()->get('cart') as $product_id=>$cartData)
        {
            OrderDetails::create([
                'order_id'=>$order->id,
                'item_id'=>$product_id,
                'quantity'=>$cartData['quantity'],
                'unit_price'=>$cartData['price'],
                'subtotal'=>$cartData['subtotal'],
            ]);

            //stock update here
            $product=Product::find($product_id);
            $product->decrement('quantity',$cartData['quantity']);


        }
        session()->forget('cart');
        return redirect()->route('home')->with('message','Order Placed Successfully');



    }
}
