@extends('components.layout')

@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
        <h1 class="text-center font-bold text-xl">Create a post</h1>

        <form action="/admin/post/store" method="POST" class="mt-10" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" />
            <x-form.input name="slug" />
            <x-form.file name="thumbnail" />

            <x-form.container>
                <x-form.title name="category" />
                
                <select name="category_id" id="category">
                    @foreach (\App\Models\Category::all() as $category)
                        <option 
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >{{ $category->name }}</option>
                    @endforeach
                </select>

                <x-form.error name="category" />
            </x-form.container>
            
            <x-form.textarea name="excerpt" />
            <x-form.textarea name="body" />
            <x-form.submit /> 
        </form>
    </main>    
@endsection