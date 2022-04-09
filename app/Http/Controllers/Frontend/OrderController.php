<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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


            //if not empty but product exist step 2
                if(array_key_exists($product_id,$getCart))
                {
                    //increment quantity of existing product.
                    ++$getCart[$product_id]['quantity'];
                    session()->put('cart',$getCart);
                    return redirect()->back()->with('message','Product Quantity Updated');
                }else
                {
                    //if not empty but product is different step 3
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







    }
}
