<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() 
    {
        return view('posts.posts', [
            'posts' => Post::latest('published_at')
                ->filter(request(['search', 'category', 'author']))
                ->paginate(6)
                ->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
            'currentCategory' => Category::where('slug', request('category'))->first()
        ]);  
    }

    public function show(Post $post) 
    {
        return view('posts.post', [
            'post' => $post,
        ]);
    }
}
