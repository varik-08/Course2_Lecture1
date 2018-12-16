<?php

namespace App\Http\Controllers;

use App\Mail\CreateOrder;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    public function CreateOrder(Request $request)
    {
        $order = Order::create([
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'product_id' => $request->get('product_id'),
        ]);

        Mail::to($order->email)->send(new CreateOrder($order->product()->withTrashed()->first()->name));
        session()->flash('success','Спасибо за заказ');
        return redirect()->back();
    }
}
