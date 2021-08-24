<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    protected $table = "tbl_replycomment";
    protected $primaryKey = "reply_id";

    public function comment(){
        return $this->beLongsTo('App\CommentModel','comments_id','comments_id');
    }
    public function admin(){
        return $this->beLongsTo('App\AdminModel','admin_id','admin_id');
    }
}
