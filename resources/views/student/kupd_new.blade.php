<!doctype html>
<html lang="ms">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kolej UNITI Port Dickson | Pilihan Terbaik Anda</title>

    <!-- Meta -->
    <meta name="description" content="Sambung Pengajian di Kolej UNITI Port Dickson. Diploma diiktiraf MQA.">
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
            /* KUPD Theme: Royal Blue & Gold */
            --primary: #1e40af;
            /* Blue 800 */
            --primary-dark: #1e3a8a;
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
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
            transition: transform 0.2s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
            color: white;
        }

        /* Hero Section */
        /* Hero Section */
        .hero-section {
            position: relative;
            padding: 8rem 0 5rem;
            background: radial-gradient(circle at top right, rgba(217, 119, 6, 0.1), transparent 40%),
                linear-gradient(to bottom, #ffffff, #eff6ff);
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
            background: url('https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupdonly.png') no-repeat center right;
            /* Fallback/Placeholder style */
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
            background: rgba(30, 64, 175, 0.1);
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
            border-color: var(--accent);
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
            background: #eff6ff;
            border-bottom: 1px solid #f1f5f9;
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
            background: #f1f5f9;
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
            background: var(--primary);
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
            background: #1e3a8a;
            color: #cbd5e1;
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
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
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
                <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupdonly.png" alt="Kolej UNITI Port Dickson">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Pilih Kampus</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('semak.permohonan.kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Semak Permohonan</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary-custom" href="{{ route('student.register-kupd', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}">
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
                        <i class="fas fa-check-circle me-1 text-success"></i> No. Pendaftaran: DK036(N)
                    </span>
                    <h1 class="hero-title fw-bold">UNITI <span class="text-warning">Pilihan Terbaik</span><br>Masa Depan Anda</h1>
                    <p class="lead text-muted mb-4">
                        Pendidikan berkualiti dengan persekitaran pembelajaran yang kondusif. Mula langkah kejayaan anda di Kolej UNITI Port Dickson hari ini.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#programmes" class="btn btn-dark btn-lg rounded-pill px-4">Lihat Program</a>
                        <a href="https://www.youtube.com/watch?v=c5QQ4-zodRc" target="_blank" class="btn btn-outline-dark btn-lg rounded-pill px-4"><i class="bi bi-play-circle me-2"></i> Video Korporat</a>
                    </div>
                </div>
                <!-- Hero Image Slider/Carousel in a nice frame -->
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
                        <div class="stat-number">28</div>
                        <div class="stat-label">Tahun Kecemerlangan</div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-card">
                        <div class="stat-number">10,000+</div>
                        <div class="stat-label">Graduan Dilahirkan</div>
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
                    <p class="text-muted lead mb-5">Kualiti pendidikan yang terjamin dan diiktiraf oleh Agensi Kelayakan Malaysia (MQA) serta Kementerian Pengajian Tinggi.</p>
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
                <span class="text-primary fw-bold text-uppercase ls-1">Kenapa UNITI?</span>
                <h2 class="display-6 fw-bold mt-2">Fasiliti & Kemudahan Lengkap</h2>
                <div class="vr bg-warning opacity-100 mx-auto mt-3" style="height: 3px; width: 60px; border:none; display:block;"></div>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-buildings-fill"></i>
                        </div>
                        <h5>Kolej Kediaman</h5>
                        <p class="text-muted mb-0">Penginapan selesa disediakan sepanjang tempoh pengajian anda di sini.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h5>Bantuan Kewangan</h5>
                        <p class="text-muted mb-0">Pelbagai bantuan kewangan dan pinjaman PTPTN disediakan untuk yang layak.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-bus-front"></i>
                        </div>
                        <h5>Kemudahan Kampus</h5>
                        <p class="text-muted mb-0">Lengkap dengan kafeteria, dobi, pengangkutan, perpustakaan dan surau.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-credit-card-2-front"></i>
                        </div>
                        <h5>Yuran Berpatutan</h5>
                        <p class="text-muted mb-0">Yuran pengajian yang berpatutan dan berbaloi dengan kualiti pendidikan.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h5>Latihan Industri</h5>
                        <p class="text-muted mb-0">Jaringan industri yang luas untuk penempatan latihan praktikal pelajar.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h5>Program Diiktiraf</h5>
                        <p class="text-muted mb-0">Semua program diploma mendapat akreditasi penuh MQA.</p>
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
                <p class="text-muted lead">Pilih laluan kerjaya anda melalui program diploma kami</p>
            </div>

            <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-ftk-tab" data-bs-toggle="pill" data-bs-target="#pills-ftk" type="button" role="tab">Teknologi & Kejuruteraan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-fpih-tab" data-bs-toggle="pill" data-bs-target="#pills-fpih" type="button" role="tab">Pengurusan & Industri Halal</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-fppm-tab" data-bs-toggle="pill" data-bs-target="#pills-fppm" type="button" role="tab">Pendidikan & Pembangunan Manusia</button>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <!-- FTK -->
                <div class="tab-pane fade show active" id="pills-ftk" role="tabpanel">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Graphic Design</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DIGD.jpg" class="program-link popupimage">
                                        <i class="bi bi-image"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1n_AJ28Kz-14X72KATn55Y0Fwa0eKoSfP/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Information Technology</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DIT-updated.jpg" class="program-link popupimage">
                                        <i class="bi bi-laptop"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1RJgMJportV67hl_6r15QrF1MtoND8JVi/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Komunikasi & Media</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DKM.jpg" class="program-link popupimage">
                                        <i class="bi bi-camera-reels"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1IiUtjTkALGed07Rtrfkjwqfr764KF4aF/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FPIH -->
                <div class="tab-pane fade" id="pills-fpih" role="tabpanel">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Perakaunan</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPerakaunan.jpg" class="program-link popupimage">
                                        <i class="bi bi-graph-up"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1L3OJq8bZ5W-WrO7MfOs-dqOzqc4cYPFQ/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Pengurusan Industri Halal</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPIH.jpg" class="program-link popupimage">
                                        <i class="bi bi-patch-check"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/13LwgqUeR6NlmYA2qNHpOd-Pgbb-FJrav/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Pengurusan Perniagaan</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPP.jpg" class="program-link popupimage">
                                        <i class="bi bi-briefcase"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1xRgU15dHEpigQwSWXPU-dMZXPMSS9AqY/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Add more FPIH cards as needed -->
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Pengajian Islam</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPI.jpg" class="program-link popupimage">
                                        <i class="bi bi-book"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1z7ZXrJlcMRtblkN98XTpX97N_Axngr3g/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FPPM -->
                <div class="tab-pane fade" id="pills-fppm" role="tabpanel">
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Pendidikan Awal Kanak-Kanak</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPAKK.jpg" class="program-link popupimage">
                                        <i class="bi bi-emoji-smile"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1FY-Tx6bXn1LyPktJaO7h4nwozbMAzJKL/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Pendidikan Islam (Sek. Rendah)</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPISR.jpg" class="program-link popupimage">
                                        <i class="bi bi-journal-text"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1DpEyExGY58xb7VsnNkYehDY3DiNlsVTH/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="program-card h-100">
                                <div class="program-header">
                                    <h5 class="m-0 fw-bold">Diploma Psikologi Kaunseling</h5>
                                </div>
                                <div class="program-body">
                                    <a href="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/DPK.jpg" class="program-link popupimage">
                                        <i class="bi bi-people"></i> Infografik
                                    </a>
                                    <a href="https://drive.google.com/file/d/1FmFJC4YMPxhHFhzEITz8PSdTUeqfFoQC/preview" class="program-link popup-pdf">
                                        <i class="bi bi-file-earmark-pdf"></i> Buku Program
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Facilities Gallery Carousel -->
    <section class="py-5">
        <div class="container">
            <h2 class="display-6 fw-bold text-center mb-5">Galeri Fasiliti</h2>
            <div class="owl-carousel owl-theme facilities-carousel">
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/cafe.jpg" alt="Cafetaria">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Cafetaria</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/koop.jpg" alt="Kedai Runcit Koop">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Kedai Runcit Koop</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/atm.jpg" alt="Mesin ATM">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Mesin ATM</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/library.jpg" alt="Perpustakaan">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Perpustakaan</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/bk.jpg" alt="Bilik Kuliah">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Bilik Kuliah</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/halal.jpg" alt="Bengkel Halal">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Bengkel Halal</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/kaunseling.jpg" alt="Bilik Kaunseling">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Bilik Kaunseling</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/komputer.jpg" alt="Makmal Komputer">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Makmal Komputer</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/guard.jpg" alt="Kawalan Keselamatan">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Kawalan Keselamatan 24 Jam</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/bus.jpg" alt="Perkhidmatan Bas Awam">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Perkhidmatan Bas Awam</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/court.jpg" alt="Gelanggang Sukan">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Gelanggang Sukan</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="facility-item">
                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/dobi.jpg" alt="Dobi Layan Diri">
                        <div class="facility-overlay">
                            <h5 class="text-white fw-bold">Dobi Layan Diri</h5>
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
                <p class="text-muted lead">Pengalaman sebenar pelajar kami di Kolej UNITI Port Dickson.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="ratio ratio-16x9 rounded-4 shadow overflow-hidden">
                        <iframe src="https://www.youtube.com/embed/Jmbz6cTQsOs" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="ratio ratio-16x9 rounded-4 shadow overflow-hidden">
                        <iframe src="https://www.youtube.com/embed/c-JiZnuxK4U" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="ratio ratio-16x9 rounded-4 shadow overflow-hidden">
                        <iframe src="https://www.youtube.com/embed/Wi4qGXYdV0U" allowfullscreen></iframe>
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
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;" data-aos="fade-left" data-aos-delay="0">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd6.png" class="card-img-top" alt="Iman">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Iman Chaiyalan</h5>
                        <p class="text-muted small mb-0">Pempengaruh Media Sosial</p>
                    </div>
                </div>
                <!-- Alumni Item 2 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;" data-aos="fade-left" data-aos-delay="100">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd7.png" class="card-img-top" alt="Ammar">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Ammar Hamizan</h5>
                        <p class="text-muted small mb-0">Pempengaruh Media Sosial</p>
                    </div>
                </div>
                <!-- Alumni Item 3 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;" data-aos="fade-left" data-aos-delay="200">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd3.png" class="card-img-top" alt="Auni">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Auni Izzati</h5>
                        <p class="text-muted small mb-0">Pelajar Ijazah (UPM)</p>
                    </div>
                </div>
                <!-- Alumni Item 4 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;" data-aos="fade-left" data-aos-delay="300">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd1.png" class="card-img-top" alt="Aniesha">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Aniesha Azyyati</h5>
                        <p class="text-muted small mb-0">Social Media Executive</p>
                    </div>
                </div>
                <!-- Alumni Item 5 -->
                <div class="card border-0 shadow-sm flex-shrink-0" style="width: 280px; scroll-snap-align: center;" data-aos="fade-left" data-aos-delay="400">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/kupd2.png" class="card-img-top" alt="Ammar Irfan">
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">Ammar Irfan</h5>
                        <p class="text-muted small mb-0">Pramugara Air Asia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section text-center">
        <div class="container position-relative">
            <h2 class="display-4 fw-bold mb-3">Tunggu Apa Lagi?</h2>
            <p class="lead mb-4 opacity-75">Jangan Lepaskan Peluang Anda!</p>
            <a href="{{ route('student.register-kupd', ['source' => request('source'), 'ref' => request('ref')]) }}" class="btn btn-primary-custom btn-lg px-5 py-3 fs-5">
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
                    <h5 class="fw-bold">Kolej UNITI Port Dickson</h5>
                    <p>UNITI Village, Persiaran UNITI, Tanjung Agas<br>71250 Port Dickson, Negeri Sembilan</p>
                    <p><i class="bi bi-telephone me-2"></i> +06-602 0303</p>
                    <p><i class="bi bi-envelope me-2"></i> info@uniti.edu.my</p>
                </div>
                <div class="col-lg-3">
                    <h5 class="fw-bold">Pautan Pantas</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ url('/') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Laman Utama</a></li>
                        <li class="mb-2"><a href="{{ route('student.kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}#programmes">Program</a></li>
                        <li class="mb-2"><a href="{{ route('semak.permohonan.kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Semak Permohonan</a></li>
                        <li class="mb-2"><a href="{{ route('student.register-kupd') . (isset($source) ? '?source=' . $source : '') . (isset($ref) ? (isset($source) ? '&' : '?') . 'ref=' . $ref : '') }}">Daftar Online</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold">Ikuti Kami</h5>
                    <div class="d-flex gap-3 mt-3">
                        <a href="https://uniti.edu.my/" class="social-link" target="_blank"><i class="bi bi-globe"></i></a>
                        <a href="https://www.facebook.com/kolejunitiportdickson" class="social-link" target="_blank"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/kolejunitiportdickson/" class="social-link" target="_blank"><i class="bi bi-instagram"></i></a>
                        <a href="https://www.tiktok.com/@kolejunitipd" class="social-link" target="_blank"><i class="bi bi-tiktok"></i></a>
                        <a href="https://www.youtube.com/@KolejUnitiPortDickson" class="social-link" target="_blank"><i class="bi bi-youtube"></i></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        $(document).ready(function() {
            $(".facilities-carousel").owlCarousel({
                loop: true,
                margin: 20,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 4
                    }
                }
            });
        });

        // Sticky Navbar Script
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').classList.add('shadow-sm');
                document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                document.querySelector('.navbar').classList.remove('shadow-sm');
                document.querySelector('.navbar').style.background = 'rgba(255, 255, 255, 0.9)';
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