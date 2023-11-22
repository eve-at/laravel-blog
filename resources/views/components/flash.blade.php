@if (session()->has('success'))
    <div x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="fixed bottom-0 right-3 bottom-3 bg-blue-500 text-white py-2 px-4 text-sm rounded-xl"
    >
        <p>{{ session('success') }}</p>
    </div>
@endif