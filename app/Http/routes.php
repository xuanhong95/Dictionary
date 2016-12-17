<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('welcome');
});
Route::get('/home','PagesController@getHomeView');

Route::any('testpage', ['middleware' => 'cors', function()
{
    return "sucess";
}]);

Route::any('/page', 'DataController@checkDatabase');
Route::any('en/result/{term}',[ 'as' => 'term', 'uses' => 'DataController@showMeaningEV']);
Route::any('vn/result/{term}',[ 'as' => 'term', 'uses' => 'DataController@showMeaningVE']);

Route::post('test', function()
{
	return 'Success! ajax in laravel 5';
});

define('APP_HOST','http://viecbonus.dev');