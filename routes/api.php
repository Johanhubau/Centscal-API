<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('associations', 'Api\AssociationController');

// Authentication routes
Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::get('/events', 'Api\EventController@index');
Route::get('events/{event}', 'Api\EventController@show');


Route::group(['middleware' => 'auth:api'], function(){

    Route::put('events/{event}', 'Api\EventController@update')->middleware('can:update,event');
    Route::post('/events', 'Api\EventController@store');
    Route::delete('events/{event}', 'Api\EventController@destroy')->middleware('can:delete,event');

    Route::post('details', 'Api\UserController@details');
    Route::post('logout', 'Api\UserController@logout');
});

Route::get('notAuth', function(){
    return response()->json(['error'=>'notAuth'], 401);
})->name('notAuth');


//Route::get('/events/{event}', function(App\Event $event){
//    return $event;
//});
//OR
//Route::get('/events/{id}', function($id){
//    return App\Event::findOrFail($id);
//});


