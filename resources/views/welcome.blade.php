<!doctype html>
<html lang="ar" dir="ltr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="jAW-nBBPmKdXh1IRqIAEZHzrj6t7QmoFX1IgsZMuqqE" />

  <!--Canonical Tag-->
  <link rel="canonical" href="https://edaftarkolej.uniticms.edu.my/">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
    integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
  <link href="{{ asset('css/home-style.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="img/ku1.png">
  <title>UTAMA - Kolej UNITI</title>

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
</head>

<body>

  <!-- Navbar -->
  <!-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
        <span>KOLEJ UNITI</span>
      </a>
    </div>
  </nav> -->

  <!-- Hero Section -->
  <section class="hero-section d-flex align-items-center position-relative overflow-hidden">
    <div class="container position-relative z-1">
      <div class="row justify-content-center text-center">
        <div class="col-lg-10">
          <span class="badge bg-soft-primary text-primary fw-bold px-3 py-2 rounded-pill mb-2 animate__animated animate__fadeInDown">
            Pendidikan Masa Depan Anda Bermula Di Sini
          </span>
          <h1 class="display-5 fw-bold mb-2 animate__animated animate__fadeInUp text-dark">
            Jom Masuk <span class="text-gradient">Kolej UNITI!</span>
          </h1>
          <p class="lead text-muted mb-4 animate__animated animate__fadeInUp animate__delay-1s fs-6">
            Pilih kampus pilihan anda dan bina masa depan yang cerah bersama kami.
            <br class="d-none d-md-block">Program berkualiti, pensyarah berpengalaman dan suasana pembelajaran yang menyokong kejayaan anda.
          </p>
        </div>
      </div>

      <div class="row justify-content-center animate__animated animate__fadeInUp animate__delay-2s">

        <!-- Kolej UNITI Port Dickson -->
        <div class="col-md-5 col-lg-4 mb-3">
          <div class="card campus-card h-100 border-0 shadow-lg">
            <div class="card-img-wrapper">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/sd1.png" class="card-img-top" alt="Kolej UNITI Port Dickson">
              <div class="overlay"></div>
            </div>
            <div class="card-body text-center p-3">
              <div class="icon-box mb-2 mx-auto bg-soft-red text-red">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
              <h5 class="fw-bold mb-1">Kolej UNITI Port Dickson</h5>
              <p class="text-muted small mb-3">Terdapat 16 program diploma yang terdiri daripada tiga fakulti.</p>
              <div class="d-grid gap-2">
                <a href="{{ route('student.kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-sm btn-outline-primary fw-semibold">Info Lanjut</a>
                <a href="{{ route('student.register-kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-sm btn-primary fw-semibold shadow-sm">Daftar Sekarang</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolej UNITI Kota Bharu -->
        <div class="col-md-5 col-lg-4 mb-3">
          <div class="card campus-card h-100 border-0 shadow-lg">
            <div class="card-img-wrapper">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/stkukb.png" class="card-img-top" alt="Kolej UNITI Kota Bharu">
              <div class="overlay"></div>
            </div>
            <div class="card-body text-center p-3">
              <div class="icon-box mb-2 mx-auto bg-soft-green text-green">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
              <h5 class="fw-bold mb-1">Kolej UNITI Kota Bharu</h5>
              <p class="text-muted small mb-3">Menawarkan 7 program diploma dalam pelbagai bidang.</p>
              <div class="d-grid gap-2">
                <a href="{{ route('student.kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-sm btn-outline-success fw-semibold">Info Lanjut</a>
                <a href="{{ route('student.register-kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn btn-sm btn-success fw-semibold shadow-sm">Daftar Sekarang</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Decorative Background Elements -->
    <div class="bg-shape user-select-none"></div>
    <div class="bg-shape-2 user-select-none"></div>
  </section>

  <!-- Footer Section Start -->
  <footer class="footer py-4 bg-white border-top">
    <div class="container text-center">
      <p class="text-muted mb-0 small">Hak Cipta Terpelihara <span id="current-year"></span> © <strong>Kolej UNITI</strong>.</p>
    </div>
  </footer>
  <!-- Footer Section End -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>