<?php

namespace App\Http\Controllers;

use DebugBar\RequestIdGenerator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('main.index',['products' => $products]);

    }
    public function store(Request $request)
    {
        $qty = 1;
        $cartItem = Cart::add($request->id, $request->name, 1, $request->price);
          Cart::associate($cartItem->rowId, Product::class);
        // $cartItem->associate('Product');
        $request->session()->flash('alert-success', 'Produit bien ajouté.');

        return redirect('/');
    }
   public function cart()
   {
       return view('main.cart');
   }
}


