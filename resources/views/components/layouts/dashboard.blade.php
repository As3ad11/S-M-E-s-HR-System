@props([
    'title' => config('app.name'),
])

<x-layouts.base title="{{ $title }}">
    <x-navigations.topbar/>

    <main class="min-h-screen pt-10 pl-56 relative">
        <x-navigations.sidebar/>

        <div class="p-2">
            {{ $slot }}
        </div>
    </main>
</x-layouts.base>
