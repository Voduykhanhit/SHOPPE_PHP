<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'tbl_category_product';
    protected $primaryKey = 'category_id';

    public function product(){
        return $this->hasMany('App\ProductModel','category_id','category_id');
    }
}
