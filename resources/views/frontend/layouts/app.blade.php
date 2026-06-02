<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>{{ $title }}</title> --}}
    <x-frontend.seo-meta />
    <link rel="stylesheet" href="{{ asset('css/front-end-custom.css') }}">
     @vite(['resources/css/app.css', 'resources/js/app.js'])

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex flex-col">
    
    @include('frontend.layouts.navbar')

    <main class="flex-grow">
       <div class="pt-22 md:pt-24 pb-12">
         @yield('content')
       </div>
    </main>

    @include('frontend.layouts.footer')

    @stack('scripts')
</body>
</html>
