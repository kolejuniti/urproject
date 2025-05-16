@extends('layouts.user')

@section('content')
<div class="container rounded bg-white">
    <div class="row">
        <div class="col-md-4 border-end">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-person-circle mb-2" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                </svg>
                <span class="font-weight-bold">{{ $user->name }}</span>
                <span class="text-black-50">{{ $user->email }}</span>
            </div>
        </div>
        <div class="col-md-8">
            <div class="p-3 py-5">
                <div class="border-bottom">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="" class="fw-bold">Kemaskini Profil</label>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="col-md-12">
                                <label for="" class="fw-bold">Nama Penuh</label>
                            </div>
                            <div class="col-md-12">
                                <label for="">{{ $user->name }}</label>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="col-md-12">
                                <label for="" class="fw-bold">No. Kad Pengenalan</label>
                            </div>
                            <div class="col-md-12">
                                <label for="">{{ $user->ic }}</label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="col-md-12">
                                    <label for="" class="fw-bold">No. Telefon</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="{{ $user->phone }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="" class="fw-bold">Emel</label>
                                </div>
                                <div class="col-md-12">
                                    <label for="">{{ $user->email }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="col-md-12">
                                    <label for="" class="fw-bold">No. Akaun Bank</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="text" name="bank_account" id="bank_account" class="form-control form-control-sm" value="{{ $user->bank_account }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="" class="fw-bold">Bank</label>
                                </div>
                                <div class="col-md-12">
                                    <select name="bank" id="bank" class="form-control form-control-sm">
                                    <option value="{{ $user->bank_id }}">{{ $user->bank }}</option>
                                    @foreach ($banks as $bank )
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12 text-start">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mt-3">
                    <form action="{{ route('admin.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <div class="col-md-12">
                                <label for="" class="fw-bold">Kemaskini Kata Laluan</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="col-md-12">
                                    <label for="" class="fw-bold">Kata Laluan</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="password" name="password" class="form-control form-control-sm" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <label for="" class="fw-bold">Pengesahan Kata Laluan</label>
                                </div>
                                <div class="col-md-12">
                                    <input type="password" name="password_confirmation" class="form-control form-control-sm" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12 text-start">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
