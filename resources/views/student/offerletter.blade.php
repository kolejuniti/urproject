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

    <style>
        /* General styles for A4 view */
        body {
            font-size: 12px;
            background: #fff;
        }
        .container-fluid {
            max-width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm 15mm;
            box-sizing: border-box;
            background: #fff url('https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/letter_head/offer_letter.jpg') no-repeat top center;
            background-size: cover;
        }
        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }
            body, html {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 0;
                overflow: visible;
            }
            .container-fluid {
                width: 100%;
                min-height: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                background: #fff url('https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/letter_head/offer_letter.jpg') no-repeat top center;
                background-size: cover;
            }
            .navbar, .footer {
                display: none !important;
            }
            .container-fluid, .row, .col-sm-2, .col-sm-10, main {
                page-break-inside: avoid;
                page-break-after: avoid;
            }
        }
    </style>

</head>
<body class="bg-white">
    @foreach($students as $student)
    <div class="container-fluid">
        <div class="col-sm-9 text-start">
            <div class="mt-3">
                <label for="">{{$student->offer_letter_date ? \Carbon\Carbon::parse($student->offer_letter_date)->format('d-m-Y') : '' }}</label>
            </div>
            <div class="mt-3 mb-3">
                <label for="" class="text-uppercase">{{ $student->name }}</label>
            </div>
            <div>
                <label for="" class="text-uppercase">{{ $student->address1 }}</label>
            </div>
            <div>
                <label for="" class="text-uppercase">{{ $student->address2 }}</label>
            </div>
            <div>
                <label for="">{{ $student->postcode }},&nbsp;</label>
                <label for="" class="text-uppercase">{{ $student->city }}</label>
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
            @if ($student->location_id === 1)
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
            @else
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Kampus</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>Lot 1911, Kampus Kijang</strong></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">&nbsp;</label>
                </div>
                <div class="col-sm-9">
                    <label for="">&nbsp;&nbsp;<strong>Jalan Pantai Cahaya Bulan</strong></label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="">&nbsp;</label>
                </div>
                <div class="col-sm-9">
                    <label for="">&nbsp;&nbsp;<strong>15350, Kota Bharu, Kelantan</strong></label>
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
            @endif
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Tarikh</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>{{$student->register_letter_date ? \Carbon\Carbon::parse($student->register_letter_date)->format('d-m-Y') : '' }}</strong></label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label for="">Masa</label>
                </div>
                <div class="col-sm-9">
                    <label for="">:&nbsp;<strong>10:00 Pagi</strong></label>
                </div>
            </div>
            <div class="mb-3">
                <label for="">Sila hubungi pegawai yang bertugas kami iaitu <strong>{{ $student->advisor }}</strong> di talian <strong>{{ $student->phone }}</strong> untuk sebarang pertanyaan dan pengesahan.</label>
            </div>
            <div class="border px-2 py-2 col-sm-12">
                <div class="mb-3">
                    <label for="" class="fw-bold">PENTING</label>
                </div>
                <ol class="list-group-numbered">
                    <li class="list-group-item mb-1">Keputusan muktamad tawaran adalah tertakluk kepada keputusan peperiksaan SPM atau yang setarafnya.</li>
                    <li class="list-group-item mb-1">Tuan dikehendaki membawa bersama:
                        <ol class="list-group-numbered">
                            <li class="list-group-item mb-1">6 keping gambar berwarna berukuran passport dan 1 salinan dokumen berikut yang telah disahkan:
                                <ol class="list-group-numbered">
                                    <li class="list-group-item mb-1">Kad Pengenalan (Pelajar, ibu dan bapa)</li>
                                    <li class="list-group-item mb-1">Sijil Kelahiran (Pelajar, ibu dan bapa)</li>
                                    <li class="list-group-item mb-1">Slip Keputusan SPM</li>
                                    <li class="list-group-item mb-1">Slip gaji atau surat pengesahan pendapatan (ibu/bapa)</li>
                                </ol>
                            </li>
                            <li class="list-group-item mb-1">Sertakan pembayaran yuran pendaftaran secara tunai atau cek/bank draft/wang pos ke akaun Kolej UNITI Sdn Bhd di akaun CIMB no akaun 8601062464 bagi tujuan pengesahan tempat dan bantuan pengajian atau bayaran boleh dibuat terus di Kolej UNITI.
                            </li>
                        </ol>
                    </li>
                    <li class="list-group-item mb-1">Ini adalah surat tawaran bersyarat, tidak boleh digunakan bagi sebarang permohonan pinjaman atau lain-lain.
                    </li>
                    <li class="list-group-item mb-1">Surat tawaran sebenar untuk tujuan permohonan pinjaman MARA, PTPTN dan lain-lain akan diberikan kepada pelajar semasa pendaftaran.
                    </li>
                </ol>
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>