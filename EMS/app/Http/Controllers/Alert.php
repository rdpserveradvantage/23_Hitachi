<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class Alert extends Controller
{
    

    public function Alert()
    {
        $title="Alert";
        return view('Alert.alert',compact('title'));

       
    }


}