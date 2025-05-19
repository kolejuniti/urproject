@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered small table-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Nama Pemohon</th>
                        <th rowspan="2">Tarikh Permohonan</th>
                        <th rowspan="2">Tarikh Diagihkan</th>
                        <th rowspan="2">Status Terkini</th>
                        <th colspan="4" class="text-center">Julat Hari</th>
                    </tr>
                    <tr>
                        <th>Data Proses</th>
                        <th>Pra Pendaftaran</th>
                        <th>Daftar Masuk</th>
                        <th>Data Ditolak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $item)
                    <tr>
                        <td></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '' }}</td>
                        <td class="text-uppercase">{{ $item->status ?? 'PERMOHONAN BARU' }}</td>
                        {{-- Group 1: status_id in [7–18] --}}
                        <td class="text-center">
                            {{ in_array($item->status_id, range(7, 18)) ? $item->days_since_update : 0 }}
                        </td>
                        {{-- Group 2: status_id === 19 --}}
                        <td class="text-center">
                            {{ $item->status_id === 19 ? $item->days_since_update : 0 }}
                        </td>
                        {{-- Group 3: status_id in [20, 21] --}}
                        <td class="text-center">
                            {{ in_array($item->status_id, [20, 21]) ? $item->days_since_update : 0 }}
                        </td>
                        {{-- Group 4: status_id in [1–5, 24, 26, 27] --}}
                        <td class="text-center">
                            {{ in_array($item->status_id, [1,2,3,4,5,24,26,27]) ? $item->days_since_update : 0 }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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
        columnDefs: [
            {
                targets: ['_all'],
                className: 'dt-head-center'
            }
        ],
        layout: {
                top1Start: {
                    div: {
                        html: '<h2>Pencapaian EA {{ $user->name }}</h2>'
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