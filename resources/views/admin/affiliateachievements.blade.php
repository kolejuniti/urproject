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

    .admin-affiliate-page {
        padding: 2rem 0;
    }

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
        gap: 1.5rem;
        flex-wrap: wrap;
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
        margin: 0.35rem 0 0;
        opacity: 0.85;
        font-size: 0.95rem;
        position: relative;
        z-index: 1;
    }

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

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
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

    .modern-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        margin-bottom: 2rem;
        animation: fadeInUp 0.5s ease-out;
    }

    .dashboard-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--admin-border);
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
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
    }

    .modern-table thead th:first-child {
        border-top-left-radius: 8px;
    }

    .modern-table thead th:last-child {
        border-top-right-radius: 8px;
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

    .modern-table tfoot td,
    .modern-table tfoot th {
        padding: 0.75rem;
        border-top: 2px solid var(--admin-border);
    }

    .modern-table caption {
        caption-side: top;
        padding-bottom: 0.75rem;
        color: var(--admin-text-muted);
        font-size: 0.85rem;
    }

    .bg-soft-danger {
        background-color: #fef2f2 !important;
    }

    .action-link {
        color: var(--admin-accent);
        text-decoration: none;
        font-weight: 600;
    }

    .action-link:hover {
        color: var(--admin-accent-hover);
        text-decoration: underline;
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

<div class="container-fluid admin-affiliate-page">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="page-header">
                <div>
                    <h2>Pencapaian Affiliate</h2>
                    @if ($start_date === null)
                        <p>Sila pilih tarikh dan lokasi untuk menjana laporan.</p>
                    @else
                        <p>Laporan bagi {{ $location_name }} dari {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '' }} hingga {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '' }}</p>
                    @endif
                </div>
            </div>

            <div class="filter-card">
                <form method="POST" action="{{ route('admin.affiliateachievements') }}" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Mula</label>
                        <input type="date" class="form-control" name="start_date" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Tamat</label>
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Lokasi</label>
                        <select name="location" id="location" class="form-select" required>
                            <option value="">Pilihan Lokasi</option>
                            @foreach ($locations as $item)
                                <option value="{{ $item->id }}">{{ $item->code }}</option>
                            @endforeach
                            <option value="3">KUPD & KUKB</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-filter" type="submit">
                            <i class="fas fa-search me-2"></i> Jana Laporan
                        </button>
                    </div>
                </form>
            </div>

            <div class="modern-card">
                <div class="dashboard-card-header">
                    <h5 class="dashboard-card-title"><i class="fas fa-chart-line"></i> Ringkasan Pencapaian</h5>
                </div>
                <div class="modern-card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="modern-table table table-hover w-100">
                            @if ($start_date === null)
                            @else
                                <caption>Laporan yang dijana adalah bagi {{ $location_name }} bertarikh {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '' }} sehingga {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '' }}</caption>
                            @endif
                            <thead>
                                <tr>
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">Nama Affiliate</th>
                                    <th rowspan="2">Profesion</th>
                                    <th rowspan="2">Data Masuk</th>
                                    <th colspan="4" class="text-center">Pecahan Data Masuk</th>
                                </tr>
                                <tr>
                                    <th>Data Proses</th>
                                    <th>Pra Pendaftaran</th>
                                    <th>Daftar Kolej</th>
                                    <th>Data Ditolak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($affiliates as $item)
                                <tr>
                                    <td></td>
                                    <td class="text-uppercase">
                                        <a href="{{ route('admin.affiliate.achievement.details', ['id' => $item->id, 'start_date' => $start_date, 'end_date' => $end_date, 'location' => $location]) }}" class="action-link" target="_blank">
                                            {{ $item->name }}
                                        </a>
                                    </td>
                                    <td class="text-uppercase text-center fw-bold">{{ $item->profession }}</td>
                                    <td class="text-center fw-bold">{{ $item->total_students ?? 0 }}</td>
                                    <td class="text-center">{{ $item->total_students_process ?? 0 }}</td>
                                    <td class="text-center">{{ $item->total_students_pre ?? 0 }}</td>
                                    <td class="text-center">{{ $item->total_students_register ?? 0 }}</td>
                                    <td class="text-center text-danger fw-semibold">{{ $item->total_students_reject ?? 0 }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-soft-danger">
                                <tr>
                                    <th></th>
                                    <th class="text-uppercase text-center" colspan="2">Jumlah Keseluruhan</th>
                                    <th class="text-center">{{ $totalStudents }}</th>
                                    <th class="text-center">{{ $totalStudentProcess }}</th>
                                    <th class="text-center">{{ $totalStudentPre }}</th>
                                    <th class="text-center">{{ $totalStudentRegister }}</th>
                                    <th class="text-center">{{ $totalStudentReject }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>
<script>
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
                            title: title,
                            exportOptions: { columns: ':visible' }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel me-1"></i> Excel',
                            title: title,
                            exportOptions: { columns: ':visible' }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                            title: title,
                            exportOptions: { columns: ':visible' }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print me-1"></i> Cetak',
                            title: title,
                            exportOptions: { columns: ':visible' }
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
        var t = $('#myTable').DataTable(getDtConfig('Pencapaian Affiliate {{ $location_name ?? '' }}'));
        t.on('order.dt search.dt', function () {
            let i = 1;
        
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
@endsection
