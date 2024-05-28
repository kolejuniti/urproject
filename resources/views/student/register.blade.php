@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('msg_error'))
                <div class="alert alert-danger">
                    {{ session('msg_error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Permohonan') }}</div>
                <form action="{{ route('student.register.post') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Maklumat Peribadi</label>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Nama Penuh</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" name="name" id="name" class="form-control form-control-sm" required autofocus>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Kad Pengenalan</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="ic" id="ic" class="form-control form-control-sm" maxlength="12" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Telefon</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm" maxlength="11" required>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Email</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="email" id="email" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Alamat 1</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" name="address1" id="address1" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Alamat 2</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" name="address2" id="address2" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Poskod</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="postcode" id="postcode" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bandar</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="city" id="city" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Negeri</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <select name="state" id="state" class="form-control form-control-sm" required>
                                <option value=""></option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Tahun SPM</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="year" id="year" class="form-control form-control-sm" required>
                                <option value=""></option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Program Pilihan</label>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Lokasi</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <select name="location" id="location" class="form-control form-control-sm" required>
                                <option value=""></option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Program 1</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <select name="programA" id="programA" class="form-control form-control-sm" required>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Program 2</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <select name="programB" id="programB" class="form-control form-control-sm" required>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Keputusan SPM</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <input type="file" class="form-control form-control-sm" name="file" id="file" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Kod Rujukan</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" id="ref" name="referral_code" value="{{ old('ref', $ref) }}" class="form-control form-control-sm" @if($ref) readonly @endif>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="">* Sila masukkan sekiranya anda mempunyai kod rujukan</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        {{-- <input type="hidden" name="referral_code" value="{{ $referral_code }}"> --}}
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
