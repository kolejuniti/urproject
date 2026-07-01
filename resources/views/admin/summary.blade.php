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

    .bg-soft-primary {
        background-color: #eff6ff !important;
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
                                            <th>DATA MASUK</th>
                                            <th>PRA DAFTAR</th>
                                            <th>DAFTAR KOLEJ</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($locationsWithPercentage as $index => $data2)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-uppercase fw-bold">{{ $data2->location }}</td>
                                            <td class="text-center fw-bold">{{ $data2->total }}</td>
                                            <td class="text-center">{{ $data2->total_pra_daftar }}</td>
                                            <td class="text-center">{{ $data2->total_daftar_kolej }}</td>
                                            <td class="text-center">{{ number_format($data2->percentage, 2) }}%</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-soft-danger">
                                        <tr>
                                            <td></td>
                                            <td class="text-end text-uppercase">Jumlah Keseluruhan</td>
                                            <td class="text-center">{{ $totalStudents }}</td>
                                            <td class="text-center">{{ $totalPraDaftar }}</td>
                                            <td class="text-center">{{ $totalDaftarKolej }}</td>
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
                                            <th colspan="4" class="text-center bg-soft-primary text-dark border-bottom">Pra Daftar</th>
                                            <th colspan="4" class="text-center bg-soft-success text-dark border-bottom">Daftar Kolej</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-soft-warning text-dark">KUPD</th>
                                            <th class="bg-soft-warning text-dark">KUKB</th>
                                            <th class="bg-soft-warning text-dark">Jumlah</th>
                                            <th class="bg-soft-warning text-dark">%</th>
                                            <th class="bg-soft-primary text-dark">KUPD</th>
                                            <th class="bg-soft-primary text-dark">KUKB</th>
                                            <th class="bg-soft-primary text-dark">Jumlah</th>
                                            <th class="bg-soft-primary text-dark">%</th>
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
                                            <td class="text-center bg-soft-primary text-dark">{{ $data3->total_kupd_pra_daftar }}</td>
                                            <td class="text-center bg-soft-primary text-dark">{{ $data3->total_kukb_pra_daftar }}</td>
                                            <td class="text-center bg-soft-primary text-dark fw-bold">{{ $data3->total_pra_daftar }}</td>
                                            <td class="text-center bg-soft-primary text-dark">{{ number_format($data3->pra_percentage, 2) }}%</td>
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
                                            <td class="text-center bg-soft-primary">{{ $totalSourceKupdPraDaftarSum }}</td>
                                            <td class="text-center bg-soft-primary">{{ $totalSourceKukbPraDaftarSum }}</td>
                                            <td class="text-center bg-soft-primary">{{ $totalSourcePraDaftarSum }}</td>
                                            <td class="bg-soft-primary"></td>
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
                                            <th colspan="4" class="text-center bg-soft-primary text-dark border-bottom">Pra Daftar</th>
                                            <th colspan="4" class="text-center bg-soft-success text-dark border-bottom">Daftar Kolej</th>
                                        </tr>
                                        <tr>
                                            <th class="bg-soft-warning text-dark">KUPD</th>
                                            <th class="bg-soft-warning text-dark">KUKB</th>
                                            <th class="bg-soft-warning text-dark">Jumlah</th>
                                            <th class="bg-soft-warning text-dark">%</th>
                                            <th class="bg-soft-primary text-dark">KUPD</th>
                                            <th class="bg-soft-primary text-dark">KUKB</th>
                                            <th class="bg-soft-primary text-dark">Jumlah</th>
                                            <th class="bg-soft-primary text-dark">%</th>
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
                                            <td class="text-uppercase fw-bold">{{ $data4->state ?? 'TIADA MAKLUMAT NEGERI' }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ $data4->total_kupd }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ $data4->total_kukb }}</td>
                                            <td class="text-center bg-soft-warning text-dark fw-bold">{{ $data4->total }}</td>
                                            <td class="text-center bg-soft-warning text-dark">{{ number_format($data4->percentage, 2) }}%</td>
                                            <td class="text-center bg-soft-primary text-dark">{{ $data4->total_kupd_pra_daftar }}</td>
                                            <td class="text-center bg-soft-primary text-dark">{{ $data4->total_kukb_pra_daftar }}</td>
                                            <td class="text-center bg-soft-primary text-dark fw-bold">{{ $data4->total_pra_daftar }}</td>
                                            <td class="text-center bg-soft-primary text-dark">{{ number_format($data4->pra_percentage, 2) }}%</td>
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
                                            <td class="text-center bg-soft-primary">{{ $totalStateKupdPraDaftarSum }}</td>
                                            <td class="text-center bg-soft-primary">{{ $totalStateKukbPraDaftarSum }}</td>
                                            <td class="text-center bg-soft-primary">{{ $totalStatePraDaftarSum }}</td>
                                            <td class="bg-soft-primary"></td>
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
                <div class="modern-card shadow-none border mb-3">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Lokasi</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody id="statusLocationTotals">
                                <!-- JS populated -->
                            </tbody>
                            <tfoot class="bg-soft-danger">
                                <tr>
                                    <td class="text-end text-uppercase">Jumlah Keseluruhan</td>
                                    <td class="text-center fw-bold" id="statusLocationTotalsSum">0</td>
                                    <td class="text-center" id="statusLocationTotalsPercent">0%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modern-card shadow-none border mb-3">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nota</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">%</th>
                                </tr>
                            </thead>
                            <tbody id="statusNotaTotals">
                                <!-- JS populated -->
                            </tbody>
                            <tfoot class="bg-soft-danger">
                                <tr>
                                    <td class="text-end text-uppercase">Jumlah Keseluruhan</td>
                                    <td class="text-center fw-bold" id="statusNotaTotalsSum">0</td>
                                    <td class="text-center" id="statusNotaTotalsPercent">0%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
                                    <th>Nota</th>
                                    <th>Tarikh Daftar</th>
                                </tr>
                            </thead>
                            <tbody id="statusDetailsContainer">
                                <!-- JS populated -->
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="alert alert-info mt-3 mb-0 small">
                    <i class="fas fa-info-circle me-2"></i> *Data pemohon yang dipaparkan adalah data yang berdaftar menggunakan link yang dikongsi oleh affiliate sahaja.
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="exportStatusExcel" disabled>
                    <i class="fas fa-file-excel me-1"></i> Excel
                </button>
                <button type="button" class="btn btn-danger" id="exportStatusPdf" disabled>
                    <i class="fas fa-file-pdf me-1"></i> PDF
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>

