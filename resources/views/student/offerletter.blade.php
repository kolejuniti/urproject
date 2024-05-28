<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>Surat Tawaran</title>
</head>
<body>
    @foreach($students as $student)
    <div class="container">
        <div class="mt-3">
            <label for="">{{ date('d-M-Y') }}</label>
        </div>
        <div class="mt-3">
            <label for="">{{ $student->name }}</label>
        </div>
    </div>
    @endforeach
</body>
</html>