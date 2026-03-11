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

    .admin-program-page {
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

    .page-header .btn-add {
        background: white;
        color: var(--admin-primary);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
    }

    .page-header .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .page-header .btn-add i {
        margin-right: 0.5rem;
    }

    /* Alert Styling */
    .alert-modern {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        animation: slideInDown 0.4s ease-out;
    }

    .alert-modern i {
        font-size: 1.25rem;
        margin-right: 1rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid var(--admin-success);
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid var(--admin-danger);
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Modern Card */
    .modern-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        overflow: hidden;
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
    .dataTables_wrapper {
        padding: 1.5rem;
    }

    .dataTables_wrapper .top1Start h2 {
        color: var(--admin-primary);
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .dataTables_wrapper .top1Start h2::before {
        content: '\f0ce';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        margin-right: 0.75rem;
        color: var(--admin-accent);
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .dataTables_wrapper .dataTables_length select:focus,
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .dataTables_wrapper .dataTables_info {
        color: var(--admin-text-muted);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        margin: 0 0.25rem;
        border: 1px solid var(--admin-border);
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--admin-accent);
        color: white !important;
        border-color: var(--admin-accent);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--admin-accent) !important;
        color: white !important;
        border-color: var(--admin-accent) !important;
    }

    /* Table Styling */
    .modern-table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
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
    }

    .modern-table thead th:last-child {
        border-top-right-radius: 12px;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid var(--admin-border);
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
        transform: scale(1.01);
    }

    .modern-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: var(--admin-text);
        font-size: 0.9rem;
    }

    /* Custom Checkbox Toggle */
    .custom-switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .custom-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cbd5e1;
        transition: 0.4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }

    input:checked+.slider {
        background-color: var(--admin-success);
    }

    input:checked+.slider:before {
        transform: translateX(24px);
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 16px;
        border: none;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
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

    .modal-header .btn-close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid var(--admin-border);
        padding: 1rem 1.5rem;
    }

    .modal-footer .btn {
        border-radius: 8px;
        padding: 0.5rem 1.25rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .modal-footer .btn-primary {
        background: var(--admin-accent);
        border: none;
    }

    .modal-footer .btn-primary:hover {
        background: var(--admin-accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }

    .modal-footer .btn-secondary {
        background: var(--admin-secondary);
        border: none;
    }

    .modal-footer .btn-secondary:hover {
        background: var(--admin-primary);
    }

    /* Form Styling */
    .form-floating>.form-control,
    .form-floating>.form-select {
        border-radius: 10px;
        border: 1px solid var(--admin-border);
        transition: all 0.3s ease;
    }

    .form-floating>.form-control:focus,
    .form-floating>.form-select:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-floating>label {
        color: var(--admin-text-muted);
    }

    /* Badge for row numbers */
    .badge-number {
        background: var(--admin-accent);
        color: white;
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .status-badge.active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-badge.inactive {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="container-fluid admin-program-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <h2><i class="fas fa-graduation-cap me-2"></i>Pengurusan Program</h2>
                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus-circle"></i>Tambah Program
                </button>
            </div>

            <!-- Alert Messages -->
            @if(session('msg_error'))
            <div class="alert alert-danger alert-modern">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('msg_error') }}</div>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-modern">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            <!-- Add Program Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="cancelModalLabel">
                                <i class="fas fa-plus-circle me-2"></i>Maklumat Program
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('admin.program.submit') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="col-md-12 col-sm-12 mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="program" id="program" class="form-control" placeholder="" required autofocus>
                                        <label for="program"><i class="fas fa-book me-2"></i>Nama Program</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-floating">
                                        <select name="location" id="location" class="form-control" required>
                                            <option value="">Pilihan Lokasi</option>
                                            @foreach ($locations as $location)
                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="location"><i class="fas fa-map-marker-alt me-2"></i>Lokasi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Tutup
                                </button>
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Programs Table -->
            <div class="modern-card">
                <div class="table-responsive">
                    <table id="myTable" class="modern-table table table-hover text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Program</th>
                                <th>Lokasi</th>
                                <th>Ditawarkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programs as $item)
                            <tr>
                                <td></td>
                                <td class="text-start fw-semibold">{{ $item->program }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-map-marker-alt me-1"></i>{{ $item->location }}
                                    </span>
                                </td>
                                <form method="POST" action="{{ route('admin.program.update', $item->id) }}" id="form-{{ $item->id }}">
                                    @csrf
                                    <td>
                                        <input type="hidden" name="offered" value="0">
                                        <label class="custom-switch">
                                            <input type="checkbox" name="offered" value="1" {{ $item->offered === 1 ? 'checked' : '' }}
                                                onchange="document.getElementById('form-{{ $item->id }}').submit();">
                                            <span class="slider"></span>
                                        </label>
                                    </td>
                                </form>
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
                        html: '<h2>Senarai Program</h2>'
                    }
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