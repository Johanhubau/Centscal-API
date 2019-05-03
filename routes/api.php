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

Route::resource('events', 'Api\EventController');

//Route::get('/events/{event}', function(App\Event $event){
//    return $event;
//});
//OR
//Route::get('/events/{id}', function($id){
//    return App\Event::findOrFail($id);
//});


