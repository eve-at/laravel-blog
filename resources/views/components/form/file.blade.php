@props(['name'])

<x-form.container>
    <x-form.title name="{{ $name }}" />

    <input type="file" 
        class="border border-gray-400 p-2 w-full" 
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes }}
    >

    <x-form.error name="{{ $name }}" />
</x-form.container>