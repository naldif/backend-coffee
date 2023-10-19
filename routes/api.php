<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CoffeeshopController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Api Campaign
 */
Route::get('/coffeeshop', [CoffeeshopController::class, 'index']);
Route::get('/coffeeshop/{cites_id}', [CoffeeshopController::class, 'showByCity']);
Route::get('/coffeeshop/detail/{slug}', [CoffeeshopController::class, 'showBySlug']);

Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/{id}', [MenuController::class, 'show']);
