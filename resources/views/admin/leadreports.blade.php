@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-8 col-sm-8 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.leadreports') }}">
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
                            <th rowspan="3">#</th>
                            <th rowspan="3">Sumber</th>
                            <th rowspan="3">Jumlah Data</th>
                            <th class="text-center" colspan="2">Data Masuk</th>
                            <th class="text-center" colspan="4">Pendaftaran</th>
                          </tr>
                          <tr>
                            <th rowspan="2">Melalui Affiliate</th>
                            <th rowspan="2">Tanpa Affiliate</th>
                            <th colspan="2" class="text-center">Pra Daftar</th>
                            <th colspan="2" class="text-center">Daftar Kolej</th>
                          </tr>
                          <tr>
                            <th>Melalui Affiliate</th>
                            <th>Tanpa Affiliate</th>
                            <th>Melalui Affiliate</th>
                            <th>Tanpa Affiliate</th>
                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($sources as $item)
                        <tr>
                            <td></td>
                            <td class="text-uppercase">{{ $item->source }}</td>
                            <td class="text-center">{{ $totalData[$item->source] ?? 0 }}</td>
                            <td class="text-center">{{ $totalDataWithAffiliate[$item->source] ?? 0 }}</td>
                            <td class="text-center">{{ $totalDataWithoutAffiliate[$item->source] ?? 0 }}</td>
                            <td class="text-center">{{ $totalDataPreRegisterWithAffiliate[$item->source] ?? 0 }}</td>
                            <td class="text-center">{{ $totalDataPreRegisterWithoutAffiliate[$item->source] ?? 0 }}</td>
                            <td class="text-center">{{ $totalDataRegisterWithAffiliate[$item->source] ?? 0 }}</td>
                            <td class="text-center">{{ $totalDataRegisterWithoutAffiliate[$item->source] ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-danger">
                        <tr>
                            <td rowspan="2"></td>
                            <td rowspan="2"><strong>Jumlah Keseluruhan</strong></td>
                            <td rowspan="2" class="text-center"><strong>{{ $totalDataCount }}</strong></td>
                            <td class="text-center"><strong>{{ $totalDataWithAffiliateCount }}</strong></td>
                            <td class="text-center"><strong>{{ $totalDataWithoutAffiliateCount }}</strong></td>
                            <td class="text-center"><strong>{{ $totalDataPreRegisterWithAffiliateCount }}</strong></td>
                            <td class="text-center"><strong>{{ $totalDataPreRegisterWithoutAffiliateCount }}</strong></td>
                            <td class="text-center"><strong>{{ $totalDataRegisterWithAffiliateCount }}</strong></td>
                            <td class="text-center"><strong>{{ $totalDataRegisterWithoutAffiliateCount }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center"><strong>{{ $totalDataEntry }}</strong></td>
                            <td colspan="2" class="text-center"><strong>{{ $totalDataPreRegister }}</strong></td>
                            <td colspan="2" class="text-center"><strong>{{ $totalDataRegister }}</strong></td>
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
                        html: '<h2>Data Masuk {{ $location_name }}</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Data Masuk'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Data Masuk'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Masuk'
                        },
                        {
                            extend: 'print',
                            title: 'Data Masuk'
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