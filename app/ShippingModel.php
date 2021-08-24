<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingModel extends Model
{
    protected $table = "tbl_shipping";
    protected $primaryKey = "shipping_id";
    public function order(){
        return $this->hasMany('App\OrderModel','shipping_id','shipping_id');
    }
    
}
