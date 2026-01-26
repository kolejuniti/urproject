@extends($isEmbedded ? 'layouts.embedded' : 'layouts.student-kupd')

@section('title', 'Daftar | Kolej UNITI Port Dickson')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #ec4899;
        --accent-color: #8b5cf6;
        --light-bg: #f8fafc;
        --card-bg: #ffffff;
        --input-bg: #f1f5f9;
        --border-color: #e2e8f0;
    }

    body {
        font-family: 'Outfit', sans-serif;
        background-color: var(--light-bg);
        background-image:
            radial-gradient(at 0% 0%, hsla(253, 16%, 7%, 1) 0, transparent 50%),
            radial-gradient(at 50% 0%, hsla(225, 39%, 30%, 1) 0, transparent 50%),
            radial-gradient(at 100% 0%, hsla(339, 49%, 30%, 1) 0, transparent 50%);
        background-size: 100% 600px;
        background-repeat: no-repeat;
        min-height: 100vh;
    }

    .register-container {
        max-width: 900px;
        margin: 50px auto;
        padding: 0 15px;
    }

    .register-card {
        background: var(--card-bg);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
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
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -50px;
        left: -50px;
    }

    .card-header-custom::after {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -20px;
        right: -20px;
    }

    .card-header-custom h2 {
        font-weight: 700;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .card-header-custom p {
        opacity: 0.9;
        font-weight: 300;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
        color: white;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--primary-color);
        margin: 25px 0 15px;
        display: flex;
        align-items: center;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 10px;
    }

    .form-section-title:first-of-type {
        margin-top: 0;
    }

    .form-section-title i {
        margin-right: 10px;
        background: #e0e7ff;
        color: var(--primary-color);
        padding: 8px;
        border-radius: 8px;
        font-size: 1rem;
    }

    .form-floating>.form-control,
    .form-floating>.form-select {
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background-color: var(--input-bg);
        transition: all 0.3s ease;
    }

    .form-floating>.form-control:focus,
    .form-floating>.form-select:focus {
        border-color: var(--accent-color);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
    }

    .form-floating>label {
        color: #64748b;
    }

    .btn-register {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        color: white;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        width: 100%;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4);
    }

    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .alert-danger {
        background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
        color: #dc3545;
        border-left: 4px solid #dc3545;
    }

    .file-upload-box {
        background: var(--input-bg);
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .file-upload-box:hover {
        border-color: var(--accent-color);
        background: white;
    }

    .file-upload-box .form-control {
        background: transparent;
        border: none;
    }

    .info-text {
        background: #fef3c7;
        border-left: 4px solid #f59e0b;
        padding: 12px 15px;
        border-radius: 8px;
        margin-top: 10px;
    }

    .info-text small {
        display: block;
        color: #92400e;
        font-weight: 500;
        margin: 3px 0;
    }

    /* Small animation for entry */
    .register-card {
        animation: slideUp 0.6s ease-out;
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

    @media (max-width: 768px) {
        .register-container {
            margin: 20px auto;
        }

        .card-header-custom {
            padding: 30px 20px;
        }
    }
</style>

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
            <h2>Borang Pendaftaran</h2>
            <p>Kolej UNITI Port Dickson</p>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
@endsection