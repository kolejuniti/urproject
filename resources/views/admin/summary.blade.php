@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-3">Statistik Permohonan</h2>
            <div>
                <div class="col-md-12">
                    <table id="myTable4" class="table table-bordered table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2" class="text-align-middle">Tahun</th>
                                <th colspan="12" class="text-center">Bulan</th>
                            </tr>
                            <tr>
                                @foreach ($monthlyData as $data)
                                    <th class="text-center">{{ $data['month'] }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <td class="text-center">{{ $currentYear }}</td>
                            @foreach ($monthlyData as $data)
                                <td class="text-center">{{ $data['total'] }}</td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
                        <tfoot class="table-danger">
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $totalStudents }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <table id="myTable3" class="table table-bordered table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Sumber</th>
                                <th>Jumlah</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sourcessWithPercentage as $data3)
                            <tr>
                                <td></td>
                                <td class="text-uppercase">{{ $data3->source }}</td>
                                <td class="text-center">{{ $data3->total }}</td>
                                <td class="text-center">{{ number_format($data3->percentage, 2) }}%</td>
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
                            title: 'Statistik Permohonan - Status'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Statistik Permohonan - Status'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Statistik Permohonan - Status'
                        },
                        {
                            extend: 'print',
                            title: 'Statistik Permohonan - Status'
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
                            title: 'Statistik Permohonan - Lokasi'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Statistik Permohonan - Lokasi'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Statistik Permohonan - Lokasi'
                        },
                        {
                            extend: 'print',
                            title: 'Statistik Permohonan - Lokasi'
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
        var t = $('#myTable3').DataTable({
        columnDefs: [
            {
                targets: ['_all'],
                className: 'dt-head-center'
            }
        ],
        layout: {
                top1Start: {
                    div: {
                        html: '<h2>Iklan</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Statistik Permohonan - Iklan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Statistik Permohonan - Iklan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Statistik Permohonan - Iklan'
                        },
                        {
                            extend: 'print',
                            title: 'Statistik Permohonan - Iklan'
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
        var t = $('#myTable4').DataTable({
        ordering: false,
        columnDefs: [
            {
                targets: ['_all'],
                className: 'dt-head-center'
            }
        ],
        layout: {
                top1Start: {
                    div: {
                        html: '<h2>Tahun & Bulan</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Statistik Permohonan - Tahun & Bulan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Statistik Permohonan - Tahun & Bulan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Statistik Permohonan - Tahun & Bulan'
                        },
                        {
                            extend: 'print',
                            title: 'Statistik Permohonan - Tahun & Bulan'
                        }
                    ]
                },
                topStart: null,
                topEnd: null,
                bottomStart: null,
                bottomEnd: null
            }
        });
        // t.on('order.dt search.dt', function () {
        //     let i = 1;
        
        //     t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
        //         this.data(i++);
        //     });
        // }).draw();
    });
</script>
@endsection
