<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class User extends Controller
{
    

    public function Logout()
    {
        $title="Logout";
        return view('User.logout',compact('title'));

        // return redirect(url('/'));


        // \Cookie::forget('refresh_token');
        // \Cookie::forget('access_token');
        // \Cookie::forget('org_id');

        // \Cookie::queue(\Cookie::forget('refresh_token'));
        // \Cookie::queue(\Cookie::forget('access_token'));
        // \Cookie::queue(\Cookie::forget('org_id'));
        
        // var_dump(Cookie::get('refresh_token'));
    }
    
    public function User()
    {
        $title="User";
        return view('User.user',compact('title'));
    }
	
	public function AccessToken(Request $request){
		$access_token = $request['access_token'];
		return 1;
	} 


}