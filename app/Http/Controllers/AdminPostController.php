<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create() 
    {
        return view('admin.posts.create');
    }

    public function store() 
    {

        $attributes = $this->validatePost();

        $attributes['user_id'] = auth()->id();
        $attributes['published_at'] = now();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('images');

        Post::create($attributes);

        return redirect('/')->with('success', 'Post was successfully created');
    }

    public function edit(Post $post) 
    {
        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post) 
    {
        $attributes = $this->validatePost($post);

        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('images');
        }

        $post->update($attributes);

        return redirect('/')->with('success', 'Post updated');
    }

    public function destroy(Post $post) 
    {
        $post->delete();

        return redirect()->route('adminPosts')->with('success', 'Post deleted');
    }

    protected function validatePost(?Post $post = null) 
    {
        $post ??= new Post;

        return request()->validate([
            'title'     => ['required', 'min:20', 'max:255'],
            'slug'      => ['required', 'min:20', 'max:255', Rule::unique('posts', 'slug')->ignore($post)],
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'excerpt'   => ['required', 'max:255'],
            'body'      => ['required'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }
}
