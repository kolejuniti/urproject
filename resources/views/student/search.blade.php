@extends('layouts.app')

@section('content')
<style>
    @media print {
        @page {
                size: landscape;
                margin: 0;
        }
        body * {
            visibility: hidden;
        }
        .printableArea, .printableArea * {
            visibility: visible;
        }
        .printableArea {
            position: absolute;
            left: 5%;
            top: 10%;
            width: 90%;
        }
        .card-footer {
            display: none;
        }
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            @if(isset($ic))
            @else
                <div class="card mb-3">
                    <form action="{{ route('student.search') }}" method="GET">
                    <div class="card-header">{{ __('Carian Permohonan') }}</div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('No. Kad Pengenalan') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="ic" id="ic" class="form-control form-control-sm" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            @endif
            @if(isset($ic))
                @if($students->isEmpty())
                    <p>No students found.</p>
                    <a href="{{ route('student.search')}}"  class="btn btn-danger">Back</a>
                @else
                    @foreach($students as $student)
                    <div class="card printableArea">
                        <div class="card-header">{{ __('Status Permohonan') }}</div>
                        <div class="card-body small">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="" class="fw-bold">Maklumat Pemohon</label>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Nama Penuh</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <label for="name">{{ $student->name }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">No. Kad Pengenalan</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="name">{{ $student->ic }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">No. Telefon</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="name">{{ $student->phone }}</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Email</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="name">{{ $student->email }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Negeri</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <label for="name">{{ $student->state }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Tahun SPM</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="name">{{ $student->spm_year }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Tarikh Permohonan</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="name">{{ \Carbon\Carbon::parse(  $student->created_at )->format('d-m-Y') }}</label>
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
                                    <label for="name">{{ $student->location }}</label>
                                </div>
                            </div>
                            @foreach ( $studentPrograms as $program )
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Program Pilihan {{ $loop->iteration }}</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <label for="name">{{ $program->program }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Status</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="name" class="text-uppercase">{{ $program->status }}</label>
                                </div>
                            </div>
                            @if ($program->status === 'baru')
                            @elseif ($program->status === 'layak')
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Surat Tawaran</label>
                                </div>
                                <div class="col-md-9 col-sm-9">.....
                                </div>
                            </div>
                            @else
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Catatan</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <textarea name="notes" id="notes" rows="2" class="form-control form-control-sm" disabled></textarea>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="" class="fw-bold">Pegawai Perhubungan</label>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Nama Pegawai</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <label for="">{{ $student->user }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">No. Telefon</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <label for="">{{ $student->user_phone }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn col-1 btn-outline-secondary" type="button"  onclick="printCardBody()"><i class="bi bi-printer-fill"></i></button>                            
                        </div>
                    </div>
                    @endforeach
                @endif
            @endif
        </div>
    </div>
</div>
<script>
    function printCardBody() {
        window.print();
    }
</script>
@endsection
