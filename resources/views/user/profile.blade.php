@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profil') }}</div>

                <div class="card-body">
                    @csrf
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
                            <label for="">{{ $user->phone }}</label>
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
                            <label for="">{{ $user->bank_account }}</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bank</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">{{ $user->bank }}</label>
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
                            <label for="">{{ $userAddress->address1 }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Alamat 2</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="">{{ $userAddress->address2 }}</label>
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
                            <label for="">{{ $userAddress->city }}</label>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
