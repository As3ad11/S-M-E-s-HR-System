@props([
    'title' => config('app.name'),
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- Metas --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Title --}}
        <title>{{ $title }}</title>

        {{-- Font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        {{-- Tailwind CSS --}}
        <script src="https://cdn.tailwindcss.com"></script>

        {{-- Alpine JS --}}
        <script src="//unpkg.com/alpinejs" defer></script>

        {{-- Styles --}}
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

        {{-- ChartJS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    </head>
    <body class="antialiased bg-zinc-50 text-gray-800">
        {{-- Content --}}
        {{ $slot }}

        {{-- Scripts --}}
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
