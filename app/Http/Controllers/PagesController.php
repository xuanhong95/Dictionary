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
}
