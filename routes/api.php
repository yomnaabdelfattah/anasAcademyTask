<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use Illuminate\Support\Facades\Auth;

Route::post('/token', function (Request $request) {
    // Validate email and password
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to authenticate the user
    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    // Fetch the authenticated user
    $user = Auth::user();

    // // Generate Sanctum token
    $token = $user->createToken('api-token')->plainTextToken;

    // Return the token in response
    return response()->json([
        'token' => $token,
        'user' => $user,
    ]);
});

use App\Http\Controllers\Api\ProductController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
});

use App\Http\Controllers\PaymentController;

Route::post('/payment', [PaymentController::class, 'payment'])->middleware('auth:sanctum');
