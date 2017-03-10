<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout(Request $request)
    {
        $token = $request->input('stripeToken');

        //Retriieve cart information
       // $cart = Cart::where('user_id',Auth::user()->id)->first();
        $items = Cart::content();
       // $items = $cart->cartItems;
        $total= Cart::total();
        if(
        Auth::user()->charge($total*100, [
            'source' => $token,
            'receipt_email' => Auth::user()->email,
        ])){

            $order = new Order();
            $order->total_paid= $total;
            $order->user_id=Auth::user()->id;
            $order->save();

            foreach($items as $item){
                $orderItem = new OrderItem();
                $orderItem->order_id=$order->id;
                $orderItem->product_id='0111';
                $orderItem->file_id='4215123';
                $orderItem->save();

                Cart::destroy();
            }
            return redirect('/order/'.$order->id);

        }else{
            return redirect('/cart');
        }

    }

    public function index(){
        $orders = Order::where('user_id',Auth::user()->id)->get();

        return view('order.list',['orders'=>$orders]);
    }

    public function viewOrder($orderId){
        $order = Order::find($orderId);
        return view('order.view',['order'=>$order]);
    }
}

