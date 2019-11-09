<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/sign',function (){
   echo \Illuminate\Support\Facades\URL::temporarySignedRoute('haha',now()->addSeconds(20),[
       'id' => '444'
   ]) ;
});
Route::get('/haha',function (){
    echo "enen";
});

$router->any('/apihelper/{model}/{method}/{primary?}',"ApiHelperController@index");
