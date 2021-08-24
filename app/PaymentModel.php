<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    protected $table = "tbl_payment";
    protected $primaryKey = "payment_id";
    public function order(){
        return $this->hasMany('App\OrderModel','payment_id','payment_id');
    }
}
