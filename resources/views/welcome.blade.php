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
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background-color: white;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm sticky-top" style="background-color: darkslateblue;">
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
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                  {{ config('app.name', 'Laravel') }}
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
                              <a href="{{ route('student.about') }}" class="btn btn-success">Jom Masuk UNITI!</a>
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

        <main class="py-3" style="max-height: 80vh;">
            {{-- @yield('content') --}}
            <div class="container mb-5">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/banner-web-kupd-jom-masuk-uniti-1.jpg" alt="" class="img-fluid">
            </div>
        </main>
    </div>
</body>
</html>
