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
Route::get('/{id?}', function (\Illuminate\Http\Request $request,$id=null) {
dd($request->hasValidSignature());
    return view('welcome');
})->name('haha')->middleware(\Illuminate\Routing\Middleware\ValidateSignature::class);

