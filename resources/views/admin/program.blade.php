@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-sm-12">
            @if(session('msg_error'))
                <div class="alert alert-danger">
                    {{ session('msg_error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            {{-- <div class="card">
                <div class="card-header">{{ __('Daftar Program') }}</div>
                <form method="POST" action="{{ route('admin.program.submit') }}" class="needs-validation" novalidate>
                <div class="card-body">
                    @csrf
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Maklumat Program</label>
                    </div>
                    <div class="row g-2 mb-2 row-cols-1">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="program" id="program" class="form-control" placeholder="" required autofocus>
                            <label for="name">Nama Program</label>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <select name="location" id="location" class="form-control" required>
                                <option value="">Pilihan Lokasi</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                            <label for="location">Lokasi</label>
                        </div>
                    </div>
                </div>    
                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                </div>
                </form>
            </div> --}}
            <div class="col-md-12 col-sm-12">
                <div style="display: flex; justify-content: right; align-items: right;">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Program</button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-bold" id="cancelModalLabel">Maklumat Program</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.program.submit') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="col-md-12 col-sm-12 mb-2">
                                    <div class="form-floating">
                                        <input type="text" name="program" id="program" class="form-control" placeholder="" required autofocus>
                                        <label for="name">Nama Program</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-floating">
                                        <select name="location" id="location" class="form-control" required>
                                            <option value="">Pilihan Lokasi</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="location">Lokasi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-sm btn-primary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="myTable" class="table table-bordered table-sm text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Program</th>
                    <th>Lokasi</th>
                    <th>Ditawarkan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $item)
                <tr>
                    <td></td>
                    <td>{{ $item->program }}</td>
                    <td>{{ $item->location }}</td>
                    <form method="POST" action="{{ route('admin.program.update', $item->id) }}" id="form-{{ $item->id }}">
                        @csrf
                        <td style="display: flex; justify-content: center; align-items: center;">
                            <input type="hidden" name="offered" value="0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="offered" value="1" {{ $item->offered === 1 ? 'checked' : '' }} 
                                       onchange="document.getElementById('form-{{ $item->id }}').submit();">
                            </div>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
        columnDefs: [
            {
                targets: ['_all'],
                className: 'dt-head-center'
            }
        ],
        layout: {
                top1Start: {
                    div: {
                        html: '<h2>Senarai Program</h2>'
                    }
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
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
