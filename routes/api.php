<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ShoppingListController;
use App\Http\Controllers\API\ShoppingItemController;
use App\Http\Controllers\AuthController;

Route::prefix('v1')->group(function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::apiResource('shopping-lists', ShoppingListController::class)
            ->missing(function (Request $request) {
                return response()->json(['message' => 'Not found'], 404);
            });
        Route::apiResource('shopping-lists.items', ShoppingItemController::class)
            ->missing(function (Request $request) {
                return response()->json(['message' => 'Not found'], 404);
            });
    });
});
