@extends('components.layout')

@section('content')
    @include('components.post-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if(!$posts->count())
            <p class="text-center">No posts yet. Please comme back later</p> 
        @else
            @include('components.post-card', [
                'article' => $posts[0],
                'isMain' => true,
            ])

            <div class="lg:grid lg:grid-cols-6">
                @foreach($posts->skip(1) as $post)
                    @include('components.post-card', [
                        'article' => $post,
                        'class' => $loop->iteration < 3 ? 'col-span-3' : 'col-span-2'
                    ])
                @endforeach
            </div>
        @endif
    </main>
@endsection