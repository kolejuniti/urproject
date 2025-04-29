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
                    <table id="myTable4" class="table table-bordered table-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th rowspan="2" class="text-align-middle">Tahun</th>
                                <th colspan="12" class="text-center">Bulan</th>
                            </tr>
                            <tr>
                                @for ($month = 1; $month <= 12; $month++)
                                    <th class="text-center">{{ $month }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($year = $startYear; $year <= $currentYear; $year++)
                                <tr>
                                    <td class="text-center">{{ $year }}</td>
                                    @foreach ($yearlyData[$year] as $data)
                                        <td class="text-center">{{ $data['total'] }}</td>
                                    @endforeach
                                </tr>
                            @endfor
                        </tbody>
                    </table>
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
                        html: '<h2>Jumlah Permohonan Mengikut Tahun & Bulan</h2>'
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
