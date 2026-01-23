@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered small table-sm text-center">
                <caption>N = data baru, R = data ulang</caption>
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tarikh Data Masuk</th>
                        <th>Sumber</th>
                        <th>Jenis Data</th>
                        <th>Insentif</th>
                        <th>Komisen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $item)
                    <tr>
                        <td></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td class="text-uppercase">{{ $item->source }}</td>
                        <td class="text-uppercase">{{ $item->remark }}</td>
                        <td class="text-center">{{ $item->incentive ?? '0.00' }}</td>
                        <td class="text-center">{{ $item->commission ?? '0.00' }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-danger">
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="text-center">Jumlah Keseluruhan</th>
                        <th></th>
                        <th>{{ $totalIncentive ?? '0.00' }}</th>
                        <th>{{ $totalCommission ?? '0.00' }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
            columnDefs: [{
                targets: ['_all'],
                className: 'dt-head-center'
            }],
            layout: {
                top1Start: {
                    div: {
                        html: '<h2>Pencapaian Affiliate {{ $affiliate->name }}</h2>'
                    }
                },
                top1End: {
                    buttons: [{
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
        t.on('order.dt search.dt', function() {
            let i = 1;

            t.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
@endsection