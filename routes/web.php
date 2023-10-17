<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\MenuController;
use App\Http\Controllers\Account\CategoryController;
use App\Http\Controllers\Account\DashboardController;
use App\Http\Controllers\Account\CoffeeShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Mapke something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account', 'as' => 'account.', 'middleware' => ['auth']], function(){
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::resource('/category', CategoryController::class);
    Route::resource('/menus', MenuController::class);
    Route::resource('/coffeeshop', CoffeeShopController::class);
    Route::resource('/coffeeshop.menu', MenuController::class);
});