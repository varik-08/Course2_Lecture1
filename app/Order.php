<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['product_id', 'email', 'phone'];
    protected $visible = ['product_id', 'email', 'phone'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
