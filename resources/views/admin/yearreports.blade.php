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

    .admin-year-page {
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
        animation: fadeInUp 0.5s ease-out;
    }

    .modern-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--admin-border);
        background: #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modern-card-title {
        font-weight: 700;
        color: var(--admin-primary);
        font-size: 1.1rem;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .modern-card-body {
        padding: 1.5rem;
    }

    /* Filter select */
    .year-select {
        min-width: 150px;
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: var(--admin-primary);
        cursor: pointer;
    }

    .year-select:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Table Styling */
    .modern-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100% !important;
    }

    /* DataTable customization */
    .dataTables_wrapper .top1Start h2 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        color: var(--admin-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        border: 1px solid rgba(255, 255, 255, 0.1);
        vertical-align: middle;
    }

    .modern-table tbody tr {
        border-bottom: 1px solid var(--admin-border);
    }

    .modern-table tbody td {
        padding: 0.6rem 0.75rem;
        vertical-align: middle;
        color: var(--admin-text);
        font-size: 0.85rem;
        border-bottom: 1px solid var(--admin-border);
    }

    .table-secondary th {
        background-color: #f1f5f9;
        color: var(--admin-primary);
        border: 1px solid var(--admin-border);
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

<div class="container-fluid admin-year-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2><i class="fas fa-calendar-alt me-2"></i>Laporan Tahunan</h2>
                    <p class="mb-0 opacity-75">Statistik kemasukan data mengikut tahun dan bulan</p>
                </div>
                <div>
                    <form method="GET" action="{{ route('admin.yearreports') }}">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-filter text-muted"></i></span>
                            <select name="year" class="form-select year-select border-start-0 ps-0" onchange="this.form.submit()">
                                @for ($year = now()->year; $year >= now()->year - 3; $year--)
                                <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>Tahun {{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </form>
                </div>
            </div>

            @php
            $monthNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Mac', 4 => 'April',
            5 => 'Mei', 6 => 'Jun', 7 => 'Julai', 8 => 'Ogos',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Disember',
            ];
            @endphp

            @foreach ($locations as $location)
            <!-- Location Card -->
            <div class="modern-card">
                <div class="modern-card-header">
                    <h5 class="modern-card-title">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        Laporan Lokasi: {{ $location->name }} ({{ $currentYear }})
                    </h5>
                    <span class="badge bg-primary rounded-pill">{{ $currentYear }}</span>
                </div>
                <div class="modern-card-body">

                    <!-- Monthly Summary Table -->
                    <h6 class="fw-bold text-muted mb-3"><i class="fas fa-chart-bar me-2"></i>Ringkasan Bulanan</h6>
                    <div class="table-responsive mb-5">
                        <table id="myTable{{ $location->id }}" class="modern-table table table-hover text-center w-100">
                            <thead>
                                <tr style="display:none;">
                                    <th colspan="13">{{ $location->name }}</th>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    @for ($month = 1; $month <= 12; $month++)
                                        <th>{{ substr($monthNames[$month], 0, 3) }}</th>
                                        @endfor
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-center">{{ $currentYear }}</td>
                                    @for ($month = 1; $month <= 12; $month++)
                                        @php
                                        $val=$yearlyData[$currentYear][$month]['total'][$location->id] ?? 0;
                                        @endphp
                                        <td class="{{ $val > 0 ? 'fw-bold text-primary' : 'text-muted' }} text-center">
                                            {{ $val }}
                                        </td>
                                        @endfor
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-5">

                    <!-- Weekly Breakdown Table -->
                    <h6 class="fw-bold text-muted mb-3"><i class="fas fa-list-ol me-2"></i>Perincian Mingguan</h6>
                    <div class="table-responsive">
                        <table class="modern-table table table-hover align-middle border">
                            <thead class="bg-light">
                                <tr>
                                    <th class="col-2 text-start ps-3">Bulan</th>
                                    <th class="col-2 text-start">Minggu</th>
                                    <th class="col-2 text-center">Jumlah Data</th>
                                    <th class="col-2 text-center">Data Affiliate</th>
                                    <th class="col-2 text-center">Data EA</th>
                                    <th class="col-2 text-center">Tanpa Affiliate/EA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($month = 1; $month <= 12; $month++)
                                    @php
                                    $weeks=$weeklyMonthlyData[$month] ?? [];
                                    $rowspan=count($weeks);
                                    $printed=false;
                                    @endphp
                                    @foreach ($weeks as $weekInMonth=> $data)
                                    <tr>
                                        @if (!$printed)
                                        <td rowspan="{{ $rowspan }}" class="align-middle fw-bold ps-3 bg-light border-end">{{ $monthNames[$month] }}</td>
                                        @php $printed = true; @endphp
                                        @endif
                                        <td class="text-start">Minggu {{ $weekInMonth }}</td>
                                        <td class="text-center fw-bold">{{ $data['total'][$location->id] ?? 0 }}</td>
                                        <td class="text-center text-success">{{ $data['total_with_referral'][$location->id] ?? 0 }}</td>
                                        <td class="text-center text-info">{{ $data['total_with_ea'][$location->id] ?? 0 }}</td>
                                        <td class="text-center text-muted">{{ $data['total_without_affiliate'][$location->id] ?? 0 }}</td>
                                    </tr>
                                    @endforeach
                                    @endfor
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        // Iterate through all location IDs found in PHP (or generic selector)
        // Since we know the IDs are likely 1 and 2, but let's be dynamic if possible.
        // Actually, the simplest way to keep it working without complex JS logic finding IDs
        // is to just target the IDs we know exist or use a "begins with" selector if we wrap in a loop.

        // Let's use a class-based approach if I had control over HTML generation completely, 
        // but sticking to the ID pattern:

        const locIds = [1, 2]; // Assuming IDs 1 and 2 based on KUPD/KUKB usually. 
        // Better: iterate existing elements

        $('table[id^="myTable"]').each(function() {
            var locationName = $(this).find('thead tr:first th').text().trim();
            var title = 'Laporan Tahunan - ' + locationName;

            $(this).DataTable({
                ordering: false,
                paging: false, // Monthly data is small, no need for paging
                searching: false,
                info: false,
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
                                title: title,
                                orientation: 'landscape'
                            },
                            {
                                extend: 'print',
                                text: '<i class="fas fa-print me-1"></i> Cetak',
                                title: title
                            }
                        ]
                    },
                    topStart: null,
                    topEnd: null,
                    bottomStart: null,
                    bottomEnd: null
                }
            });
        });
    });
</script>
@endsection