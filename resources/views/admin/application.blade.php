@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <h2>Senarai Permohonan</h2>
                <table id="myTable" class="table table-bordered small table-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Pemohon</th>
                        <th>No. Kad Pengenalan</th>
                        <th>No. Telefon</th>
                        <th>Email</th>
                        <th>Tarikh Permohonan</th>
                        <th>Tarikh Agihan</th>
                        <th>Education Advisor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicantsWithPrograms as $data)
                    @if ($data['applicant']->user_id !== null && $data['applicant']->register_at === null)
                    <tr class="table-warning">
                    @elseif ($data['applicant']->user_id !== null && $data['applicant']->register_at !== null)
                    <tr class="table-success">
                    @else
                    <tr>
                    @endif
                        <td>&nbsp;</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-link text-uppercase" data-bs-toggle="modal" data-bs-target="#modal{{ $data['applicant']->ic }}">{{ $data['applicant']->name }}</button>
                        </td>
                        <td class="text-center">{{ $data['applicant']->ic }}</td>
                        <td class="text-center">{{ $data['applicant']->phone }}</td>
                        <td>{{ $data['applicant']->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d-m-Y') }}</td>
                        <td>{{$data['applicant']->updated_at ? \Carbon\Carbon::parse($data['applicant']->updated_at)->format('d-m-Y') : '' }}</td>
                        <td class="text-uppercase">{{ $data['applicant']->user }}</td>
                    </tr>
                    <div class="modal fade" id="modal{{ $data['applicant']->ic }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $data['applicant']->ic }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body small">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="" class="fw-bold">Maklumat Pemohon</label>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $data['applicant']->name }}" readonly disabled>
                                            <label for="name" class="labels fw-bold">Nama Penuh</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="ic" id="ic" class="form-control" value="{{ $data['applicant']->ic }}" readonly disabled>
                                            <label for="ic" class="labels fw-bold">No. Kad Pengenalan</label>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $data['applicant']->phone }}" readonly disabled>
                                            <label for="phone" class="labels fw-bold">No. Telefon</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="email" id="email" class="form-control" value="{{ $data['applicant']->email }}" readonly disabled>
                                            <label for="email" class="labels fw-bold">Emel</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-12 form-floating">
                                            <input type="text" name="address1" id="address1" class="form-control" value="{{ $data['applicant']->address1 }}" readonly disabled>
                                            <label for="address1" class="labels fw-bold">Alamat 1</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-12 form-floating">
                                            <input type="text" name="address2" id="address2" class="form-control" value="{{ $data['applicant']->address2 }}" readonly disabled>
                                            <label for="address2" class="labels fw-bold">Alamat 2</label>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-2 row-cols-2">
                                        <div class="col-md-3 form-floating">
                                            <input type="text" name="postcode" id="postcode" class="form-control" value="{{ $data['applicant']->postcode }}" readonly disabled>
                                            <label for="postcode" class="labels fw-bold">Poskod</label>
                                        </div>
                                        <div class="col-md-3 form-floating">
                                            <input type="text" name="city" id="city" class="form-control" value="{{ $data['applicant']->city }}" readonly disabled>
                                            <label for="city" class="labels fw-bold">Bandar</label>
                                        </div>
                                        <div class="col-12 col-md-6 form-floating">
                                            <input type="text" name="state" id="state" class="form-control" value="{{ $data['applicant']->state }}" readonly disabled>
                                            <label for="state" class="labels fw-bold">Negeri</label>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-2">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="spm_year" id="spm_year" class="form-control" value="{{ $data['applicant']->spm_year }}" readonly disabled>
                                            <label for="spm_year" class="labels fw-bold">Tahun SPM</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="created_at" id="created_at" class="form-control" value="{{ \Carbon\Carbon::parse( $data['applicant']->created_at )->format('d-m-Y') }}" readonly disabled>
                                            <label for="email" class="labels fw-bold">Tarikh Permohonan</label>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-12 col-sm-12">
                                            <a class="btn btn-sm btn-warning" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Keputusan SPM</a>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                @if ($data['file_url'])
                                                    @if (pathinfo($data['file_url'], PATHINFO_EXTENSION) === 'pdf')
                                                        <object data="{{ $data['file_url'] }}" type="application/pdf" width="100%" height="500px">
                                                            <p><a href="{{ $data['file_url'] }}">Click here to download the PDF file.</a></p>
                                                        </object>
                                                    @else
                                                        <img src="{{ $data['file_url'] }}" loading="lazy" alt="Keputusan SPM" class="img-fluid">
                                                    @endif
                                                @else
                                                    <label for="">Tiada keputusan peperiksaan SPM</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3 mt-3">
                                        <label for="" class="fw-bold">Program Yang Dipohon</label>
                                    </div>
                                    <div class="mb-2">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="location" id="location" class="form-control" value="{{ $data['applicant']->location }}" readonly disabled>
                                            <label for="location" class="labels fw-bold">Lokasi Pilihan</label>
                                        </div>
                                    </div>
                                    @foreach ($data['programs'] as $program)
                                    <div class="row g-2 mb-2 row-cols-1">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="program{{ $loop->iteration }}" id="program{{ $loop->iteration }}" class="form-control" value="{{ $program->name }}" readonly disabled>
                                            <label for="program{{ $loop->iteration }}" class="fw-bold">Program Pilihan {{ $loop->iteration }}</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="status{{ $loop->iteration }}" id="status{{ $loop->iteration }}" class="form-control text-uppercase" value="{{ $program->status }}" readonly disabled>
                                            <label for="status{{ $loop->iteration }}" class="labels fw-bold">Status</label>
                                        </div>
                                    </div>
                                    @if ($program->status !== 'baru' && $program->status !== 'layak')
                                    <div class="mb-2">
                                        <div class="col-md-12 col-sm-12 form-floating">
                                            <textarea name="notes" id="notes" rows="2" class="form-control text-uppercase" disabled>{{ $program->notes }}</textarea>
                                            <label for="notes" class="fw-bold">Catatan</label>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    @if ($data['applicant']->status !== null)
                                        <div class="mb-2">
                                            <div class="col-md-12 form-floating">
                                                <input type="text" name="status" id="status" class="form-control text-uppercase" value="{{ $data['applicant']->status }}" readonly disabled>
                                                <label for="status" class="labels fw-bold">Status Permohonan</label>
                                            </div>
                                        </div>                                            
                                    @endif
                                    <form action="{{ route('admin.application.update', ['id' => $data['applicant']->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')   
                                    <div class="mt-3">
                                        <div class="col-sm-3 col-md-3">
                                            <label for="" class="fw-bold">Pegawai Perhubungan</label>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        @if ($data['applicant']->user_id == NULL)
                                        <div class="col-sm-12 col-md-12 form-floating">
                                            <select name="pic" id="pic" class="form-control text-uppercase">
                                                <option value=""></option>
                                                @foreach ($users as $user )
                                                    <option value="{{ $user->id }}">{{ $loop->iteration }}.&nbsp;{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="pic" class="fw-bold">Nama Pegawai</label>
                                        </div>
                                        @else
                                        <div class="col-sm-12 col-md-12 form-floating">
                                            <select name="pic" id="pic" class="form-control text-uppercase">
                                                <option value="{{ $data['applicant']->user_id }}">{{ $data['applicant']->user }}</option>
                                                <option value="">TIADA PEGAWAI</option>
                                                @foreach ($users as $user )
                                                    <option value="{{ $user->id }}">{{ $loop->iteration }}.&nbsp;{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="pic" class="fw-bold">Nama Pegawai</label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
                </table>
            </div>
            {{-- <div class="card">
                <div class="card-header">{{ __('Senarai Permohonan')}}</div>

                <div class="card-body">
                </div>
            </div> --}}
        </div>
    </div>
</div>
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
