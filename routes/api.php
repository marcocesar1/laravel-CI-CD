<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('health', function () {
    return response()->json(['status' => 'ok']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::resource('posts', \App\Http\Controllers\PostsController::class);

Route::get('test', function () {
    \App\Jobs\CreateRandomOrdersJob::dispatch();
    
    return response()->json(['status' => 'ok']);
});