@props(['value' => 'Submit'])
<x-form.container>
    <button 
        type="submit"
        class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
    >
        {{ $value }}
    </button>
</x-form.container>