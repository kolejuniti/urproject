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
        <div class="col-sm-12">
            <div class="mt-3">
                <label for="">{{ \Carbon\Carbon::parse($student->offer_letter_date)->format('d-m-Y') }}</label>
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
                <label for="">Saudara/i,</label>
            </div>
            <div class="mb-3">
                <label for="">Sukacita dimaklumkan bahawa anda ditawarkan tempat untuk mengikuti kursus pengajian pilihan di Peringkat Diploma.</label>
            </div>
            <div class="row mb-3">
                @foreach ( $studentprograms as $studentprogram )
                <div class="col-sm-3">
                    <label for="">Program</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>{{ $studentprogram->program }}</strong></label>
                </div>
                <div class="col-sm-3">
                    <label for="">Penganugerahan</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>MQA & JPA</strong></label>
                </div>
                <div class="col-sm-3">
                    <label for="">Tempoh</label>
                </div>
                <div class="col-sm-9 mb-1">
                    <label for="">:&nbsp;<strong>3 Tahun</strong></label>
                </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="">Sila hadir bagi sesi pendaftaran di:</label>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Kampus</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>Kampus UNITI, UNITI Village</strong></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">&nbsp;</label>
                </div>
                <div class="col-sm-9">
                    <label for="">&nbsp;&nbsp;<strong>Tanjung Agas, 71250 Port Dickson</strong></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">&nbsp;</label>
                </div>
                <div class="col-sm-9">
                    <label for="">&nbsp;&nbsp;<strong>Negeri Sembilan Darul Khusus</strong></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Tempat</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>Pejabat Pentadbiran Kolej UNITI</strong></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Tarikh</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>{{ \Carbon\Carbon::parse($student->register_letter_date)->format('d-m-Y') }}</strong></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Masa</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>10:00 Pagi</strong></label>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>