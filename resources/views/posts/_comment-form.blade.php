@guest
    <p class="font-semibold">
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Log in</a> or <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a> to comment out!
    </p>
@else
    <form action="/posts/{{ $post->slug }}/comment" method="POST" class="border border-gray-200 p-6 rounded-xl">
        @csrf

        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{ auth()->user()->id }}" width="60" height="60" alt="" class="rounded-xl">

            <h2 class="ml-3">
                Leave a comment
            </h2>
        </header>

        <div class="mt-3">
            <textarea name="body" class="w-full text-sm p-5 focus:outline-none focus:ring" rows="6" cols="10" placeholder="Share your thoughts" required></textarea>
            
            @error('body')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-3 border-t border-gray-200">
            <button type="submit" class="mt-3 bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600">Submit</button>
        </div>
    </form>
@endguest