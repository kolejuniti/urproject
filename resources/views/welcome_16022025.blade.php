<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kolej UNITI | e-Daftar</title>
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Preconnect to Font Provider -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    
    <!-- Preload Fonts and Load Asynchronously -->
    <link rel="preload" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" as="style" onload="this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap">
    </noscript>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
    </style>
    
</head>
<body style="background-color: white;">
    <div id="app">
        <!-- <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: darkslateblue;">
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
        </nav> -->
        
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
                          <li class="nav-item dropdown">
                              <a href="{{ route('student.about') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-success">Jom Masuk UNITI!</a>
                          </li>
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

        {{-- Hero Section --}}
        <div class="container py-5">
            <div class="row align-items-center min-vh-75" style="margin-top: 2rem; margin-bottom: 2rem;">
                <!-- Left Column (Text) -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge bg-primary px-3 py-2 mb-3 rounded-pill">Selamat Datang ke Kolej UNITI</span>
                    <h1 class="display-4 fw-bold mb-4 lh-sm hero-title" style="background: linear-gradient(to right, #2c3e50, #3498db); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Melangkah Ke Masa Depan Bersama Kolej Uniti</h1>
                    <p class="lead mb-4 text-muted">Kolej Uniti adalah institusi pendidikan tinggi yang berdedikasi membentuk generasi masa depan dengan pendidikan berkualiti. Sertai kolej kami untuk membina kejayaan melalui program akademik yang diiktiraf, fasiliti moden dan bimbingan daripada pensyarah berpengalaman.</p>
                </div>
                <!-- Right Column (Image) -->
                <div class="col-lg-6">
                    <div class="position-relative">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-primary rounded-4" style="transform: rotate(-3deg); opacity: 0.1;"></div>
                        <img src="{{ env('IMAGE_BASE_URL') }}/banners/hero_konvo.JPG" alt="Kolej UNITI Port Dickson" class="img-fluid rounded-4 shadow-lg" style="transform: rotate(2deg);">
                    </div>
                </div>
            </div>
        </div>

        {{-- Campus Section --}}
        <div class="container py-5">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="fw-bold mb-4">Kampus UNITI</h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4 g-xl-5">
                <div class="col">
                    <div class="card text-start shadow hover-shadow h-100 border-0 rounded-3 transition" style="transition: all 0.3s ease;">
                        <img class="card-img-top rounded-top" src="{{ env('IMAGE_BASE_URL') }}/banners/kupd.jpg" alt="Title" />
                        <div class="card-body p-4">
                            <h4 class="card-title fw-bold mb-3">Kolej UNITI Port Dickson</h4>
                            <p class="card-text text-muted mb-4">Kolej UNITI Port Dickson merupakan sebuah institusi pendidikan tinggi swasta yang terletak di Port Dickson, Negeri Sembilan. Kolej ini menawarkan pelbagai program pengajian di peringkat diploma di dalam bidang perniagaan, pendidikan awal kanak-kanak, teknologi maklumat dan industri halal. Dengan lokasi strategik berhampiran pantai dan kemudahan pembelajaran yang lengkap, Kolej UNITI Port Dickson komited dalam melahirkan graduan berkualiti untuk memenuhi keperluan industri.</p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <a href="{{ route('student.kupd') }}" class="btn btn-primary px-4 py-2 rounded-3"><i class="bi bi-info-circle-fill me-2"></i>Lebih Lanjut</a>
                                <button class="btn btn-outline-danger px-4 py-2 rounded-3"><i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card text-start shadow hover-shadow h-100 border-0 rounded-3 transition" style="transition: all 0.3s ease;">
                    <img class="card-img-top rounded-top" src="{{ env('IMAGE_BASE_URL') }}/banners/kupd.jpg" alt="Title" />
                        <div class="card-body p-4">
                            <h4 class="card-title fw-bold mb-3">Kolej UNITI Kota Bharu</h4>
                            <p class="card-text text-muted mb-4">Kolej UNITI Kota Bharu merupakan sebuah institusi pendidikan tinggi swasta yang terletak di Kota Bharu, Kelantan. Kolej ini menawarkan pelbagai program pengajian di peringkat diploma di alam bidang pengajian islam, pendidikan awal kanak-kanak, muamalat dan industri halal. Dengan lokasi strategik di pusat bandar dan dilengkapi dengan kemudahan pembelajaran moden, Kolej UNITI Kota Bharu bertekad untuk melahirkan graduan berkemahiran tinggi yang memenuhi kehendak pasaran kerja semasa.</p>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <button class="btn btn-primary px-4 py-2 rounded-3"><i class="bi bi-info-circle-fill me-2"></i>Lebih Lanjut</button>
                                <button class="btn btn-outline-danger px-4 py-2 rounded-3"><i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Section--}}
        <div class="py-2 bg-dark text-white">
            <div class="container">
                <footer>
                    <div class="text-center">
                        <p class="mb-md-0">&#169; Kolej UNITI. All Right Reserved</p>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
