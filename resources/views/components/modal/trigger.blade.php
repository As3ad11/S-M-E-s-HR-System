@props([
    'target' => 'modal-example',
])

<span
    x-data="{id:'{{ $target }}'}"
    x-on:click="bsd(true), $dispatch('modal-overlay',{id})">
    {{ $slot }}
</span>
