<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = array_sum(array_column(session()->get('cart'),'subtotal')); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->first_name.' '.$request->first_name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '01616626263';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Life Style";
        $post_data['product_category'] = "Fashion";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $order=Order::create([
//           'user_id' =>auth()->user()->id,
            'user_id' =>auth()->user()->id,
            'status' =>'pending',
            'tran_id' => $post_data['tran_id'],
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
        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        session()->forget('cart');
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
       $order_details=Order::where('tran_id',$tran_id)->first();

        if ($order_details->status == 'pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $order_details->update([
                   'status'=>'success'
               ]);

            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $order_details->update([
                    'status'=>'failed'
                ]);

            }
        }

        return redirect()->route('home');
    }



    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details=Order::where('tran_id',$tran_id)->first();
        if ($order_details->status == 'pending') {
            $order_details->update([
                'status'=>'failed'
            ]);
        }

        return redirect()->route('home');

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details=Order::where('tran_id',$tran_id)->first();
        if ($order_details->status == 'pending') {
            $order_details->update([
                'status'=>'cancel'
            ]);
        }

        return redirect()->route('home');


    }


}
