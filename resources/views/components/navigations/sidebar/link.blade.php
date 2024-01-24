@props([
    'href' => '#',
    'active' => '',
])

<a
    href="{{ $href }}"
    class="flex items-center justify-start px-4 space-x-4 hover:underline h-12 transition duration-200 ease-in-out {{ (Str::contains(Route::currentRouteName(), $active)) ? 'bg-indigo-600 text-gray-50 hover:bg-indigo-800' : 'text-gray-600 hover:bg-indigo-200 hover:text-indigo-800' }}"
    {{ $attributes }}>
    {{ $slot }}
</a>
