@extends('layouts.student-kukb')

@section('title', 'Semakan | Kolej UNITI Kota Bharu')  

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
            top: 5%;
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
                    <form action="{{ route('semak.permohonan.kukb') }}" method="GET">
                    <div class="card-header">{{ __('Carian Permohonan') }}</div>

                    <div class="card-body">
                        {{-- <div class="row mb-3">
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
                        </div> --}}
                        <div class="col-12 col-md-6 col-sm-6 offset-md-3">
                            <div class="input-group mb-3">
                                <input type="text" name="ic" id="ic" class="form-control" placeholder="No. Kad Pengenalan" maxlength="12" aria-label="No. Kad Pengenalan" aria-describedby="button-addon2" oninput="this.value = this.value.replace(/[-\s]/g, '')">
                                <button class="btn btn-warning" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            @endif
            @if(isset($ic))
                @if($students->isEmpty())
                    <p>Tiada maklumat permohonan dijumpai.</p>
                    <a href="{{ route('semak.permohonan.kukb') }}"  class="btn btn-danger">Back</a>
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
                                    <label for="name" class="text-uppercase">{{ $student->ic }}</label>
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
                            <form action="{{ route('kemaskini.permohonan.kukb', [$student->ic, $student->email]) }}" id="form-{{ $student->ic }}" date-email="form-{{ $student->email }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')  
                            <div class="row mb-2">
                                @if (empty($student->address1) || trim($student->address1) === '')
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Alamat 1</label>
                                    </div>
                                    <div class="col-12 col-md-6 col-sm-6">
                                        <input type="text" name="address1" id="address1" class="form-control form-control-sm is-invalid" required>
                                    </div>
                                @else
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Alamat 1</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <label for="name" class="text-uppercase">{{ $student->address1 }}</label>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-2">
                                @if (empty($student->address2))
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Alamat 2</label>
                                    </div>
                                    <div class="col-12 col-md-6 col-sm-6">
                                        <input type="text" name="address2" id="address2" class="form-control form-control-sm is-invalid" required>
                                    </div>
                                @else
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Alamat 2</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <label for="name" class="text-uppercase">{{ $student->address2 }}</label>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-2">
                                @if (empty($student->postcode))
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Poskod</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <input type="text" name="postcode" id="postcode" class="form-control form-control-sm is-invalid" required>
                                    </div>
                                @else
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Poskod</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label for="name">{{ $student->postcode }}</label>
                                    </div>
                                @endif
                                @if (empty($student->city))
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Bandar</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <input type="text" name="city" id="city" class="form-control form-control-sm is-invalid" required>
                                    </div>
                                @else
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Bandar</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label for="name" class="text-uppercase">{{ $student->city }}</label>
                                    </div>
                                @endif
                            </div>
                            <div class="row mb-2">
                                @if (empty($student->state))
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Negeri</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select name="state" id="state" class="form-control form-control-sm  is-invalid" required>
                                            <option value="">Pilihan Negeri</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>  
                                @else
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Negeri</label>
                                    </div>
                                    <div class="col-md-9 col-sm-9">
                                        <label for="name">{{ $student->state }}</label>
                                    </div>                                   
                                @endif
                            </div>
                            <div class="row mb-2">
                                @if (empty($student->spm_year))
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Tahun SPM</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <select name="year" id="year" class="form-control form-control-sm is-invalid" required>
                                            <option value="">Pilihan Tahun</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Tahun SPM</label>
                                    </div>
                                    <div class="col-md-3 col-sm-3">
                                        <label for="name">{{ $student->spm_year }}</label>
                                    </div>                                    
                                @endif
                            </div>
                            @if ($foundFile === null)
                                <div class="row mb-2">
                                    <div class="col-md-3 col-sm-3">
                                        <label for="">Keputusan SPM</label>
                                    </div>
                                    <div class="col-12 col-md-6 col-sm-6">
                                        <input type="file" class="form-control form-control-sm is-invalid" name="file" id="file" required>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="col-md-6 col-sm-6 form-floating">
                                        <small class="text-danger">* Salinan SPM mestilah dalam format jpg, jpeg, png atau pdf.</small>
                                    </div>
                                    <div class="col-md-6 col-sm-6 form-floating">
                                        <small class="text-danger">* Saiz salinan SPM mestilah tidak melebihi 5MB.</small>
                                    </div>
                                </div>
                            @endif
                            @if (empty($student->address1) || trim($student->address1) === '')
                            <div class="mb-3">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan / Kemaskini</button>
                                </div>
                            </div>
                            @endif
                            </form>
                            <div class="col-md-12 col-sm-12 mt-3 mb-3">
                                <label for="" class="fw-bold">Program Yang Dipohon</label>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Tarikh Permohonan</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="name">{{ \Carbon\Carbon::parse(  $student->created_at )->format('d-m-Y') }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
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
                                <div class="col-md-9 col-sm-9">
                                    <a href="#" onclick="openOfferLetter(event, '{{ $student->ic }}')" target="_blank">Klik</a>
                                </div>
                            </div>
                            @else
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Catatan</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <textarea name="notes" id="notes" rows="2" class="form-control form-control-sm text-uppercase" disabled>{{ $program->notes }}</textarea>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @if( $student->user !== null )
                            <div class="col-md-12 col-sm-12 mt-3 mb-3">
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
                            @else
                            <div class="col-md-12 col-sm-12 mt-3 mb-3">
                                <label for="" class="fw-bold">Pegawai Perhubungan</label>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <label for="">Pegawai yang dilantik akan menghubungi anda dalam masa terdekat.</label>
                            </div>
                            @endif
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
<script>
    function openOfferLetter(event, ic) {
        event.preventDefault(); // Prevent the default link behavior
        var url = "{{ route('student.offerletter') }}" + "?ic=" + encodeURIComponent(ic);
        window.open(url, '_blank');
    }

    function printCardBody() {
        window.print();
    }
</script>
@endsection
