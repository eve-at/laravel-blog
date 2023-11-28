@extends('components.layout')

@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
        <h1 class="text-center font-bold text-xl">Edit Post: {{ $post->title }}</h1>

        <form action="/admin/posts/{{ $post->id }}" method="POST" class="mt-10" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="title" value="{{ old('title', $post->title) }}" />
            <x-form.input name="slug" value="{{ old('slug', $post->slug) }}" />

            <div class="mb-6">
                <x-form.file name="thumbnail" />
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="" class="rounded-xl" width="500">
            </div>

            <x-form.container>
                <x-form.title name="category" />
                
                <select name="category_id" id="category">
                    @foreach (\App\Models\Category::all() as $category)
                        <option 
                            value="{{ $category->id }}"
                            {{ $post->category_id == $category->id ? 'selected' : '' }}
                        >{{ $category->name }}</option>
                    @endforeach
                </select>

                <x-form.error name="category" />
            </x-form.container>
            
            <x-form.textarea name="excerpt">
                {{ old('excerpt', $post->excerpt) }}
            </x-form.textarea>
            <x-form.textarea name="body">
                {{ old('body', $post->body) }}
            </x-form.textarea>

            <x-form.submit value="Update" /> 
        </form>
    </main>    
@endsection