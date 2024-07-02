@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            @if(session('msg_error'))
                <div class="alert alert-danger">
                    {{ session('msg_error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Borang Pendaftaran Pengguna') }}</div>
                <form method="POST" action="{{ route('admin.register') }}" class="needs-validation" novalidate>
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
                            <input type="text" name="ic" id="ic" class="form-control" placeholder="" required>
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
                    <div class="row g-2 mb-2 row-cols-2">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="" required>
                            <label for="phone">No. Telefon</label>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="email" id="email" class="form-control" placeholder="" required>
                            <label for="ic">Emel</label>
                        </div>
                    </div>
                    <div class="row g-2 mb-2 row-cols-1">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <select name="position" id="position" class="form-control" required>
                                <option value="">Pilihan Jawatan</option>
                                <option value="MANAGER">MANAGER</option>
                                <option value="EDUCATION ADVISOR">EDUCATION ADVISOR</option>
                            </select>
                            <label for="position">Jawatan</label>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="bank_account" id="bank_account" class="form-control" placeholder="" required>
                            <label for="bank_account">No. Akaun Bank</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mt-3 mb-3">
                        <label for="" class="fw-bold">Alamat Pemohon</label>
                    </div>
                    <div class="row g-2 mb-2 row-cols-1">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="address1" id="address1" class="form-control" placeholder="" required>
                            <label for="address1">Alamat 1</label>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="address2" id="address2" class="form-control" placeholder="" required>
                            <label for="address2">Alamat 2</label>
                        </div>
                    </div>
                    <div class="row g-2 mb-2 row-cols-2">
                        <div class="col-md-4 col-sm-4 form-floating">
                            <input type="text" name="postcode" id="postcode" class="form-control" placeholder="" required>
                            <label for="postcode">Poskod</label>
                        </div>
                        <div class="col-md-4 col-sm-4 form-floating">
                            <input type="text" name="city" id="city" class="form-control" placeholder="" required>
                            <label for="city">Bandar</label>
                        </div>
                        <div class="col-12 col-md-4 col-sm-4 form-floating">
                            <select name="state" id="state" class="form-control" required>
                                <option value="">Pilihan Negeri</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <label for="state">Negeri</label>
                        </div>
                    </div>
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
        }, false);
    })();
</script>
@endsection
