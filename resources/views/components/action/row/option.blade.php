@props([
    'type' => 'submit',
])

@if ($type == "submit")
    <button
        type="submit"
        {{ $attributes->merge(['class' => 'flex items-center space-x-4 px-4 py-1 hover:bg-gray-100 w-full']) }}>
        {{ $slot }}
    </button>
@endif

@if ($type == "button")
    <button
        type="button"
        {{ $attributes->merge(['class' => 'flex items-center space-x-4 px-4 py-1 hover:bg-gray-100 w-full']) }}>
        {{ $slot }}
    </button>
@endif

@if ($type == "link")
    <a
        {{ $attributes->merge(['class' => 'flex items-center space-x-4 px-4 py-1 hover:bg-gray-100 w-full']) }}>
        {{ $slot }}
    </a>
@endif
