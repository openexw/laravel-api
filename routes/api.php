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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers\v1'], function ($api) {
        $api->get("news", "NewsController@index");
        $api->get("news/{id}", "NewsController@show");
        $api->post("user/login", "AuthController@login");
        $api->post("user/register", "AuthController@register");

        $api->group(['middleware'=>'jwt.auth'], function ($api) {
            $api->get("user/me", "AuthController@profile");
        });
    });
});
