<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>{{ $title ?? 'Laporan' }}</title>
    <!--Tailwind css-->
       <link rel="stylesheet" href="{{ asset('public/assets/css/tailwind.css') }}">
</head>
<body class="container_laporan-body" onload="window.print()">
    {{ $slot }}
</body>
</html>