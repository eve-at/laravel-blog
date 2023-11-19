<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('posts', [
        //'posts' => Post::all()
        'posts' => Post::latest('published_at')->with(['category', 'author'])->get()
    ]);  
});

Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post' => $post
    ]);   
});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => Post::latest('published_at')
                        ->with(['category', 'author'])
                        ->where('category_id', $category->id)
                        ->get()
    ]);
});

Route::get('/authors/{user}', function (User $user) {
    return view('posts', [
        'posts' => Post::latest('published_at')
                    ->with(['category', 'author'])
                    ->where('user_id', $user->id)
                    ->get()
    ]);
});
