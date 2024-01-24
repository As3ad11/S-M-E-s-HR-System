@props([
    'type' => 'button',
    'accent' => 'primary',
])

@php
    $styles = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-800',
        'secondary' => 'text-gray-800 hover:bg-gray-200',
        'success' => 'bg-green-600 text-white hover:bg-green-800',
    ];
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => $styles[$accent] . ' text-xs rounded-sm transition duration-200 ease-in-out']) }}>
    {{ $slot }}
</button>
