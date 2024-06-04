@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(isset($success))
                <div class="alert alert-success">
                    {{ $success }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Senarai Pelajar')}}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered small table-sm text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pelajar</th>
                                    <th>No. Kad Pengenalan</th>
                                    <th>No. Telefon</th>
                                    <th>Email</th>
                                    <th>Tarikh Permohonan</th>
                                    <th>Affiliate</th>
                                    <th>Tarikh Agihan</th>
                                    <th>Education Advisor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student )
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>{{ $student->name }}</td>
                                    <td class="text-center">{{ $student->ic }}</td>
                                    <td class="text-center">{{ $student->phone }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        @foreach ($affiliates[$student->id] as $affiliate)
                                            {{ $affiliate->name }}
                                        @endforeach
                                    </td>
                                    <td>{{ $student->updated_at ? \Carbon\Carbon::parse($student->updated_at)->format('d-m-Y') : '' }}</td>
                                    <td>
                                        @foreach ($advisors[$student->id] as $advisor)
                                            {{ $advisor->name }}
                                        @endforeach
                                    </td>
                                    <td>&nbsp;</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'dt-head-center'
                }
            ]
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
