<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Kolej UNITI Port Dickson')</title>

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
    
    {{-- <!-- Preconnect to Font Provider -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" as="style" onload="this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap">
    </noscript> --}}
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/kupd-style.css') }}">
  
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B4BRS3VJS0"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
  
      gtag('config', 'G-B4BRS3VJS0');
    </script>
</head>
<body class="bg-white">
    <div id="app">
        
        <!--Top Start-->
        <div class="top-class p-1">
            <div class="container d-flex justify-content-between align-items-center">
                <h7>UNITI Pilihan Terbaik Anda</h7>
                <h7>No. Pendaftaran: DK036(N)</h7>
            </div>
        </div>
        <!--Top End-->

        <!-- Nav Start -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
          <div class="container">
            <!-- Logo -->
            <a class="navbar-brand ms-0 me-auto" href="#">
              <img src="{{ env('IMAGE_BASE_URL') }}/img/kupdonly.png" alt="Logo" style="max-width: 100%; height: 50px;">
            </a>

            <!-- Hamburger Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Menu Items -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <ul class="navbar-nav align-items-center gap-lg-4 gap-2">
                <li class="nav-item">
                  <a class="nav-link d-flex justify-content-end" href="{{ url('/') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '')}}">PILIH KAMPUS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex justify-content-end" href="{{ route('semak.permohonan.kupd') }}">SEMAK PERMOHONAN</a>
                </li>
              </ul>
            </div>

          </div>
        </nav>
        <!-- Nav End -->

        <main class="py-3 bg-white">
            @yield('content')
        </main>

        <footer class="footer bg-dark py-5">
            <div class="container">
              <div class="row">
        
                <div class="col-md-9 d-flex gap-3">
                  <img src="{{ env('IMAGE_BASE_URL') }}/img/ku1.png" alt="Logo Kolej UNITI" class="me-3 mb-3 mb-md-0"
                    style="max-width: 100px; height: auto;">
                  <div>
                    <h5 class="fw-bold mb-1 text-light">Kolej UNITI Port Dickson</h5>
                    <p class="mb-1 text-light">UNITI Village, Persiaran UNITI, Tanjung Agas 71250 Port Dickson, Negeri Sembilan
                    </p>
                    <p class="mb-1 text-light"><i class="bi bi-telephone text-light"></i> +06-602 0303</p>
                    <p class="mb-1 text-light"><i class="bi bi-envelope text-light"></i> info@uniti.edu.my</p>
                  </div>
                </div>
        
                <div
                  class="col-md-3 d-flex flex-column align-items-center align-items-md-end justify-content-center text-md-end text-center mt-3 mt-md-0">
                  <h5 class="fw-bold mb-3 text-light">Ikuti Kami</h5>
                  <div class="d-flex gap-3 justify-content-center justify-content-md-end">
                    <a href="https://www.facebook.com/kolejunitiportdickson" class="text-light"><i
                        class="bi bi-facebook fs-1"></i></a>
                    <a href="https://www.instagram.com/kolejunitiportdickson/" class="text-light"><i
                        class="bi bi-instagram fs-1"></i></a>
                    <a href="https://x.com/kolejuniti_pd" class="text-light"><i class="bi bi-twitter-x fs-1"></i></a>
                    <a href="https://www.tiktok.com/@kolejunitipd" class="text-light"><i class="bi bi-tiktok fs-1"></i></a>
                    <a href="https://www.youtube.com/@KolejUnitiPortDickson" class="text-light"><i
                        class="bi bi-youtube fs-1"></i></a>
                  </div>
                </div>
            </div><br>
      
            <hr class="border-light my-4">
      
            <p class="text-center text-light mb-0">Hak Cipta Terpelihara <span id="current-year"></span> © Kolej UNITI</p>
          </div>
        </footer>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js" integrity="sha512-7Pi/otdlbbCR+LnW+F7PwFcSDJOuUJB3OxtEHbg4vSMvzvJjde4Po1v4BR9Gdc9aXNUNFVUY+SK51wWT8WF0Gg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
