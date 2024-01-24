@props([
    'accent' => 'primary',
])

@php
    $color = [
        'primary' => 'border-indigo-400 bg-zinc-100',
        'warning' => 'border-yellow-400 bg-zinc-100',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'px-8 py-6 border-l-4 rounded ' . $color[$accent]]) }}>
    {{ $slot }}
</div>
