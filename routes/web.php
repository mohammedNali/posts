<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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

Route::get('/manytomany', function() {
    $categories = [1, 2, 3];

    $post = new Post();
    $post->title = 'my fourth post';
    $post->body = 'this is the body for the fourth post';
    $post->user_id = 11;
    $post->save();
    $post->categories()->attach($categories);
});


// http://posts.test/register
Route::get('/register', function() {
    return view('auth.register');
});
Route::get('/login', function() {
    return view('auth.login');
});

Route::post('/register', [AuthController::class, 'register'])
        ->name('registerUser');
Route::post('/login', [AuthController::class, 'login'])
        ->name('loginUser');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');







