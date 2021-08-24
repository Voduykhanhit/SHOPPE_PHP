<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistrictModel extends Model
{
    protected $table = "tbl_quanhuyen";
    protected $primaryKey = "maqh";
    
    public function Tinh(){
        return $this->beLongsTo('App\CityModel','matp','matp');
    }
    
}
