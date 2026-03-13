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

    .admin-user-page {
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
        content: '\f0c0';
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
        padding-top: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        margin: 0 0.25rem;
        border: 1px solid var(--admin-border);
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--admin-accent) !important;
        color: white !important;
        border-color: var(--admin-accent) !important;
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

    /* Buttons in Table */
    .btn-user-link {
        font-weight: 600;
        color: var(--admin-accent);
        text-decoration: none;
        border: none;
        background: transparent;
        padding: 0;
        transition: all 0.2s;
        text-align: left;
    }

    .btn-user-link:hover {
        color: var(--admin-accent-hover);
        text-decoration: underline;
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

    .section-title {
        color: var(--admin-primary);
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--admin-border);
        display: flex;
        align-items: center;
    }

    .section-title i {
        margin-right: 0.5rem;
        color: var(--admin-accent);
    }

    .info-label {
        font-weight: 600;
        color: var(--admin-text-muted);
        font-size: 0.8rem;
        margin-bottom: 0.25rem;
    }

    .info-value {
        color: var(--admin-text);
        font-weight: 500;
        font-size: 0.95rem;
    }

    .modal-footer {
        border-top: 1px solid var(--admin-border);
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-radius: 0 0 16px 16px;
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
        background: white;
        color: var(--admin-text);
        border: 1px solid var(--admin-border);
    }

    .modal-footer .btn-secondary:hover {
        background: #f1f5f9;
    }

    /* Form inputs in modal */
    .modal-body .form-control,
    .modal-body .form-select {
        border-radius: 8px;
        border-color: var(--admin-border);
        padding: 0.5rem 0.75rem;
    }

    .modal-body .form-control:focus,
    .modal-body .form-select:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Status Badge */
    .status-badge {
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-block;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

<div class="container-fluid admin-user-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2><i class="fas fa-users-cog me-2"></i>Pengurusan Pengguna</h2>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-modern">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            <div class="modern-card">
                <div class="table-responsive">
                    <table id="myTable" class="modern-table table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengguna</th>
                                <!-- <th>No. Kad Pengenalan</th> -->
                                <th>No. Telefon</th>
                                <th>Email</th>
                                <th>Jawatan</th>
                                <th>Bank</th>
                                <th>No. Akaun</th>
                                <th>Pekerjaan</th>
                                <th>Status</th>
                                <th>Tarikh Daftar</th>
                                <th>Log Masuk Terakhir</th>
                                <th>Rujukan Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <button type="button" class="btn-user-link text-uppercase open-modal" data-ic="{{ $user->ic }}">
                                        <i class="fas fa-user-circle me-1"></i> {{ $user->name }}
                                    </button>
                                </td>
                                <!-- <td class="text-center font-monospace">{{ $user->ic }}</td> -->
                                <td class="text-center">{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge bg-secondary">{{ $user->position }}</span></td>
                                <td>{{ $user->bank }}</td>
                                <td class="font-monospace">{{ $user->bank_account }}</td>
                                <td class="text-center text-uppercase">{{ $user->profession }}</td>
                                <td>
                                    @if($user->status == 'AKTIF')
                                    <span class="status-badge status-active">AKTIF</span>
                                    @else
                                    <span class="status-badge status-inactive">{{ $user->status }}</span>
                                    @endif
                                </td>
                                <td class="text-center text-muted small"><i class="far fa-calendar-alt me-1"></i> {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                <td class="text-center small">
                                    @if($user->last_login_at)
                                    <span class="d-flex align-items-center justify-content-center gap-1" style="white-space:nowrap;">
                                        <i class="fas fa-clock text-success"></i>
                                        <span>{{ \Carbon\Carbon::parse($user->last_login_at)->format('d-m-Y') }}</span>
                                        <span class="badge" style="background:#e0f2fe;color:#0369a1;font-weight:600;">{{ \Carbon\Carbon::parse($user->last_login_at)->format('h:i A') }}</span>
                                    </span>
                                    @else
                                    <span class="badge" style="background:#f1f5f9;color:#94a3b8;font-weight:600;">Belum Log Masuk</span>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($leaders[$user->leader_id]))
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-tie me-1 text-primary"></i>
                                        {{ $leaders[$user->leader_id]->name }}
                                    </div>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- User Modal -->
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="userModalLabel">
                                <i class="fas fa-user-edit me-2"></i>Kemaskini Maklumat Pengguna
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="user-form" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">

                                <div class="section-title">
                                    <i class="fas fa-id-card"></i> Maklumat Peribadi
                                </div>

                                <!-- Name & IC -->
                                <div id="name-container" class="mb-3">
                                    <!--Name will display here-->
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="info-label">No. Kad Pengenalan</div>
                                        <div class="info-value p-2 bg-light rounded border" id="user-ic"></div>
                                    </div>
                                </div>

                                <!-- Demographics -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="info-label">Agama</div>
                                        <div class="info-value" id="user-religion"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Bangsa</div>
                                        <div class="info-value" id="user-nation"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-label">Jantina</div>
                                        <div class="info-value" id="user-sex"></div>
                                    </div>
                                </div>

                                <div class="section-title mt-4">
                                    <i class="fas fa-address-book"></i> Maklumat Hubungan
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div id="phone-container">
                                            <!--Phone will display here-->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-label">Emel</div>
                                        <div class="info-value p-2 bg-light rounded border" id="user-email"></div>
                                    </div>
                                </div>

                                <div class="section-title mt-4">
                                    <i class="fas fa-university"></i> Maklumat Perbankan
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div id="bank_account-container">
                                            <!--Bank account will display here-->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="bank-container">
                                            <!--Bank will display here-->
                                        </div>
                                    </div>
                                </div>

                                <div class="section-title mt-4">
                                    <i class="fas fa-briefcase"></i> Maklumat Jawatan & Status
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div id="position-container">
                                            <!--Position account will display here-->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="status-container">
                                            <!--Status will display here-->
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3 p-3 bg-light rounded border mx-1">
                                    <div class="col-md-6">
                                        <div id="accept_data-container">
                                            <!--Accept Data checkbox will display here-->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="affiliate_data-container">
                                            <!--Affiliate Data checkbox will display here-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Tutup
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                            </div>
                        </form>
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
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
            columnDefs: [{
                targets: ['_all'],
                className: 'dt-head-center'
            }],
            layout: {
                top1Start: {
                    div: {
                        html: '<h2>Senarai Pengguna Sistem</h2>'
                    }
                },
                top1End: {
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="fas fa-copy me-1"></i> Salin',
                            title: 'Senarai Pengguna'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel me-1"></i> Excel',
                            title: 'Senarai Pengguna',
                            exportOptions: {
                                columns: ':visible'
                            },
                            customize: function(xlsx) {
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('row c[r^="H"]', sheet).attr('t', 'inlineStr');
                                $('row c[r^="H"]', sheet).each(function() {
                                    var cell = $(this);
                                    var text = cell.text();
                                    cell.empty().append('<is><t>' + text + '</t></is>');
                                });
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                            title: 'Senarai Pengguna'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fas fa-print me-1"></i> Cetak',
                            title: 'Senarai Pengguna'
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

        // Event delegation for dynamically added elements
        $(document).on('click', '.open-modal', function() {
            var ic = $(this).data('ic');

            $.ajax({
                url: "{{ route('admin.userlist.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ic: ic
                },
                success: function(response) {
                    if (response.users) {
                        $('#user-form').attr('action', "{{ url('admin/kemaskini/pengguna') }}/" + response.users.id);

                        if (response.users.name) {
                            $('#name-container').html(`
                                <div class="form-group">
                                    <label for="user-name" class="info-label">Nama Penuh</label>
                                    <input type="text" name="name" id="user-name" class="form-control" value="${response.users.name}" required>    
                                </div>
                            `);
                        } else {
                            $('#name-container').html(`
                                <div class="form-group">
                                    <label for="user-name" class="info-label">Nama Penuh</label>
                                    <input type="text" name="name" id="user-name" class="form-control" required>    
                                </div>
                            `);
                        }

                        $('#user-ic').text(response.users.ic);
                        $('#user-religion').text(response.users.religion);
                        $('#user-nation').text(response.users.nation);
                        $('#user-sex').text(response.users.sex);
                        $('#user-email').text(response.users.email);

                        // Handle phone
                        if (response.users.phone) {
                            $('#phone-container').html(`
                                <div class="form-group">
                                    <label for="user-phone" class="info-label">No. Telefon</label>
                                    <input type="text" name="phone" id="user-phone" class="form-control" value="${response.users.phone}" required>    
                                </div>
                            `);
                        } else {
                            $('#phone-container').html(`
                                <div class="form-group">
                                    <label for="user-phone" class="info-label">No. Telefon</label>
                                    <input type="text" name="phone" id="user-phone" class="form-control" required>    
                                </div>
                            `);
                        }

                        // Handle bank account
                        if (response.users.bank_account) {
                            $('#bank_account-container').html(`
                                <div class="form-group">
                                    <label for="user-bank_account" class="info-label">No. Akaun Bank</label>
                                    <input type="text" name="bank_account" id="user-bank_account" class="form-control" value="${response.users.bank_account}" required>    
                                </div>
                            `);
                        } else {
                            $('#bank_account-container').html(`
                                <div class="form-group">
                                    <label for="user-bank_account" class="info-label">No. Akaun Bank</label>
                                    <input type="text" name="bank_account" id="user-bank_account" class="form-control" required>    
                                </div>
                            `);
                        }

                        // Handle bank option
                        let bankOptions = response.banks.map((bank) => `<option value="${bank.id}">${bank.name}</option>`).join('');
                        if (response.users.bank_id) {
                            $('#bank-container').html(`
                                <div class="form-group">
                                    <label for="user-bank" class="info-label">Jenis Bank</label>
                                    <select name="bank" id="user-bank" class="form-control form-select text-uppercase" required>
                                        <option value="${response.users.bank_id}">${response.users.bank}</option>
                                        ${bankOptions}
                                    </select>    
                                </div>
                            `);
                        } else {
                            $('#bank-container').html(``);
                        }

                        // Handle position
                        if (response.users.position) {
                            let positionOptions = '';

                            if (response.users.position === "AFFILIATE UNITI") {
                                positionOptions = `<option value="EDUCATION ADVISOR">EDUCATION ADVISOR</option>`;
                            } else if (response.users.position === "EDUCATION ADVISOR") {
                                positionOptions = `<option value="AFFILIATE UNITI">AFFILIATE UNITI</option>`;
                            }

                            $('#position-container').html(`
                                <div class="form-group">
                                    <label for="user-position" class="info-label">Jawatan</label>
                                    <select name="position" id="user-position" class="form-control form-select text-uppercase" required>
                                        <option value="${response.users.position}">${response.users.position}</option>
                                        ${positionOptions}
                                    </select>    
                                </div>
                            `);
                        } else {
                            $('#position-container').html(``);
                        }

                        // Handle status
                        if (response.users.status) {
                            let statusOptions = '';

                            if (response.users.status === "AKTIF") {
                                statusOptions = `<option value="TIDAK AKTIF">TIDAK AKTIF</option>`;
                            } else if (response.users.status === "TIDAK AKTIF") {
                                statusOptions = `<option value="AKTIF">AKTIF</option>`;
                            }

                            $('#status-container').html(`
                                <div class="form-group">
                                    <label for="user-status" class="info-label">Status</label>
                                    <select name="status" id="user-status" class="form-control form-select text-uppercase" required>
                                        <option value="${response.users.status}">${response.users.status}</option>
                                        ${statusOptions}
                                    </select>    
                                </div>
                            `);
                        } else {
                            $('#status-container').html(``);
                        }

                        // Handle Affiliate Data
                        if (response.users.type === "advisor") {
                            if (response.users.accept_data !== undefined && response.users.accept_data !== null) {
                                const isChecked = String(response.users.accept_data) === "1"; // true if accept_data = 1

                                $('#accept_data-container').html(`
                                    <div class="form-check form-switch pt-2">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="user-accept_data" 
                                            name="accept_data" 
                                            value="1"
                                            ${isChecked ? 'checked' : ''}
                                        >
                                        <label class="form-check-label fw-bold" for="user-accept_data">
                                            Terima Data
                                        </label>
                                    </div>
                                `);
                            } else {
                                $('#accept_data-container').html('');
                            }

                            if (response.users.affiliate_data !== undefined && response.users.affiliate_data !== null) {
                                const isChecked = String(response.users.affiliate_data) === "1"; // true if affiliate_data = 1

                                $('#affiliate_data-container').html(`
                                    <div class="form-check form-switch pt-2">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="user-affiliate_data" 
                                            name="affiliate_data" 
                                            value="1"
                                            ${isChecked ? 'checked' : ''}
                                        >
                                        <label class="form-check-label fw-bold" for="user-affiliate_data">
                                            Penerima Data Affiliate
                                        </label>
                                    </div>
                                `);
                            } else {
                                $('#affiliate_data-container').html('');
                            }
                        } else {
                            $('#accept_data-container').html('');
                            $('#affiliate_data-container').html('');
                        }

                        $('#userModal').modal('show');
                    } else {
                        console.error('No user data found');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection