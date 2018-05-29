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

    Route::group(['as' => 'cafe.' , 'prefix' => 'cafe'], function() {
        #Cafe Home
        Route::get('{cafename}','HomeController@indexCafe')->name('indexCafe');
        #aboutCafe
        Route::get('{cafename}/about','HomeController@aboutCafe')->name('aboutCafe');
        #Addcredit
        Route::group(['as' => 'addcredit.' , 'prefix' => '{cafename}/addcredit'], function() {
            Route::get('/indexuser','AddcreditController@index')->name('index');
            Route::get('/indexadmin','AddcreditController@indexAdmin')->name('indexAdmin');
            Route::post('post','AddcreditController@store')->name('post');
            Route::post('update','AddcreditController@update')->name('update');
        });
        #promotions
        Route::group(['as' => 'promotions.' , 'prefix' => '{cafename}/promotions'], function() {
            Route::get('/','PostsController@index')->name('index');
            Route::get('create','PostsController@create')->name('create');
            Route::post('posts','PostsController@store')->name('posts');
            Route::get('posts/{post}','PostsController@show')->name('post');
            Route::delete('destroy','PostsController@destroy')->name('destroy');
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

        #income
        Route::group(['as' => 'income.' , 'prefix' => '{cafename}/income'], function() {
            Route::get('/','IncomeController@index')->name('index');
            Route::post('create','IncomeController@create')->name('create');
        });

        #userinfo
        Route::group(['as' => 'usersinfo.' , 'prefix' => '{cafename}/usersinfo'], function() {
            Route::get('/','UsersinfoController@index')->name('index');
            Route::post('update','UsersinfoController@update')->name('update');
        });

        #editcafe
        Route::group(['as' => 'editcafe.' , 'prefix' => '{cafename}/editcafe'], function() {
            Route::get('/','EditcafeController@index')->name('index');
            Route::post('update','EditcafeController@update')->name('update');
        });
    });

});

#Profile
Route::get('/profile','ProfileController@index');
Route::get('/profile/provider','ProfileController@indexProvider');
Route::post('/profile','ProfileController@update');

#Provider
#Users Management
Route::get('/users_management','UsersmanagementController@index');
Route::post('/users_management/update','UsersmanagementController@update');
