<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = "tbl_customers";
    protected $primaryKey = "customer_id";
    public function order(){
        return $this->hasMany('App\OrderModel','customer_id','customer_id');
    }
}
