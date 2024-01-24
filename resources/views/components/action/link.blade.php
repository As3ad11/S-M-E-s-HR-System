@props([
    'href' => '#',
    'accent' => 'primary',
])

@php
    $styles = [
        'primary' => 'bg-indigo-600 text-white hover:bg-indigo-800',
        'secondary' => 'text-gray-800 hover:bg-gray-200',
        'classic-primary' => 'text-indigo-600 hover:text-indigo-800 hover:underline',
    ];
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => $styles[$accent] . ' text-xs rounded-sm transition duration-200 ease-in-out']) }}>
    {{ $slot }}
</a>
