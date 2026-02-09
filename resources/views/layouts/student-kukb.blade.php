<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Canonical Tag-->
  <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Kolej UNITI Kota Bharu')</title>

  <link rel="icon" type="image/png" href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ku1.png">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Scripts -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <style>
    :root {
      /* KUPD Theme: Royal Blue & Gold */
      --primary: #065f46;
      /* Blue 800 */
      --primary-dark: #064e3b;
      /* Blue 900 */
      --accent: #d97706;
      /* Amber 600 */
      --accent-hover: #b45309;
      --secondary: #334155;
      --light: #eff6ff;
      /* Light Blue Tint */
      --surface: #ffffff;
      --text-main: #1e293b;
      --text-muted: #64748b;
      --font-main: 'Outfit', sans-serif;
      --radius-sm: 8px;
      --radius-md: 16px;
      --radius-lg: 24px;
      --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
      --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    body {
      font-family: var(--font-main);
      color: var(--text-main);
      background-color: var(--light);
      line-height: 1.6;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      color: var(--primary);
      font-weight: 700;
      line-height: 1.2;
    }

    a {
      text-decoration: none;
      transition: all 0.3s ease;
    }

    main {
      flex: 1;
      /* Padding top for fixed navbar */
      padding-top: 80px;
    }

    /* Navbar */
    .navbar {
      padding: 1rem 0;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .navbar-brand img {
      height: 50px;
    }

    .nav-link {
      font-weight: 500;
      color: var(--secondary);
      padding: 0.5rem 1rem !important;
      font-size: 1rem;
    }

    .nav-link:hover,
    .nav-link.active {
      color: var(--primary);
    }

    .btn-primary-custom {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      border: none;
      color: white;
      padding: 0.75rem 2rem;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1rem;
      box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
      transition: transform 0.2s;
      display: inline-block;
    }

    .btn-primary-custom:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
      color: white;
    }

    /* Footer */
    footer {
      background: #022c22;
      color: #94a3b8;
      padding: 4rem 0 2rem;
      font-size: 0.9rem;
      margin-top: auto;
    }

    footer h5 {
      color: white;
      margin-bottom: 1.5rem;
    }

    footer a {
      color: #94a3b8;
    }

    footer a:hover {
      color: white;
    }

    .social-link {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid #64748b;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
    }

    .social-link:hover {
      background: var(--accent);
      border-color: var(--accent);
      color: white;
    }

    /* Utility */
    .text-accent {
      color: var(--accent) !important;
    }

    .bg-surface {
      background-color: var(--surface);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #f0fdf4;
    }

    ::-webkit-scrollbar-thumb {
      background: #6ee7b7;
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #34d399;
    }
  </style>

  <!-- Load gtag.js only ONCE -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-B4BRS3VJS0"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    // Configure BOTH tags using the same gtag instance
    gtag('config', 'G-B4BRS3VJS0'); // Your GA4
    gtag('config', 'AW-11015826304'); // Your Google Ads
  </script>

  <!-- TikTok Pixel Code Start -->
  <script>
    ! function(w, d, t) {
      w.TiktokAnalyticsObject = t;
      var ttq = w[t] = w[t] || [];
      ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias", "group", "enableCookie", "disableCookie", "holdConsent", "revokeConsent", "grantConsent"], ttq.setAndDefer = function(t, e) {
        t[e] = function() {
          t.push([e].concat(Array.prototype.slice.call(arguments, 0)))
        }
      };
      for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);
      ttq.instance = function(t) {
        for (
          var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++) ttq.setAndDefer(e, ttq.methods[n]);
        return e
      }, ttq.load = function(e, n) {
        var r = "https://analytics.tiktok.com/i18n/pixel/events.js",
          o = n && n.partner;
        ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = r, ttq._t = ttq._t || {}, ttq._t[e] = +new Date, ttq._o = ttq._o || {}, ttq._o[e] = n || {};
        n = document.createElement("script");
        n.type = "text/javascript", n.async = !0, n.src = r + "?sdkid=" + e + "&lib=" + t;
        e = document.getElementsByTagName("script")[0];
        e.parentNode.insertBefore(n, e)
      };


      ttq.load('D088RO3C77U75NH4JFCG');
      ttq.page();
    }(window, document, 'ttq');
  </script>
  <!-- TikTok Pixel Code End -->
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukbonly.png" alt="Kolej UNITI Port Dickson">
      </a>
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}">Pilih Kampus</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-5">
          <!-- <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ku1.png" alt="Logo" class="mb-3" style="height:60px;"> -->
          <h5 class="fw-bold">Kolej UNITI Kota Bharu</h5>
          <p>Kampus Kijang, Lot 1911, Jalan Pantai Cahaya Bulan,<br>15350 Kota Bharu, Kelantan</p>
          <p><i class="bi bi-telephone me-2"></i> +609-774 7449</p>
          <p><i class="bi bi-envelope me-2"></i> info@uniti.edu.my</p>
        </div>
        <div class="col-lg-3">
          <h5 class="fw-bold">Pautan Pantas</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="{{ url('/') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}">Laman Utama</a></li>
            <li class="mb-2"><a href="{{ route('student.kukb') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}#programmes">Program</a></li>
            <li class="mb-2"><a href="{{ route('semak.permohonan.kukb') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}">Semak Permohonan</a></li>
            <li class="mb-2"><a href="{{ route('student.register-kukb') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}">Daftar Online</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h5 class="fw-bold">Ikuti Kami</h5>
          <div class="d-flex gap-3 mt-3">
            <a href="https://unitikotabharu.edu.my/" class="social-link"><i class="bi bi-globe"></i></a>
            <a href="https://web.facebook.com/kolejunitikotabharu" class="social-link"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/kolejunitikotabharu/" class="social-link"><i class="bi bi-instagram"></i></a>
            <a href="https://www.tiktok.com/@kolejunitikotabharu" class="social-link"><i class="bi bi-tiktok"></i></a>
            <a href="https://www.youtube.com/@kolejunitikotabharu" class="social-link"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
      </div>
      <hr class="border-secondary my-4 opacity-50">
      <div class="text-center opacity-75">
        <small>Hak Cipta Terpelihara &copy; {{ date('Y') }} Kolej UNITI. All Rights Reserved.</small>
      </div>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
    AOS.init({
      duration: 800,
      once: true
    });

    // Sticky Navbar Script
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        document.querySelector('.navbar').classList.add('shadow-sm');
        document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.98)';
      } else {
        document.querySelector('.navbar').classList.remove('shadow-sm');
        document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.95)';
      }
    });
  </script>
</body>

</html>