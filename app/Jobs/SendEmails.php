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
        $orders = Order::where('email', "varik-08@mail.ru")->status(0)->get();
        $data = "Количество: " . $orders->count();
        $data = $data . "\nТовары:\n";
        $array = [];
        foreach ($orders as $order) {
            array_push($array, $order->product()->withTrashed()->first()->name);
        }
        foreach (array_unique($array) as $item) {
            $data = $data . $item . "\n";
        }

        Mail::to($this->email)->send(new CreateOrder($data));

        foreach ($orders as $order) {
            $order->update([
                'status' => 1,
            ]);
        }

    }
}
