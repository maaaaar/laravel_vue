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

Route::apiResource("rol", "Api\RolController");
Route::delete("/rol/{id}", "Api\RolController@destroy");
Route::post("/rol", "Api\RolController@store");
Route::get("/rol", "Api\RolController@index");

Route::apiResource("usuari", "Api\UsuariController");
Route::get("/usuari", "Api\UsuariController@index");