@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --admin-primary: #1e293b;
        --admin-secondary: #334155;
        --admin-accent: #3b82f6;
        --admin-accent-hover: #2563eb;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
        --admin-bg: #f8fafc;
        --admin-card-bg: #ffffff;
        --admin-border: #e2e8f0;
        --admin-text: #1e293b;
        --admin-text-muted: #64748b;
        --admin-gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--admin-bg);
        color: var(--admin-text);
    }

    .admin-register-page {
        padding: 2rem 0;
    }

    /* Page Header */
    .page-header {
        background: var(--admin-gradient-1);
        border-radius: 16px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-header h2 {
        font-weight: 700;
        font-size: 1.75rem;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .page-header p {
        margin: 0;
        opacity: 0.8;
        font-size: 1rem;
        position: relative;
        z-index: 1;
    }

    /* Modern Card */
    .modern-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        margin-bottom: 2rem;
        animation: fadeInUp 0.5s ease-out;
    }

    .modern-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--admin-border);
        background: #f8fafc;
    }

    .modern-card-title {
        font-weight: 700;
        color: var(--admin-primary);
        font-size: 1.1rem;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .modern-card-body {
        padding: 2rem;
    }

    /* Form Styles */
    .form-section-title {
        color: var(--admin-primary);
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--admin-border);
        display: flex;
        align-items: center;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--admin-text);
        margin-bottom: 0.5rem;
    }

    .required::after {
        content: '*';
        color: var(--admin-danger);
        margin-left: 2px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        padding: 0.6rem 1rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: white;
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .btn-primary {
        background: var(--admin-accent);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.2);
    }

    .btn-primary:hover {
        background: var(--admin-accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(59, 130, 246, 0.3);
    }

    .input-group-text {
        background-color: #f1f5f9;
        border: 1px solid var(--admin-border);
        border-right: none;
        color: var(--admin-text-muted);
    }

    .input-group .form-control,
    .input-group .form-select {
        border-left: none;
    }

    .input-group .form-control:focus,
    .input-group .form-select:focus {
        border-color: var(--admin-accent);
        z-index: 3;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid admin-register-page">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2><i class="fas fa-user-plus me-2"></i>Pendaftaran Pengguna Baru</h2>
                </div>
            </div>

            @if(session('msg_error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-left: 5px solid var(--admin-danger) !important;">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('msg_error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-left: 5px solid var(--admin-success) !important;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.register') }}" class="needs-validation" novalidate>
                @csrf
                <div class="modern-card">
                    <div class="modern-card-header">
                        <div class="modern-card-title">
                            <i class="fas fa-edit me-2"></i> Maklumat Pendaftaran
                        </div>
                    </div>
                    <div class="modern-card-body">

                        <!-- Personal Info -->
                        <div class="form-section-title">
                            <i class="fas fa-id-card me-2 text-primary"></i> Maklumat Peribadi
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label required">Nama Penuh</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Isi nama penuh seperti dalam KP" required autofocus>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="ic" class="form-label required">No. Kad Pengenalan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                    <input type="text" name="ic" id="ic" class="form-control" placeholder="Contoh: 900101011234" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="religion" class="form-label required">Agama</label>
                                <select name="religion" id="religion" class="form-select" required>
                                    <option value="">Pilih Agama...</option>
                                    @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="nation" class="form-label required">Bangsa</label>
                                <select name="nation" id="nation" class="form-select" required>
                                    <option value="">Pilih Bangsa...</option>
                                    @foreach ($nations as $nation)
                                    <option value="{{ $nation->id }}">{{ $nation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="sex" class="form-label required">Jantina</label>
                                <select name="sex" id="sex" class="form-select" required>
                                    <option value="">Pilih Jantina...</option>
                                    @foreach ($sexs as $sex)
                                    <option value="{{ $sex->id }}">{{ $sex->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="form-section-title">
                            <i class="fas fa-address-book me-2 text-primary"></i> Maklumat Perhubungan & Jawatan
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="phone" class="form-label required">No. Telefon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Contoh: 0123456789" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label required">Emel</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="nama@admin.com" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="position" class="form-label required">Jawatan</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    <select name="position" id="position" class="form-select" required>
                                        <option value="">Pilih Jawatan...</option>
                                        <option value="MANAGER">MANAGER</option>
                                        <option value="EDUCATION ADVISOR">EDUCATION ADVISOR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="bank_account" class="form-label required">No. Akaun Bank</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-money-check-alt"></i></span>
                                    <input type="text" name="bank_account" id="bank_account" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!-- Address Info -->
                        <div class="form-section-title">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i> Alamat Tetap
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="address1" class="form-label required">Alamat 1</label>
                                <input type="text" name="address1" id="address1" class="form-control" placeholder="No. Rumah, Jalan" required>
                            </div>
                            <div class="col-12">
                                <label for="address2" class="form-label required">Alamat 2</label>
                                <input type="text" name="address2" id="address2" class="form-control" placeholder="Taman, Kawasan" required>
                            </div>
                            <div class="col-md-4">
                                <label for="postcode" class="form-label required">Poskod</label>
                                <input type="text" name="postcode" id="postcode" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="city" class="form-label required">Bandar</label>
                                <input type="text" name="city" id="city" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label required">Negeri</label>
                                <select name="state" id="state" class="form-select" required>
                                    <option value="">Pilih Negeri...</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-5 text-end">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane me-2"></i> Daftar Pengguna
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
@endsection