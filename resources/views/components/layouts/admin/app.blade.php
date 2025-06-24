<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="{{ asset('public/node_modules/bootstrap-icons/font/bootstrap-icons.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" href="{{ asset('public/node_modules/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Metis Menu-->
    <link rel="stylesheet" href="{{ asset('public/node_modules/metismenu/dist/metisMenu.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">

       <!--Tailwind css-->
       <link rel="stylesheet" href="{{ asset('public/assets/css/tailwind.css') }}">
</head>

<body class="antialiased" >
    <x-layouts.admin.navbar />
    <x-layouts.admin.sidebar />0
    <section class="section-content">
      
        {{ $slot }}
    </section>


    <script src="{{ asset('public/assets/js/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('public/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/node_modules/metismenu/dist/metisMenu.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="{{ asset('public/assets/js/app.js') }}"></script>
    
    @stack('js')
</body>

</html>
