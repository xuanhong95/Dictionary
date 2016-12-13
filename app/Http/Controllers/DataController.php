<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DataController extends Controller
{
    function checkDatabase(){
    	$value = \Request::input('term');
    	$savevalue = \DB::table('tbl_edict')->where('word', '=', $value)->first();
    	if(!$savevalue){
    		return "Từ không tồn tại";
    	}
    	else{
    		return $value;
    	}	
    }



	function showMeaningEV($term){
		$savevalue = \DB::table('tbl_edict')->where('word', '=', $term)->first();
		$result = $savevalue->detail;
		return view('pages.result', compact('result', 'term'));
	}

    function showMeaningVE($term){
        $savevalue = \DB::table('tbl_edict')->where('word', '=', $term)->first();
        $result = $savevalue->detail;
        return view('pages.result', compact('result', 'term'));
    }

}
