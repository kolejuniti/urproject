@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <div class="col-md-6 col-sm-6 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.yearreports') }}">
                @csrf
                    <div class="input-group mb-3">
                        <button class="btn btn-secondary" disabled>Tarikh</button>
                        <input type="date" class="form-control" name="start_date">
                        <button class="btn btn-secondary" disabled>-</button>
                        <input type="date" class="form-control" name="end_date">
                        <button class="btn btn-warning" type="submit">Cari</button>
                    </div>
                </form>
            </div> --}}
            <div>
                <div class="col-md-12">
                    @foreach ($locations as $location)
                        <table id="myTable{{ $location->id }}" class="table table-bordered table-sm text-center">
                            <caption>Laporan yang dijana adalah bagi 3 tahun terakhir di {{ $location->name }}.</caption>
                            <thead class="table-dark">
                                <tr>
                                    <th colspan="13" class="text-center">{{ $location->name }}</th>
                                </tr>
                                <tr>
                                    <th rowspan="2" class="text-align-middle">Tahun</th>
                                    <th colspan="12" class="text-center">Bulan</th>
                                </tr>
                                <tr>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <th class="text-center" width="100">{{ $month }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                @for ($year = $startYear; $year <= $currentYear; $year++)
                                    <tr>
                                        <td class="text-center">{{ $year }}</td>
                                        @for ($month = 1; $month <= 12; $month++)
                                            <td class="text-center">
                                                {{ $yearlyData[$year][$month]['total'][$location->id] ?? 0 }}
                                            </td>
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    @endforeach
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
        var t = $('#myTable1').DataTable({
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
                        html: '<h2>Jumlah Data Masuk Mengikut Tahun & Bulan</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Data Masuk - Tahun & Bulan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Data Masuk - Tahun & Bulan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Masuk - Tahun & Bulan'
                        },
                        {
                            extend: 'print',
                            title: 'Data Masuk - Tahun & Bulan'
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
<script>
    $(document).ready(function() {
        var t = $('#myTable2').DataTable({
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
                        html: '<h2>Jumlah Data Masuk Mengikut Tahun & Bulan</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Data Masuk - Tahun & Bulan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Data Masuk - Tahun & Bulan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Masuk - Tahun & Bulan'
                        },
                        {
                            extend: 'print',
                            title: 'Data Masuk - Tahun & Bulan'
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
