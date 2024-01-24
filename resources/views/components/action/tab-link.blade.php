@props([
    'href' => '#',
    'active' => 'false'
])

<a
    href="{{ $href }}"
    class="text-xs uppercase px-4 py-3 hover:bg-indigo-100 hover:text-indigo-800 transition duration-200 ease-in-out rounded-sm {{ ($active == "true") ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-500' }}">
        {{ $slot }}
</a>
