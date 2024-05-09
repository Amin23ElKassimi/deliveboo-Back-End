<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\API\FoodItemController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\Orders\OrderController as OrdersOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::name('api.')->group(function () {
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/foodItems', [FoodItemController::class, 'index'])->name('apo.foodItem.index');
    Route::get('/foodItems/search', [FoodItemController::class, 'search'])->name('foodItem.search');
    Route::get('/foodItems/{foodItem}', [FoodItemController::class, 'show'])->name('foodItem.show');
});


Route::get('orders/generate', [OrdersOrderController::class, 'generate']);
Route::post('orders/make/payment', [OrdersOrderController::class, 'makePayment']);
