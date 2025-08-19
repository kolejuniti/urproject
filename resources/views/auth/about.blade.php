@extends('layouts.app')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        
        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        
        .btn-hero {
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
        }
        
        .features-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }
        
        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }
        
        .cta-section {
            background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
            color: white;
            padding: 80px 0;
        }
        
        .cta-section h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        
        .btn-cta {
            padding: 18px 45px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            margin: 0 10px 10px 0;
        }
        
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            
            .cta-section h2 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1>Program Affiliate UNITI</h1>
                    <p class="lead">Jana Pendapatan Dengan Berkongsi.</p>
                    <a href="{{ route('affiliate.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-danger btn-cta">Jom Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    @if (now()->lte(\Carbon\Carbon::create(2025, 9, 16)))
    <!-- Poster Section -->
    <section class="my-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Tawaran Terhad</h2>
            <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/img/tawaran_istimewa_affiliate_uniti.jpg" alt="Program Poster" class="img-fluid rounded shadow">
        </div>
    </section>
    @endif

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold">Kenapa Pilih Program Kami?</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card shadow">
                        <div class="feature-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <h3 class="h4 mb-3">Peluang Menjana Pendapatan Tambahan</h3>
                        <p>Anda akan menerima komisen bagi setiap pelajar yang mendaftar di Kolej UNITI melalui pautan atau rujukan anda.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card shadow">
                        <div class="feature-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="h4 mb-3">Memanfaatkan Rangkaian Anda</h3>
                        <p>Memanfaatkan rangkaian yang luas di dalam kalangan pelajar, ibu bapa atau komuniti pendidikan dengan memperkenalkan Kolej UNITI.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card shadow">
                        <div class="feature-icon">
                            <i class="bi bi-link-45deg"></i>
                        </div>
                        <h3 class="h4 mb-3">Mudah dan Fleksibel</h3>
                        <p>Anda boleh berkongsi pautan atau rujukan anda di mana-mana media sosial tanpa mengira masa dan tempat.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-2">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card shadow">
                        <div class="feature-icon">
                            <i class="bi bi-bank"></i>
                        </div>
                        <h3 class="h4 mb-3">Tanpa Modal Besar</h3>
                        <p>Tidak memerlukan kos permulaan yang tinggi. Anda hanya perlu mempromosikan pautan atau rujukan anda.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card shadow">
                        <div class="feature-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h3 class="h4 mb-3">Menyumbang Kepada Pendidikan Berkualiti</h3>
                        <p>Dengan memperkenalkan pelajar kepada Kolej UNITI, anda membantu mereka mendapatkan akses pendidikan berkualiti yang ditawarkan.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card shadow">
                        <div class="feature-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <h3 class="h4 mb-3">Ganjaran dan Pengiktirafan</h3>
                        <p>Selain komisen, anda mungkin menerima ganjaran lain seperti bonus prestasi, sijil penghargaan atau pengiktirafan lain daripada Kolej UNITI sebagai tanda penghargaan atas sumbangan anda.</p>
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
                    <h2>Sudahkan Anda Bersedia Untuk Menjana Pendapatan?</h2>
                    <p class="lead">Sertai beribu-ribu ahli yang telah mendaftar dengan program kami. Tiada pengalaman diperlukan - kami sedia membimbing anda.</p>
                    <div class="d-flex flex-wrap justify-content-center">
                        <a href="{{ route('affiliate.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-danger btn-cta">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection
