@extends('layouts.advisor')

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
        font-family: 'Outfit', sans-serif !important;
    }

    .profile-header-card {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 20px;
        padding: 30px;
        color: white;
        text-align: center;
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.2);
        position: relative;
        overflow: hidden;
    }

    .profile-header-card::before {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -30px;
        right: -30px;
    }

    .profile-header-card::after {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -20px;
        left: -20px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 40px;
        color: white;
        backdrop-filter: blur(5px);
        border: 3px solid rgba(255, 255, 255, 0.3);
    }

    .card-custom {
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header-simple {
        padding: 20px 25px;
        border-bottom: 1px solid var(--border-color);
        background: rgba(248, 250, 252, 0.5);
    }

    .card-header-simple h5 {
        margin: 0;
        color: var(--primary-color);
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .card-header-simple h5 i {
        margin-right: 10px;
        background: #e0e7ff;
        padding: 8px;
        border-radius: 8px;
        font-size: 1rem;
    }

    .form-floating>.form-control,
    .form-floating>.form-select {
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background-color: var(--input-bg);
    }

    .form-floating>.form-control:focus,
    .form-floating>.form-select:focus {
        border-color: var(--accent-color);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
    }

    .form-control[readonly] {
        background-color: #e2e8f0;
        opacity: 0.8;
    }

    .btn-save {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        color: white;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(79, 70, 229, 0.4);
    }
</style>

<div class="container py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-exclamation-triangle me-2"></i> <strong>Terdapat Ralat:</strong>
        </div>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <!-- Left Column: User Summary -->
        <div class="col-md-4 mb-4">
            <div class="profile-header-card mb-4">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="mb-0 text-white-50">{{ $user->email }}</p>
                <div class="mt-3 badge bg-white text-primary px-3 py-2 rounded-pill">
                    <i class="fas fa-id-card me-1"></i> {{ $user->ic }}
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="card-custom">
                <div class="card-header-simple">
                    <h5><i class="fas fa-lock"></i> Keselamatan</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('advisor.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Kata Laluan Baru" required>
                            <label for="password">Kata Laluan Baru</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Sah Kata Laluan" required>
                            <label for="password_confirmation">Sahkan Kata Laluan</label>
                            <div id="passwordMatchHelp" class="invalid-feedback">Kata laluan tidak sepadan.</div>
                        </div>
                        <button type="submit" class="btn btn-save w-100">
                            Simpan Kata Laluan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Edit Profile Form -->
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-simple">
                    <h5><i class="fas fa-user-edit"></i> Kemaskini Profil</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('advisor.profile.update') }}" method="POST" id="profileForm">
                        @csrf
                        @method('PUT')

                        <!-- Read Only Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                <label>Nama Penuh</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" value="{{ $user->ic }}" readonly>
                                <label>No. Kad Pengenalan</label>
                            </div>
                        </div>

                        <!-- Useable Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 form-floating">
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" placeholder="No. Telefon" required>
                                <label for="phone">No. Telefon</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                <label>Emel (Tidak boleh diubah)</label>
                            </div>
                        </div>

                        <hr class="text-secondary opacity-25 my-4">

                        <!-- Banking Section -->
                        <div class="mb-4">
                            <label class="d-block form-label fw-bold mb-3 text-secondary"><i class="fas fa-university me-2"></i>Maklumat Perbankan</label>
                            <div class="row g-3">
                                <div class="col-md-6 form-floating">
                                    <select name="bank" id="bank" class="form-select" required>
                                        {{-- Current Bank --}}
                                        <option value="{{ $user->bank_id }}">{{ $user->bank }}</option>
                                        {{-- Other Banks --}}
                                        @foreach ($banks as $bank )
                                        @if($bank->id != $user->bank_id)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="bank">Nama Bank</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" name="bank_account" id="bank_account" class="form-control" value="{{ $user->bank_account }}" placeholder="No. Akaun" required>
                                    <label for="bank_account">No. Akaun Bank</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-save px-5">
                                <i class="fas fa-save me-2"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password Match Validation
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirmation');

        function validatePasswordMatch() {
            if (passwordConfirmInput.value && passwordInput.value !== passwordConfirmInput.value) {
                passwordConfirmInput.classList.add('is-invalid');
            } else {
                passwordConfirmInput.classList.remove('is-invalid');
            }
        }

        passwordInput.addEventListener('input', validatePasswordMatch);
        passwordConfirmInput.addEventListener('input', validatePasswordMatch);
    });
</script>
@endsection