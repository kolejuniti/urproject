@extends('layouts.advisor')

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
                <div class="card-header">{{ __('Senarai Permohonan') }}</div>

                <div class="card-body">
                    @auth
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
                                    <th>No. Kad Pengenalan</th>
                                    <th>No. Telefon</th>
                                    <th>Email</th>
                                    <th>Tarikh Permohonan</th>
                                    <th>Tarikh Agihan</th>
                                    <th>Status</th>
                                    <th>Tarikh Pendaftaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applicantsWithPrograms as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#modal{{ $data['applicant']->ic }}">{{ $data['applicant']->name }}</button>
                                    </td>
                                    <td class="text-center">{{ $data['applicant']->ic }}</td>
                                    <td class="text-center">{{ $data['applicant']->phone }}</td>
                                    <td>{{ $data['applicant']->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d-m-Y') }}</td>
                                    <td>{{$data['applicant']->updated_at ? \Carbon\Carbon::parse($data['applicant']->updated_at)->format('d-m-Y') : '' }}</td>
                                    <td class="text-uppercase">{{ $data['applicant']->status }}</td>
                                    <td>{{$data['applicant']->register_at ? \Carbon\Carbon::parse($data['applicant']->register_at)->format('d-m-Y') : '' }}</td>
                                </tr>
                                <div class="modal fade" id="modal{{ $data['applicant']->ic }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $data['applicant']->ic }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel{{ $data['applicant']->ic }}"></h5>
                                        </div>
                                        <form action="{{ route('advisor.application.update', ['ic' => $data['applicant']->ic]) }}" method="POST">
                                            @csrf
                                            @method('PUT')   
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
                                            <div class="row mb-2">
                                                <div class="col-md-12 col-sm-12">
                                                    <a class="btn btn-sm btn-warning" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Keputusan SPM</a>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        @if ($data['file_url'])
                                                            <img src="{{ $data['file_url'] }}" alt="Keputusan SPM" class="img-fluid">
                                                        @else
                                                            <label for="">Tiada keputusan peperiksaan SPM</label>
                                                        @endif
                                                    </div>
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
                                            @php
                                                $uniqueId = $data['applicant']->ic . '_' . $loop->iteration;
                                            @endphp
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
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="programs[{{ $loop->iteration }}][status]" id="layak{{ $uniqueId }}" value="layak" onchange="toggleTextarea('{{ $uniqueId }}')" {{ $program->status === 'layak' ? 'checked' : '' }} required />
                                                        <label class="form-check-label" for="layak{{ $uniqueId }}">LAYAK</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="programs[{{ $loop->iteration }}][status]" id="tidaklayak{{ $uniqueId }}" value="tidak layak" onchange="toggleTextarea('{{ $uniqueId }}')" {{ $program->status === 'tidak layak' ? 'checked' : '' }} required />
                                                        <label class="form-check-label" for="tidaklayak{{ $uniqueId }}">TIDAK LAYAK</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($program->status === 'tidak layak')
                                            <div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="notes{{ $uniqueId }}" >Catatan</label>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <textarea name="programs[{{ $loop->iteration }}][notes]" id="notes{{ $uniqueId }}" rows="2" class="form-control form-control-sm">{{ $program->notes }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div id="notes-container{{ $uniqueId }}" style="display: none;">
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="notes{{ $uniqueId }}" >Catatan</label>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <textarea name="programs[{{ $loop->iteration }}][notes]" id="notes{{ $uniqueId }}" rows="2" class="form-control form-control-sm"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <input type="hidden" name="programs[{{ $loop->iteration }}][id]" value="{{ $program->id }}">
                                            @endforeach
                                            <div class="row mb-2">
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="">Status Permohonan</label>
                                                </div>
                                                <div class="col-md-9 col-sm-9">
                                                    <select name="statusApplication" id="statusApplication" class="form-control form-control-sm text-uppercase">
                                                        <option value="{{ $data['applicant']->status_id }}">{{ $data['applicant']->status }}</option>
                                                        @foreach ($statusApplications as $statusApplication )
                                                            <option value="{{ $statusApplication->id }}">{{ $statusApplication->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                        </div>
                                        </form>
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
    function toggleTextarea(uniqueId) {
        const layakRadio = document.getElementById('layak' + uniqueId);
        const container = document.getElementById('notes-container' + uniqueId);
        
        if (layakRadio.checked) {
            container.style.display = 'none';
        } else {
            container.style.display = 'block';
        }
    }
</script>
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
