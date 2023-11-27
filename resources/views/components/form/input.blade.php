@props(['name', 'type' => 'text'])

<x-form.container>
    <x-form.title name="{{ $name }}" />

    <input type="{{ $type }}" 
        class="border border-gray-400 p-2 w-full" 
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name) }}"
        required
    />

    <x-form.error name="{{ $name }}" />
</x-form.container>