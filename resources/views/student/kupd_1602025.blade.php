<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kampus | UNITI Port Dickson</title>
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" as="style" onload="this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">
    </noscript>

    <!-- Scripts -->
    <!-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .card {
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .badge {
            font-size: 0.7rem;
            padding: 0.35em 0.65em;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <!-- Top Bar -->
    <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: #AB0006;">
        <div class="container">
            <div class="row col-12">
                <div class="col-md-4">
                    <label class="text-white">{{ __('NO. PERAKUAN PENDAFTARAN : DK036(N)') }}</label>
                </div>
                <div class="col-md-2">
                    <label class="text-white"><i class="bi bi-telephone-fill"></i>&nbsp;{{ __('+606-6490350') }}</label>
                </div>
                <div class="col-md-4">
                    <label class="text-white"><i class="bi bi-envelope-at-fill"></i>&nbsp;{{ __('info@uniti.edu.my') }}</label>
                </div>
                <div class="col-md-2 d-flex justify-content-md-end justify-content-start mt-md-0">
                    <a href="https://uniti.edu.my" target="_blank" class="text-white mx-2"><i class="bi bi-globe-central-south-asia"></i></a>
                    <a href="https://www.facebook.com/kolejunitiportdickson" target="_blank" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/kolejunitiportdickson/" target="_blank" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/KOLEJUNITIPORTDICKSON" target="_blank" class="text-white mx-2"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.tiktok.com/@kolejunitipd" target="_blank" class="text-white mx-2"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">
                <picture>
                    <source srcset="{{ env('IMAGE_BASE_URL') }}/logo/edaftar.webp" type="image/webp">
                    <img src="{{ env('IMAGE_BASE_URL') }}/logo/edaftar.png" alt="Logo" class="img-fluid" style="width: 150px; height: auto;">
                </picture>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        <!-- <li class="nav-item dropdown">
                            <a href="{{ route('student.about') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-success">Jom Masuk UNITI!</a>
                        </li> -->
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-uppercase" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <div class="container py-5">
            <div class="row align-items-center min-vh-75">
                <!-- Left Column -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge bg-danger px-3 py-2 mb-3">Kolej UNITI Port Dickson</span>
                    <h1 class="display-4 fw-bold mb-4">Mulakan Masa Depan
                    di Kolej UNITI Port Dickson</h1>
                    <p class="lead text-muted mb-4">Dengan sokongan akademik yang kukuh dan kemudahan moden, Kolej UNITI Port Dickson menawarkan pelbagai program pengajian di peringkat diploma dalam bidang perniagaan, pendidikan awal kanak-kanak, teknologi maklumat dan industri halal.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('student.register') }}" class="btn btn-danger px-4 py-2 rounded-3">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </a>
                        <a href="#" class="btn btn-warning px-4 py-2 rounded-3">
                            <i class="bi bi-search me-2"></i>Semak Permohonan
                        </a>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="col-lg-6">
                    <img src="{{ env('IMAGE_BASE_URL') }}/banners/kupd.jpg" alt="Kolej UNITI Port Dickson" class="img-fluid rounded-4 shadow-lg">
                </div>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div>
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-4">Kenapa Kolej UNITI Port Dickson?</h2>
                    <p class="lead text-muted mb-5">Pelbagai faedah dan kelebihan ditawarkan kepada pelajar di Kolej UNITI Port Dickson.</p>
                </div>
                <!-- 1st row -->
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?q=80&w=1470" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Student registering for college"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-cash-coin text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Yuran Pendaftaran</h4>
                                </div>
                                <p class="text-muted">Yuran pendaftaran RM250 bagi semua program yang ditawarkan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1561414927-6d86591d0c4f?q=80&w=1373" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Modern campus facilities"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-building text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Elaun Semester</h4>
                                </div>
                                <p class="text-muted">Pelajar menerima elaun sebanyak RM750 selama 5 semester.</p>
                                <p class="text-muted" style="font-size: .70rem"><em>* Tertakluk kepada terma dan syarat.</em></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1470" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Students studying together"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-people text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Insentif</h4>
                                </div>
                                <p class="text-muted">Diskaun insentif minima RM5000 akan diberikan kepada pelajar sepanjang tempoh pengajian.</p>
                                <p class="text-muted" style="font-size: .70rem"><em>* Tertakluk kepada pakej kewangan yang ditawarkan.</em></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 2nd row -->
                <div class="row g-4 mt-3">
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Graduates in caps and gowns"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-mortarboard text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Program Diploma</h4>
                                </div>
                                <p class="text-muted">Diploma berkualiti, diiktiraf dan memenuhi keperluan industri.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1552581234-26160a2d9e10?q=80&w=1000" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Students in a dormitory"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-building text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Penginapan</h4>
                                </div>
                                <p class="text-muted">Jaminan penginapan selama 3 tahun di dalam kawasan kolej.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Students working on a project"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-table text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Program Keusahawanan</h4>
                                </div>
                                <p class="text-muted">Jana pendapatan menerusi aktiviti keusahawanan dan bekerja sambil belajar.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 3rd row -->
                <div class="row g-4 mt-3">
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1552581234-26160a2d9e10?q=80&w=1000" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Students in a library"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-bank text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Pinjaman PTPTN</h4>
                                </div>
                                <p class="text-muted">Pakej tajaan penuh yuran pengajian dan penginapan disediakan.</p>
                                <p class="text-muted" style="font-size: .70rem"><em>* Tertakluk kepada terma dan syarat.</em></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Students in a meeting"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-briefcase text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">Yayasan UNITI</h4>
                                </div>
                                <p class="text-muted">Permohonan dana Yayasan UNITI disediakan bagi golongan B40.</p>
                                <p class="text-muted" style="font-size: .70rem"><em>* Tertakluk kepada terma dan syarat.</em></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow rounded-4 h-100">
                            <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                 class="card-img-top rounded-top-4" 
                                 alt="Students with certificates"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-award text-danger me-2"></i>
                                    <h4 class="fw-bold mb-0">MyQUEST</h4>
                                </div>
                                <p class="text-muted">Beroperasi 27 tahun sebagai institusi pendidikan dan telah mendapat pengiktirafan MyQUEST.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mb-5">
            <a href="#" class="btn btn-danger px-4 py-2 rounded-3">
                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
            </a>
        </div>
        
        <!-- Faculty Section -->
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold mb-4">Fakulti & Program</h2>
                <p class="lead text-muted mb-5">Terokai program-program yang kami tawarkan dan pilih laluan pendidikan yang sesuai dengan minat dan cita-cita anda.</p>
            </div>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="bi bi-mortarboard text-danger me-3"></i>
                        <div>
                            <span class="d-block">Fakulti Pendidikan & Pembangunan Manusia</span>
                            <small class="text-muted fw-normal">3 Program Diploma</small>
                        </div>
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Student registering for college"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Pendidikan Awal Kanak-Kanak</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1552581234-26160a2d9e10?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students in a library"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Pendidikan Islam Sekolah Rendah</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                    <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                         class="card-img-top rounded-top-4" 
                                         alt="Students with certificates"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Psikologi Kaunseling</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="bi bi-mortarboard text-danger me-3"></i>
                        <div>
                            <span class="d-block">Fakulti Teknologi & Kejuruteraan</span>
                            <small class="text-muted fw-normal">3 Program Diploma</small>
                        </div>
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Student registering for college"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma In Graphic Design</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1552581234-26160a2d9e10?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students in a library"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                                <div class="d-flex align-items-center mb-2">
                                                    <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                    <h5 class="fw-bold mb-0">Diploma In Information Technology (System Support)</h5>
                                                </div>
                                                <p class="text-muted small mb-3">
                                                    <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                                </p>
                                                <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                    <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                                </a>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students with certificates"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Komunikasi dan Media</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <i class="bi bi-mortarboard text-danger me-3"></i>
                        <div>
                            <span class="d-block">Fakulti Pengurusan & Industri Halal</span>
                            <small class="text-muted fw-normal">10 Program Diploma</small>
                        </div>
                    </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                            <!-- 1st row -->
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Student registering for college"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma In Accounting (UiTM)</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1552581234-26160a2d9e10?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students in a library"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma In Business Studies (UiTM)</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students with certificates"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Pengajian Islam</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 2nd row -->
                            <div class="row g-4 mt-1">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Student registering for college"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Pengurusan Perniagaan</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1552581234-26160a2d9e10?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students in a library"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Perakaunan</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students with certificates"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Pengurusan Muamalat</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 3rd row -->
                            <div class="row g-4 mt-1">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Student registering for college"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Pengurusan Industri Halal</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1552581234-26160a2d9e10?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students in a library"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma In Tourism Management</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1524250504178-2f3bcb936601?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Students with certificates"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma In Halal Product Manufacturing</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- 4th row -->
                            <div class="row g-4 mt-1 justify-content-center">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm rounded-4 h-100">
                                        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=1000" 
                                             class="card-img-top rounded-top-4" 
                                             alt="Student registering for college"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-danger-subtle text-danger me-2"></span>
                                                <h5 class="fw-bold mb-0">Diploma Pengurusan Teknologi</h5>
                                            </div>
                                            <p class="text-muted small mb-3">
                                                <i class="bi bi-clock me-1"></i>Tempoh Pengajian: 3 Tahun
                                            </p>
                                            <a href="#" class="btn btn-outline-danger rounded-3 btn-sm stretched-link">
                                                <i class="bi bi-info-circle me-2"></i>Maklumat Lanjut
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>