<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmails;
use App\Mail\CreateOrder;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class UserController extends Controller
{
    public function index()
    {
        if (!Cache::has('products')) {
            $products = Product::all();
            Cache::forever('products', $products);
        }
        $products = Cache::get('products');


        return view('welcome', compact('products'));
    }

    public function CreateOrder(Request $request)
    {
        $email = Order::where('email', $request->get('email'))->status(0)->value('email');

        Order::create([
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'product_id' => $request->get('product_id'),
        ]);

        if (!$email) {
            SendEmails::dispatch($request->get('email'));//->delay(3600);
        }

        session()->flash('success', 'Спасибо за заказ');
        return redirect()->back();
    }
}
