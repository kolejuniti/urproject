@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-3">Statistik Permohonan</h2>
            <div class="row">
                <div class="col-md-6">
                    <table id="myTable" class="table table-bordered table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Status</th>
                                <th>Jumlah</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statusWithPercentage as $data)
                            <tr>
                                <td></td>
                                <td class="text-uppercase">{{ $data->status }}</td>
                                <td class="text-center">{{ $data->total }}</td>
                                <td class="text-center">{{ number_format($data->percentage, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-danger">
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $totalStudents }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-md-6">
                    <table id="myTable2" class="table table-bordered table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Lokasi</th>
                                <th>Jumlah</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locationsWithPercentage as $data2)
                            <tr>
                                <td></td>
                                <td class="text-uppercase">{{ $data2->location }}</td>
                                <td class="text-center">{{ $data2->total }}</td>
                                <td class="text-center">{{ number_format($data2->percentage, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                        html: '<h2>Status</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Ringkasan Bilangan Permohonan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Ringkasan Bilangan Permohonan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Ringkasan Bilangan Permohonan'
                        },
                        {
                            extend: 'print',
                            title: 'Ringkasan Bilangan Permohonan'
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
<script>
    $(document).ready(function() {
        var t = $('#myTable2').DataTable({
        columnDefs: [
            {
                targets: ['_all'],
                className: 'dt-head-center'
            }
        ],
        layout: {
                top1Start: {
                    div: {
                        html: '<h2>Lokasi</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Ringkasan Bilangan Permohonan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Ringkasan Bilangan Permohonan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Ringkasan Bilangan Permohonan'
                        },
                        {
                            extend: 'print',
                            title: 'Ringkasan Bilangan Permohonan'
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
