<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticatable
{
    protected $table = "tbl_admin";
    protected $primaryKey = "admin_id";

    public function Reply(){
        return $this->hasMany('App\ReplyComment','admin_id','admin_id');
    }
    public function getAuthPassword(){
        return $this->admin_password;
    }
}
