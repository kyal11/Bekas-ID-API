<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
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

// Auth Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Unauthorized Access Route
Route::get('/', fn () => response()->json(['status' => false, 'message' => 'Invalid Token'], 401))->name('login');

// Authenticated Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('current-user', [AuthController::class, 'currentUser']);
    Route::delete('logout', [AuthController::class, 'logout']);

    Route::prefix('users')->group(function () {
        Route::post('/', [UserController::class, 'update']);
        Route::delete('{id}', [UserController::class, 'destroy']);
        Route::get('{id}/review', [UserController::class, 'getUserWithReview']);
    });

    Route::prefix('product')->group(function () {
        Route::post('/', [ProductController::class, 'store']);
        Route::post('{id}', [ProductController::class, 'update']);
        Route::delete('{id}', [ProductController::class, 'destroy']);
        Route::delete('{idProduct}/image/{idImage}', [ProductController::class, 'deleteProductImageById']);
        Route::post('{id}/offer', [OfferController::class, 'store']);
        Route::put('{idProduct}/offer/{idOffer}/accept', [OfferController::class, 'setAcceptOffer']);
        Route::put('{idProduct}/offer/{idOffer}/reject', [OfferController::class, 'setRejectOffer']);
        Route::get('{idProduct}/offer', [OfferController::class, 'getAllOffers']);
        Route::get('{idProduct}/offer/{idOffer}', [OfferController::class, 'getDetailOffer']);
        Route::put('{idProduct}/offer/{idOffer}', [OfferController::class, 'updateOffer']);
        Route::delete('{idProduct}/offer/{idOffer}', [OfferController::class, 'deleteOffer']);
    });

    Route::prefix('chat')->group(function () {
        Route::post('/', [ChatController::class, 'store']);
        Route::get('offer/{id}', [ChatController::class, 'getChatByOffer']);
        Route::get('{idUser}/{idSeller}', [ChatController::class, 'getChatBetweenUserAndSeller']);
        Route::delete('offer/{id}', [ChatController::class, 'destroyByOffer']);
        Route::delete('{idUser}/{idSeller}', [ChatController::class, 'destroyByUserAndSeller']);
    });

    Route::post('review', [ReviewController::class, 'store']);
    
    Route::prefix('category')->group(function () {
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('{id}', [CategoryController::class, 'update']);
        Route::delete('{id}', [CategoryController::class, 'destroy']);
    });
});

// Public Routes
Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::get('category', [CategoryController::class, 'index']);
Route::get('category/{id}', [CategoryController::class, 'show']);
Route::get('category/{id}/product', [CategoryController::class, 'getProductByCategory']);
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::get('users/{id}/review', [UserController::class, 'getUserWithReview']);
Route::get('user/{id}/rating', [UserController::class, '']);