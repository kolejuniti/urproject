@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Senarai Permohonan')}}</div>

                <div class="card-body">
                    @auth
                    <div class="col-md-12 col-sm-12 mb-2">
                        <label for="">Kongsi pautan ini kepada yang berminat mendaftar / belajar di Kolej UNITI.</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="referral_url" name="url" class="form-control" value="{{ route('student.about', ['ref' => Auth::user()->referral_code]) }}" readonly>
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()"><i class="bi bi-clipboard"></i></button>
                        </div>
                    </div>
                    @endauth
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered small table-sm text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pemohon</th>
                                    <th>Tarikh Permohonan</th>
                                    <th>Status</th>
                                    <th>Tarikh Pendaftaran</th>
                                    <th>Tarikh Komisen</th>
                                    <th>Amaun Komisen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applicantsWithPrograms as $data)
                                @if ($data['applicant']->user_id !== null)
                                <tr class="table-warning">
                                @else
                                <tr>
                                @endif
                                    <td>&nbsp;</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#modal{{ $data['applicant']->ic }}">{{ $data['applicant']->name }}</button>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d-m-Y') }}</td>
                                    <td class="text-uppercase">{{ $data['applicant']->status }}</td>
                                    <td>{{$data['applicant']->register_at ? \Carbon\Carbon::parse($data['applicant']->register_at)->format('d-m-Y') : '' }}</td>
                                    <td>{{$data['applicant']->commission_date ? \Carbon\Carbon::parse($data['applicant']->commission_date)->format('d-m-Y') : '' }}</td>
                                    <td class="text-center">{{ $data['applicant']->commission }}</td>
                                </tr>
                                <div class="modal fade" id="modal{{ $data['applicant']->ic }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $data['applicant']->ic }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $data['applicant']->ic }}"></h5>
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
                                            {{-- <div class="row mb-2">
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
                                                    <textarea name="notes" id="notes" rows="2" class="form-control form-control-sm text-uppercase" disabled>{{ $program->notes }}</textarea>
                                                </div>
                                            </div>
                                            @endif --}}
                                            @endforeach
                                            @if ($data['applicant']->status !== null)
                                            <div class="row mb-2">
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="">Status Permohonan</label>
                                                </div>
                                                <div class="col-md-9 col-sm-9">
                                                    <label for="" class="text-uppercase">{{ $data['applicant']->status }}</label>
                                                </div>
                                            </div>                                            
                                            @endif
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
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'dt-head-center'
                }
            ]
        });
        t.on('order.dt search.dt', function () {
            let i = 1;
        
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
@endsection
