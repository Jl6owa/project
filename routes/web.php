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
/*
Route::get('/', function () {
    return view('welcome');
});*/






Route::group(['middleware' => ['auth']], function()
{
   Route::get('/addhome/create', 'HomesController@create');
   Route::post('/addhome/create/save', 'HomesController@store')->name('store');;

   Route::get('/success','HomesController@success');
   Route::get('/adview/{id}/edit','HomesController@editAd');





Route::post('/adview/book/{id}', 'HomesController@bookdate');



Route::get('/home', 'HomesController@loadmyads');

Route::put('/home/booking/', 'HomesController@acceptbooking');

Route::put('/adview/{id}/edit/save', 'HomesController@savechanges');

Route::put('/home/editad/{id}', 'HomesController@homeEdit');



Route::put('/home/updateuser/{action}', 'HomesController@updateuser');     
});

Auth::routes();
Route::get('/searchres/{id}','GuestController@searchres');
Route::get('/searchres/','GuestController@searchresall');
Route::get('/','GuestController@getcities');
Route::get('/adview/{id}','GuestController@searchresAd');






