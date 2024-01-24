@props([
    'label' => '',
    'id' => 'field1',
    'name' => 'field1',
    'value' => '',
])

<div class="flex flex-col">
    @if ($label != "")
        <label for="{{ $id }}" class="text-xs font-light text-gray-400">{{ $label }}</label>
    @endif
    <textarea id="{{ $id }}" name="{{ $name }}" {{ $attributes }} class="px-2 py-1 text-xs border-b hover:border-indigo-300 focus:border-indigo-500 focus:outline-none transition duration-200 ease-in-out bg-transparent" required>{{ $value }}</textarea>
    @error($id) <p class="text-xs font-light text-red-600">{{ $message }}</p> @enderror
</div>
