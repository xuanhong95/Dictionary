<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    //
    function getHomeView(){
    	return view ('pages.home');
    }
    function saveDatabase(){
    	$value = \Request::post('username');
    	dd($value);
    	$savevalue = \App\Test::where('name', '=', $value)->first();
    	if(!$savevalue){
    		$savevalue = new \App\Test();
    		$savevalue->name = $value;
    		$savevalue->save();
    	}
    }
}
