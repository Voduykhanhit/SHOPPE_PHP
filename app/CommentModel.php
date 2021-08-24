<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    protected $table = "tbl_comments";
    protected $primaryKey = "comments_id";
    
    public function reply(){
        return $this->hasMany('App/ReplyComment','comments_id','comments_id');
    }
}
