<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

     <!-- Inline Critical CSS -->
     <style>
        body {
            font-family: 'Nunito', sans-serif;
            /* Add other critical styles here */
        }
    </style>
    
    <!-- Preconnect to Font Provider -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    
    <!-- Preload Fonts and Load Asynchronously -->
    <link rel="preload" href="https://fonts.bunny.net/css?family=Nunito" as="style" onload="this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.bunny.net/css?family=Nunito">
    </noscript>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color: darkslateblue;">
          <div class="container">
              <div class="row col-12">
                  <div class="col-12 col-md-4">
                      <label class="text-white">{{ __('NO. PERAKUAN PENDAFTARAN : DK036(N)') }}</label>
                  </div>
                  <div class="col-12 col-md-2">
                      <label class="text-white"><i class="bi bi-telephone-fill"></i>&nbsp;{{ __('+606-6490350') }}</label>
                  </div>
                  <div class="col-12 col-md-4">
                      <label class="text-white"><i class="bi bi-envelope-at-fill"></i>&nbsp;{{ __('info@uniti.edu.my') }}</label>
                  </div>
                  <div class="col-12 col-md-2 d-flex justify-content-md-end justify-content-start mt-md-0">
                    <a href="https://uniti.edu.my" target="_blank" class="text-white mx-2"><i class="bi bi-globe-central-south-asia"></i></a>
                    <a href="https://www.facebook.com/kolejunitiportdickson" target="_blank" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/kolejunitiportdickson/" target="_blank" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/KOLEJUNITIPORTDICKSON" target="_blank" class="text-white mx-2"><i class="bi bi-youtube"></i></a>
                    <a href="https://www.tiktok.com/@kolejunitipd" target="_blank" class="text-white mx-2"><i class="bi bi-tiktok"></i></a>
                  </div>
              </div>
          </div>
        </nav> --}}

        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}">
                    <picture>
                        <source srcset="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/logo/edaftar.webp" type="image/webp">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/logo/edaftar.png" alt="Logo" class="img-fluid" style="width: 150px; height: auto;">
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
                                <a href="{{ route('student.about') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}" class="btn btn-success">Jom Masuk UNITI!</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a href="{{ route('student.about') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}" class="btn btn-success">Jom Masuk UNITI!</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        <main class="py-3 bg-white">
            @yield('content')
        </main>
        
        {{-- <div class="container bg-white">
            <footer>
              <div class="row">
                <div class="col-md-2 offset-md-5 mb-3">
                  <h5>Pautan Segera</h5>
                  <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('student.about') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}" class="nav-link p-0 text-body-secondary">Daftar Kemasukan</a>
                    </li>
                  </ul>
                </div>
                
                <div class="col-md-2 mb-3">
                    <h5>Info Kualiti</h5>
                    <ul class="nav flex-column">
                      <li class="nav-item mb-2"><a href="https://uniti.edu.my/polisi-kualiti/" class="nav-link p-0 text-body-secondary">Polisi Kualiti</a></li>
                      <li class="nav-item mb-2"><a href="https://uniti.edu.my/objektif-kualiti/" class="nav-link p-0 text-body-secondary">Objektif Kualiti</a></li>
                      <li class="nav-item mb-2"><a href="https://uniti.edu.my/sijil-dan-logo-iso/" class="nav-link p-0 text-body-secondary">Logo & Sijil ISO</a></li>
                    </ul>
                  </div>

                <div class="col-md-3 mb-3">
                    <form>
                      <h5>UNITI, Pilihan Terbaik Anda</h5>
                      <label class="mb-1">UNITI Village Persiaran UNITI</label><br>
                      <label class="mb-1">Tanjung Agas, 71250 Port Dickson</label><br>
                      <label class="mb-1">Negeri Sembilan</label><br>
                      <label class="mb-1"><i class="bi bi-telephone-fill"></i>&nbsp;{{ __('+606-6490350') }}</label><br>
                      <label class="mb-1"><i class="bi bi-envelope-at-fill"></i>&nbsp;{{ __('info@uniti.edu.my') }}</label>
                    </form>
                  </div>
              </div>
          
              <div class="d-flex flex-column flex-sm-row justify-content-between py-2 border-top">
                <p>&copy; Copyright Kolej UNITI 2024.</p>
                <ul class="list-unstyled d-flex">
                  <li class="ms-3"><a href="https://uniti.edu.my" target="_blank" class="text-dark"><i class="bi bi-globe-central-south-asia"></i></a></li>
                  <li class="ms-3"><a href="https://www.facebook.com/kolejunitiportdickson" target="_blank" class="text-dark"><i class="bi bi-facebook"></i></a></li>
                  <li class="ms-3"><a href="https://www.instagram.com/kolejunitiportdickson/" target="_blank" class="text-dark"><i class="bi bi-instagram"></i></a></li>
                  <li class="ms-3"><a href="https://www.youtube.com/KOLEJUNITIPORTDICKSON" target="_blank" class="text-dark"><i class="bi bi-youtube"></i></a></li>
                  <li class="ms-3"><a href="https://www.tiktok.com/@kolejunitipd" target="_blank" class="text-dark"><i class="bi bi-tiktok"></i></a></li>
                </ul>
              </div>
            </footer>
        </div> --}}
    </div>
</body>
</html>
