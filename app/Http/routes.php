<?php

use Illuminate\Http\Request;

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

Route::auth();

Route::get("/test", function() {
	$path = "public/Attachments\phpCFDF.tmp";
	return view("test", ["path" => $path]);
});

Route::get('/home', 'HomeController@index');

Route::get("/createChannel", "channelController@create");

Route::get("/channels/search", "channelController@search");

Route::post("/channel", "channelController@store");

Route::get("/channels", "channelController@index");

Route::get("/channel/{channel}", "channelController@show");

Route::delete("/channel/{channel}", "channelController@destroy");

Route::post("/subscribe/{channel}", "subscriptionsController@store");

Route::delete("/unsubscribe/{channel}", "subscriptionsController@destroy");

Route::post("post/{channel}", "postController@store");

Route::delete("post/{post}", "postController@destroy");

Route::get("download/", function(Request $request) {
	
	$name = $request->name;

	return response()->download($name);
})->name("download");