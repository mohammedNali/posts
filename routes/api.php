<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
    return $request->user();
});

// GET http://posts.test/api/posts
// Route::get('/posts', [PostController::class, 'index']);
// Route::get('/posts', [PostController::class, 'store']);


// Route::middleware('auth:sanctum')->group(function() {
Route::middleware('auth:api')->group(function() {

    // http://posts.test/api/have-middleware
    Route::get('/have-middleware', function() {
        return 'You have a sanctum middleware';
    });
    Route::apiResource('/posts', PostController::class);

    // http://posts.test/api/users
    Route::get('/users', [UserController::class,'index']);

});


// http://posts.test/api/generate-token
Route::get('/generate-token', function () {
    $user = User::first();
    return $user->createToken('token')->plainTextToken;
});

// http://posts.test/api/generate-api-token/11
Route::get('/generate-api-token/{id}', function($id) {
    $user = User::findOrFail($id);
    if(!$user->api_token) {
        $user->api_token = Str::random(60);
        $user->save();
    } 
    return $user->api_token;
});




