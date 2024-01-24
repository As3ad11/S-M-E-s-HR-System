@props([
    'align' => 'text-left',
])

<th
    {{ $attributes->merge(['class' => 'p-4 ' . $align]) }}>
    {{ $slot }}
</th>
