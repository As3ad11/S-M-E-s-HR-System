@props([
    'label' => '',
    'id' => 'field1',
    'name' => 'field1',
    'type' => 'text',
])

<div class="flex flex-col">
    @if ($label != "")
        <label for="{{ $id }}" class="text-xs font-light text-gray-400">{{ $label }}</label>
    @endif
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" {{ $attributes }} class="appearance-none px-2 py-1 text-xs border-b hover:border-indigo-300 focus:border-indigo-500 focus:outline-none transition duration-200 ease-in-out bg-transparent" required>
    @error($id) <p class="text-xs font-light text-red-600">{{ $message }}</p> @enderror
</div>
