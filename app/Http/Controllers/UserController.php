<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    public function CreateOrder(Request $request)
    {
        Order::create([
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'product_id' => $request->get('product_id'),
        ]);
        session()->flash('success','Спасибо за заказ');
        return redirect()->back();
    }
}
