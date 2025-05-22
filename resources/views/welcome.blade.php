<!doctype html>
<html lang="ar" dir="ltr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="jAW-nBBPmKdXh1IRqIAEZHzrj6t7QmoFX1IgsZMuqqE" />

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
  
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11015826304"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-11015826304');
  </script>
</head>

<body>

  <!-- CAMPUS Section START -->
  <section class="campus py-3" id="campus">
    <div class="container py-5">
      <div class="row align-items-center justify-content-center text-center text-md-start">
        <h1 class="text-center mb-1 fw-bold text-uppercase text-red">
          Jom Masuk <span class="text-green">Kolej Uniti!</span>
        </h1>
        <p class="text-center fw-bold">
          Pilih Kampus Dan Mulakan Perjalanan Anda
        </p>


        <!-- Kolej UNITI Port Dickson -->
        <div class="col-md-3 col-sm-6 py-3">
          <div class="card border-0 h-100">
            <div class="position-relative">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/sd1.png" class="card-img-top rounded-top" alt="Kolej UNITI Port Dickson">
            </div>
            <div class="card-body d-flex flex-column text-center">
              <h6 class="fw-bold mb-3">KOLEJ UNITI PORT DICKSON</h6>
              <p class="text-muted small mb-4">Terdapat 16 program diploma yang terdiri daripada tiga fakulti.</p>
              <div class="mt-auto">
                <a href="{{ route('student.kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn card-btn-outline-primary w-100 mb-2">Info Lanjut</a>
                <a href="{{ route('student.register-kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn card-btn-primary w-100">Daftar Sekarang</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Kolej UNITI Kota Bharu -->
        <div class="col-md-3 col-sm-6 py-3">
          <div class="card border-0 h-100">
            <div class="position-relative">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/stkukb.png" class="card-img-top rounded-top" alt="Kolej UNITI Kota Bharu">
            </div>
            <div class="card-body d-flex flex-column text-center">
              <h6 class="fw-bold mb-3">KOLEJ UNITI KOTA BHARU</h6>
              <p class="text-muted small mb-4">Menawarkan 7 program diploma dalam pelbagai bidang.</p>
              <div class="mt-auto">
                <a href="{{ route('student.kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn card-btn-outline-primary w-100 mb-2">Info Lanjut</a>
                <a href="{{ route('student.register-kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}" class="btn card-btn-primary w-100">Daftar Sekarang</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- CAMPUS Section END -->

  <!-- Footer Section Start -->
  <footer class="footer bg-dark">
    <div class="container text-center">
      <p class="text-light mb-0">Hak Cipta Terpelihara <span id="current-year"></span> © Kolej UNITI</p>
    </div>
  </footer>
  <!-- Footer Section End -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>