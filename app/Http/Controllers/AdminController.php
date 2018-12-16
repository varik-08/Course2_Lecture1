<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Orders()
    {
        $orders = Order::simplePaginate(5);
        return view('orders.orders',compact('orders'));
    }

    public function Products()
    {
        $products = Product::simplePaginate(5);
        return view('products.products',compact('products'));
    }

    public function CreateProduct(Request $request)
    {
        Product::create([
            'name' => $request->get('name'),
        ]);
        session()->flash('status', 'Продукт создан!');
        return redirect()->back();
    }

    public function DeleteProduct($id)
    {
        Product::find($id)->delete();
        session()->flash('status','Продукт удален!');
        return redirect()->back();
    }
}
