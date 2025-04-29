@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-6 col-sm-6 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.achievements') }}">
                @csrf
                    <div class="input-group mb-3">
                        <button class="btn btn-secondary" disabled>Tarikh</button>
                        <input type="date" class="form-control" name="start_date">
                        <button class="btn btn-secondary" disabled>-</button>
                        <input type="date" class="form-control" name="end_date">
                        <button class="btn btn-warning" type="submit">Cari</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama EA</th>
                            <th>Permohonan Diterima</th>
                            <th>Permohonan Dalam Proses</th>
                            <th>Permohonan Didaftarkan</th>
                            <th>Permohonan Ditolak/Menolak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($advisors as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">{{ $assigns[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $process[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $registers[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $rejects[$item->id] ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-danger">
                            <td></td>
                            <td><strong>Jumlah Keseluruhan</strong></td>
                            <td class="text-center"><strong>{{ $totalCountAssign }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountProcess }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountRegister }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountReject }}</strong></td>
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
                        html: '<h2>Pencapaian EA</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Pencapaian EA'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Pencapaian EA'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Pencapaian EA'
                        },
                        {
                            extend: 'print',
                            title: 'Pencapaian EA'
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