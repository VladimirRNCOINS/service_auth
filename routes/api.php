<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthAccessController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/api_access', [AuthAccessController::class, 'api_access']);
Route::group(["prefix" => "auth"], function () {
    Route::get('/error_401', [AuthAccessController::class, 'error_401']);
});