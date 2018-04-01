<?php
#Home
Route::get('/','HomeController@index')->name('home');
Route::get('/about','HomeController@about');

#promotions
Route::get('/post','PostsController@index');
Route::get('/posts/create','PostsController@create');
Route::post('/posts','PostsController@store');
Route::get('/posts/{post}','PostsController@show');

#comment
Route::post('/posts/{post}/comments','CommentsController@store');

#Auth/register
Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');

#login/logout
Route::get('/login','SessionsController@create');
Route::post('/login','SessionsController@store');
Route::get('/logout','SessionsController@destroy');

#Profile Info
Route::get('/profile','ProfileController@index');
Route::post('/profile','ProfileController@updated');
#Addcredit
Route::get('/addcredit','AddcreditController@index');

#Booking
Route::get('/booking','BookingController@index');
Route::get('/booking/cancle','BookingController@cancle');
