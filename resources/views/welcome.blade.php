<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <x-navbar />
    <x-jombotron />
    <x-specialties />
    <x-socialproof />
    <x-footer />
    <main>
        {{-- {{ $slot }} --}}
    </main>

    @stack('scripts')
</body>
</html>