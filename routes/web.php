<?php

Route::get('/', 'HomeController@getIndex');
//////////////// AUTH ////////////////
Route::get('/signin', 'Auth\AuthController@getSignin');
Route::post('/signin', 'Auth\AuthController@postSignin');
Route::get('/signup', 'Auth\AuthController@getSignup');
Route::post('/signup', 'Auth\AuthController@postSignup');
Route::get('/signout', 'Auth\AuthController@getSignout');

/////////////////// USER ACTIVATION /////////////////
Route::get('user/activation/{token}', 'Auth\AuthController@userActivation');

/////////// PROFILE CONTROLLER ///////////
Route::get('@{username}', 'ProfileController@getUpdate');
Route::get('@{username}/create', 'ProfileController@getCreate');
Route::post('@{username}/store', 'ProfileController@postCreate');
Route::post('@{username}/edit/store', 'ProfileController@postUpdate');
Route::post('ajax/add_new_price', 'ProfileController@postNewPrice');
Route::get('ajax/delete_price/{price_id}', 'ProfileController@deletePrice');