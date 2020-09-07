<?php

use Illuminate\Support\Facades\Route;
use App\Domain\Infrastructure\Controllers;

/*
|--------------------------------------------------------------------------
| INFRASTRUCTURE Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "api middleware group. Now create something great!
|
*/

# public
Route::group(['middleware' => ['api']], function () {

    # misc
    Route::get('/ping', Controllers\Ping\ReadController::class);

});

# public - resolve.project
Route::group(['middleware' => ['api']], function () {

    # auth
    Route::post('/login', Controllers\Auth\LoginController::class);
    Route::post('/register', Controllers\Auth\RegisterController::class);

});

# auth
Route::group(['middleware' => ['api', 'auth:api']], function () {

    # account
    Route::get('/account', Controllers\Account\ReadController::class);

});
