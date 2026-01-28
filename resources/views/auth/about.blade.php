@extends('layouts.app')

@section('content')
<!-- Custom CSS for Premium Look -->
<style>
    :root {
        --primary-color: #4f46e5;
        /* Indigo 600 */
        --secondary-color: #ec4899;
        /* Pink 500 */
        --accent-color: #8b5cf6;
        /* Violet 500 */
        --dark-bg: #0f172a;
        /* Slate 900 */
        --light-bg: #f8fafc;
        /* Slate 50 */
        --text-color: #334155;
        /* Slate 700 */
    }

    body {
        font-family: 'Outfit', 'Nunito', sans-serif;
        /* utilizing existing font or fallback */
        background-color: var(--light-bg);
        overflow-x: hidden;
    }

    /* Hero Section */
    .hero-section {
        background: radial-gradient(circle at top right, #4338ca, transparent),
            radial-gradient(circle at bottom left, #be185d, transparent),
            linear-gradient(135deg, #1e1b4b, #312e81);
        color: white;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }

    .hero-shapes div {
        position: absolute;
        border-radius: 50%;
        opacity: 0.2;
        filter: blur(50px);
        animation: float 10s infinite ease-in-out;
    }

    .shape-1 {
        width: 300px;
        height: 300px;
        top: -50px;
        left: -50px;
        background: var(--secondary-color);
    }

    .shape-2 {
        width: 200px;
        height: 200px;
        bottom: 10%;
        right: 10%;
        background: var(--primary-color);
        animation-delay: 2s;
    }

    .shape-3 {
        width: 150px;
        height: 150px;
        top: 20%;
        right: 20%;
        background: var(--accent-color);
        animation-delay: 4s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        background: linear-gradient(to right, #fff, #cecece);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }

    .hero-content p {
        font-size: 1.25rem;
        color: #cbd5e1;
        margin-bottom: 2rem;
        max-width: 600px;
    }

    .btn-glow {
        background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
        color: white;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        border: none;
        box-shadow: 0 0 20px rgba(236, 72, 153, 0.5);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
        text-decoration: none;
        display: inline-block;
    }

    .btn-glow::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        z-index: -1;
        transition: opacity 0.3s ease;
        opacity: 0;
    }

    .btn-glow:hover::before {
        opacity: 1;
    }

    .btn-glow:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(236, 72, 153, 0.7);
        color: white;
    }

    /* Stats/Commission Section */
    .commission-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .commission-card:hover {
        transform: translateY(-10px);
    }

    .commission-amount {
        font-size: 3rem;
        font-weight: 800;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .commission-label {
        font-size: 1.1rem;
        color: var(--text-color);
        font-weight: 600;
    }

    /* Process Section */
    .process-step {
        position: relative;
        padding: 2rem;
        background: white;
        border-radius: 16px;
        z-index: 1;
        border: 1px solid #e2e8f0;
        transition: all 0.3s;
    }

    .process-step:hover {
        border-color: var(--primary-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .step-icon {
        width: 60px;
        height: 60px;
        background: #e0e7ff;
        color: var(--primary-color);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    /* Features/Benefits */
    .benefit-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 2rem;
    }

    .benefit-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 1rem;
        margin-top: 5px;
    }

    /* CTA Bottom */
    .cta-bottom {
        background: linear-gradient(135deg, #0f172a, #334155);
        border-radius: 30px;
        padding: 4rem 2rem;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }

        .commission-amount {
            font-size: 2.5rem;
        }
    }
</style>

<!-- Navbar spacer if needed (depends on layout) -->
<!-- <div style="height: 70px;"></div> -->

<div class="hero-section">
    <div class="hero-shapes">
        <div class="shape-1"></div>
        <div class="shape-2"></div>
        <div class="shape-3"></div>
    </div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-content">
                    <h1>Jana Pendapatan Pasif <br> Tanpa Modal</h1>
                    <p>Sertai Komuniti Affiliate Kolej UNITI. Kongsi pautan pendidikan di media sosial anda dan nikmati ganjaran lumayan bagi setiap pendaftaran.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('affiliate.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-glow">
                            Daftar Affiliate Sekarang <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <!-- <a href="#how-it-works" class="btn btn-outline-light rounded-pill px-4 py-3 fw-bold">Ketahui Lebih Lanjut</a> -->
                    </div>
                    <div class="mt-4 d-flex align-items-center text-white-50">
                        <i class="fas fa-check-circle text-success me-2"></i> Percuma Seumur Hidup
                        <span class="mx-3">|</span>
                        <i class="fas fa-check-circle text-success me-2"></i> Bahan Pemasaran Disediakan
                    </div>
                </div>
            </div>
            <div class="col-lg-5 text-center mt-4 mt-lg-0">
                <!-- Abstract 3D Illustration or Image representation -->
                <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/poster_affiliate_3.webp" onerror="this.src='https://placehold.co/500x500/png?text=Affiliate+Marketing'" alt="Affiliate Marketing" class="img-fluid animate__animated animate__fadeInRight" style="filter: drop-shadow(0 20px 40px rgba(0,0,0,0.3)); max-height: 500px;">
            </div>
        </div>
    </div>
</div>

<div class="container py-5 mt-5">
    <div class="text-center mb-5">
        <span class="text-uppercase fw-bold text-primary tracking-wider">Potensi Pendapatan</span>
        <h2 class="fw-bold mt-2 display-6">Struktur Komisen Kami</h2>
        <p class="text-muted">Ganjaran lumayan menanti usaha anda</p>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-md-5">
            <div class="commission-card">
                <div class="icon mb-3">
                    <i class="fas fa-database fa-2x text-primary opacity-50"></i>
                </div>
                <div class="commission-amount">RM 10.00</div>
                <h3 class="h5 fw-bold text-dark">Setiap Data Prospek</h3>
                <p class="text-muted">Dibayar apabila prospek mendaftar minat menggunakan kod rujukan anda.</p>
            </div>
        </div>
        <div class="col-md-5">
            <div class="commission-card border-2 border-primary" style="background: #fdf2f8;">
                <div class="icon mb-3">
                    <i class="fas fa-graduation-cap fa-2x text-secondary opacity-50"></i>
                </div>
                <div class="commission-amount text-secondary">RM 500.00</div>
                <h3 class="h5 fw-bold text-dark">Setiap Pendaftaran Pelajar</h3>
                <p class="text-muted">Bonus besar apabila prospek berjaya mendaftar masuk ke Kolej UNITI.</p>
            </div>
        </div>
    </div>
</div>

<section id="how-it-works" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <span class="text-uppercase fw-bold text-secondary tracking-wider">Mudah & Pantas</span>
            <h2 class="fw-bold mt-2 display-6">Bagaimana Ia Berfungsi?</h2>
        </div>

        <div class="row g-4 position-relative">
            <!-- Connecting line for desktop could be added here purely with CSS -->
            <div class="col-lg-3 col-md-6">
                <div class="process-step h-100">
                    <div class="step-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h4 class="fw-bold h5">1. Daftar Akaun</h4>
                    <p class="text-muted small">Daftar akaun Affiliate anda secara percuma. Hanya perlukan butiran asas.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="process-step h-100">
                    <div class="step-icon" style="background-color: #fce7f3; color: var(--secondary-color);">
                        <i class="fas fa-link"></i>
                    </div>
                    <h4 class="fw-bold h5">2. Dapat Kod Rujukan Unik</h4>
                    <p class="text-muted small">Sistem akan menjana kod rujukan dan pautan unik automatik untuk anda.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="process-step h-100">
                    <div class="step-icon" style="background-color: #ede9fe; color: var(--accent-color);">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h4 class="fw-bold h5">3. Kongsi & Promosi</h4>
                    <p class="text-muted small">Gunakan bahan media yang kami sediakan. Kongsi di TikTok, Facebook, WhatsApp, dll.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="process-step h-100">
                    <div class="step-icon" style="background-color: #d1fae5; color: #059669;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h4 class="fw-bold h5">4. Terima Bayaran</h4>
                    <p class="text-muted small">Pantau prestasi anda di dashboard dan terima bayaran komisen anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold display-6 mb-4">Kenapa Anda Perlu Sertai Kami?</h2>

                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-ban"></i></div>
                    <div>
                        <h5 class="fw-bold">Tiada Yuran Pendaftaran</h5>
                        <p class="text-muted mb-0">Pendaftaran adalah 100% PERCUMA. Anda tidak perlu mengeluarkan sebarang modal untuk bermula.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-photo-video"></i></div>
                    <div>
                        <h5 class="fw-bold">Bahan Media Disediakan</h5>
                        <p class="text-muted mb-0">Tak pandai design? Tak pandai copywriting? Jangan risau. Kami sediakan 'Bank Media' dengan poster dan ayat iklan untuk anda 'copy & paste'.</p>
                    </div>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon"><i class="fas fa-hands-helping"></i></div>
                    <div>
                        <h5 class="fw-bold">Bantu Masyarakat Pendidikan</h5>
                        <p class="text-muted mb-0">Sambil menjana pendapatan, anda membantu pelajar lepasan sekolah menyambung pengajian ke peringkat yang lebih tinggi.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-4 bg-white rounded-4 shadow-sm border">
                    <div class="d-flex align-items-center mb-4">
                        <div class="rounded-circle bg-light p-3 me-3">
                            <i class="fas fa-quote-left fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0">Apa Kata Affiliate Kami?</h5>
                            <small class="text-muted">Real stories form real people</small>
                        </div>
                    </div>

                    <div class="card border-0 bg-light mb-3 p-3">
                        <p class="mb-2 fst-italic">"Saya student IPTA, buat affiliate ni simple sangat. Share link di status WhatsApp kawan-kawan sekolah dulu. Bulan lepas dapat RM600, lepas duit poket!"</p>
                        <div class="d-flex align-items-center">
                            <div class="fw-bold small text-dark">- Aiman, Pelajar</div>
                        </div>
                    </div>

                    <div class="card border-0 bg-light p-3">
                        <p class="mb-2 fst-italic">"Suri rumah macam saya pun boleh buat. Kolej sediakan gambar cantik-cantik, saya post je kat FB Group. Alhamdulillah rezeki anak-anak."</p>
                        <div class="d-flex align-items-center">
                            <div class="fw-bold small text-dark">- Pn. Sarah, Suri Rumah</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container pb-5 mb-5">
    <div class="cta-bottom shadow-lg">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="fw-bold mb-3">Bersedia Untuk Mula?</h2>
                <p class="lead mb-4 opacity-75">Sertai kami hari ini dan mula jana pendapatan sampingan dengan mudah.</p>
                <a href="{{ route('affiliate.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-glow">
                    Daftar Sebagai Affiliate Sekarang
                </a>
                <p class="mt-3 small opacity-50">Tertakluk kepada terma & syarat.</p>
            </div>
        </div>
    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
@endsection