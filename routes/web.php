<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     // return '<h1>Main Page</h1>';
//     return view('posts');
// });

// Route::get('/', [PostController::class, 'index']);

// Route::get('/posts/index', [PostController::class, 'index']);
// Route::get('/posts/create', [PostController::class, 'create']);
// Route::get('/posts/edit', [PostController::class, 'edit']);
// Route::get('/posts/show', [PostController::class, 'show']);

Route::get('/', function() {
    $posts = Post::orderBy('title', 'desc')->get();
    return view('posts.index', [
        'posts' => $posts
    ]);
});

Route::resource('posts', PostController::class);





