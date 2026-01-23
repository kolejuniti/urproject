@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
    body {
        background: #f5f7fa;
    }

    .hero-section {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #d946ef 100%);
        color: white;
        padding: 50px 0;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }

    .hero-section .container {
        position: relative;
        z-index: 1;
    }

    .hero-section h1 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .hero-section p {
        font-size: 0.95rem;
        margin-bottom: 1.2rem;
        opacity: 0.95;
    }

    .btn-hero {
        padding: 10px 28px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 25px;
        background: white;
        color: #6366f1;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .btn-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        color: #8b5cf6;
        background: white;
    }

    .poster-section {
        padding: 30px 0;
        background: white;
    }

    .poster-section h2 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.5rem;
    }

    .features-section {
        padding: 40px 0;
        background: #f5f7fa;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        border-radius: 2px;
    }

    .feature-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        text-align: left;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.15);
        border-color: #6366f1;
    }

    .feature-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .feature-content h3 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.4rem;
    }

    .feature-content p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }

    .cta-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%);
        color: white;
        padding: 40px 0;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .cta-section .container {
        position: relative;
        z-index: 1;
    }

    .cta-section h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
    }

    .cta-section p {
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
        opacity: 0.9;
    }

    .btn-cta {
        padding: 11px 32px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 25px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        transition: all 0.3s ease;
    }

    .btn-cta:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
        background: linear-gradient(135deg, #8b5cf6, #6366f1);
    }

    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 1.5rem;
        }

        .feature-card {
            flex-direction: column;
            text-align: center;
            align-items: center;
        }

        .feature-content h3 {
            text-align: center;
        }

        .feature-content p {
            text-align: center;
        }

        .cta-section h2 {
            font-size: 1.3rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1><i class="fas fa-handshake me-2"></i>Program Affiliate UNITI</h1>
                <p>Jana pendapatan pasif dengan berkongsi peluang pendidikan berkualiti</p>
                <a href="{{ route('affiliate.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-hero">
                    <i class="fas fa-rocket me-2"></i>Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

@if (now()->lte(\Carbon\Carbon::create(2025, 9, 16)))
<!-- Poster Section -->
<section class="poster-section">
    <div class="container text-center">
        <h2><i class="fas fa-gift me-2"></i>Tawaran Terhad</h2>
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/tawaran_istimewa_affiliate_uniti.jpg" alt="Program Poster" class="img-fluid rounded shadow">
    </div>
</section>
@endif

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h2 class="section-title">Kenapa Pilih Program Kami?</h2>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Pendapatan Tambahan</h3>
                        <p>Terima komisen untuk setiap pelajar yang mendaftar melalui rujukan anda</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Rangkaian Luas</h3>
                        <p>Manfaatkan rangkaian anda dalam kalangan pelajar, ibu bapa dan komuniti</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-link"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Mudah & Fleksibel</h3>
                        <p>Kongsi pautan di media sosial bila-bila masa, di mana sahaja</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Tanpa Modal</h3>
                        <p>Tiada kos permulaan diperlukan, hanya promosi dan berkongsi</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Pendidikan Berkualiti</h3>
                        <p>Bantu pelajar akses pendidikan berkualiti di Kolej UNITI</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="feature-content">
                        <h3>Ganjaran & Bonus</h3>
                        <p>Bonus prestasi, sijil penghargaan dan pengiktirafan istimewa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2><i class="fas fa-chart-line me-2"></i>Mula Jana Pendapatan Hari Ini</h2>
                <p>Sertai ribuan ahli yang berjaya. Tiada pengalaman diperlukan - kami akan membimbing anda!</p>
                <a href="{{ route('affiliate.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-cta">
                    <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection