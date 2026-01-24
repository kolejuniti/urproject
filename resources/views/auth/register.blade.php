@extends('layouts.app')

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

    .profession-options .form-check {
        background: white;
        border: 1px solid var(--border-color);
        padding: 10px 15px 10px 40px;
        border-radius: 10px;
        margin-right: 10px;
        margin-bottom: 10px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .profession-options .form-check:hover {
        border-color: var(--primary-color);
        background: #eef2ff;
    }

    .profession-options .form-check-input:checked~.form-check-label {
        font-weight: 600;
        color: var(--primary-color);
    }

    .bg-shape {
        position: absolute;
        z-index: -1;
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
</style>

<div class="register-container">
    @if(session('msg_error'))
    <div class="alert alert-danger shadow-sm rounded-4 mb-4 border-0 d-flex align-items-center">
        <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
        <div>{{ session('msg_error') }}</div>
    </div>
    @endif

    <div class="register-card">
        <div class="card-header-custom">
            <h2>Pendaftaran Affiliate UNITI</h2>
            <p>Lengkapkan maklumat di bawah untuk menyertai kami</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="needs-validation p-4 p-md-5" novalidate>
            @csrf

            <!-- Personal Info -->
            <div class="form-section-title mt-0">
                <i class="fas fa-user"></i> Maklumat Peribadi
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6 form-floating">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nama Penuh" required autofocus>
                    <label for="name">Nama Penuh</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="text" name="ic" id="ic" class="form-control" placeholder="No. KP" maxlength="12" required>
                    <label for="ic">No. Kad Pengenalan</label>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4 form-floating">
                    <select name="religion" id="religion" class="form-select" required>
                        <option value="">Pilih Agama</option>
                        @foreach ($religions as $religion)
                        <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                        @endforeach
                    </select>
                    <label for="religion">Agama</label>
                </div>
                <div class="col-md-4 form-floating">
                    <select name="nation" id="nation" class="form-select" required>
                        <option value="">Pilih Bangsa</option>
                        @foreach ($nations as $nation)
                        <option value="{{ $nation->id }}">{{ $nation->name }}</option>
                        @endforeach
                    </select>
                    <label for="nation">Bangsa</label>
                </div>
                <div class="col-md-4 form-floating">
                    <select name="sex" id="sex" class="form-select" required>
                        <option value="">Pilih Jantina</option>
                        @foreach ($sexs as $sex)
                        <option value="{{ $sex->id }}">{{ $sex->name }}</option>
                        @endforeach
                    </select>
                    <label for="sex">Jantina</label>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 form-floating">
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="No. Telefon" required>
                    <label for="phone">No. Telefon</label>
                </div>
            </div>

            <!-- Address Info -->
            <div class="form-section-title">
                <i class="fas fa-map-marker-alt"></i> Alamat Surat Menyurat
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

            <div class="row g-3 mb-4">
                <div class="col-md-4 form-floating">
                    <input type="number" name="postcode" id="postcode" class="form-control" placeholder="Poskod" required>
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

            <!-- Profession Info -->
            <div class="form-section-title">
                <i class="fas fa-briefcase"></i> Kategori Profesion
            </div>


            <div class="row g-3 mb-4">
                <div class="col-md-12 form-floating">
                    <select name="staff" id="staff" class="form-select" required>
                        <option value="0" selected>Tidak</option>
                        <option value="1">Ya</option>
                    </select>
                    <label for="staff">Adakah anda staff UNITI?</label>
                </div>
            </div>

            <div class="mb-3 p-3 bg-light rounded-3">
                <label class="d-block form-label fw-bold mb-3 text-secondary">Anda Termasuk Dalam Kategori?</label>
                <div class="profession-options d-flex flex-wrap">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="profession_option" id="prof_opt1" value="Pelajar">
                        <label class="form-check-label" for="prof_opt1">Pelajar</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="profession_option" id="prof_opt2" value="Alumni KU">
                        <label class="form-check-label" for="prof_opt2">Alumni KU</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="profession_option" id="prof_opt3" value="Staff KUPD">
                        <label class="form-check-label" for="prof_opt3">Staff KUPD</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="profession_option" id="prof_opt4" value="Staff KUKB">
                        <label class="form-check-label" for="prof_opt4">Staff KUKB</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="profession_option" id="prof_opt5" value="Staff Uniti Asia">
                        <label class="form-check-label" for="prof_opt5">Staff Uniti Asia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="profession_option" id="prof_opt6" value="Lain-Lain" checked>
                        <label class="form-check-label" for="prof_opt6">Lain-Lain</label>
                    </div>
                </div>

                <div class="form-floating mt-3" id="profession_container">
                    <input list="professions" name="profession" id="profession" class="form-control" placeholder="Nyatakan Pekerjaan Anda" required>
                    <datalist id="professions">
                        @foreach ($professions as $profession)
                        <option value="{{ $profession->name }}">
                            @endforeach
                    </datalist>
                    <label for="profession">Nyatakan Pekerjaan / Profesion</label>
                </div>
            </div>

            <!-- Financial Info -->
            <div class="form-section-title">
                <i class="fas fa-university"></i> Maklumat Kewangan
                <small class="ms-auto text-muted fw-normal" style="font-size: 0.8rem;">(Untuk pembayaran komisen)</small>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6 form-floating">
                    <select name="bank" id="bank" class="form-select" required>
                        <option value="">Pilih Bank</option>
                        @foreach ($banks as $bank)
                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                        @endforeach
                    </select>
                    <label for="bank">Nama Bank</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="number" name="bank_account" id="bank_account" class="form-control" placeholder="No. Akaun" required>
                    <label for="bank_account">No. Akaun Bank</label>
                </div>
            </div>

            <!-- Account Security -->
            <div class="form-section-title">
                <i class="fas fa-lock"></i> Keselamatan Akaun
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 form-floating">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Emel" required>
                    <label for="email">Alamat Emel (Akan digunakan sebagai ID)</label>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Kata Laluan" required>
                    <label for="password">Kata Laluan</label>
                    <div id="passwordHelp" class="invalid-feedback">
                        Min. 8 aksara.
                    </div>
                </div>
                <div class="col-md-6 form-floating">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Sah Kata Laluan" required>
                    <label for="password_confirmation">Sahkan Kata Laluan</label>
                    <div id="passwordMatchHelp" class="invalid-feedback">
                        Kata laluan tidak sepadan.
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
            @else
            <input type="hidden" id="ref" name="referral_code" value="" class="form-control">
            @endif

            <div class="mt-5 text-center">
                <button class="btn btn-register btn-lg" type="submit">
                    <i class="fas fa-paper-plane me-2"></i> Daftar Sekarang
                </button>
                <p class="mt-3 text-muted small">Dengan mendaftar, anda bersetuju dengan Terma & Syarat program Affiliate.</p>
            </div>
        </form>
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

            // Profession Option Logic
            const professionRadios = document.querySelectorAll('input[name="profession_option"]');
            const professionInput = document.getElementById('profession');
            const professionContainer = document.getElementById('profession_container');

            function updateProfessionField() {
                const checkedRadio = document.querySelector('input[name="profession_option"]:checked');
                if (!checkedRadio) return;

                let selectedValue = checkedRadio.value;
                if (selectedValue === 'Lain-Lain') {
                    professionContainer.style.display = 'block';
                    // Clear if previously auto-filled with an option value
                    if (['Pelajar', 'Alumni KU', 'Staff Uniti Asia', 'Staff KUKB', 'Staff KUPD'].includes(professionInput.value)) {
                        professionInput.value = '';
                    }
                } else {
                    professionContainer.style.display = 'none';
                    professionInput.value = selectedValue;
                }
            }

            professionRadios.forEach(radio => {
                radio.addEventListener('change', updateProfessionField);
            });

            // Run on load
            updateProfessionField();

            // Password Validation
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');

            function validatePassword() {
                if (passwordInput.value.length < 8) {
                    passwordInput.setCustomValidity('Kata laluan mestilah sekurang-kurangnya 8 aksara.');
                    passwordInput.classList.add('is-invalid');
                    document.getElementById('passwordHelp').textContent = 'Kata laluan mestilah sekurang-kurangnya 8 aksara.';
                } else if (/\s/.test(passwordInput.value)) {
                    passwordInput.setCustomValidity('Kata laluan tidak boleh mengandungi ruang kosong.');
                    passwordInput.classList.add('is-invalid');
                    document.getElementById('passwordHelp').textContent = 'Kata laluan tidak boleh mengandungi ruang kosong.';
                } else {
                    passwordInput.setCustomValidity('');
                    passwordInput.classList.remove('is-invalid');
                }
            }

            function validatePasswordMatch() {
                if (/\s/.test(passwordConfirmInput.value)) {
                    passwordConfirmInput.setCustomValidity('Kata laluan tidak boleh mengandungi ruang kosong.');
                    passwordConfirmInput.classList.add('is-invalid');
                    document.getElementById('passwordMatchHelp').textContent = 'Kata laluan tidak boleh mengandungi ruang kosong.';
                } else if (passwordConfirmInput.value !== passwordInput.value) {
                    passwordConfirmInput.setCustomValidity('Kata laluan tidak sepadan.');
                    passwordConfirmInput.classList.add('is-invalid');
                    document.getElementById('passwordMatchHelp').textContent = 'Kata laluan tidak sepadan.';
                } else {
                    passwordConfirmInput.setCustomValidity('');
                    passwordConfirmInput.classList.remove('is-invalid');
                }
            }

            passwordInput.addEventListener('input', function() {
                validatePassword();
                if (passwordConfirmInput.value) validatePasswordMatch();
            });

            passwordConfirmInput.addEventListener('input', validatePasswordMatch);

        }, false);
    })();
</script>
@endsection