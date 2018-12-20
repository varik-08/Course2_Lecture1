<?php

namespace App\Observers;

use App\Mail\SendEmailEventProduct;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $this->overwriteProductCache();
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        $orders = $product->orders()->get();
        foreach ($orders->unique('email') as $order)
        {
            Mail::to($order->email)->send(new SendEmailEventProduct($product->name, "Удален"));
        }

        $this->overwriteProductCache();
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        $orders = $product->orders()->get();

        foreach ($orders->unique('email') as $order)
        {
            Mail::to($order->email)->send(new SendEmailEventProduct($product->name, "Восстановлен"));
        }

        $this->overwriteProductCache();
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }

    public function overwriteProductCache()
    {
        Cache::forget('products');
        Cache::forever('products', Product::all());
        //Cache::forget('productsWithTrashed');
        //Cache::forever('products', Product::withTrashed()->get());
    }
}
