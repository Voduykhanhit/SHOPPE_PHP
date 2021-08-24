<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    
    // Category 1-n
    public function category(){
        return $this->beLongsTo('App\CategoryModel','category_id','category_id');
    }
}
