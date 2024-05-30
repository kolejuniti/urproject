@extends('layouts.student')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            @if(session('msg_reg'))
                <div class="alert alert-success">
                    {{ session('msg_reg') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Pengesahan Permohonan') }}</div>

                <div class="card-body">
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Maklumat Pemohon</label>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Nama Penuh</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="name">{{ session('name') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Kad Pengenalan</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name">{{ session('ic') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">No. Telefon</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name">{{ session('phone') }}</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Email</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name">{{ session('email') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Alamat 1</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="name">{{ session('address1') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Alamat 2</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="name">{{ session('address2') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Poskod</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name">{{ session('postcode') }}</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="">Bandar</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name">{{ session('city') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Negeri</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="name">{{ session('state') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Tahun SPM</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name">{{ session('year') }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Tarikh Permohonan</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name">{{ \Carbon\Carbon::parse( session('created_at'))->format('d-m-Y') }}</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mt-3 mb-3">
                        <label for="" class="fw-bold">Program Yang Dipohon</label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Lokasi</label>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="name">{{ session('location') }}</label>
                        </div>
                    </div>
                    @foreach (session('program') as $index => $data)
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Program Pilihan {{ $loop->iteration }}</label>
                        </div>
                        <div class="col-md-9 col-sm-9">
                            <label for="name">{{ $data->name }}</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-sm-3">
                            <label for="">Status</label>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <label for="name" class="text-uppercase">{{ $data->status }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
