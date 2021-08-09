<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'cors'], function(){

    //Auth Admin
    Route::post('admin/login', 'AdminController@login');
    Route::post('admin/register', 'AdminController@register');
    Route::get('admin/logout', 'AdminController@logout');


    //GET DATA
    Route::get('aboutus', 'AboutUsController@index');
    Route::get('homepage', 'HomepageController@index');
    Route::get('productcosmetic', 'ProductCosmeticController@index');
    Route::get('productfashion', 'ProductFashionController@index');
    Route::get('profile', 'ProfileController@index');



    Route::group(['middleware' => 'jwt'], function(){

        //GET TEST Only
        Route::get('admin', 'AdminController@index');

        //POST
        Route::post('aboutus', 'AboutUsController@store');
        Route::post('homepage', 'HomepageController@store');
        Route::post('productcosmetic', 'ProductCosmeticController@store');
        Route::post('productfashion', 'ProductFashionController@store');
        Route::post('profile', 'ProfileController@store');


        //PUT
        Route::put('admin', 'AdminController@update');
        Route::put('aboutus/{id}', 'AboutUsController@update');
        Route::put('homepage/{id}', 'HomepageController@update');
        Route::put('productcosmetic/{id}', 'ProductCosmeticController@update');
        Route::put('productfashion/{id}', 'ProductFashionController@update');
        Route::put('profile/{id}', 'ProfileController@update');


        // DELETE
        // Route::delete('aboutus/{id}', 'AboutUsController@delete');
        // Route::delete('homepage/{id}', 'HomepageController@delete');
        Route::delete('productcosmetic/{id}', 'ProductCosmeticController@delete');
        Route::delete('productfashion/{id}', 'ProductFashionController@delete');
        // Route::delete('profile/{id}', 'ProfileController@delete');

    });

});