<script>
    var currentStatusModalExport = null;

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

    function statusModalValue(value, fallback) {
        if (fallback === undefined) {
            fallback = 'N/A';
        }

        return value === null || value === undefined || value === '' ? fallback : String(value);
    }

    function escapeHtml(value) {
        return statusModalValue(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function statusModalPercent(total, sum) {
        total = Number(total || 0);
        sum = Number(sum || 0);

        return sum > 0 ? ((total / sum) * 100).toFixed(2) + '%' : '0.00%';
    }

    function statusModalFileName(extension) {
        var status = statusModalValue(currentStatusModalExport && currentStatusModalExport.status, 'status')
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');

        return 'perincian-status-' + status + '.' + extension;
    }

    function buildStatusModalExportData() {
        var data = currentStatusModalExport || {};
        var locationTotalsSum = Number(data.locationTotalsSum || 0);
        var notaTotalsSum = Number(data.notaTotalsSum || 0);

        return {
            title: 'Perincian Status: ' + statusModalValue(data.status, 'N/A').toUpperCase(),
            locations: (data.locationTotals || []).map(function(item) {
                return [
                    statusModalValue(item.location, 'TIADA LOKASI').toUpperCase(),
                    statusModalValue(item.total, 0),
                    statusModalPercent(item.total, locationTotalsSum)
                ];
            }),
            notes: (data.notaTotals || []).map(function(item) {
                return [
                    statusModalValue(item.reason, 'TIADA NOTA').toUpperCase(),
                    statusModalValue(item.total, 0),
                    statusModalPercent(item.total, notaTotalsSum)
                ];
            }),
            details: (data.statusDetails || []).map(function(item, index) {
                return [
                    index + 1,
                    statusModalValue(item.student).toUpperCase(),
                    statusModalValue(item.ic),
                    statusModalValue(item.created_at),
                    statusModalValue(item.affiliate).toUpperCase(),
                    statusModalValue(item.advisor).toUpperCase(),
                    statusModalValue(item.reason).toUpperCase(),
                    statusModalValue(item.register_at)
                ];
            }),
            locationTotal: ['Jumlah Keseluruhan', locationTotalsSum, locationTotalsSum > 0 ? '100%' : '0%'],
            noteTotal: ['Jumlah Keseluruhan', notaTotalsSum, notaTotalsSum > 0 ? '100%' : '0%']
        };
    }

    function exportStatusModalPdf() {
        if (!currentStatusModalExport || !window.pdfMake) {
            return;
        }

        var exportData = buildStatusModalExportData();
        var emptyRow = ['Tiada rekod', '', ''];
        var emptyDetailRow = ['', 'Tiada rekod ditemui', '', '', '', '', '', ''];

        var docDefinition = {
            pageOrientation: 'landscape',
            pageMargins: [24, 32, 24, 32],
            content: [
                { text: exportData.title, style: 'title' },
                { text: 'Lokasi', style: 'sectionTitle' },
                {
                    table: {
                        headerRows: 1,
                        widths: ['*', 60, 60],
                        body: [
                            ['Lokasi', 'Jumlah', '%'],
                            ...(exportData.locations.length ? exportData.locations : [emptyRow]),
                            exportData.locationTotal
                        ]
                    },
                    layout: 'lightHorizontalLines'
                },
                { text: 'Nota', style: 'sectionTitle', margin: [0, 16, 0, 6] },
                {
                    table: {
                        headerRows: 1,
                        widths: ['*', 60, 60],
                        body: [
                            ['Nota', 'Jumlah', '%'],
                            ...(exportData.notes.length ? exportData.notes : [emptyRow]),
                            exportData.noteTotal
                        ]
                    },
                    layout: 'lightHorizontalLines'
                },
                { text: 'Senarai Pemohon', style: 'sectionTitle', margin: [0, 16, 0, 6] },
                {
                    table: {
                        headerRows: 1,
                        widths: [24, '*', 70, 70, '*', '*', '*', 70],
                        body: [
                            ['#', 'Nama Pemohon', 'No. KP', 'Tarikh Mohon', 'Affiliate', 'Education Advisor', 'Nota', 'Tarikh Daftar'],
                            ...(exportData.details.length ? exportData.details : [emptyDetailRow])
                        ]
                    },
                    layout: 'lightHorizontalLines'
                }
            ],
            styles: {
                title: { fontSize: 14, bold: true, margin: [0, 0, 0, 12] },
                sectionTitle: { fontSize: 11, bold: true, margin: [0, 8, 0, 6] }
            },
            defaultStyle: {
                fontSize: 8
            }
        };

        pdfMake.createPdf(docDefinition).download(statusModalFileName('pdf'));
    }

    function excelTableHtml(title, headers, rows, footer) {
        var bodyRows = rows.length ? rows : [headers.map(function(_, index) {
            return index === 0 ? 'Tiada rekod' : '';
        })];

        return '<h3>' + escapeHtml(title) + '</h3>' +
            '<table border="1">' +
            '<thead><tr>' + headers.map(function(header) {
                return '<th>' + escapeHtml(header) + '</th>';
            }).join('') + '</tr></thead>' +
            '<tbody>' + bodyRows.map(function(row) {
                return '<tr>' + row.map(function(cell) {
                    return '<td>' + escapeHtml(cell) + '</td>';
                }).join('') + '</tr>';
            }).join('') + '</tbody>' +
            (footer ? '<tfoot><tr>' + footer.map(function(cell) {
                return '<td><strong>' + escapeHtml(cell) + '</strong></td>';
            }).join('') + '</tr></tfoot>' : '') +
            '</table><br>';
    }

    function escapeExcelXml(value) {
        return statusModalValue(value, '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&apos;');
    }

    function excelColumnName(index) {
        var name = '';

        while (index >= 0) {
            name = String.fromCharCode((index % 26) + 65) + name;
            index = Math.floor(index / 26) - 1;
        }

        return name;
    }

    function buildXlsxSheet(rows) {
        var sheetRows = rows.map(function(row, rowIndex) {
            var cells = row.map(function(cell, cellIndex) {
                var cellRef = excelColumnName(cellIndex) + (rowIndex + 1);

                return '<c r="' + cellRef + '" t="inlineStr"><is><t>' + escapeExcelXml(cell) + '</t></is></c>';
            }).join('');

            return '<row r="' + (rowIndex + 1) + '">' + cells + '</row>';
        }).join('');

        return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
            '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">' +
            '<sheetData>' + sheetRows + '</sheetData>' +
            '</worksheet>';
    }

    function downloadStatusModalBlob(blob, fileName) {
        var link = document.createElement('a');

        link.href = URL.createObjectURL(blob);
        link.download = fileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(link.href);
    }

    function buildStatusModalExcelRows(exportData) {
        return [
            [exportData.title],
            [],
            ['Lokasi'],
            ['Lokasi', 'Jumlah', '%'],
            ...(exportData.locations.length ? exportData.locations : [['Tiada rekod', '', '']]),
            exportData.locationTotal,
            [],
            ['Nota'],
            ['Nota', 'Jumlah', '%'],
            ...(exportData.notes.length ? exportData.notes : [['Tiada rekod', '', '']]),
            exportData.noteTotal,
            [],
            ['Senarai Pemohon'],
            ['#', 'Nama Pemohon', 'No. KP', 'Tarikh Mohon', 'Affiliate', 'Education Advisor', 'Nota', 'Tarikh Daftar'],
            ...(exportData.details.length ? exportData.details : [['', 'Tiada rekod ditemui', '', '', '', '', '', '']])
        ];
    }

    function exportStatusModalExcel() {
        if (!currentStatusModalExport) {
            return;
        }

        var exportData = buildStatusModalExportData();
        var rows = buildStatusModalExcelRows(exportData);

        if (window.JSZip) {
            var zip = new JSZip();
            zip.file('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
                '<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">' +
                '<Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>' +
                '<Default Extension="xml" ContentType="application/xml"/>' +
                '<Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>' +
                '<Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>' +
                '</Types>');
            zip.folder('_rels').file('.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
                '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' +
                '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>' +
                '</Relationships>');
            zip.folder('xl').file('workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
                '<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">' +
                '<sheets><sheet name="Perincian Status" sheetId="1" r:id="rId1"/></sheets>' +
                '</workbook>');
            zip.folder('xl').folder('_rels').file('workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' +
                '<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">' +
                '<Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>' +
                '</Relationships>');
            zip.folder('xl').folder('worksheets').file('sheet1.xml', buildXlsxSheet(rows));

            zip.generateAsync({ type: 'blob' }).then(function(blob) {
                downloadStatusModalBlob(blob, statusModalFileName('xlsx'));
            });

            return;
        }

        var html = '<html><head><meta charset="UTF-8"></head><body>' +
            '<h2>' + escapeHtml(exportData.title) + '</h2>' +
            excelTableHtml('Lokasi', ['Lokasi', 'Jumlah', '%'], exportData.locations, exportData.locationTotal) +
            excelTableHtml('Nota', ['Nota', 'Jumlah', '%'], exportData.notes, exportData.noteTotal) +
            excelTableHtml('Senarai Pemohon', ['#', 'Nama Pemohon', 'No. KP', 'Tarikh Mohon', 'Affiliate', 'Education Advisor', 'Nota', 'Tarikh Daftar'], exportData.details, null) +
            '</body></html>';

        downloadStatusModalBlob(
            new Blob(['\ufeff', html], { type: 'application/vnd.ms-excel;charset=utf-8;' }),
            statusModalFileName('xls')
        );
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
            currentStatusModalExport = null;
            $('#exportStatusExcel, #exportStatusPdf').prop('disabled', true);
            $('#statusDetail-status').text('');

            // Show Loading
            $('#statusDetailsContainer').html('<tr><td colspan="7" class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><br>Sedang memuatkan data...</td></tr>');
            $('#statusLocationTotals').html('<tr><td colspan="3" class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><br>Sedang memuatkan data...</td></tr>');
            $('#statusNotaTotals').html('<tr><td colspan="3" class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><br>Sedang memuatkan data...</td></tr>');
            $('#statusLocationTotalsSum').text('0');
            $('#statusLocationTotalsPercent').text('0%');
            $('#statusNotaTotalsSum').text('0');
            $('#statusNotaTotalsPercent').text('0%');
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
                    currentStatusModalExport = response;
                    $('#exportStatusExcel, #exportStatusPdf').prop('disabled', false);
                    $('#statusDetail-status').text((response.status || 'N/A').toUpperCase());
                    $('#statusDetailsContainer').empty();
                    $('#statusLocationTotals').empty();
                    $('#statusNotaTotals').empty();
                    $('#statusLocationTotalsSum').text(response.locationTotalsSum || 0);
                    $('#statusLocationTotalsPercent').text((response.locationTotalsSum || 0) > 0 ? '100%' : '0%');
                    $('#statusNotaTotalsSum').text(response.notaTotalsSum || 0);
                    $('#statusNotaTotalsPercent').text((response.notaTotalsSum || 0) > 0 ? '100%' : '0%');

                    if (response.locationTotals && response.locationTotals.length > 0) {
                        response.locationTotals.forEach(function(item) {
                            var percentage = response.locationTotalsSum > 0 ? ((item.total / response.locationTotalsSum) * 100).toFixed(2) : '0.00';
                            var locationRow = `
                                <tr>
                                    <td class="text-uppercase fw-bold">${escapeHtml(item.location || 'TIADA LOKASI')}</td>
                                    <td class="text-center fw-bold">${escapeHtml(item.total || 0)}</td>
                                    <td class="text-center">${percentage}%</td>
                                </tr>
                            `;
                            $('#statusLocationTotals').append(locationRow);
                        });
                    } else {
                        $('#statusLocationTotals').html('<tr><td colspan="3" class="text-center py-4 text-muted fst-italic">Tiada maklumat lokasi untuk status ini.</td></tr>');
                    }

                    if (response.notaTotals && response.notaTotals.length > 0) {
                        response.notaTotals.forEach(function(item) {
                            var percentage = response.notaTotalsSum > 0 ? ((item.total / response.notaTotalsSum) * 100).toFixed(2) : '0.00';
                            var notaRow = `
                                <tr>
                                    <td class="text-uppercase fw-bold">${escapeHtml(item.reason || 'TIADA NOTA')}</td>
                                    <td class="text-center fw-bold">${escapeHtml(item.total || 0)}</td>
                                    <td class="text-center">${percentage}%</td>
                                </tr>
                            `;
                            $('#statusNotaTotals').append(notaRow);
                        });
                    } else {
                        $('#statusNotaTotals').html('<tr><td colspan="3" class="text-center py-4 text-muted fst-italic">Tiada maklumat nota untuk status ini.</td></tr>');
                    }

                    if (response.statusDetails && response.statusDetails.length > 0) {
                        response.statusDetails.forEach(function(statusDetail, index) {
                            var recordHtml = `
                                <tr>
                                    <td class="text-uppercase fw-bold"><span class="text-muted fw-normal me-2">${index + 1}.</span> ${escapeHtml(statusDetail.student || 'N/A')}</td>
                                    <td class="font-monospace">${escapeHtml(statusDetail.ic || 'N/A')}</td>
                                    <td>${escapeHtml(statusDetail.created_at || 'N/A')}</td>
                                    <td class="text-uppercase">${escapeHtml(statusDetail.affiliate || 'N/A')}</td>
                                    <td class="text-uppercase">${escapeHtml(statusDetail.advisor || 'N/A')}</td>
                                    <td class="text-uppercase">${escapeHtml(statusDetail.reason || 'N/A')}</td>
                                    <td>${escapeHtml(statusDetail.register_at || 'N/A')}</td>
                                </tr>
                            `;
                            $('#statusDetailsContainer').append(recordHtml);
                        });
                    } else {
                        $('#statusDetailsContainer').html('<tr><td colspan="7" class="text-center py-4 text-muted fst-italic">Tiada rekod ditemui untuk status ini.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#statusDetailsContainer').html('<tr><td colspan="7" class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Ralat semasa memuatkan data.</td></tr>');
                    $('#statusLocationTotals').html('<tr><td colspan="3" class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Ralat semasa memuatkan data.</td></tr>');
                    $('#statusNotaTotals').html('<tr><td colspan="3" class="text-center py-4 text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Ralat semasa memuatkan data.</td></tr>');
                    $('#statusLocationTotalsSum').text('0');
                    $('#statusLocationTotalsPercent').text('0%');
                    $('#statusNotaTotalsSum').text('0');
                    $('#statusNotaTotalsPercent').text('0%');
                    currentStatusModalExport = null;
                    $('#exportStatusExcel, #exportStatusPdf').prop('disabled', true);
                }
            });
        });

        $('#exportStatusExcel').on('click', exportStatusModalExcel);
        $('#exportStatusPdf').on('click', exportStatusModalPdf);
    });
</script>
@endsection
