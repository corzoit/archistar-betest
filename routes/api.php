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

// Route::middleware('api.auth')->group(function(){
//     Route::post('/properties', 'PropertyController@create');
// });

Route::middleware('api.auth')->group(function(){
    Route::post('/properties', 'PropertyController@create');
    Route::post('/properties/{property_id}/analytics', 'AnalyticController@create');
    Route::put('/properties/{property_id}/analytics/{analytic_id}', 'AnalyticController@update');
    Route::get('/properties/{property_id}/analytics', 'AnalyticController@search');

    Route::get('/stats', 'StatsController@search');
});

