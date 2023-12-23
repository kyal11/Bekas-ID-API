<?php

use App\Http\Controllers\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/', function () {
    return response()->json([
        'status' => false,
        'message' => 'Invalid Token'
    ], 401);
})->name('login');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('current-user', [AuthController::class, 'currentUser']);
    Route::delete('logout', [AuthController::class, 'logout']);

    Route::post('users', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);

    Route::post('product', [ProductController::class, 'store']);
    Route::post('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);
    Route::delete('product/{idProduct}/image/{idImage}', [ProductController::class, 'deleteProductImageById']);

    Route::post('product/{id}/offer', [OfferController::class, 'store']);
    Route::put('/product/{idProduct}/offer/{idOffer}/accept', [OfferController::class, 'setAcceptOffer']);
    Route::put('/product/{idProduct}/offer/{idOffer}/reject', [OfferController::class, 'setRejectOffer']);
    Route::get('/product/{idProduct}/offer', [OfferController::class, 'getAllOffers']);
    Route::get('/product/{idProduct}/offer/{idOffer}', [OfferController::class, 'getDetailOffer']);
    Route::put('/product/{idProduct}/offer/{idOffer}', [OfferController::class, 'updateOffer']);
    Route::delete('/product/{idProduct}/offer/{idOffer}', [OfferController::class, 'deleteOffer']);

    Route::post('chat', [ChatController::class, 'store']);
    Route::get('chat/offer/{id}' , [ChatController::class, 'getChatByOffer']);
    Route::get('chat/{idUser}/{idSeller}', [ChatController::class, 'getChatBetweenUserAndSeller']);
    Route::delete('chat/offer/{id}' , [ChatController::class, 'destroyByOffer']);
    Route::delete('chat/{idUser}/{idSeller}', [ChatController::class, 'destroyByUserAndSeller']);

    Route::post('review', [ReviewController::class, 'store']);
});


Route::get('product', [ProductController::class, 'index']);
Route::get('product/{id}', [ProductController::class, 'show']);

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::get('users/{id}/review', [UserController::class, 'getUserWithReview']);
Route::get('user/{id}/rating', [UserController::class, '']);