@extends('layouts.user')

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
            <div class="card">
                <div class="card-header">{{ __('Senarai Permohonan') }}</div>

                <div class="card-body">
                    @auth
                    <div class="col-md-12 col-sm-12 mb-2">
                        <label for="">Kongsi pautan ini kepada yang berminat untuk mendaftar sebagai affiliate Kolej UNITI.</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="referral_url" name="url" class="form-control" value="{{ route('about', ['ref' => Auth::user()->referral_code]) }}" readonly>
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
                                    <th>No. Telefon</th>
                                    <th>Email</th>
                                    <th>Tarikh Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $affiliates as $affiliate )
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-uppercase">{{ $affiliate->name }}
                                        {{-- <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#modal">{{ $affiliate->name }}</button> --}}
                                    </td>
                                    <td class="text-center">{{ $affiliate->phone }}</td>
                                    <td class="text-center">{{ $affiliate->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($affiliate->created_at)->format('d-m-Y') }}</td>
                                </tr>
                                @endforeach
                                <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel"></h5>
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
                                                    <label for="name"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="">No. Kad Pengenalan</label>
                                                </div>
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="name"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="">No. Telefon</label>
                                                </div>
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="name"></label>
                                                </div>
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="">Email</label>
                                                </div>
                                                <div class="col-md-3 col-sm-3">
                                                    <label for="name"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
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
