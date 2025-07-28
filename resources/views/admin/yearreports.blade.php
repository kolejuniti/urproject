@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-end mb-3">
                <div style="min-width: 120px;">
                    <form method="GET" action="{{ route('admin.yearreports') }}">
                        <div class="input-group">
                            <select name="year" class="form-select" onchange="this.form.submit()">
                                @for ($year = now()->year; $year >= now()->year - 3; $year--)
                                    <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <div class="col-md-12">
                    @php
                        $monthNames = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
                            5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember',
                        ];
                    @endphp
                    @foreach ($locations as $location)
                        <table id="myTable{{ $location->id }}" class="table table-bordered table-sm text-center">
                            <caption>Laporan yang dijana adalah bagi tahun {{ $currentYear }} di {{ $location->name }}.</caption>
                            <thead class="table-dark">
                                <tr>
                                    <th colspan="13" class="text-center">{{ $location->name }}</th>
                                </tr>
                                <tr>
                                    <th class="text-align-middle">Tahun</th>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <th class="text-center" width="100">{{ $month }}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $currentYear }}</td>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <td class="text-center">
                                            {{ $yearlyData[$currentYear][$month]['total'][$location->id] ?? 0 }}
                                        </td>
                                    @endfor
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-sm text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th>Bulan</th>
                                <th>Minggu</th>
                                <th>Jumlah Pendaftaran</th>
                            </tr>
                        </thead>
                            <tbody>
                                @for ($month = 1; $month <= 12; $month++)
                                    @php
                                        $weeks = $weeklyMonthlyData[$month] ?? [];
                                        $rowspan = count($weeks);
                                        $printed = false;
                                    @endphp
                                    @foreach ($weeks as $weekInMonth => $data)
                                        <tr>
                                            @if (!$printed)
                                                <td rowspan="{{ $rowspan }}" class="align-middle">{{ $monthNames[$month] }}</td>
                                                @php $printed = true; @endphp
                                            @endif
                                            <td>Minggu {{ $weekInMonth }}</td>
                                            <td>{{ $data['total'][$location->id] ?? 0 }}</td>
                                        </tr>
                                    @endforeach
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
