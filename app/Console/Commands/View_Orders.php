<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\Product;

class View_Orders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Admin:view_orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'View all orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $headers = ['Email', 'Phone', 'Product'];
        $orders = Order::all();
        $i = 0;

        foreach ($orders as $order)
        {
            $data[$i] = [
                $order->email,
                $order->phone,
                $order->product()->withTrashed()->first()->name,
            ];
            $i++;
        }
        $this->table($headers, $data);
    }
}
