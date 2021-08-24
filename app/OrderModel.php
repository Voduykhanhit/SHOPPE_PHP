<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $table = "tbl_order";
    protected $primaryKey = "order_id";

    public function customer(){
        return $this->beLongsTo('App\CustomerModel','customer_id','customer_id');
    }
    public function shipping(){
        return $this->beLongsTo('App\ShippingModel','shipping_id','shipping_id');
    }
    public function payment(){
        return $this->beLongsTo('App\PaymentModel','payment_id','payment_id');
    }
}
