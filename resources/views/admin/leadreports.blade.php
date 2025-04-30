@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-6 col-sm-6 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.leadreports') }}">
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
                    @if ($start_date === null)
                    @else
                    <caption>Data permohonan ini adalah bagi tarikh {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '' }} sehingga {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '' }}</caption>
                    @endif
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Sumber</th>
                            <th>KUPD</th>
                            <th>KUKB</th>
                            <th>Jumlah Keseluruhan</th>
                            {{-- <th>{{ $start_date ? \Carbon\Carbon::parse($start_date)->format('m-Y') : '-' }}
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sources as $item)
                        <tr>
                            <td></td>
                            <td class="text-uppercase">{{ $item->source }}</td>
                            <td class="text-center">{{ $item->total_kupd }}</td>
                            <td class="text-center">{{ $item->total_kukb }}</td>
                            <td class="text-center">{{ $item->total }}</td>
                            {{-- <td class="text-center">{{ $monthlyTotals[$item->source] ?? 0 }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-danger">
                            <th colspan="2" class="text-center">Jumlah Keseluruhan</th>
                            <th class="text-center">{{ $total_kupd }}</th>
                            <th class="text-center">{{ $total_kukb }}</th>
                            <th class="text-center">{{ $all_total }}</th>
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
                        html: '<h2>Jumlah Data Permohonan</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Jumlah Data Permohonan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Jumlah Data Permohonan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Jumlah Data Permohonan'
                        },
                        {
                            extend: 'print',
                            title: 'Jumlah Data Permohonan'
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