<button
    type="button"
    x-on:click="tab = '{{ $target }}'"
    x-bind:class="{ 'text-indigo-600 border-b-2 border-indigo-600': tab === '{{ $target }}', 'text-gray-500': tab !== '{{ $target }}' }"
    class="text-xs uppercase px-4 py-3 hover:bg-indigo-100 hover:text-indigo-800 transition duration-200 ease-in-out rounded-sm">
        {{ $slot }}
</button>
