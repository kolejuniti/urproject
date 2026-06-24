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
                    <h2>Perincian Pencapaian</h2>
                    <p>Affiliate: {{ $affiliate->name }}</p>
                </div>
            </div>

            <div class="modern-card">
                <div class="dashboard-card-header">
                    <h5 class="dashboard-card-title"><i class="fas fa-list"></i> Senarai Permohonan</h5>
                </div>
                <div class="modern-card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="modern-table table table-hover w-100">
                            <caption>N = data baru, R = data ulang</caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Tarikh Data Masuk</th>
                                    <th>Sumber</th>
                                    <th>Jenis Data</th>
                                    <th>Insentif</th>
                                    <th>Komisen</th>
                                </tr>
                            </thead>
                            @php
                                $displayTotalIncentive = 0;
                            @endphp
                            <tbody>
                                @foreach ($applications as $item)
                                @php
                                    $displayIncentive = strtoupper($item->remark ?? '') === 'R' ? 0 : ($item->incentive ?? 0);
                                    $displayTotalIncentive += (float) $displayIncentive;
                                @endphp
                                <tr>
                                    <td></td>
                                    <td class="text-uppercase fw-semibold">{{ $item->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                    <td class="text-uppercase">{{ $item->source }}</td>
                                    <td class="text-uppercase">{{ $item->remark }}</td>
                                    <td class="text-center">{{ number_format((float) $displayIncentive, 2) }}</td>
                                    <td class="text-center">{{ $item->commission ?? '0.00' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-soft-danger">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-center text-uppercase">Jumlah Keseluruhan</th>
                                    <th></th>
                                    <th class="text-center">{{ number_format($displayTotalIncentive, 2) }}</th>
                                    <th class="text-center">{{ $totalCommission ?? '0.00' }}</th>
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
        var t = $('#myTable').DataTable(getDtConfig('Pencapaian Affiliate {{ $affiliate->name }}'));
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
