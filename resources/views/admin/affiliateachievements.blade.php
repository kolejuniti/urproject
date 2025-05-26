@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-6 col-sm-6 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.affiliateachievements') }}">
                @csrf
                <div class="input-group mb-3">
                    <button class="btn btn-secondary" disabled>Tarikh</button>
                    <input type="date" class="form-control" name="start_date" required>
                    <button class="btn btn-secondary" disabled>-</button>
                    <input type="date" class="form-control" name="end_date" required>
                    <button class="btn btn-secondary" disabled>Lokasi</button>
                    <select name="location" id="location" class="form-control" required>
                        <option value="">Pilihan Lokasi</option>
                        @foreach ($locations as $item)
                            <option value="{{ $item->id }}">{{ $item->code }}</option>
                        @endforeach
                        <option value="3">KUPD & KUKB</option>
                    </select>
                    <button class="btn btn-warning" type="submit">Cari</button>
                </div>
                </form>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    @if ($start_date === null)
                    @else
                    <caption>Laporan yang dijana adalah bagi {{ $location_name }} bertarikh {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '' }} sehingga {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '' }}</caption>
                    @endif
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Affiliate</th>
                            <th>Data Masuk</th>
                            <th>Data Proses</th>
                            <th>Pra Pendaftaran</th>
                            <th>Daftar Kolej</th>
                            <th>Data Ditolak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($affiliates as $item)
                        <tr>
                            <td></td>
                            <td class="text-uppercase">{{ $item->name }}</td>
                            <td class="text-center">{{ $item->total_students ?? 0 }}</td>
                            <td class="text-center">{{ $item->total_students_process ?? 0 }}</td>
                            <td class="text-center">{{ $item->total_students_pre ?? 0 }}</td>
                            <td class="text-center">{{ $item->total_students_register ?? 0 }}</td>
                            <td class="text-center">{{ $item->total_students_reject ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-danger">
                        <tr>
                            <th></th>
                            <th>Jumlah Keseluruhan</th>
                            <th>{{ $totalStudents }}</th>
                            <th>{{ $totalStudentProcess }}</th>
                            <th>{{ $totalStudentPre }}</th>
                            <th>{{ $totalStudentRegister }}</th>
                            <th>{{ $totalStudentReject }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
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
                        html: '<h2>Pencapaian Affiliate {{ $location_name }}</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Pencapaian Affiliate'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Pencapaian Affiliate'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Pencapaian Affiliate'
                        },
                        {
                            extend: 'print',
                            title: 'Pencapaian Affiliate'
                        }
                    ]
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