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
        #Addcredit
        Route::get('{cafename}/addcredit','AddcreditController@index')->name('addcredit');

        #promotions
        Route::group(['as' => 'promotions.' , 'prefix' => '{cafename}/promotions'], function() {
            Route::get('/','PostsController@index')->name('index');
            Route::get('create','PostsController@create')->name('create');
            Route::post('posts','PostsController@store')->name('posts');
            Route::get('posts/{post}','PostsController@show')->name('post');
        #comment
            Route::post('posts/{post}/comments','CommentsController@store')->name('comments');
        });

        #Booking
        Route::group(['as' => 'booking.' , 'prefix' => '{cafename}/booking'], function() {
            Route::get('/','BookingController@index')->name('index');
            Route::post('/','BookingController@update')->name('update');
            Route::get('cancle','BookingController@cancle')->name('cancle');
        });

        #Edit Seat
        Route::group(['as' => 'editseat.' , 'prefix' => '{cafename}/editseat'], function() {
            Route::get('/','EditseatController@index')->name('index');
            Route::post('/','EditseatController@update')->name('update');
        });
    });


    Route::group([], function() {

    });


});

#Profile
Route::get('/profile','ProfileController@index');
Route::post('/profile','ProfileController@update');

// #Edit Seat
// Route::get('/editseat','EditseatController@index');
