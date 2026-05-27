<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CssProjectController extends Controller
{
    public function dashboard(Request $request)
    {
        $is_access_token = 0;
        $access_token = ""; 
        if($request->session()->has('access_token')){
            $is_access_token = 1;
            $access_token = $request->session()->get('access_token');
        }
        $title='Dashboard';
        return view('dashboard.home',compact('title','is_access_token','access_token'));
    }

    public function report()
    {
        $title='Report';
        return view('report.homepage.main',compact('title'));
    }


}