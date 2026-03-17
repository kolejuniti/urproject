<!doctype html>
<html lang="ms">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar | Kolej UNITI Port Dickson</title>

    <!-- Meta -->
    <meta name="description" content="Daftar Pengajian di Kolej UNITI Port Dickson. Diploma diiktiraf MQA.">
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

            /* Form Specific */
            --input-bg: #f8fafc;
            --border-color: #cbd5e1;
        }

        body {
            font-family: var(--font-main);
            color: var(--text-main);
            background-color: var(--light);
            line-height: 1.6;
            overflow-x: hidden;
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
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.3);
            transition: transform 0.2s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
            color: white;
        }

        /* Registration Form Styles */
        .register-container {
            max-width: 900px;
            margin: 120px auto 60px;
            /* Analyzed: Top margin for navbar */
            padding: 0 15px;
        }

        .register-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            animation: slideUp 0.6s ease-out;
        }

        .card-header-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -50px;
            left: -50px;
        }

        .card-header-custom::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -20px;
            right: -20px;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            margin: 25px 0 15px;
            display: flex;
            align-items: center;
            border-bottom: 2px solid var(--light);
            padding-bottom: 10px;
        }

        .form-section-title i {
            margin-right: 10px;
            background: var(--light);
            color: var(--primary);
            padding: 8px;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-floating>.form-control,
        .form-floating>.form-select {
            border-radius: var(--radius-sm);
            border: 1px solid var(--border-color);
            background-color: var(--input-bg);
            transition: all 0.3s ease;
        }

        .form-floating>.form-control:focus,
        .form-floating>.form-select:focus {
            border-color: var(--primary);
            background-color: white;
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
        }

        .btn-register {
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
            transition: all 0.3s;
            box-shadow: 0 10px 20px rgba(30, 64, 175, 0.3);
            width: 100%;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(30, 64, 175, 0.4);
            color: white;
        }

        .file-upload-box {
            background: var(--input-bg);
            border: 2px dashed var(--border-color);
            border-radius: var(--radius-sm);
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .file-upload-box:hover {
            border-color: var(--primary);
            background: white;
        }

        .info-text {
            background: #fffbeb;
            border-left: 4px solid var(--accent);
            padding: 12px 15px;
            border-radius: var(--radius-sm);
            margin-top: 10px;
        }

        .info-text small {
            display: block;
            color: #92400e;
        }

        @keyframes slideUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Footer */
        footer {
            background: #1e3a8a;
            /* Dark Blue */
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
                    <li class=" nav-item"><a class="nav-link" href="{{ route('semak.permohonan.kupd') }}">Semak Permohonan</a></li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary-custom" href="{{ route('student.register-kupd', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}">
                            Daftar Sekarang <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="register-container">
        @if ($errors->any())
        <div class="alert alert-danger shadow-sm rounded-4 mb-4 border-0">
            <strong><i class="fas fa-exclamation-circle me-2"></i>Sila betulkan ralat berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(session('msg_error'))
        <div class="alert alert-danger shadow-sm rounded-4 mb-4 border-0 d-flex align-items-center">
            <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
            <div>{{ session('msg_error') }}</div>
        </div>
        @endif

        <div class="register-card">
            <div class="card-header-custom">
                <h2 class="mb-0 fw-bold">Borang Daftar Minat</h2>
                <p class="mb-0 text-white-50">Kolej UNITI Port Dickson</p>
            </div>

            <form action="{{ route('student.register-kupd.post') }}" method="POST" enctype="multipart/form-data" class="needs-validation p-4 p-md-5" novalidate>
                @csrf

                <!-- Personal Info -->
                <div class="form-section-title">
                    <i class="fas fa-user"></i> Maklumat Peribadi
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Penuh" required autofocus>
                        <label for="name">Nama Penuh</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="text" name="ic" id="ic" class="form-control" maxlength="12" placeholder="No. KP" required oninput="this.value = this.value.replace(/[-\s]/g, '')">
                        <label for="ic">No. Kad Pengenalan</label>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6 form-floating">
                        <input type="tel" name="phone" id="phone" placeholder="No. Telefon" oninput="formatPhoneNumber(this)" class="form-control" maxlength="13" required>
                        <label for="phone">No. Telefon</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
                        <label for="email">Alamat Email</label>
                    </div>
                </div>

                <!-- Address Info -->
                <div class="form-section-title">
                    <i class="fas fa-map-marker-alt"></i> Alamat Kediaman
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12 form-floating">
                        <input type="text" name="address1" id="address1" class="form-control" placeholder="Alamat 1" required>
                        <label for="address1">Alamat Baris 1</label>
                    </div>
                    <div class="col-12 form-floating">
                        <input type="text" name="address2" id="address2" class="form-control" placeholder="Alamat 2" required>
                        <label for="address2">Alamat Baris 2</label>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-4 form-floating">
                        <input type="text" name="postcode" id="postcode" class="form-control" placeholder="Poskod" maxlength="5" required>
                        <label for="postcode">Poskod</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <input type="text" name="city" id="city" class="form-control" placeholder="Bandar" required>
                        <label for="city">Bandar</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <select name="state" id="state" class="form-select" required>
                            <option value="">Pilih Negeri</option>
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <label for="state">Negeri</label>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6 form-floating">
                        <select name="year" id="year" class="form-select" required>
                            <option value="">Pilih Tahun SPM</option>
                            @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        <label for="year">Tahun SPM</label>
                    </div>
                </div>

                <!-- Program Selection -->
                <div class="form-section-title">
                    <i class="fas fa-graduation-cap"></i> Program Pilihan
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6 form-floating">
                        <input type="text" id="location" name="location" value="KOLEJ UNITI PORT DICKSON" class="form-control" readonly>
                        <label for="location">Lokasi Kampus</label>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6 form-floating">
                        <select name="programA" id="programA" class="form-select" required>
                            <option value="">Pilih Program Pertama</option>
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                        <label for="programA">Pilihan Program 1</label>
                    </div>
                    <div class="col-md-6 form-floating">
                        <select name="programB" id="programB" class="form-select" required>
                            <option value="">Pilih Program Kedua</option>
                            @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                        <label for="programB">Pilihan Program 2</label>
                    </div>
                </div>

                <!-- Document Upload -->
                <div class="form-section-title">
                    <i class="fas fa-file-upload"></i> Dokumen Sokongan
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <div class="file-upload-box">
                            <div class="form-floating">
                                <input type="file" class="form-control" name="file" id="file" required>
                                <label for="file"><i class="fas fa-cloud-upload-alt me-2"></i>Muat Naik Keputusan SPM</label>
                            </div>
                        </div>
                        <div class="info-text">
                            <small><i class="fas fa-info-circle me-1"></i>Salinan SPM mestilah dalam format jpg, jpeg, png atau pdf.</small>
                            <small><i class="fas fa-info-circle me-1"></i>Saiz salinan SPM mestilah tidak melebihi 5MB.</small>
                        </div>
                    </div>
                </div>

                @if ($ref !== null)
                <div class="p-3 bg-light rounded-3 border border-warning mb-4">
                    <label class="small text-muted mb-1">Kod Rujukan Penaja Anda:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-warning border-warning text-dark fw-bold"><i class="fas fa-tag"></i></span>
                        <input type="text" id="ref" name="referral_code" value="{{ old('ref', $ref) }}" class="form-control border-warning bg-white fw-bold text-dark" readonly>
                    </div>
                </div>
                @endif

                <div class="mt-5 text-center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="source" id="source" value="{{ $source }}">
                    <button class="btn btn-register btn-lg" type="submit">
                        <i class="fas fa-paper-plane me-2"></i> Hantar Permohonan
                    </button>
                    <p class="mt-3 text-muted small">Dengan menghantar borang ini, anda bersetuju dengan terma dan syarat yang ditetapkan.</p>
                </div>
            </form>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- AJAX Script -->
    <script>
        $(document).ready(function() {
            $('#location').change(function() {
                var locationId = $(this).val();

                // Clear the program dropdown
                $('#programA').empty().append('<option value="">Pilih Program</option>');
                $('#programB').empty().append('<option value="">Pilih Program</option>');

                if (locationId) {
                    // Send an AJAX request to get the programs for the selected location
                    $.ajax({
                        url: '/student/location/' + locationId, // Adjust the URL according to your route
                        type: 'GET',
                        success: function(data) {
                            // Populate the program dropdown with the received data
                            $.each(data, function(key, value) {
                                $('#programA').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                            $.each(data, function(key, value) {
                                $('#programB').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('An error occurred while fetching programs:', error);
                        }
                    });
                }
            });
        });
    </script>
    <!-- Validation Script -->
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
    <!-- Phone Format Script -->
    <script>
        function formatPhoneNumber(input) {
            // Get the input value and remove non-digits
            let value = input.value.replace(/\D/g, '');

            // Remove leading '0' if present
            if (value.startsWith('0')) {
                value = value.substring(1);
            }

            // Add '6' prefix if not present
            if (!value.startsWith('60')) {
                value = '60' + value;
            }

            // Limit length to 13 digits
            value = value.substring(0, 13);

            // Update the input value
            input.value = value;
        }
    </script>
</body>

</html>