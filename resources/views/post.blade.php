@extends("layout")

@section("content")
    <article>
        <h1>{{ $post->title }}</h1>
        
        <p>
            By <a href="/authors/{{ $post->user_id }}">{{ $post->user->username }}</a> in <a href="#">{{ $post->category->name }}</a>
        </p>

        <div>
            {!! $post->body !!}
        </div>
    </article>
    <a href="/"><< Back</a>
@endsection