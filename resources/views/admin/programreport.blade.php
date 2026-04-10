@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">

<style>
    :root {
        --admin-primary: #1e293b;
        --admin-accent: #3b82f6;
        --admin-accent-hover: #2563eb;
        --admin-bg: #f8fafc;
        --admin-card-bg: #ffffff;
        --admin-border: #e2e8f0;
        --admin-text: #1e293b;
        --admin-text-muted: #64748b;
        --admin-gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    body { font-family: 'Inter', sans-serif; background: var(--admin-bg); color: var(--admin-text); }

    .admin-program-report-page { padding: 2rem 0; }

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
        top: -50%; right: -10%;
        width: 300px; height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .page-header h2 { font-weight: 700; font-size: 1.75rem; margin: 0; position: relative; z-index: 1; }
    .page-header p  { margin: 0; opacity: 0.8; font-size: 1rem; position: relative; z-index: 1; }

    /* Filter Card */
    .filter-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    .filter-card .form-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--admin-text-muted);
        margin-bottom: 0.5rem;
    }
    .filter-card .form-control {
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    .filter-card .form-control:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
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
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-filter:hover {
        background: var(--admin-accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59,130,246,0.2);
        color: white;
    }

    /* Stat cards */
    .stat-card {
        background: var(--admin-card-bg);
        border-radius: 14px;
        border: 1px solid var(--admin-border);
        padding: 1.1rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        animation: fadeInUp 0.4s ease-out;
    }
    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; flex-shrink: 0;
    }
    .stat-icon.blue   { background:#eff6ff; color:#3b82f6; }
    .stat-icon.green  { background:#f0fdf4; color:#10b981; }
    .stat-icon.purple { background:#faf5ff; color:#8b5cf6; }
    .stat-icon.orange { background:#fff7ed; color:#f97316; }

    .stat-label { font-size: 0.75rem; color: var(--admin-text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-value { font-size: 1.6rem; font-weight: 800; color: var(--admin-primary); line-height: 1; }

    /* Section card */
    .modern-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 2rem;
        animation: fadeInUp 0.5s ease-out;
    }
    .modern-card-header {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid var(--admin-border);
        background: #f8fafc;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modern-card-title { font-weight: 700; color: var(--admin-primary); font-size: 1.1rem; margin: 0; }
    .modern-card-body  { padding: 1.5rem; }

    /* Table */
    .modern-table { margin: 0; border-collapse: separate; border-spacing: 0; width: 100% !important; }
    .modern-table thead { background: var(--admin-primary); color: white; }
    .modern-table thead th {
        font-weight: 600; text-transform: uppercase;
        font-size: 0.75rem; letter-spacing: 0.5px;
        padding: 0.85rem 1rem;
        border: 1px solid rgba(255,255,255,0.08);
        vertical-align: middle;
    }
    .modern-table tbody tr { transition: background 0.15s; border-bottom: 1px solid var(--admin-border); }
    .modern-table tbody tr:hover { background: #f1f5f9; }
    .modern-table tbody td {
        padding: 0.72rem 1rem;
        vertical-align: middle;
        color: var(--admin-text);
        font-size: 0.875rem;
        border-bottom: 1px solid var(--admin-border);
    }
    .modern-table tbody tr:last-child td { border-bottom: none; }

    /* Progress bar */
    .progress-thin { height: 6px; border-radius: 99px; background: #e2e8f0; overflow: hidden; }
    .progress-bar-fill { height: 100%; border-radius: 99px; background: linear-gradient(90deg,#3b82f6,#6366f1); transition: width 1s ease; }

    /* DataTable buttons */
    .dataTables_wrapper .dt-buttons .btn {
        background: white; border: 1px solid var(--admin-border);
        border-radius: 8px; color: var(--admin-text-muted); font-weight: 600;
        margin-right: 0.5rem; transition: all 0.3s ease; padding: 0.5rem 1rem;
    }
    .dataTables_wrapper .dt-buttons .btn:hover { background: var(--admin-accent); color: white; border-color: var(--admin-accent); }

    /* Rank badge */
    .rank-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 28px; height: 28px; border-radius: 50%;
        font-weight: 700; font-size: 0.75rem;
    }
    .rank-1 { background:#fef3c7; color:#92400e; }
    .rank-2 { background:#f1f5f9; color:#475569; }
    .rank-3 { background:#fdf2f8; color:#9d174d; }
    .rank-other { background:#f8fafc; color:#94a3b8; }

    @keyframes fadeInUp { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
</style>

<div class="container-fluid admin-program-report-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2><i class="fas fa-chart-pie me-2"></i>Laporan Program</h2>
                    <p class="mb-0 opacity-75">Jumlah permohonan pelajar mengikut program dan lokasi</p>
                </div>
                <div style="position:relative;z-index:1;">
                    <span class="badge bg-white text-dark fw-bold px-3 py-2 rounded-pill" style="font-size:0.9rem;">
                        <i class="fas fa-calendar-day me-1 text-primary"></i>
                        {{ now()->format('d M Y') }}
                    </span>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-card">
                <form method="POST" action="{{ route('admin.programreport') }}" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Mula</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $start_date ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Tamat</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $end_date ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-filter w-100" type="submit">
                            <i class="fas fa-filter me-2"></i> Cari Data
                        </button>
                    </div>
                </form>
            </div>

            @php
                $grandTotal = collect($programStatsByLocation)->sum(fn($loc) => $loc['stats']->sum('total'));
            @endphp

            <!-- Date Range Caption -->
            <p class="text-muted small mb-3">
                <i class="fas fa-info-circle me-1"></i>
                Data dipaparkan dari tarikh <strong>{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}</strong>
                sehingga <strong>{{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</strong>
            </p>

            <!-- Overall Summary -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div class="stat-label">Jumlah Lokasi</div>
                            <div class="stat-value">{{ count($programStatsByLocation) }}</div>
                        </div>
                    </div>
                </div>
                @foreach ($programStatsByLocation as $data)
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon {{ $loop->first ? 'green' : 'orange' }}">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <div class="stat-label">{{ $data['location']->code }} — Jumlah Permohonan</div>
                            <div class="stat-value">{{ number_format($data['stats']->sum('total')) }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="fas fa-users"></i></div>
                        <div>
                            <div class="stat-label">Jumlah Keseluruhan</div>
                            <div class="stat-value">{{ number_format($grandTotal) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Per-Location Tables -->
            @foreach ($programStatsByLocation as $data)
            @php
                $locTotal = $data['stats']->sum('total');
                $locCode  = $data['location']->code;
                $tableId  = 'programTable' . $data['location']->id;
            @endphp

            <div class="modern-card">
                <div class="modern-card-header">
                    <h5 class="modern-card-title">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        Laporan Program — {{ $data['location']->name }} ({{ $locCode }})
                    </h5>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-pill">{{ $data['stats']->count() }} program</span>
                        <span class="badge bg-secondary rounded-pill">{{ number_format($locTotal) }} permohonan</span>
                    </div>
                </div>
                <div class="modern-card-body">
                    @if ($data['stats']->isEmpty())
                        <p class="text-muted text-center py-3">
                            <i class="fas fa-info-circle me-1"></i>Tiada data untuk lokasi ini dalam julat tarikh tersebut.
                        </p>
                    @else
                    <div class="table-responsive">
                        <table id="{{ $tableId }}" class="modern-table table table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:55px;">#</th>
                                    <th>Nama Program</th>
                                    <th class="text-center">Jumlah Permohonan</th>
                                    <th>Peratusan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['stats'] as $index => $item)
                                @php
                                    $pct = $locTotal > 0 ? round(($item->total / $locTotal) * 100, 1) : 0;
                                    $rankClass = $index === 0 ? 'rank-1' : ($index === 1 ? 'rank-2' : ($index === 2 ? 'rank-3' : 'rank-other'));
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        <span class="rank-badge {{ $rankClass }}">{{ $index + 1 }}</span>
                                    </td>
                                    <td class="fw-semibold text-uppercase">{{ $item->program_name }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill px-3 py-2" style="font-size:0.88rem;">
                                            {{ number_format($item->total) }}
                                        </span>
                                    </td>
                                    <td style="min-width:180px;">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress-thin flex-grow-1">
                                                <div class="progress-bar-fill" style="width:{{ $pct }}%"></div>
                                            </div>
                                            <span class="text-muted small fw-semibold" style="min-width:38px;">{{ $pct }}%</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-light fw-bold">
                                    <td colspan="2" class="text-end">JUMLAH KESELURUHAN ({{ $locCode }})</td>
                                    <td class="text-center">
                                        <span class="badge bg-dark rounded-pill px-3 py-2" style="font-size:0.88rem;">
                                            {{ number_format($locTotal) }}
                                        </span>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    @endif
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
    $(document).ready(function () {
        $('table[id^="programTable"]').each(function () {
            var locLabel = $(this).closest('.modern-card').find('.modern-card-title').text().trim();
            var title    = 'Laporan Program - ' + locLabel;

            $(this).DataTable({
                ordering : true,
                order    : [[2, 'desc']],
                paging   : false,
                info     : false,
                columnDefs: [
                    { targets: [0, 2], className: 'dt-body-center' },
                    { targets: [3], orderable: false }
                ],
                layout: {
                    top1Start: null,
                    top1End: {
                        buttons: [
                            { extend: 'copy',       text: '<i class="fas fa-copy me-1"></i> Salin',        title: title, exportOptions: { columns: [0,1,2] } },
                            { extend: 'excelHtml5', text: '<i class="fas fa-file-excel me-1"></i> Excel',   title: title, exportOptions: { columns: [0,1,2] } },
                            { extend: 'pdfHtml5',   text: '<i class="fas fa-file-pdf me-1"></i> PDF',       title: title, exportOptions: { columns: [0,1,2] } },
                            { extend: 'print',      text: '<i class="fas fa-print me-1"></i> Cetak',        title: title, exportOptions: { columns: [0,1,2] } }
                        ]
                    },
                    topStart: 'search',
                    topEnd: null,
                    bottomStart: null,
                    bottomEnd: null
                }
            });
        });
    });
</script>
@endsection
