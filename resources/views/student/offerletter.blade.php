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
        <div class="col-sm-10">
            <div class="mt-3">
                <label for="">{{ date('d-M-Y') }}</label>
            </div>
            <div class="mt-3 mb-3">
                <label for="">{{ $student->name }}</label>
            </div>
            <div>
                <label for="">{{ $student->address1 }}</label>
            </div>
            <div>
                <label for="">{{ $student->address2 }}</label>
            </div>
            <div>
                <label for="">{{ $student->postcode }},&nbsp;</label>
                <label for="">{{ $student->city }}</label>
            </div>
            <div>
                <label for="">{{ $student->state }}</label>
            </div>
            <div class="mt-3 mb-3">
                <label for="">Saudara / Saudari,</label>
            </div>
            <div class="mb-3">
                <label for="">TAWARAN KEMASUKAN KE PROGRAM AKADEMIK KOLEJ UNITI SESI <strong>JULAI 2024/2025</strong></label>
            </div>
            <div class="mb-3">
                <label for=""><strong>TAHNIAH</strong> dan <strong>SUKACITA</strong> di maklumkan, saudara / saudari layak untuk mengikuti pengajian bagi program</label>
            </div>
            <div class="row">
                @foreach ( $studentprograms as $studentprogram )
                <div class="col-sm-1">
                    <label for="">{{ $loop->iteration }}.</label>
                </div>
                <div class="col-sm-11">
                    <label for="">{{ $studentprogram->program }}</label>
                </div>
                @endforeach
            </div>
            <div class="mt-3 mb-3">
                <label for="">Untuk pengetahuan saudara / saudari, program yang layak adalah program akademik yang dikendalikan oleh <strong>KOLEJ UNITI di PERSIARAN UNITI VILLAGE, TANJUNG AGAS, 71250, PORT DICKSON, NEGERI SEMBILAN</strong>. Setelah memenuhi semua keperluan, saudara / saudari akan <strong>DIANUGERAHKAN DIPLOMA OLEH KOLEJ UNITI ATAU UiTM DAN UTM</strong>.</label>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>