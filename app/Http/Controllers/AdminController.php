<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $productName = Product::find($id)->name;
        if(Product::find($id)->delete()){
            Log::channel('deleted')->info($productName);
            session()->flash('status','Продукт удален!');
        }

        return redirect()->back();
    }
}
