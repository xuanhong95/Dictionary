<?php

namespace App\Http\Controllers;
include "simple_html_dom.php";
use Illuminate\Http\Request;
use App\Http\Requests;

class DataController extends Controller
{
    function checkDatabase(){
    	$value = \Request::input('term');
    	$savevalue = \DB::table('anh_viet')->where('word', '=', $value)->first();
    	if(!$savevalue){
    		return false;
    	}
    	else{
    		return $value;
    	}	
    }


    function showMeaning($term){
      $savevalue = \DB::table('anh_viet')->where('word', '=', $term)->first();
      $result = $savevalue->content;
      $search_query = $term;
      $search_query = urlencode( $search_query );
      $html11 = file_get_html( "https://www.google.com/search?q=".$search_query."&tbm=isch" );
      $images = $html11->find('img');
      if($images)
        $image = $images[0];
      return view('pages.result', compact('result', 'term', 'image'));
  }
}
