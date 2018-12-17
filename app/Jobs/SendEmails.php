<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreateOrder;
use App\Order;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $email;
    public $tries = 5;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = Order::email($this->email)->status(0)->get();
        $countProducts = $orders->count();
        $products = [];
        foreach ($orders as $order) {
            $products[] = $order->product()->withTrashed()->first()->name;
        }

        $productsStr = implode("\n", array_unique($products));

        Mail::to($this->email)->send(new CreateOrder($countProducts, $productsStr));

        $orders->map->update(array('status' => 1));
    }
}
