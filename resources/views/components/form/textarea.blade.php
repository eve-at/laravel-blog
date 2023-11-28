@props(['name'])

<x-form.container>
    <x-form.title name="{{ $name }}" />

        <textarea 
            name="{{ $name }}" 
            class="w-full text-sm p-5 focus:outline-none focus:ring" 
            rows="6" 
            cols="10" 
            required
        >{{ $slot ?? old($name)}}</textarea>

    <x-form.error name="{{ $name }}" />
</x-form.container>