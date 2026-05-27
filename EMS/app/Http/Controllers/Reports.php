<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Reports extends Controller
{
    

    public function reports()
    {
        $title='Report';
        return view('reports.main',compact('title'));
    }


}