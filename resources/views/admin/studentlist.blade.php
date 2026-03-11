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

    .admin-student-page {
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

    /* Filter Card */
    .filter-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .filter-card .form-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--admin-text-muted);
        margin-bottom: 0.5rem;
    }

    .filter-card .form-control,
    .filter-card .form-select {
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .filter-card .btn-filter {
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

    .filter-card .btn-filter:hover {
        background: var(--admin-accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
    }

    /* Modern Card */
    .modern-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
        padding: 1.5rem;
        animation: fadeInUp 0.5s ease-out;
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

    /* DataTable Customization */
    .dataTables_wrapper .top1Start h2 {
        color: var(--admin-primary);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    .dataTables_wrapper .top1Start h2::before {
        content: '\f15c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        margin-right: 0.75rem;
        color: var(--admin-accent);
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

    .dataTables_caption {
        caption-side: top;
        color: var(--admin-text-muted);
        font-style: italic;
        margin-bottom: 0.5rem;
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
        padding: 1rem;
        border: none;
        vertical-align: middle;
    }

    .modern-table thead th:first-child {
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .modern-table thead th:last-child {
        border-top-right-radius: 12px;
        border-bottom-right-radius: 12px;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid var(--admin-border);
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.005);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .modern-table tbody td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
        color: var(--admin-text);
        font-size: 0.875rem;
        border-bottom: 1px solid var(--admin-border);
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge-modern {
        padding: 0.35rem 0.6rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.7rem;
    }

    .badge-affiliate {
        background: #e0e7ff;
        color: #4338ca;
    }

    .badge-advisor {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-location {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }

    /* Form Check Switch */
    .form-check-input:checked {
        background-color: var(--admin-accent);
        border-color: var(--admin-accent);
    }
</style>

<div class="container-fluid admin-student-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2><i class="fas fa-user-graduate me-2"></i>Senarai Data Masuk</h2>
                </div>
            </div>

            @if(isset($success))
            <div class="alert alert-success alert-modern fade show">
                <i class="fas fa-check-circle me-2"></i> {{ $success }}
            </div>
            @endif

            <!-- Filter Section -->
            <div class="filter-card">
                <form method="POST" action="{{ route('admin.studentlist') }}" class="row g-3 align-items-end">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Mula</label>
                        <input type="date" class="form-control" name="start_date" value="{{ $start_date ?? '' }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="far fa-calendar-alt me-1"></i> Tarikh Tamat</label>
                        <input type="date" class="form-control" name="end_date" value="{{ $end_date ?? '' }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Lokasi</label>
                        <select name="location" id="location" class="form-select">
                            <option value="">Pilihan Lokasi</option>
                            @foreach ($locations as $item)
                            <option value="{{ $item->id }}">{{ $item->code }}</option>
                            @endforeach
                            <option value="3">KUPD & KUKB</option>
                        </select>
                    </div>

                    <div class="col-md-3 d-flex align-items-center">
                        <div class="form-check form-switch me-3 mb-0">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="show_affiliate_only" value="1" {{ request('show_affiliate_only') ? 'checked' : '' }}>
                            <label class="form-check-label small fw-bold text-muted" for="flexSwitchCheckDefault">Affiliate Sahaja</label>
                        </div>
                        <button class="btn btn-filter flex-grow-1" type="submit">
                            <i class="fas fa-filter me-2"></i> Cari Data
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="modern-card">
                <div class="table-responsive">
                    <table id="myTable" class="modern-table table table-hover">
                        <caption class="dataTables_caption pb-2">
                            <i class="fas fa-info-circle me-1"></i>
                            Senarai yang dipaparkan adalah dari tarikh <strong>{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}</strong> sehingga <strong>{{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</strong>
                        </caption>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No. Kad Pengenalan</th>
                                <th>No. Telefon</th>
                                <th>Email</th>
                                <th>Tarikh Data</th>
                                <th>Lokasi</th>
                                <th>Bandar/Daerah</th>
                                <th>Affiliate</th>
                                <th>Education Advisor</th>
                                <th>Status</th>
                                <th>Tarikh Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-uppercase fw-bold text-primary">{{ $student->name }}</td>
                                <td class="text-center font-monospace">{{ $student->ic }}</td>
                                <td class="text-center">{{ $student->phone }}</td>
                                <td class="small text-muted">{{ strtolower($student->email) }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($student->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge badge-modern badge-location">{{ $student->location }}</span>
                                </td>
                                <td class="text-uppercase">{{ $student->city }}</td>
                                <td class="text-uppercase">
                                    @if (!empty($student->referral_code) && $student->referral_code !== 'null' && isset($affiliates[$student->id]))
                                    @foreach ($affiliates[$student->id] as $affiliate)
                                    <span class="badge badge-modern badge-affiliate">
                                        <i class="fas fa-handshake me-1"></i> {{ $affiliate->name }}
                                    </span>
                                    @endforeach
                                    @else
                                    <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td class="text-uppercase">
                                    @foreach ($advisors[$student->id] as $advisor)
                                    <span class="badge badge-modern badge-advisor">
                                        <i class="fas fa-user-tie me-1"></i> {{ $advisor->name }}
                                    </span>
                                    @endforeach
                                </td>
                                <td class="text-uppercase">
                                    @if($student->status == 'Berminat')
                                    <span class="badge bg-success badge-modern">BERMINAT</span>
                                    @elseif($student->status == 'KIV')
                                    <span class="badge bg-warning text-dark badge-modern">KIV</span>
                                    @else
                                    <span class="badge bg-secondary badge-modern">{{ $student->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($student->register_at)
                                    {{ \Carbon\Carbon::parse($student->register_at)->format('d/m/Y') }}
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
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
            columnDefs: [{
                targets: ['_all'],
                className: 'dt-head-center'
            }],
            layout: {
                top1Start: {
                    div: {
                        html: '<h2><i class="fas fa-table me-2"></i>Senarai Data Pelajar</h2>'
                    }
                },
                top1End: {
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="fas fa-copy me-1"></i> Salin',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel me-1"></i> Excel',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print me-1"></i> Cetak',
                            title: 'Senarai Data Masuk'
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        });
        t.on('order.dt search.dt', function() {
            let i = 1;

            t.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
@endsection