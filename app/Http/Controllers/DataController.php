<?php

namespace App\Http\Controllers;
include "simple_html_dom.php";
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\History;

class DataController extends Controller
{
  function checkDatabase(){
    $value = \Request::input('term');
    $type = \Request::input('searchtype');
    $savevalue = DB::table('anh_viet')->where('word', '=', $value)->first();  
  
    if(!$savevalue){
      return "Từ không tồn tại";
    }
    else{
      return $value;
    }
  }	


  function mobileJsonEN($term){
    $savevalue = DB::table('anh_viet')->where('word', '=', $term)->first();
    if(!$savevalue){
      return "Từ không tồn tại";
    }
    else{
      $returnJSON = "";
      $search_query = $term;
      $search_query = urlencode( $search_query );
      $html11 = file_get_html( "https://www.google.com/search?q=".$search_query."&tbm=isch" );
      $images = $html11->find('img');
      if($images)
        $image = $images[0];
      $returnJSON = '{"content":'. json_encode($savevalue->content).',"image":'. json_encode($image."") . '}';
      return $returnJSON;
    }
  }

  function showMeaningEV($term){
    $savevalue = DB::table('anh_viet')->where('word', '=', $term)->first();
    $result = $savevalue->content;

    $search_query = $term;
    $search_query = urlencode( $search_query );
    $html11 = file_get_html( "https://www.google.com/search?q=".$search_query."&tbm=isch" );
    $images = $html11->find('img');
    if($images){
      $image = $images[0];
    }

    if(\Auth::check()){
        $uid=+\Auth::user()->id;
        History::create(['userId'=>$uid,
                                'word'=>$term]);
        $history_record=DB::table('histories')->where('userId','=',$uid)->get();
  /*      if(count($history_record)==5){
          DB::table('histories')->where('userId','=',$uid)->first()->delete();
      }*/
      return view('pages.ev_result', compact('result', 'term', 'image','history_record'));
    }

    return view('pages.ev_result', compact('result', 'term', 'image'));
  }


}
