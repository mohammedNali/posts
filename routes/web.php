<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function() {

        // Auth::loginUsingId(1);
    
        $posts = Post::orderBy('title', 'desc')->get();
        return view('posts.index', [
            'posts' => $posts
        ]);
    });
    
    Route::resource('posts', PostController::class);
    Route::get('/posts/create', [PostController::class, 'create'])
            ->middleware('auth')->name('posts.create');
    
    
    
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
    })->name('login');
    
    Route::post('/register', [AuthController::class, 'register'])
            ->name('registerUser');
    Route::post('/login', [AuthController::class, 'login'])
            ->name('loginUser');
    
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    
    
    Route::get('/{locale}', function (string $locale) {
        if (! in_array($locale, ['en', 'es', 'fr', 'ar'])) {
            abort(400);
        }
     
        App::setLocale($locale);
     
        return __('msg.greeting');
    });
});


// Route::get('/dashboard', function ($id) {
//     return view('layouts.dashboard');
// })->can("view-dashboard");

// Route::post('/posts', [PostController::class, 'store'])
//     //    ->can("create")
//        ->name('posts.store');



