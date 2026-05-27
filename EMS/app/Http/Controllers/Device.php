<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class Device extends Controller
{
    

    public function Device()
    {
        $title="Device";
        return view('Device.device',compact('title'));

       
    }


}