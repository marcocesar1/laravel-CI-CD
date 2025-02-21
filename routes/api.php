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

Route::get('orders', function () {
    $orders = \App\Models\Order::with('user', 'items')->paginate(100);

    return response()->json([
        'data' => $orders,
    ]);
});