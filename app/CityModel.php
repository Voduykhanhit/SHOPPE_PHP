<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityModel extends Model
{
    protected $table = "tbl_tinhthanhpho";
    protected $primaryKey = "matp";
    
    public function quanhuyen(){
        return $this->hasMany('App\DistrictModel','matp','matp');
    }
    public function xaphuong(){
        return $this->hasManyThrough('App\CommuneModel','App\DistrictModel','matp','maqh','matp');
    }
}
