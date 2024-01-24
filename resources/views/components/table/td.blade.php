
@props([
    'align' => 'text-left',
])

<td
    {{ $attributes->merge(['class' => 'p-4 text-xs ' . $align]) }}>
    {{ $slot }}
</td>
