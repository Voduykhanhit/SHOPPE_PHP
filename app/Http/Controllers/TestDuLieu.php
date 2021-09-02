<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class TestDuLieu extends Controller
{
    public function getTest()
    {
        $test = "12345678DUYKHANH";
        Storage::put('public/client_id.txt',$test);
    }
    public function getUser($id,$ok)
    {
        return redirect()->route('TestThu');
    }
    public function getView(){
        return view('test');
    } 
    public function ChoiThu(){
        echo "ok";
    }
}
