@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Senarai Permohonan')}}</div>

                <div class="card-body">
                    @auth
                    <div class="input-group mb-3">
                        <input type="text" id="referral_url" name="url" class="form-control" value="{{ route('student.register', ['ref' => Auth::user()->referral_code]) }}" readonly>
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()"><i class="bi bi-clipboard"></i></button>
                        </div>
                    </div>
                    @endauth
                    <table class="table table-bordered small table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Nama Pemohon</th>
                                <th>No. Kad Pengenalan</th>
                                <th>No. Telefon</th>
                                <th>Email</th>
                                <th>Tarikh Permohonan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicantsWithPrograms as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data['applicant']->name }}</td>
                                <td>{{ $data['applicant']->ic }}</td>
                                <td>{{ $data['applicant']->phone }}</td>
                                <td>{{ $data['applicant']->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{ $data['applicant']->ic }}">Details</button>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal{{ $data['applicant']->ic }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $data['applicant']->ic }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $data['applicant']->ic }}">Senarai Program</h5>
                                    </div>
                                    <div class="modal-body small">
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <label for="" class="fw-bold">Maklumat Pemohon</label>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Nama Penuh</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="name">{{ $data['applicant']->name }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">No. Kad Pengenalan</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $data['applicant']->ic }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">No. Telefon</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $data['applicant']->phone }}</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Email</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $data['applicant']->email }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Negeri</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="name">{{ $data['applicant']->state }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Tahun SPM</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $data['applicant']->spm_year }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Tarikh Permohonan</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ \Carbon\Carbon::parse( $data['applicant']->created_at )->format('d-m-Y') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3 mt-3">
                                            <label for="" class="fw-bold">Program Yang Dipohon</label>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Lokasi</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $data['applicant']->location }}</label>
                                            </div>
                                        </div>
                                        @foreach ($data['programs'] as $program)
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Program Pilihan {{ $loop->iteration }}</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="name">{{ $program->name }}</label>
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
                                        @if ($program->status !== 'baru' && $program->status !== 'layak')
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
                                                <label for="">{{ $data['applicant']->user }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">No. Telefon</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="">{{ $data['applicant']->user_phone }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("referral_url");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        navigator.clipboard.writeText(copyText.value).then(function() {
            alert("Referral URL copied to clipboard!");
        }, function(err) {
            console.error('Failed to copy text: ', err);
        });
    }
</script>
@endsection
