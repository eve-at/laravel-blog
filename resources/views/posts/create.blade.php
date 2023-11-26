@extends('components.layout')

@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
        <h1 class="text-center font-bold text-xl">Create a post</h1>

        <form action="/admin/post/store" method="POST" class="mt-10">
            @csrf

            <div class="mb-6">
                <label for="title" class="block mb-2 uppercase font-bold text-xs text-gray-400">
                    Title
                </label>

                <input type="text" 
                    class="border border-gray-400 p-2 w-full" 
                    name="title"
                    id="title"
                    value="{{ old('title')}}"
                    required
                >

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="slug" class="block mb-2 uppercase font-bold text-xs text-gray-400">
                    Slug
                </label>

                <input type="text" 
                    class="border border-gray-400 p-2 w-full" 
                    name="slug"
                    id="slug"
                    value="{{ old('slug')}}"
                    required
                >

                @error('slug')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="block mb-2 uppercase font-bold text-xs text-gray-400">
                    Category
                </label>

                <select name="category_id" id="category_id">
                    @foreach (\App\Models\Category::all() as $category)
                        <option 
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >{{ $category->name }}</option>
                    @endforeach
                </select>

                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mt-3">
                <label for="excerpt" class="block mb-2 uppercase font-bold text-xs text-gray-400">
                    Excerpt
                </label>

                <textarea 
                    name="excerpt" 
                    class="w-full text-sm p-5 focus:outline-none focus:ring" 
                    rows="6" 
                    cols="10" 
                    required
                >{{ old('excerpt')}}</textarea>
                
                @error('excerpt')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-3">
                <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-400">
                    Body
                </label>

                <textarea 
                    name="body" 
                    class="w-full text-sm p-5 focus:outline-none focus:ring" 
                    rows="6" 
                    cols="10" 
                    required
                >{{ old('body')}}</textarea>
                
                @error('body')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <button 
                    type="submit"
                    class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                >
                    Submit
                </button>
            </div>
        </form>
    </main>    
@endsection