@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-6 col-sm-6 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.summary') }}">
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
            <h2 class="mb-3">Statistik Permohonan</h2>
            {{-- <div>
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
            </div> --}}
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
                                {{-- <td class="text-uppercase">{{ $data->status }}</td> --}}
                                <td>
                                    <button type="button" class="btn btn-sm btn-link text-uppercase open-modal" data-status_id="{{ $data->status_id }}">{{ $data->status }}</button>
                                </td>
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
                                <th>KUPD</th>
                                <th>KUKB</th>
                                <th>Jumlah</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sourcessWithPercentage as $data3)
                            <tr>
                                <td></td>
                                <td class="text-uppercase">{{ $data3->source }}</td>
                                <td class="text-center">{{ $data3->total_kupd }}</td>
                                <td class="text-center">{{ $data3->total_kukb }}</td>
                                <td class="text-center">{{ $data3->total }}</td>
                                <td class="text-center">{{ number_format($data3->percentage, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-danger">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $totalStudents }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <table id="myTable5" class="table table-bordered table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Negeri</th>
                                <th>KUPD</th>
                                <th>KUKB</th>
                                <th>Jumlah</th>
                                <th>%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($statesWithPercentage as $data4)
                            <tr>
                                <td></td>
                                <td class="text-uppercase">{{ $data4->state }}</td>
                                <td class="text-center">{{ $data4->total_kupd }}</td>
                                <td class="text-center">{{ $data4->total_kukb }}</td>
                                <td class="text-center">{{ $data4->total }}</td>
                                <td class="text-center">{{ number_format($data4->percentage, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-danger">
                            <tr>
                                <td></td>
                                <td></td>
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
    
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header small">
                    <label class="fw-bold" id="statusDetail-status"></label>
                </div>
                <div class="modal-body small">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label class="fw-bold">#&nbsp;&nbsp;&nbsp;Nama Pemohon</label>
                        </div>
                        <div class="col-md-2">
                            <label class="fw-bold">No. Kad Pengenalan</label>
                        </div>
                        <div class="col-md-3">
                            <label class="fw-bold">Affiliate</label>
                        </div>
                        <div class="col-md-3">
                            <label class="fw-bold">Education Advisor</label>
                        </div>
                    </div>
                    <div id="statusDetailsContainer" class="mb-2">
                        <!-- Records will be appended here by JavaScript -->
                    </div>
                    <div>
                        <div class="col-md-12">
                            <label><em>*Data pemohon yang dipaparkan adalah data yang berdaftar menggunakan link yang dikongsi oleh affiliate sahaja.</em></label>
                        </div>
                    </div>                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
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
        pageLength: 50,
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

        $(document).on('click', '.open-modal', function() {
            var status_id = $(this).data('status_id');

            $.ajax({
                url: "{{ route('admin.summary.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status_id: status_id
                },
                success: function(response) {
                    console.log(response.statusDetails); // Debugging: log the response
                    console.log(response.status); // Debugging: log the status

                    // Display the general status message, even if there are no student details
                    $('#statusDetail-status').text((response.status || 'N/A').toUpperCase());

                    // Clear previous data
                    $('#statusDetailsContainer').empty();

                    if (response.statusDetails && response.statusDetails.length > 0) {
                        // Iterate over each record and append to the modal
                        response.statusDetails.forEach(function(statusDetail, index) {
                            var recordHtml = `
                                <div class="row mb-2 border-bottom">
                                    <div class="col-md-4">
                                        <label class="text-uppercase">${index + 1}.&nbsp;&nbsp;${statusDetail.student || 'N/A'}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="text-uppercase">${statusDetail.ic || 'N/A'}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-uppercase">${statusDetail.affiliate || 'N/A'}</label>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-uppercase">${statusDetail.advisor || 'N/A'}</label>
                                    </div>
                                </div>
                            `;
                            $('#statusDetailsContainer').append(recordHtml);
                        });
                    } else {
                        console.error('No status data found');

                        // Optionally, show a default message when no records are found
                        $('#statusDetailsContainer').html('<p>Tiada Data Pemohon</p>');
                    }

                    // Show the modal
                    $('#statusModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                    $('#statusDetailsContainer').html('<p>Masalah Data Pemohon</p>');
                    $('#statusModal').modal('show');
                }
            });
        });

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
                bottomStart: null,
                bottomEnd: null
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
                        html: '<h2>Sumber</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Statistik Permohonan - Sumber'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Statistik Permohonan - Sumber'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Statistik Permohonan - Sumber'
                        },
                        {
                            extend: 'print',
                            title: 'Statistik Permohonan - Sumber'
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: null,
                bottomEnd: null
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
        var t = $('#myTable5').DataTable({
        pageLength: 20,
        columnDefs: [
            {
                targets: ['_all'],
                className: 'dt-head-center'
            }
        ],
        layout: {
                top1Start: {
                    div: {
                        html: '<h2>Negeri</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Statistik Permohonan - Negeri'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Statistik Permohonan - Negeri'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Statistik Permohonan - Negeri'
                        },
                        {
                            extend: 'print',
                            title: 'Statistik Permohonan - Negeri'
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: null,
                bottomEnd: null
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
