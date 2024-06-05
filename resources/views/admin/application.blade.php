@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(isset($success))
                <div class="alert alert-success">
                    {{ $success }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Senarai Permohonan')}}</div>

                <div class="card-body">
                    <div class="table-responsive">
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
                            @if ($data['applicant']->user_id !== null)
                            <tr class="table-warning">
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
                                                <label for="name" class="text-uppercase">{{ $data['applicant']->name }}</label>
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
                                                <label for="">Alamat 1</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="name">{{ $data['applicant']->address1 }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Alamat 2</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="name">{{ $data['applicant']->address2 }}</label>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Poskod</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $data['applicant']->postcode }}</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Bandar</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $data['applicant']->city }}</label>
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
                                                <textarea name="notes" id="notes" rows="2" class="form-control form-control-sm text-uppercase" disabled>{{ $program->notes }}</textarea>
                                            </div>
                                        </div>
                                        @endif
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
                                        <form action="{{ route('admin.application.update', ['id' => $data['applicant']->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')   
                                        <div class="mt-3">
                                            <div class="col-sm-3 col-md-3">
                                                <label for="" class="fw-bold">Pegawai Perhubungan</label>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-sm-3 col-md-3">
                                                <label for="">Nama Pegawai</label>
                                            </div>
                                            @if ($data['applicant']->user_id == NULL)
                                            <div class="col-sm-9 col-md-9">
                                                <select name="pic" id="pic" class="form-control form-control-sm text-uppercase">
                                                    <option value=""></option>
                                                    @foreach ($users as $user )
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <div class="col-sm-9 col-md-9">
                                                <select name="pic" id="pic" class="form-control form-control-sm text-uppercase">
                                                    <option value="{{ $data['applicant']->user_id }}">{{ $data['applicant']->user }}</option>
                                                    <option value="">TIADA PEGAWAI</option>
                                                    @foreach ($users as $user )
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                    @endforeach
                                                </select>
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
                </div>
            </div>
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
