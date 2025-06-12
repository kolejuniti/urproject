<!doctype html>
<html lang="ar" dir="ltr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Canonical Tag-->
  <link rel="canonical" href="https://edaftarkolej.uniticms.edu.my/kampus/port-dickson">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/kupd-style.css') }}">

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Owl Carousel -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

  <!-- Animation CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

  <link rel="icon" type="image/png" href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ku1.png">
  <title>Kolej UNITI Port Dickson</title>
  
  <!-- Load gtag.js only ONCE -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-B4BRS3VJS0"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    // Configure BOTH tags using the same gtag instance
    gtag('config', 'G-B4BRS3VJS0');      // Your GA4
    gtag('config', 'AW-11015826304');    // Your Google Ads
  </script>
</head>

<body>

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
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupdonly.png" alt="Logo" style="max-width: 100%; height: 50px;">
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
            <a class="nav-link d-flex justify-content-end" href="{{ url('/') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">PILIH KAMPUS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex justify-content-end" href="{{ route('semak.permohonan.kupd') }}">SEMAK PERMOHONAN</a>
          </li>
          <li class="nav-item">
            <input type="hidden" name="source" value="{{ $source }}">
            <a class="btn btn-lg shadow-sm" style="padding: 0.8rem 1.5rem; border-radius: 50px;"
              href="{{ route('student.register-kupd', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}" role="button">
              DAFTAR SEKARANG
            </a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  <!-- Nav End -->

  <!-- Slider Start -->
  <section class="container-fluid px-0">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ban1.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ban2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ban3.png" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev custom-control-prev" type="button"
        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next custom-control-next" type="button"
        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>
  <!-- Slider End -->

  <!-- Achievements start -->
  <section class="mqa container py-5">

    <div class="row justify-content-center text-center">
      <div class="col-12 col-md-9">
        <h1 class="mqa-heading">
          Diploma Diiktiraf MQA Dengan Penarafan MyQuest
        </h1>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-auto">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/mqa-01.png" alt="" style="max-width: 100%; height: 170px;">
      </div>
      <div class="col-auto">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/myquest22-01.png" alt="" style="max-width: 100%; height: 170px;">
      </div>

    </div>

  </section>
  <!-- Achievements end -->

  <!-- Section Services Start -->
  <section class="services bg-light py-5">
    <div class="container">
      <div class="row align-items-center">

        <div
          class="col-12 col-md-5 d-flex flex-column justify-content-center align-items-center py-3 py-md-5 position-relative">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/tawaran_tablet_kupd.jpeg" alt="Tawaran Tablet" class="img-fluid services-img" />
        </div>

        <div class="col-12 col-md-7">
          <div class="row g-4">

            <div class="col-12 col-md-6">
              <div class="service-card d-flex align-items-stretch border shadow-lg rounded h-100">
                <div class="service-icon p-3 text-white bg-danger d-flex align-items-center">
                  <i class="bi bi-buildings-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div class="service-content flex-grow-1 p-3 bg-light d-flex flex-column">
                  <h5 class="fw-bold text-danger">Kolej Kediaman</h5>
                  <p class="mb-0">Kolej kediaman disediakan sepanjang pengajian</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="service-card d-flex align-items-stretch border shadow-lg rounded h-100">
                <div class="service-icon p-3 text-white bg-danger d-flex align-items-center">
                  <i class="bi bi-cash-coin" style="font-size: 2.5rem;"></i>
                </div>
                <div class="service-content flex-grow-1 p-3 bg-light d-flex flex-column">
                  <h5 class="fw-bold text-danger">Elaun Sara Diri</h5>
                  <p class="mb-0">Diberikan kepada pelajar yang layak</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="service-card d-flex align-items-stretch border shadow-lg rounded h-100">
                <div class="service-icon p-3 text-white bg-danger d-flex align-items-center">
                  <i class="bi bi-bus-front" style="font-size: 2.5rem;"></i>
                </div>
                <div class="service-content flex-grow-1 p-3 bg-light d-flex flex-column">
                  <h5 class="fw-bold text-danger">Kemudahan Kampus</h5>
                  <p class="mb-0">Kafeteria, Dobi, KOOP, Perpustakaan, Pengangkutan dan Lain-lain</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="service-card d-flex align-items-stretch border shadow-lg rounded h-100">
                <div class="service-icon p-3 text-white bg-danger d-flex align-items-center">
                  <i class="bi bi-credit-card-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div class="service-content flex-grow-1 p-3 bg-light d-flex flex-column">
                  <h5 class="fw-bold text-danger">Yuran Berpatutan</h5>
                  <p class="mb-0">Yuran pengajian berpatutan berbanding yuran IPTS yang lain</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="service-card d-flex align-items-stretch border shadow-lg rounded h-100">
                <div class="service-icon p-3 text-white bg-danger d-flex align-items-center">
                  <i class="bi bi-bank2" style="font-size: 2.5rem;"></i>
                </div>
                <div class="service-content flex-grow-1 p-3 bg-light d-flex flex-column">
                  <h5 class="fw-bold text-danger">Latihan Industri</h5>
                  <p class="mb-0">Latihan industri disediakan pada semester akhir pengajian</p>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <div class="service-card d-flex align-items-stretch border shadow-lg rounded h-100">
                <div class="service-icon p-3 text-white bg-danger d-flex align-items-center">
                  <i class="bi bi-file-earmark-check-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div class="service-content flex-grow-1 p-3 bg-light d-flex flex-column">
                  <h5 class="fw-bold text-danger">Pinjaman Kewangan</h5>
                  <p class="mb-0">Pelajar boleh membuat permohonan pinjaman melalui portal PTPTN</p>
                </div>
              </div>
            </div>

          </div>
        </div>


      </div>
    </div>
  </section>
  <!-- Section Services End -->

  <!-- Student Produce Start -->
  <section class="about py-5 bg-dark" id="about">
    <div class="container">
      <div class="row text-center align-items-center">

        <div class="col-md-6 py-3">
          <h1 class="fw-bold"><span>28 Tahun</span><br>Dalam Pendidikan</h1><br>
          <div class="d-flex justify-content-around flex-wrap">
            <div class="stat-item text-center px-3">
              <h2 class="stat-number" data-target="10000">0+</h2>
              <p class="stat-description">Graduan<br>Dilahirkan</p>
            </div>
            <div class="stat-item text-center px-3">
              <h2 class="stat-number" data-target="16">0+</h2>
              <p class="stat-description">Program<br>Diploma</p>
            </div>
            <div class="stat-item text-center px-3">
              <h2 class="stat-number" data-target="90">0%</h2>
              <p class="stat-description">Kebolehpasaran<br>Graduan</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 py-3">
          <iframe class="custom-iframe" width="100%" height="315" src="https://www.youtube.com/embed/c5QQ4-zodRc"
            frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>

      </div>
  </section>
  <!-- Student Produce End -->

  <!-- Program Start -->
  <section class="container-fluid py-3">
    <div class="container py-5">
      <div class="d-flex flex-column align-items-center">

        <h1 class="fw-bold mb-4 text-center">Program Diploma</h1>

        <ul class="nav nav-pills custom-nav d-flex flex-row p-0 m-0 justify-content-center">
          <li class="nav-item">
            <a class="nav-link active text-center" data-bs-toggle="pill" href="#ftk">
              Fakulti Teknologi & Kejuruteraan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center" data-bs-toggle="pill" href="#fpih">
              Fakulti Pengurusan & Industri Halal
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-center" data-bs-toggle="pill" href="#fppm">
              Fakulti Pendidikan & Pembangunan Manusia
            </a>
          </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content mt-4">
          <div id="ftk" class="tab-pane fade show active">
            <div class="text-center mb-4">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ftk.png" alt="Fakulti Teknologi Dan Kejuruteraan" class="img-fluid">
            </div>

            <div class="row justify-content-center">
              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma In Graphic Design</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DIGD.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1n_AJ28Kz-14X72KATn55Y0Fwa0eKoSfP/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma In Information Technology</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DIT-updated.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1RJgMJportV67hl_6r15QrF1MtoND8JVi/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Komunikasi Dan Media</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DKM.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1IiUtjTkALGed07Rtrfkjwqfr764KF4aF/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div id="fpih" class="tab-pane fade">
            <div class="text-center mb-4">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/fpih.png" alt="Fakulti Teknologi Dan Kejuruteraan" class="img-fluid">
            </div>

            <div class="row justify-content-center">
              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma in Accounting [UiTM]</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DACC-UNITI-UITM.jpg"
                          class="faculty-link text-decoration-none popupimage">Infografik Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1k9Z12hQDmGSZ5U36y1ljBCm2mwj-pyrt/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma in Business Studies [UiTM]</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DIBS-UNITI-UITM.jpg"
                          class="faculty-link text-decoration-none popupimage">Infografik Program</a></li>
                      <li><a href="https://drive.google.com/file/d/16L6YHZzcEBhH-Xrv25eTUeokTOAGkmG0/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Pengurusan Teknologi [UTM]</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPT.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1fyrQA1YvnHWfv225liDCqhCh2eXBwvoQ/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma in Halal Product Manufacturing</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DIHPM.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1jrnubV9mTdoPawlxN4V0uYa_VNvb__VD/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma in Tourism
                      Management</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DITM.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1XXaarg525wGkbBsYIUnCM02wHTk5aiAe/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Pengurusan
                      Industri Halal</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPIH.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/13LwgqUeR6NlmYA2qNHpOd-Pgbb-FJrav/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Pengajian
                      Islam</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPI.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1z7ZXrJlcMRtblkN98XTpX97N_Axngr3g/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Pengurusan
                      Perniagaan</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPP.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1xRgU15dHEpigQwSWXPU-dMZXPMSS9AqY/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma
                      Perakaunan</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPerakaunan.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1L3OJq8bZ5W-WrO7MfOs-dqOzqc4cYPFQ/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma
                      Pengurusan Muamalat</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPMuaamalat.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1rmAl2C-r-pFpw8a5WbMK_aBFG4KwL2yn/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <div id="fppm" class="tab-pane fade">
            <div class="text-center mb-4">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/fppm.png" alt="Fakulti Teknologi Dan Kejuruteraan" class="img-fluid">
            </div>

            <div class="row justify-content-center">
              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Pendidikan
                      Awal Kanak-Kanak</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPAKK.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1FY-Tx6bXn1LyPktJaO7h4nwozbMAzJKL/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Pendidikan
                      Islam Sekolah Rendah</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPISR.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1DpEyExGY58xb7VsnNkYehDY3DiNlsVTH/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="faculty mt-1">
                  <div class="faculty-header" onclick="toggleProgram(this)">
                    <h6 class="py-1 m-0">Diploma Psikologi
                      Kaunseling</h6>
                    <span class="arrow">▲</span>
                  </div>
                  <div class="faculty-content" style="display: none;">
                    <ul>
                      <li><a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPK.jpg" class="faculty-link text-decoration-none popupimage">Infografik
                          Program</a></li>
                      <li><a href="https://drive.google.com/file/d/1FmFJC4YMPxhHFhzEITz8PSdTUeqfFoQC/preview"
                          class="faculty-link text-decoration-none popup-pdf">Buku Program</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Popup Gambar -->
  <div id="imageModal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered d-flex align-items-center justify-content-center">
      <div class="modal-content bg-transparent border-0">
        <img src="" id="popupImage" class="img-fluid">
      </div>
    </div>
  </div>


  <!-- Modal Popup PDF -->
  <div id="pdfModal" class="modal fade">
    <div class="modal-dialog modal-xl modal-dialog-centered d-flex align-items-center justify-content-center">
      <div class="modal-content" style="width: 700px; height: 990px; max-width: 90vw; max-height: 90vh; margin: auto;">
        <div class="modal-body p-0">
          <iframe id="popupPdf" src="" style="width: 100%; height: 100%;" frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div><br><br>
  <!-- Program END-->

  <!-- Kemudahan & Fasiliti Start -->
  <section class="container-fluid py-3">
    <h1 class="fw-bold mb-4 text-center">Kemudahan & Fasiliti</h1>
    <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/cafe.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Cafetaria</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/koop.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Kedai Runcit Koop</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/atm.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Mesin ATM</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/library.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Perpustakaan</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/bk.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Bilik Kuliah</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/halal.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Bengkel Halal</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/kaunseling.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Bilik Kaunseling</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/komputer.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Makmal Komputer</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/guard.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Kawalan Keselamatan 24 Jam</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/bus.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Perkhidmatan Bas Awam</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/court.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Gelanggang Sukan</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/dobi.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Dobi Layan Diri</h6>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Student Section Start -->
  <section class="student-feedback py-5 bg-light">
    <div class="container">
      <div class="row justify-content-center align-items-center text-center">

        <div class="col-md-6 text-center">
          <h1 class="fw-bold">Apa Kata Pelajar?
          </h1>

          <p class="mb-0">Menjawab Persoalan Penting Anda Tentang Kolej UNITI Port Dickson</p>
        </div>

        <div class="col-md-12 mt-4 py-3">
          <div class="row">
            <!-- Video 1 -->
            <div class="col-md-4 custom-iframe2">
              <iframe class="w-100" height="250" src="https://www.youtube.com/embed/Jmbz6cTQsOs" frameborder="0"
                allowfullscreen></iframe>
            </div>
            <!-- Video 2 -->
            <div class="col-md-4 custom-iframe2">
              <iframe class="w-100" height="250" src="https://www.youtube.com/embed/c-JiZnuxK4U" frameborder="0"
                allowfullscreen></iframe>
            </div>
            <!-- Video 3 -->
            <div class="col-md-4 custom-iframe2">
              <iframe class="w-100" height="250" src="https://www.youtube.com/embed/Wi4qGXYdV0U" frameborder="0"
                allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Student Section END -->

  <!-- Alumni Section Start -->
  <section class="alumni py-5" id="why">
    <div class="container">
      <div class="row ">
        <div class="col-12 text-center">
          <h1 class="fw-bold">Alumni Kami</h1>
          <p class="fs-6 fs-sm-4 fs-md-5 fs-lg-6">Alumni Kolej UNITI Port Dickson Terus Mencipta Impak Di Pelbagai
            Bidang</p>
        </div>
      </div>
    </div>
    <div id="projects-slider" class="owl-carousel owl-theme py-3 justify-content-center">
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd6.png" alt="Alumni 1">
        <div class="content">
          <h5 class="fw-bold mt-3">Iman Chaiyalan</h5>
          <p>Pempengaruh<br>Media Sosial</p>
        </div>
      </div>
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd7.png" alt="Alumni 2">
        <div class="content">
          <h5 class="fw-bold mt-3">Ammar Hamizan</h5>
          <p>Pempengaruh<br>Media Sosial</p>
        </div>
      </div>
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd3.png" alt="Alumni 3">
        <div class="content">
          <h5 class="fw-bold mt-3">Auni Izzati</h5>
          <p>Sambung Ijazah<br>Di UPM, Serdang</p>
        </div>
      </div>
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd4.png" alt="Alumni 4">
        <div class="content">
          <h5 class="fw-bold mt-3">Muqri Rafiqi</h5>
          <p>Guru Diniyah<br>SRI Teras Islam Selayang Baru</p>
        </div>
      </div>
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd5.png" alt="Alumni 5">
        <div class="content">
          <h5 class="fw-bold mt-3">Nordin Baharudin</h5>
          <p>FrontEnd Developer<br>Biztory Cloud Sdn.Bhd.</p>
        </div>
      </div>
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd1.png" alt="Alumni 6">
        <div class="content">
          <h5 class="fw-bold mt-3">Aniesha Azyyati</h5>
          <p>Social Media Executive<br>Huzeifa Studio</p>
        </div>
      </div>
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd2.png" alt="Alumni 7">
        <div class="content">
          <h5 class="fw-bold mt-3">Ammar Irfan</h5>
          <p>Pramugara<br>Air Asia Berhad</p>
        </div>
      </div>
      <div class="project">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd8.png" alt="Alumni 8">
        <div class="content">
          <h5 class="fw-bold mt-3">Putera Muhammad</h5>
          <p>IT Field Service Technican T2<br>Micron Technology</p>
        </div>
      </div>
    </div><br>
  </section>
  <!-- Alumni Section END -->


  <!-- Kata-Kata Section Start-->


  <section class="kata-section">
    <div class="container">
      <div class="row align-items-center py-2">
        <div class="col-12 col-md-7 text-center text-md-start">
          <h2 class="mb-4">Jangan Lepaskan Peluang! <b>Daftar Sekarang</b></h2>
        </div>
        <div class="col-12 col-md-5 d-flex justify-content-center justify-content-md-end">
          <a href="{{ route('student.register-kupd', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}" class="btn btn-lg mb-2 shadow-sm"
            style="padding: 0.8rem 1.5rem; border-radius: 50px;">
            Daftar Sekarang
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Kata-Kata Section End-->

  <!-- Footer Section-->

  <footer class="footer bg-dark py-5">
    <div class="container">
      <div class="row">

        <div class="col-md-9 d-flex gap-3">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ku1.png" alt="Logo Kolej UNITI" class="me-3 mb-3 mb-md-0"
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>