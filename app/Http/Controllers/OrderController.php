<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use DB;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::all();
        $orders = Order::all();
        return view('orders.index',['products' => $products, 'orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        DB::transaction(function() use($request){

            //Order Modal
            $orders = new Order;
            $orders->name = $request->customer_name;
            $orders->address = $request->customer_address;
            $orders->save();
             $order_id = $orders->id;

            //Order Details Modal
            if (is_array($request->product_id)) {
            for ($product_id = 0; $product_id < count($request->product_id) ; $product_id++) { 
                $order__details = new Order_Detail;
                $order__details->order_id = $order_id;
                $order__details->product_id = $request->product_id [$product_id];
                $order__details->quantity = $request->quantity [$product_id];
                $order__details->unitprice = $request->price [$product_id];
                $order__details->amount = $request->paid_amount [$product_id];
                $order__details->discount = $request->discount [$product_id];
                $order__details->save();
            }
         }

            $order__details = new Order_Detail;
            $order__details->amount = $request->paid_amount;
            //Transaction Modal
            $transaction = new Transaction;
            $transaction->order_id = $order_id;
            $transaction->user_id = auth()->user()->id;
            $transaction->balance = $request->balance;
            $transaction->paid_amount = $request->paid_amount;
            $transaction->payment_method = $request->payment_method;
            // $transaction->transac_amount = isset($request->transac_amount) ? $request->transac_amount : 0;
            $transaction->transac_amount =  $order__details->amount - $request->balance;
            $transaction->transac_date = date('Y-m-d');
            $transaction->save();
            
            //Last Order History
            $products = Product::all();
            $order__details = Order_Detail::where('order_id',$order_id)->get();
            $orderedBy = Order::where('id',$order_id)->get();

            return view('orders.index',
            [
                'products' => $products,
                'order__details' =>$order__details,
                'customer_orders' => $orderedBy
            ]);

        });
        
        return back()->with("Product Orders Fails to Insert");
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
