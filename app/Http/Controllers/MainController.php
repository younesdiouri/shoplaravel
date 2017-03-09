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
        $cartItem = Cart::add($request->id, $request->name, 1, $request->price);
        Cart::associate($cartItem->rowId, Product::class);
 //http://andremadarang.com/implementing-a-shopping-cart-in-laravel/
        return redirect('/')->withSuccessMessage('Produit ajouté au panier!');
    }
}


