@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">

<style>
    :root {
        --admin-primary: #1e293b;
        --admin-secondary: #334155;
        --admin-accent: #3b82f6;
        --admin-accent-hover: #2563eb;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
        --admin-bg: #f8fafc;
        --admin-card-bg: #ffffff;
        --admin-border: #e2e8f0;
        --admin-text: #1e293b;
        --admin-text-muted: #64748b;
        --admin-gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--admin-bg);
        color: var(--admin-text);
    }

    .admin-summary-page {
        padding: 2rem 0;
    }

    /* Page Header */
    .page-header {
        background: var(--admin-gradient-1);
        border-radius: 16px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .page-header h2 {
        font-weight: 700;
        font-size: 1.75rem;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .page-header p {
        margin: 0;
        opacity: 0.8;
        font-size: 1rem;
        position: relative;
        z-index: 1;
    }

    /* Modern Card */
    .modern-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        margin-bottom: 2rem;
        height: 100%;
        animation: fadeInUp 0.5s ease-out;
    }

    .dashboard-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--admin-border);
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dashboard-card-title {
        font-weight: 700;
        color: var(--admin-primary);
        margin: 0;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
    }

    .dashboard-card-title i {
        margin-right: 0.75rem;
        color: var(--admin-accent);
    }

    .modern-card-body {
        padding: 1.5rem;
    }

    /* Filter Card */
    .filter-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--admin-text-muted);
        margin-bottom: 0.5rem;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .btn-filter {
        background: var(--admin-accent);
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        height: 100%;
        width: 100%;
    }

    .btn-filter:hover {
        background: var(--admin-accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
    }

    /* DataTable Customization */
    .dataTables_wrapper .top1Start h2 {
        color: var(--admin-primary);
        font-weight: 700;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .dataTables_wrapper .dt-buttons .btn {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 8px;
        color: var(--admin-text-muted);
        font-weight: 600;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
    }

    .dataTables_wrapper .dt-buttons .btn:hover {
        background: var(--admin-accent);
        color: white;
        border-color: var(--admin-accent);
    }

    /* Table Styling */
    .modern-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }

    .modern-table thead {
        background: var(--admin-primary);
        color: white;
    }

    .modern-table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 0.75rem;
        border: none;
        vertical-align: middle;
        background: var(--admin-primary);
        /* Ensure header bg covers custom rowspan/colspan */
    }

    .modern-table thead th:first-child {
        border-top-left-radius: 8px;
    }

    .modern-table thead th:last-child {
        border-top-right-radius: 8px;
    }

    /* Specific for multi-row headers */
    .modern-table thead tr:last-child th:first-child {
        border-bottom-left-radius: 8px;
    }

    .modern-table thead tr:last-child th:last-child {
        border-bottom-right-radius: 8px;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid var(--admin-border);
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
    }

    .modern-table tbody td {
        padding: 0.6rem 0.75rem;
        vertical-align: middle;
        color: var(--admin-text);
        font-size: 0.85rem;
        border-bottom: 1px solid var(--admin-border);
    }

    .modern-table tfoot {
        background: #f1f5f9;
        font-weight: bold;
    }

    .modern-table tfoot td {
        padding: 0.75rem;
        border-top: 2px solid var(--admin-border);
    }

    /* Custom cell colors */
    .bg-soft-warning {
        background-color: #fffbeb !important;
    }

    .bg-soft-success {
        background-color: #f0fdf4 !important;
    }

    .bg-soft-danger {
        background-color: #fef2f2 !important;
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        background: var(--admin-gradient-1);
        color: white;
        border-radius: 16px 16px 0 0;
        padding: 1.25rem 1.5rem;
        border: none;
    }

    .modal-header .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid admin-summary-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2><i class="fas fa-chart-pie me-2"></i>Statistik & Laporan</h2>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-card">
                <form method="POST" action="{{ route('admin.summary') }}" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Mula</label>
                        <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Tamat</label>
                        <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-filter" type="submit">
                            <i class="fas fa-filter me-2"></i> Jana Laporan
                        </button>
                    </div>
                </form>
            </div>

            <div class="row">
                <!-- Status Table -->
                <div class="col-lg-6 mb-4">
                    <div class="modern-card h-100">
                        <div class="dashboard-card-header">
                            <h5 class="dashboard-card-title"><i class="fas fa-tasks"></i> Statistik Status Data Masuk</h5>
                        </div>
                        <div class="modern-card-body">
                            <div class="table-responsive">
                                <table id="myTable" class="modern-table table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Status</th>
                                            <th>Jumlah</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statusWithPercentage as $index => $data)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-link text-uppercase open-modal text-start p-0 fw-bold text-decoration-none" data-status_id="{{ $data->status_id }}" style="color: var(--admin-accent);">
                                                    {{ $data->status }}
                                                </button>
                                            </td>
                                            <td class="text-center fw-bold">{{ $data->total }}</td>
                                            <td class="text-center">{{ number_format($data->percentage, 2) }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-soft-danger">
                                        <tr>
                                            <td></td>
                                            <td class="text-end text-uppercase">Jumlah Keseluruhan</td>
                                            <td class="text-center">{{ $totalStudents }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location Table -->
                <div class="col-lg-6 mb-4">
                    <div class="modern-card h-100">
                        <div class="dashboard-card-header">
                            <h5 class="dashboard-card-title"><i class="fas fa-map-marker-alt"></i> Statistik Mengikut Lokasi</h5>
                        </div>
                        <div class="modern-card-body">
                            <div class="table-responsive">
                                <table id="myTable2" class="modern-table table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Lokasi</th>
                                            <th>Jumlah</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($locationsWithPercentage as $index => $data2)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-uppercase fw-bold">{{ $data2->location }}</td>
                                            <td class="text-center fw-bold">{{ $data2->total }}</td>
                                            <td class="text-center">{{ number_format($data2->percentage, 2) }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-soft-danger">
                                        <tr>
                                            <td></td>
                                            <td class="text-end text-uppercase">Jumlah Keseluruhan</td>
                                            <td class="text-center">{{ $totalStudents }}</td>
                                            <td>100%</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Source Table -->
                <div class="col-lg-12 mb-4">
                    <div class="modern-card">
                        <div class="dashboard-card-header">
                            <h5 class="dashboard-card-title"><i class="fas fa-share-alt"></i> Analisis Sumber Data Masuk</h5>
                        </div>
                        <div class="modern-card-body">
                            <div class="table-responsive">
                                <table id="myTable3" class="modern-table table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Sumber</th>
                                            <th colspan="4" class="text-center bg-soft-warning text-dark border-bottom">Data Masuk</th>
                                            <th colspan="4" class="text-center bg-soft-success text-dark border-bottom">Daftar Kolej</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-soft-warning text-dark">KUPD</th>
                                            <th class="bg-soft-warning text-dark">KUKB</th>
                                            <th class="bg-soft-warning text-dark">Jumlah</th>
                                            <th class="bg-soft-warning text-dark">%</th>
                                            <th class="bg-soft-success text-dark">KUPD</th>
                                            <th class="bg-soft-success text-dark">KUKB</th>
                                            <th class="bg-soft-success text-dark">Jumlah</th>
                                            <th class="bg-soft-success text-dark">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sourcessWithPercentage as $index => $data3)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-uppercase fw-bold">{{ $data3->source }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ $data3->total_kupd }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ $data3->total_kukb }}</td>
                                            <td class="text-center bg-soft-warning text-dark fw-bold">{{ $data3->total }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ number_format($data3->percentage, 2) }}%</td>
                                            <td class="text-center bg-soft-success text-dark">{{ $data3->total_kupd_register }}</td>
                                            <td class="text-center bg-soft-success text-dark">{{ $data3->total_kukb_register }}</td>
                                            <td class="text-center bg-soft-success text-dark fw-bold">{{ $data3->total_register }}</td>
                                            <td class="text-center bg-soft-success text-dark">{{ number_format($data3->register_percentage, 2) }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end text-uppercase">Jumlah Keseluruhan</td>
                                            <td class="text-center bg-soft-warning">{{ $totalSourceKupdSum }}</td>
                                            <td class="text-center bg-soft-warning">{{ $totalSourceKukbSum }}</td>
                                            <td class="text-center bg-soft-warning">{{ $totalStudents }}</td>
                                            <td class="bg-soft-warning"></td>
                                            <td class="text-center bg-soft-success">{{ $totalSourceKupdRegisterSum }}</td>
                                            <td class="text-center bg-soft-success">{{ $totalSourceKukbRegisterSum }}</td>
                                            <td class="text-center bg-soft-success">{{ $totalSourceRegisterSum }}</td>
                                            <td class="text-center bg-soft-success">
                                                {{ $totalSourceSum > 0 ? number_format(($totalSourceRegisterSum / $totalSourceSum) * 100, 2) . '%' : '0.00%' }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- State Table -->
                <div class="col-lg-12 mb-4">
                    <div class="modern-card">
                        <div class="dashboard-card-header">
                            <h5 class="dashboard-card-title"><i class="fas fa-map"></i> Analisis Mengikut Negeri</h5>
                        </div>
                        <div class="modern-card-body">
                            <div class="table-responsive">
                                <table id="myTable5" class="modern-table table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">#</th>
                                            <th rowspan="2">Negeri</th>
                                            <th colspan="4" class="text-center bg-soft-warning text-dark border-bottom">Data Masuk</th>
                                            <th colspan="4" class="text-center bg-soft-success text-dark border-bottom">Daftar Kolej</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-soft-warning text-dark">KUPD</th>
                                            <th class="bg-soft-warning text-dark">KUKB</th>
                                            <th class="bg-soft-warning text-dark">Jumlah</th>
                                            <th class="bg-soft-warning text-dark">%</th>
                                            <th class="bg-soft-success text-dark">KUPD</th>
                                            <th class="bg-soft-success text-dark">KUKB</th>
                                            <th class="bg-soft-success text-dark">Jumlah</th>
                                            <th class="bg-soft-success text-dark">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($statesWithPercentage as $index => $data4)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-uppercase fw-bold">{{ $data4->state }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ $data4->total_kupd }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ $data4->total_kukb }}</td>
                                            <td class="text-center bg-soft-warning text-dark fw-bold">{{ $data4->total }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ number_format($data4->percentage, 2) }}%</td>
                                            <td class="text-center bg-soft-success text-dark">{{ $data4->total_kupd_register }}</td>
                                            <td class="text-center bg-soft-success text-dark">{{ $data4->total_kukb_register }}</td>
                                            <td class="text-center bg-soft-success text-dark fw-bold">{{ $data4->total_register }}</td>
                                            <td class="text-center bg-soft-success text-dark">{{ number_format($data4->register_percentage, 2) }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end text-uppercase">Jumlah Keseluruhan</td>
                                            <td class="text-center bg-soft-warning">{{ $totalStateKupdSum }}</td>
                                            <td class="text-center bg-soft-warning">{{ $totalStateKukbSum }}</td>
                                            <td class="text-center bg-soft-warning">{{ $totalStateSum }}</td>
                                            <td class="bg-soft-warning"></td>
                                            <td class="text-center bg-soft-success">{{ $totalStateKupdRegisterSum }}</td>
                                            <td class="text-center bg-soft-success">{{ $totalStateKukbRegisterSum }}</td>
                                            <td class="text-center bg-soft-success">{{ $totalStateRegisterSum }}</td>
                                            <td class="text-center bg-soft-success">
                                                {{ $totalStateSum > 0 ? number_format(($totalStateRegisterSum / $totalStateSum) * 100, 2) . '%' : '0.00%' }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-white" id="statusModalLabel">
                    <i class="fas fa-list me-2"></i> Perincian Status: <span id="statusDetail-status" class="fw-bold text-decoration-underline"></span>
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="modern-card shadow-none border mb-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th># Nama Pemohon</th>
                                    <th>No. KP</th>
                                    <th>Tarikh Mohon</th>
                                    <th>Affiliate</th>
                                    <th>Education Advisor</th>
                                    <th>Tarikh Daftar</th>
                                </tr>
                            </thead>
                            <tbody id="statusDetailsContainer">
                                <!-- JS populated -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="alert alert-info mt-3 mb-0 small">
                    <i class="fas fa-info-circle me-2"></i> *Data pemohon yang dipaparkan adalah data yang berdaftar menggunakan link yang dikongsi oleh affiliate sahaja.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>

<script>
    // General DataTable Config
    function getDtConfig(title) {
        return {
            columnDefs: [{
                targets: ['_all'],
                className: 'dt-head-center'
            }],
            layout: {
                top1Start: null,
                top1End: {
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="fas fa-copy me-1"></i> Salin',
                            title: title
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel me-1"></i> Excel',
                            title: title
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                            title: title
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print me-1"></i> Cetak',
                            title: title
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        };
    }

    $(document).ready(function() {
        // Init tables
        $('#myTable').DataTable(getDtConfig('Statistik Status Data Masuk'));

        $('#myTable2').DataTable(getDtConfig('Statistik Mengikut Lokasi'));

        $('#myTable3').DataTable(getDtConfig('Analisis Sumber Data Masuk'));

        const config5 = getDtConfig('Analisis Mengikut Negeri');
        config5.pageLength = 20;
        $('#myTable5').DataTable(config5);

        // Modal Logic
        $(document).on('click', '.open-modal', function() {
            var status_id = $(this).data('status_id');
            var start_date = $('input[name="start_date"]').val();
            var end_date = $('input[name="end_date"]').val();

            // Show Loading
            $('#statusDetailsContainer').html('<tr><td colspan="6" class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><br>Sedang memuatkan data...</td></tr>');
            $('#statusModal').modal('show');

            $.ajax({
                url: "{{ route('admin.summary.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status_id: status_id,
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(response) {
                    $('#statusDetail-status').text((response.status || 'N/A').toUpperCase());
                    $('#statusDetailsContainer').empty();

                    if (response.statusDetails && response.statusDetails.length > 0) {
                        response.statusDetails.forEach(function(statusDetail, index) {
                            var recordHtml = `
                                <tr>
                                    <td class="text-uppercase fw-bold"><span class="text-muted fw-normal me-2">${index + 1}.</span> ${statusDetail.student || 'N/A'}</td>
                                    <td class="font-monospace">${statusDetail.ic || 'N/A'}</td>
                                    <td>${statusDetail.created_at || 'N/A'}</td>
                                    <td class="text-uppercase">${statusDetail.affiliate || 'N/A'}</td>
                                    <td class="text-uppercase">${statusDetail.advisor || 'N/A'}</td>
                                    <td>${statusDetail.register_at || 'N/A'}</td>
                                </tr>
                            `;
                            $('#statusDetailsContainer').append(recordHtml);
                        });
                    } else {
                        $('#statusDetailsContainer').html('<tr><td colspan="6" class="text-center py-4 text-muted fst-italic">Tiada rekod ditemui untuk status ini.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#statusDetailsContainer').html('<tr><td colspan="6" class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Ralat semasa memuatkan data.</td></tr>');
                }
            });
        });
    });
</script>
@endsection