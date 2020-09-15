<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix'=>'auth','namespace'=>'Auth'],function (){

    Route::post('login','LoginController');

    Route::get('me','MeController');

    Route::post('logout','logoutController') ;

    Route::post('/register','RegisterController');

    Route::get('forget/{user}','ForgetPasswordController');
});
Route::resource('snippets','Snippets\SnippetsController');

Route::put('snippets/{snippet}/step/{step}','Snippets\StepsController@update');

Route::post('snippets/{snippet}/step','Snippets\StepsController@store');

Route::delete('snippets/{snippet}/{step}','Snippets\StepsController@destroy');

Route::get('snippet/search','Snippets\SnippetsController@search') ;

Route::group(['prefix'=>'me','namespace'=>'Me'],function (){
    Route::get('snippets','SnippetsController@index') ;
});

Route::group(['prefix'=>'user/{user}','namespace'=>'User'],function (){

    Route::get('','UserController@show') ;
    Route::put('','UserController@update') ;
    Route::get('snippets','SnippetController@index') ;

});
