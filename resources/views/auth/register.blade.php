@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            @if(session('msg_error'))
            <div class="alert alert-danger">
                {{ session('msg_error') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Borang Pendaftaran Affiliate UNITI') }}</div>
                <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                    <div class="card-body">
                        @csrf
                        <div class="col-md-12 col-sm-12 mb-3">
                            <label for="" class="fw-bold">Maklumat Pemohon</label>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-6 col-sm-6 form-floating">
                                <input type="text" name="name" id="name" class="form-control" placeholder="" required autofocus>
                                <label for="name">Nama Penuh</label>
                            </div>
                            <div class="col-md-6 col-sm-6 form-floating">
                                <input type="text" name="ic" id="ic" class="form-control" placeholder="" maxlength="12" required>
                                <label for="ic">No. Kad Pengenalan</label>
                            </div>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-4 col-sm-4 form-floating">
                                <select name="religion" id="religion" class="form-control" required>
                                    <option value="">Pilihan Agama</option>
                                    @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                    @endforeach
                                </select>
                                <label for="religion">Agama</label>
                            </div>
                            <div class="col-md-4 col-sm-4 form-floating">
                                <select name="nation" id="nation" class="form-control" required>
                                    <option value="">Pilihan Bangsa</option>
                                    @foreach ($nations as $nation)
                                    <option value="{{ $nation->id }}">{{ $nation->name }}</option>
                                    @endforeach
                                </select>
                                <label for="nation">Bangsa</label>
                            </div>
                            <div class="col-md-4 col-sm-4 form-floating">
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="">Pilihan Jantina</option>
                                    @foreach ($sexs as $sex)
                                    <option value="{{ $sex->id }}">{{ $sex->name }}</option>
                                    @endforeach
                                </select>
                                <label for="sex">Jantina</label>
                            </div>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-12 col-sm-12 form-floating">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="" maxlength="12" required>
                                <label for="phone">No. Telefon</label>
                            </div>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-6 col-sm-6 form-floating">
                                <input type="text" name="bank_account" id="bank_account" class="form-control" placeholder="" required>
                                <label for="bank_account">No. Akaun Bank</label>
                            </div>
                            <div class="col-md-6 col-sm-6 form-floating">
                                <select name="bank" id="bank" class="form-control" required>
                                    <option value="">Pilihan Bank</option>
                                    @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                                <label for="bank">Bank</label>
                            </div>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-3 col-sm-3 form-floating">
                                <select name="staff" id="staff" class="form-control" required>
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                                <label for="staff">Adakah anda staf UNITI?</label>
                            </div>
                            <div class="col-md-9 col-sm-9">
                                <div class="mb-2">
                                    <label class="d-block form-label fw-bold">Kategori Profesion</label>
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
                                <div class="form-floating" id="profession_container">
                                    <input list="professions" name="profession" id="profession" class="form-control" placeholder="" required>
                                    <datalist id="professions">
                                        @foreach ($professions as $profession)
                                        <option value="{{ $profession->name }}">
                                            @endforeach
                                    </datalist>
                                    <label for="profession">Profesion / Pekerjaan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3 mt-3">
                            <label for="" class="fw-bold">Alamat Pemohon</label>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-6 col-sm-6 form-floating">
                                <input type="text" name="address1" id="address1" class="form-control" placeholder="" required>
                                <label for="address1">Alamat 1 (No. Rumah / Lot / Unit)</label>
                            </div>
                            <div class="col-md-6 col-sm-6 form-floating">
                                <input type="text" name="address2" id="address2" class="form-control" placeholder="" required>
                                <label for="address2">Alamat 2 (Nama Jalan / Lorong / Taman / Kampung)</label>
                            </div>
                        </div>
                        <div class="row g-2 mb-2 row-cols-2">
                            <div class="col-md-3 col-sm-3 form-floating">
                                <input type="text" name="postcode" id="postcode" class="form-control" placeholder="" required>
                                <label for="postcode">Poskod</label>
                            </div>
                            <div class="col-md-3 col-sm-3 form-floating">
                                <input type="text" name="city" id="city" class="form-control" placeholder="" required>
                                <label for="city">Bandar</label>
                            </div>
                            <div class="col-12 col-md-6 col-sm-6 form-floating">
                                <select name="state" id="state" class="form-control" required>
                                    <option value="">Pilihan Negeri</option>
                                    @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                <label for="state">Negeri</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 mb-3 mt-3">
                            <label for="" class="fw-bold">Maklumat Akaun</label>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-12 col-sm-12 form-floating">
                                <input type="email" name="email" id="email" class="form-control" placeholder="" required>
                                <label for="email">Emel</label>
                            </div>
                        </div>
                        <div class="row g-2 mb-2 row-cols-1">
                            <div class="col-md-6 col-sm-6 form-floating">
                                <input type="password" name="password" id="password" class="form-control" placeholder="" required>
                                <label for="password">Kata Laluan</label>
                                <div id="passwordHelp" class="invalid-feedback">
                                    Kata laluan mestilah sekurang-kurangnya 8 aksara.
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 form-floating">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="" required>
                                <label for="password_confirmation">Pengesahan Kata Laluan</label>
                                <div id="passwordMatchHelp" class="invalid-feedback">
                                    Kata laluan tidak sepadan.
                                </div>
                            </div>
                        </div>
                        @if ($ref !== null)
                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <div class="mb-2">
                            <div class="col-md-3 col-sm-3 form-floating">
                                <input type="text" id="ref" name="referral_code" value="{{ old('ref', $ref) }}" class="form-control" placeholder="" @if($ref) readonly @endif>
                                <label for="ref">Kod Rujukan</label>
                            </div>
                        </div>
                        @else
                        <input type="hidden" id="ref" name="referral_code" value="" class="form-control">
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary" type="submit">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
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
                    if (professionInput.value === 'Pelajar' || professionInput.value === 'Alumni KU' || professionInput.value === 'Staff Uniti Asia' || professionInput.value === 'Staff KUKB' || professionInput.value === 'Staff KUPD') {
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