<!doctype html>
<html lang="ms">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kolej UNITI Kota Bharu | Pilihan Terbaik Anda</title>

    <!-- Meta -->
    <meta name="description" content="Sambung Pengajian di Kolej UNITI Kota Bharu. Kampus Panoramic dan Tenang. Diploma diiktiraf MQA.">
    <link rel="canonical" href="{{ url()->current() }}">
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

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <style>
        :root {
            /* KUKB Theme: Emerald Green & Gold */
            --primary: #065f46;
            /* Emerald 800 */
            --primary-dark: #064e3b;
            /* Emerald 900 */
            --accent: #d97706;
            /* Amber 600 */
            --accent-hover: #b45309;
            --secondary: #334155;
            --light: #f0fdf4;
            /* Light Green Tint */
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
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--primary-dark);
            font-weight: 700;
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            transition: all 0.3s ease;
        }

        /* Navbar */
        .navbar {
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.95);
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
            box-shadow: 0 4px 15px rgba(6, 95, 70, 0.3);
            transition: transform 0.2s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 95, 70, 0.4);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            padding: 8rem 0 5rem;
            background: radial-gradient(circle at top right, rgba(217, 119, 6, 0.1), transparent 40%),
                linear-gradient(to bottom, #ffffff, #ecfdf5);
            overflow: hidden;
        }

        .hero-title {
            font-size: 3.5rem;
            letter-spacing: -1px;
            margin-bottom: 1.5rem;
        }

        .hero-bg-accent {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 50%;
            height: 100%;
            background: url('https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukbonly.png') no-repeat center right;
            /* KUKB Logo Background */
            opacity: 0.03;
            z-index: 0;
            pointer-events: none;
        }

        /* Stats Cards */
        .stat-card {
            background: var(--surface);
            padding: 2rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }

        /* Features Section */
        .feature-icon-box {
            width: 60px;
            height: 60px;
            background: rgba(6, 95, 70, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }

        .feature-card:hover .feature-icon-box {
            background: var(--primary);
            color: white;
            transform: scale(1.1) rotate(5deg);
        }

        .feature-card {
            padding: 2rem;
            border-radius: var(--radius-md);
            background: var(--surface);
            border: 1px solid #e2e8f0;
            height: 100%;
            transition: all 0.3s;
        }

        .feature-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-md);
        }

        /* Programs Section */
        .nav-pills .nav-link {
            border-radius: 50px;
            padding: 0.75rem 2rem;
            margin: 0 0.5rem;
            color: var(--text-muted);
            background: white;
            border: 1px solid #e2e8f0;
            font-weight: 600;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .program-card {
            background: white;
            border-radius: var(--radius-sm);
            overflow: hidden;
            border: 1px solid #f1f5f9;
            transition: all 0.3s;
        }

        .program-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-5px);
            border-color: var(--accent);
        }

        .program-header {
            padding: 1.5rem;
            background: #f0fdf4;
            border-bottom: 1px solid #d1fae5;
        }

        .program-body {
            padding: 1.5rem;
        }

        .program-link {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: var(--text-main);
            font-weight: 500;
        }

        .program-link:hover {
            background: #ecfdf5;
            color: var(--primary);
            border-color: var(--primary);
        }

        .program-link i {
            margin-right: 10px;
            color: var(--accent);
        }

        /* Facilities (Gallery) */
        .facility-item {
            position: relative;
            overflow: hidden;
            border-radius: var(--radius-md);
            height: 250px;
        }

        .facility-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .facility-item:hover img {
            transform: scale(1.1);
        }

        .facility-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
        }

        /* CTA Section */
        .cta-section {
            background: var(--primary-dark);
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Footer */
        footer {
            background: #022c22;
            /* Very dark green */
            color: #94a3b8;
            padding: 4rem 0 2rem;
            font-size: 0.9rem;
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

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.25rem;
            }

            .nav-pills {
                flex-direction: column;
                width: 100%;
            }

            .nav-pills .nav-link {
                margin: 0.25rem 0;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukbonly.png" alt="Kolej UNITI Kota Bharu">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Pilih Kampus</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('semak.permohonan.kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Semak Permohonan</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary-custom" href="{{ route('student.register-kukb', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}">
                            Daftar Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section d-flex align-items-center">
        <div class="container position-relative" style="z-index: 1;">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-up">
                    <span class="badge bg-white text-primary border px-3 py-2 rounded-pill mb-3 fw-semibold">
                        <i class="fas fa-check-circle me-1 text-success"></i> No. Pendaftaran: DK215(D)
                    </span>
                    <h1 class="hero-title fw-bold">Kampus <span class="text-warning">Panoramic</span> <br>Dan Tenang</h1>
                    <p class="lead text-muted mb-4">
                        Suasana pembelajaran yang kondusif di Pantai Cahaya Bulan, Kota Bharu. Sertai kami untuk masa depan yang cemerlang.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#programmes" class="btn btn-dark btn-lg rounded-pill px-4">Lihat Program</a>
                        <a href="https://www.youtube.com/watch?v=S0gTEQqAZlI" target="_blank" class="btn btn-outline-dark btn-lg rounded-pill px-4"><i class="bi bi-play-circle me-2"></i> Video Korporat</a>
                    </div>
                </div>
                <!-- Hero Image Slider/Carousel -->
                <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left">
                    <div class="position-relative">
                        <div id="heroCarousel" class="carousel slide rounded-4 shadow-lg overflow-hidden" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ban1.png" class="d-block w-100" alt="Student Life">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ban2.png" class="d-block w-100" alt="Campus">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ban3.png" class="d-block w-100" alt="Achievements">
                                </div>
                            </div>
                        </div>
                        <!-- Decorative elements -->
                        <!-- <div class="position-absolute bottom-0 start-0 translate-middle-x mb-n4 ms-n4 bg-white p-4 rounded-4 shadow-lg d-none d-md-block">
                            <div class="d-flex align-items-center gap-3">
                                <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle">
                                    <i class="bi bi-trophy-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold m-0">Diiktiraf MQA</h6>
                                    <small class="text-muted">Kualiti Terjamin</small>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section-stats mt-n5 position-relative" style="z-index: 10;">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-card">
                        <div class="stat-number">10,000+</div>
                        <div class="stat-label">Graduan Dilahirkan</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-number">7</div>
                        <div class="stat-label">Program Diploma</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-card">
                        <div class="stat-number">90%</div>
                        <div class="stat-label">Kebolehpasaran Graduan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Accreditation Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <div class="row justify-content-center align-items-center" data-aos="fade-up">
                <div class="col-lg-8">
                    <span class="text-primary fw-bold text-uppercase ls-1">Pengiktirafan</span>
                    <h2 class="display-6 fw-bold mt-2 mb-4">Diploma Diiktiraf MQA & Penarafan MyQuest</h2>
                    <p class="text-muted lead mb-5">Komitmen kami terhadap kualiti pendidikan yang tinggi dan diiktiraf oleh Agensi Kelayakan Malaysia (MQA).</p>
                </div>
            </div>
            <div class="row justify-content-center align-items-center gap-4 gap-md-5" data-aos="zoom-in">
                <div class="col-auto">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/mqa-01.png" alt="MQA Accredited" style="height: 120px; object-fit: contain;">
                </div>
                <div class="col-auto">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/myquest22-01.png" alt="MyQuest 6 Stars" style="height: 120px; object-fit: contain;">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 my-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="text-primary fw-bold text-uppercase ls-1">Kenapa KUKB?</span>
                <h2 class="display-6 fw-bold mt-2">Fasiliti & Kelebihan Kami</h2>
                <div class="vr bg-warning opacity-100 mx-auto mt-3" style="height: 3px; width: 60px; border:none; display:block;"></div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-buildings-fill"></i>
                        </div>
                        <h5>Kolej Kediaman</h5>
                        <p class="text-muted mb-0">Kolej kediaman disediakan sepanjang pengajian untuk keselesaan pelajar.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h5>Elaun Sara Diri</h5>
                        <p class="text-muted mb-0">Diberikan kepada pelajar yang layak bagi meringankan beban kewangan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-bus-front"></i>
                        </div>
                        <h5>Kemudahan Kampus</h5>
                        <p class="text-muted mb-0">Lengkap dengan kafeteria, dobi, pengangkutan dan perpustakaan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-credit-card-2-front"></i>
                        </div>
                        <h5>Yuran Berpatutan</h5>
                        <p class="text-muted mb-0">Yuran pengajian yang kompetitif dan berbaloi.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h5>Latihan Industri</h5>
                        <p class="text-muted mb-0">Penempatan latihan industri disediakan pada semester akhir.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-file-earmark-check-fill"></i>
                        </div>
                        <h5>Pinjaman Kewangan</h5>
                        <p class="text-muted mb-0">Bantuan permohonan pinjaman PTPTN disediakan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programmes Section -->
    <section id="programmes" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold">Program Ditawarkan</h2>
                <p class="text-muted lead">Laluan masa depan anda bermula di sini</p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Program 1 -->
                <div class="col-md-4">
                    <div class="program-card h-100">
                        <div class="program-header">
                            <h5 class="m-0 fw-bold">Diploma Pendidikan Awal Kanak-Kanak</h5>
                        </div>
                        <div class="program-body">
                            <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPAKK-%20KUKB.jpg" class="program-link popupimage">
                                <i class="bi bi-image"></i> Infografik
                            </a>
                            <a href="https://drive.google.com/file/d/1YiZgKuj1jnIJ6v7ErH4RXf3CuJtsHLMQ/preview" class="program-link popup-pdf">
                                <i class="bi bi-file-earmark-pdf"></i> Buku Program
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Program 2 -->
                <div class="col-md-4">
                    <div class="program-card h-100">
                        <div class="program-header">
                            <h5 class="m-0 fw-bold">Diploma Pengurusan Industri Halal</h5>
                        </div>
                        <div class="program-body">
                            <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPIH-KUKB.jpg" class="program-link popupimage">
                                <i class="bi bi-patch-check"></i> Infografik
                            </a>
                            <a href="https://drive.google.com/file/d/1tfvhQlNGaHMIGtljHse2grnPDn76eTab/preview" class="program-link popup-pdf">
                                <i class="bi bi-file-earmark-pdf"></i> Buku Program
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Program 3 -->
                <div class="col-md-4">
                    <div class="program-card h-100">
                        <div class="program-header">
                            <h5 class="m-0 fw-bold">Diploma Pengajian Islam</h5>
                        </div>
                        <div class="program-body">
                            <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPI-KUKB-update.jpg" class="program-link popupimage">
                                <i class="bi bi-book"></i> Infografik
                            </a>
                            <a href="https://drive.google.com/file/d/124rO7XVW3Og0ZlpBengplMACG_TSqyRM/preview" class="program-link popup-pdf">
                                <i class="bi bi-file-earmark-pdf"></i> Buku Program
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Program 4 -->
                <div class="col-md-4">
                    <div class="program-card h-100">
                        <div class="program-header">
                            <h5 class="m-0 fw-bold">Diploma Pelancongan Amalan Halal</h5>
                        </div>
                        <div class="program-body">
                            <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPAH-KUKB.jpg" class="program-link popupimage">
                                <i class="bi bi-airplane"></i> Infografik
                            </a>
                            <a href="https://drive.google.com/file/d/1qihW0pigAXj-3l4X16VZFiJ5ANDUR9UV/preview" class="program-link popup-pdf">
                                <i class="bi bi-file-earmark-pdf"></i> Buku Program
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Program 5 -->
                <div class="col-md-4">
                    <div class="program-card h-100">
                        <div class="program-header">
                            <h5 class="m-0 fw-bold">Diploma Pengurusan Muamalat</h5>
                        </div>
                        <div class="program-body">
                            <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPM-KUKB.jpg" class="program-link popupimage">
                                <i class="bi bi-graph-up"></i> Infografik
                            </a>
                            <a href="https://drive.google.com/file/d/1nYXl45rPrJeX3qmtxIX4eLzkZ6ZQPT35/preview" class="program-link popup-pdf">
                                <i class="bi bi-file-earmark-pdf"></i> Buku Program
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Program 6 -->
                <div class="col-md-4">
                    <div class="program-card h-100">
                        <div class="program-header">
                            <h5 class="m-0 fw-bold">Diploma Psikologi</h5>
                        </div>
                        <div class="program-body">
                            <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DP-KUKB-update.jpg" class="program-link popupimage">
                                <i class="bi bi-people"></i> Infografik
                            </a>
                            <a href="https://drive.google.com/file/d/1qSAQHrGmQxhTu5LrWc2wf5XHSk6BN307/preview" class="program-link popup-pdf">
                                <i class="bi bi-file-earmark-pdf"></i> Buku Program
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Program 7 -->
                <div class="col-md-4">
                    <div class="program-card h-100">
                        <div class="program-header">
                            <h5 class="m-0 fw-bold">Diploma Pengurusan</h5>
                        </div>
                        <div class="program-body">
                            <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPengurusan-KUKB.jpg" class="program-link popupimage">
                                <i class="bi bi-briefcase"></i> Infografik
                            </a>
                            <a href="https://drive.google.com/file/d/1ylPoqripsFAxgGGwXLrCJnDgjD-qgoxJ/preview" class="program-link popup-pdf">
                                <i class="bi bi-file-earmark-pdf"></i> Buku Program
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Student Feedback (Videos) -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-6 fw-bold">Apa Kata Pelajar?</h2>
                <p class="text-muted lead">Pengalaman sebenar pelajar kami di Kolej UNITI Kota Bharu.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="ratio ratio-16x9 rounded-4 shadow overflow-hidden">
                        <iframe src="https://www.youtube.com/embed/oTV40GUly44" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="ratio ratio-16x9 rounded-4 shadow overflow-hidden">
                        <iframe src="https://www.youtube.com/embed/yDc03PhCa1U" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="ratio ratio-16x9 rounded-4 shadow overflow-hidden">
                        <iframe src="https://www.youtube.com/embed/tgFxNtVLXTQ" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alumni Section -->
    <section class="py-5 bg-light overflow-hidden">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-6 fw-bold">Alumni Kebanggaan Kami</h2>
                <p class="text-muted lead">Mencipta impak dalam pelbagai industri.</p>
            </div>

            <!-- Horizontal Scroll Container -->
            <div class="d-flex gap-4 overflow-auto pb-4 px-2" style="scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;">
                <!-- Alumni Item 1 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukb4.png" class="card-img-top" alt="Alumni 1">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Fatihah Othman</h5>
                        <p class="text-muted small mb-0">Guru Tadika</p>
                    </div>
                </div>
                <!-- Alumni Item 2 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukb3.png" class="card-img-top" alt="Alumni 2">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Haniff Mohd Zalani</h5>
                        <p class="text-muted small mb-0">Pegawai Ladang</p>
                    </div>
                </div>
                <!-- Alumni Item 3 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukb2.png" class="card-img-top" alt="Alumni 3">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Nurin Athirah</h5>
                        <p class="text-muted small mb-0">Pelajar Ijazah (UPSI)</p>
                    </div>
                </div>
                <!-- Alumni Item 4 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukb5.png" class="card-img-top" alt="Alumni 4">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Aiman Abd Razak</h5>
                        <p class="text-muted small mb-0">Pramugara AirAsia</p>
                    </div>
                </div>
                <!-- Alumni Item 5 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kukb1.png" class="card-img-top" alt="Alumni 5">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Wan Nor Aisah</h5>
                        <p class="text-muted small mb-0">Ustazah Fardhu Ain</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-center">
        <div class="container position-relative">
            <h2 class="display-4 fw-bold mb-3">Sertai Keluarga KUKB</h2>
            <p class="lead mb-4 opacity-75">Bina masa depan cemerlang bersama kami di Kota Bharu.</p>
            <a href="{{ route('student.register-kukb', ['source' => request('source'), 'ref' => request('ref')]) }}" class="btn btn-primary-custom btn-lg px-5 py-3 fs-5">
                Daftar Secara Online Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <!-- <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/ku1.png" alt="Logo" class="mb-3" style="height:60px;"> -->
                    <h5 class="fw-bold">Kolej UNITI Kota Bharu</h5>
                    <p>Kampus Kijang, Lot 1911,<br>Jalan Pantai Cahaya Bulan,<br>15350 Kota Bharu, Kelantan</p>
                    <p><i class="bi bi-telephone me-2"></i> +609-774 7449</p>
                    <p><i class="bi bi-envelope me-2"></i> info@uniti.edu.my</p>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold">Pautan Pantas</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Laman Utama</a></li>
                        <li class="mb-2"><a href="#programmes">Program</a></li>
                        <li class="mb-2"><a href="{{ route('semak.permohonan.kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Semak Permohonan</a></li>
                        <li class="mb-2"><a href="{{ route('student.register-kukb') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Daftar Online</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold">Ikuti Kami</h5>
                    <div class="d-flex gap-3 mt-3">
                        <a href="https://unitikotabharu.edu.my/" class="social-link" target="_blank"><i class="bi bi-globe"></i></a>
                        <a href="https://web.facebook.com/kolejunitikotabharu" class="social-link" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/kolejunitikotabharu/" class="social-link" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.tiktok.com/@kolejunitikotabharu" class="social-link" target="_blank"><i class="bi bi-tiktok"></i></a>
                        <a href="https://www.youtube.com/@kolejunitikotabharu" class="social-link" target="_blank"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4 opacity-50">
            <div class="text-center opacity-75">
                <small>Hak Cipta Terpelihara &copy; {{ date('Y') }} Kolej UNITI. All Rights Reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Modals (Copied and styled from original) -->
    <div id="imageModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-body p-0 text-center">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <img src="" id="popupImage" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </div>

    <div id="pdfModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered" style="height: 90vh;">
            <div class="modal-content h-100">
                <div class="modal-header">
                    <h5 class="modal-title">Buku Program</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <iframe id="popupPdf" src="" style="width: 100%; height: 100%;" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>


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

        // Popup Logic
        document.querySelectorAll('.popupimage').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const src = item.getAttribute('href');
                document.getElementById('popupImage').src = src;
                new bootstrap.Modal(document.getElementById('imageModal')).show();
            });
        });

        document.querySelectorAll('.popup-pdf').forEach(item => {
            item.addEventListener('click', event => {
                event.preventDefault();
                const src = item.getAttribute('href');
                document.getElementById('popupPdf').src = src;
                new bootstrap.Modal(document.getElementById('pdfModal')).show();
            });
        });
    </script>
</body>

</html>