@extends('components.layout')

@section('content')
    <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
        <h1 class="text-center font-bold text-xl">Register</h1>

        <form action="/register" method="POST" class="mt-10">
            @csrf

            <x-form.input name="name" />
            <x-form.input name="username" />
            <x-form.input name="email" type="email" />
            <x-form.input name="password" type="password" />
            <x-form.submit /> 
        </form>
    </main>    
@endsection