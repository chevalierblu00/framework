<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiPlaylistController;
use App\Http\Middleware\VerifyApiKey;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware([VerifyApiKey::class])->group(function () {
    Route::get('/playlists', [ApiPlaylistController::class, 'index']);
});