<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetailsModel extends Model
{
    protected $table = "tbl_order_details";
    protected $primaryKey = "order_details_id";
}
