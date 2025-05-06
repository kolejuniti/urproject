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
                            <th rowspan="2">#</th>
                            <th rowspan="2">Nama EA</th>
                            <th colspan="2" class="text-center">Data Diagih</th>
                            <th colspan="2" class="text-center">Data Diproses</th>
                            <th colspan="2" class="text-center">Pra Daftar</th>
                            <th colspan="2" class="text-center">Daftar Masuk</th>
                            <th colspan="2" class="text-center">Data Ditolak</th>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <th>%</th>
                            <th>Jumlah</th>
                            <th>%</th>
                            <th>Jumlah</th>
                            <th>%</th>
                            <th>Jumlah</th>
                            <th>%</th>
                            <th>Jumlah</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($advisors as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">{{ $assigns[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $assignPercentage[$item->id] ?? 0 }}%</td>
                            <td class="text-center">{{ $process[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $processPercentage[$item->id] ?? 0 }}%</td>
                            <td class="text-center">{{ $preregisters[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $preregisterPercentage[$item->id] ?? 0 }}%</td>
                            <td class="text-center">{{ $registers[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $registerPercentage[$item->id] ?? 0 }}%</td>
                            <td class="text-center">{{ $rejects[$item->id] ?? 0 }}</td>
                            <td class="text-center">{{ $rejectPercentage[$item->id] ?? 0 }}%</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-danger">
                            <td></td>
                            <td><strong>Jumlah Keseluruhan</strong></td>
                            <td class="text-center"><strong>{{ $totalCountAssign }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountAssignPercentage }}%</strong></td>
                            <td class="text-center"><strong>{{ $totalCountProcess }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountProcessPercentage }}%</strong></td>
                            <td class="text-center"><strong>{{ $totalCountPreRegister }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountPreRegisterPercentage }}%</strong></td>
                            <td class="text-center"><strong>{{ $totalCountRegister }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountRegisterPercentage }}%</strong></td>
                            <td class="text-center"><strong>{{ $totalCountReject }}</strong></td>
                            <td class="text-center"><strong>{{ $totalCountRejectPercentage }}%</strong></td>
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
                        html: '<h2>Pencapaian EA {{ $location_name }}</h2>'
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