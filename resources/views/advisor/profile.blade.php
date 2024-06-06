@extends('layouts.advisor')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Profil') }}</div>

                <form action="{{ route('advisor.profile.update') }}" method="POST">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Profil Pengguna</label>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-3 col-md-3">
                            <label for="">Nama Penuh</label>
                        </div>
                        <div class="col-sm-9 col-md-9">
                            <label for="" class="text-uppercase">{{ $user->name }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-3 col-md-3">
                            <label for="">No. Kad Pengenalan</label>
                        </div>
                        <div class="col-sm-9 col-md-9">
                            <label for="">{{ $user->ic }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Agama</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">{{ $user->religion }}</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bangsa</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">{{ $user->nation }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Jantina</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">{{ $user->sex }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Telefon</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="{{ $user->phone }}" required>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Emel</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">{{ $user->email }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Akaun Bank</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <input type="text" name="bank_account" id="bank_account" class="form-control form-control-sm" value="{{ $user->bank_account }}" required>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bank</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <select name="bank" id="bank" class="form-control form-control-sm">
                            <option value="{{ $user->bank_id }}">{{ $user->bank }}</option>
                            @foreach ($banks as $bank )
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3 mt-3">
                        <label for="" class="fw-bold">Alamat Pengguna</label>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Alamat 1</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="" class="text-uppercase">{{ $userAddress->address1 }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Alamat 2</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="" class="text-uppercase">{{ $userAddress->address2 }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Poskod</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">{{ $userAddress->postcode }}</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bandar</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="" class="text-uppercase">{{ $userAddress->city }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Negeri</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="">{{ $userAddress->state }}</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="col-1 btn btn-sm btn-primary">Save</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
