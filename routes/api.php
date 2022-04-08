<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::post('v1/register', 'Auth\RegisterController@register');
Route::post('v1/login', 'Auth\LoginController@login');

Route::middleware('auth:api')->get('v1/user', function (Request $request) {
    return $request->user();
});

//no auth
//Route::get('v1/person', 'api\v1\PersonController@index');

//auth
Route::middleware('auth:api')->get('v1/person', 'api\v1\PersonController@index');

Route::middleware('auth:api')->post('v1/logout', 'Auth\LoginController@logout');
