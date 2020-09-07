<?php

use App\Domain\Chat\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CHAT Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "api" middleware group. Now create something great!
|
*/

# public
Route::group(['middleware' => ['api']], function () {

});

# auth
Route::group(['middleware' => ['api', 'auth:api']], function () {

    # user
//    Route::patch('/account/last-channel', Controllers\Account\LastChannel\UpdateController::class);

    # channels
//    Route::get('/channels', Controllers\Channel\ListController::class);
//    Route::post('/channels', Controllers\Channel\CreateController::class);
//    Route::get('/channels/{channel}', Controllers\Channel\ReadController::class);
//    Route::patch('/channels/{channel}', Controllers\Channel\UpdateController::class);
//    Route::delete('/channels/{channel}', Controllers\Channel\DeleteController::class);

    # channel messages
//    Route::get('/channels/{channel}/messages', Controllers\Channel\Message\ListController::class);
//    Route::post('/channels/{channel}/messages', Controllers\Channel\Message\CreateController::class);
//    Route::get('/channels/{channel}/messages/{message}', Controllers\Channel\Message\ReadController::class);
//    Route::patch('/channels/{channel}/messages/{message}', Controllers\Channel\Message\UpdateController::class);
//    Route::delete('/channels/{channel}/messages/{message}', Controllers\Channel\Message\DeleteController::class);

});
