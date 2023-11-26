<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index() 
    {
        return view('posts.index', [
            'posts' => Post::latest('published_at')
                ->whereNotNull('published_at')
                ->where('published_at', '<', now())
                ->filter(request(['search', 'category', 'author']))
                ->paginate(6)
                ->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
            'currentCategory' => Category::where('slug', request('category'))->first()
        ]);  
    }

    public function show(Post $post) 
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store() 
    {
        $attributes = request()->validate([
            'title'   => ['required', 'min:20', 'max:255'],
            'slug'    => ['required', 'min:20', 'max:255', Rule::unique('posts', 'slug')],
            'excerpt' => ['required', 'max:255'],
            'body'    => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['published_at'] = now();

        Post::create($attributes);

        return redirect('/');
    }
}
