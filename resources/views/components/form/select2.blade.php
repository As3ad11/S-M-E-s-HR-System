@props([
    'name' => 'field1',
])

<select name="{{ $name }}" {{ $attributes }}  class="bg-white w-full border border-gray-100 text-sm py-2 px-1 rounded hover:cursor-pointer font-semibold">
    {{ $slot }}
</select>
