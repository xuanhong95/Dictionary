<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DataController extends Controller
{
    function saveDatabase(){
    	$value = \Request::input('username');
    	$savevalue = \App\Test::where('name', '=', $value)->first();
    	if(!$savevalue){
    		$savevalue = new \App\Test();
    		$savevalue->name = $value;
    		$savevalue->save();
    	}
    }
    function getDatabase(){
    	$value=Test::all()->name;
    	return view('home',['name'=>$value]);
    }
}
