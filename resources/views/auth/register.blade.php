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
                <div class="card-header">{{ __('Pendaftaran Affiliate UNITI') }}</div>
                <form method="POST" action="{{ route('register') }}">
                <div class="card-body">
                    @csrf
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Maklumat Pemohon</label>
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
                            <label for="">Agama</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="religion" id="religion" class="form-control form-control-sm" required>
                                <option value=""></option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bangsa</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="nation" id="nation" class="form-control form-control-sm" required>
                                <option value=""></option>
                                @foreach ($nations as $nation)
                                    <option value="{{ $nation->id }}">{{ $nation->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Jantina</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="sex" id="sex" class="form-control form-control-sm" required>
                                <option value=""></option>
                                @foreach ($sexs as $sex)
                                    <option value="{{ $sex->id }}">{{ $sex->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Telefon</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm" maxlength="12" required>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Emel</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="email" id="email" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Akaun Bank</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="bank_account" id="bank_account" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bank</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="bank" id="bank" class="form-control form-control-sm" required>
                                <option value=""></option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Profesion / Pekerjaan</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <input list="professions" name="profession" id="profession" class="form-control form-control-sm">
                            <datalist id="professions">
                                @foreach ($professions as $profession)
                                    <option value="{{ $profession->name }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Alamat Pemohon</label>
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
                    @if ($ref !== null)
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Kod Rujukan</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" id="ref" name="referral_code" value="{{ old('ref', $ref) }}" class="form-control form-control-sm" @if($ref) readonly @endif>
                        </div>
                    </div>
                    @else
                        <input type="hidden" id="ref" name="referral_code" value="" class="form-control form-control-sm">
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
@endsection
