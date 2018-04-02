<?php
#Auth/register
Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');

#login/logout
Route::get('/login','SessionsController@create');
Route::post('/login','SessionsController@store');
Route::get('/logout','SessionsController@destroy');

Route::group([], function() {
    #Home
    Route::group([], function() {
        Route::get('/','HomeController@index')->name('home');
        Route::get('/about','HomeController@about');
    });

    #Cafe Home
    Route::group(['as' => 'cafe.' , 'prefix' => 'cafe'], function() {
        Route::get('{cafename}','HomeController@indexCafe')->name('indexCafe');

        #promotions
        Route::group(['as' => 'promotions.' , 'prefix' => '{cafename}/promotions'], function() {
            Route::get('/','PostsController@index')->name('index');
            Route::get('create','PostsController@create')->name('create');
            Route::post('posts','PostsController@store')->name('posts');
            Route::get('posts/{post}','PostsController@show')->name('post');
        #comment
            Route::post('posts/{post}/comments','CommentsController@store')->name('comments');
        });

    });

    Route::group([], function() {

    });


});


// #promotions
// Route::get('/post/{cafename}','PostsController@index');
// Route::get('/posts/create','PostsController@create');
// Route::post('/posts','PostsController@store');
// Route::get('/posts/{post}','PostsController@show');


#Profile Info
Route::get('/profile','ProfileController@index');
Route::post('/profile','ProfileController@update');

#Addcredit
Route::get('/addcredit','AddcreditController@index');

#Booking
Route::get('/booking','BookingController@index');
Route::get('/booking/cancle','BookingController@cancle');

#Edit Seat
Route::get('/editseat','EditseatController@index');
