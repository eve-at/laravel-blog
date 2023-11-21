@php 
    $isMain = $isMain ?? false;
    $post = $post ?? null;    
    $class = $class ?? '';    
@endphp

@if ($post)
    <article
        class="{{ $class }} transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
        <div class="py-6 px-5 {{ $isMain ? 'lg:flex' : '' }}">
            <div class="{{ $isMain ? 'flex-1 lg:mr-8' : '' }}">
                <a href="/posts/{{ $post->slug }}">
                    <img src="/images/image{{ rand(1, 5) }}.jpg" alt="Blog Post illustration" class="rounded-xl">
                </a>
            </div>

            <div class="flex flex-col justify-between {{ $isMain ? 'flex-1' : 'mt-8' }}">
                <header class="{{ $isMain ? 'mt-8 lg:mt-0' : '' }}">
                    <div class="space-x-2">
                        @include('components.category-button', [
                            'category' => $post->category
                        ])
                    </div>

                    <div class="mt-4">
                        <h1 class="text-3xl">
                            <a href="/posts/{{ $post->slug }}">
                                {{ $post->title }}
                            </a>
                        </h1>

                        <span class="mt-2 block text-gray-400 text-xs">
                            Published <time>{{ $post->created_at->diffForHumans() }}</time>
                        </span>
                    </div>
                </header>

                <div class="text-sm mt-4">
                    {!! $post->excerpt !!}
                </div>

                <footer class="flex justify-between items-center mt-8">
                    <div class="flex items-center text-sm">
                        <a href="/?author={{ $post->author->username }}">
                            <img src="/images/avatar.jpg" width="60" height="60" alt="{{ $post->author->name }} avatar">
                        </a>
                        <div class="ml-3">
                            <a href="?author={{ $post->author->username }}">
                                <h5 class="font-bold">{{ $post->author->name }}</h5>
                            </a>
                        </div>
                    </div>

                    <div>
                        <a href="/posts/{{ $post->slug }}"
                        class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                        >Read More</a>
                    </div>
                </footer>
            </div>
        </div>
    </article>
@endif