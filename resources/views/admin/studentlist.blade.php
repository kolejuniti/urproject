@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(isset($success))
                <div class="alert alert-success">
                    {{ $success }}
                </div>
            @endif
            <div class="col-md-8 col-sm-8 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.studentlist') }}">
                @csrf
                    <div class="input-group mb-3">
                        <button class="btn btn-secondary" disabled>Tarikh</button>
                        <input type="date" class="form-control" name="start_date">
                        <button class="btn btn-secondary" disabled>-</button>
                        <input type="date" class="form-control" name="end_date">
                        <span class="input-group-text">
                            <input type="checkbox" name="show_affiliate_only" value="1" {{ request('show_affiliate_only') ? 'checked' : '' }}>
                            <span class="ms-2">Affiliate Sahaja</span>
                        </span>
                        <button class="btn btn-warning" type="submit">Cari</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    <caption>Senarai yang dipaparkan adalah dari tarikh {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }} sehingga {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</caption>
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Pelajar</th>
                            <th>No. Kad Pengenalan</th>
                            <th>No. Telefon</th>
                            <th>Email</th>
                            <th>Tarikh Permohonan</th>
                            <th>Lokasi</th>
                            <th>Affiliate</th>
                            {{-- <th>Tarikh Agihan</th> --}}
                            <th>Education Advisor</th>
                            <th>Status</th>
                            <th>Tarikh Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student )
                        <tr>
                            <td>&nbsp;</td>
                            <td class="text-uppercase">{{ $student->name }}</td>
                            <td class="text-center">{{ $student->ic }}</td>
                            <td class="text-center">{{ $student->phone }}</td>
                            <td>{{ strtolower($student->email) }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y') }}</td>
                            <td>{{ $student->location }}</td>
                            <td class="text-uppercase">
                                @if (!empty($student->referral_code) && $student->referral_code !== 'null' && isset($affiliates[$student->id]))
                                    @foreach ($affiliates[$student->id] as $affiliate)
                                        {{ $affiliate->name }}
                                    @endforeach
                                @else
                                    {{ __('TIADA AFFILIATE') }}
                                @endif
                            </td>
                            {{-- <td>{{ $student->updated_at ? \Carbon\Carbon::parse($student->updated_at)->format('d-m-Y') : '' }}</td> --}}
                            <td class="text-uppercase">
                                @foreach ($advisors[$student->id] as $advisor)
                                    {{ $advisor->name }}
                                @endforeach
                            </td>
                            <td class="text-uppercase">{{ $student->status }}</td>
                            <td>{{ $student->register_at ? \Carbon\Carbon::parse($student->register_at)->format('d-m-Y') : '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
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
                        html: '<h2>Senarai Permohonan Pelajar</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Senarai Permohonan Pelajar'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Senarai Permohonan Pelajar'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Senarai Permohonan Pelajar'
                        },
                        {
                            extend: 'print',
                            title: 'Senarai Permohonan Pelajar'
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
