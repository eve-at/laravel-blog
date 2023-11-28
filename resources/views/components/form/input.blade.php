@props(['name'])

<x-form.container>
    <x-form.title name="{{ $name }}" />

    <input 
        class="border border-gray-400 p-2 w-full" 
        name="{{ $name }}"
        id="{{ $name }}"
        required
        {{ $attributes(['type' => 'text', 'value' => old($name)]) }}
    />

    <x-form.error name="{{ $name }}" />
</x-form.container>