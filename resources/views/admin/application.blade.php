@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    :root {
        --admin-primary: #1e293b;
        --admin-secondary: #334155;
        --admin-accent: #3b82f6;
        --admin-accent-hover: #2563eb;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
        --admin-info: #0ea5e9;
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

    .admin-application-page {
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
        margin-bottom: 1.5rem;
        animation: fadeInUp 0.5s ease-out;
    }

    .modern-card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--admin-border);
        background: #f8fafc;
        font-weight: 700;
        color: var(--admin-primary);
        display: flex;
        align-items: center;
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

    /* Referral Card Styling */
    .qr-container {
        padding: 1rem;
        background: white;
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        display: inline-block;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .qr-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .referral-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .bg-whatsapp-light {
        background: #dcfce7;
        color: #16a34a;
    }

    .bg-facebook-light {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .bg-telegram-light {
        background: #e0f2fe;
        color: #0284c7;
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
        content: '\f0c9';
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
        transform: scale(1.002);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        z-index: 1;
        position: relative;
    }

    .modern-table tbody td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
        color: var(--admin-text);
        font-size: 0.875rem;
        border-bottom: 1px solid var(--admin-border);
    }

    /* Subtle row backgrounds for status instead of full color */
    .row-danger {
        background-color: #fef2f2 !important;
    }

    .row-info {
        background-color: #f0f9ff !important;
    }

    .row-warning {
        background-color: #fffbeb !important;
    }

    .row-success {
        background-color: #f0fdf4 !important;
    }

    /* Badges */
    .badge-modern {
        padding: 0.35rem 0.6rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.7rem;
    }

    .btn-applicant-link {
        font-weight: 600;
        color: var(--admin-accent);
        text-decoration: none;
        border: none;
        background: transparent;
        padding: 0;
        transition: all 0.2s;
        text-align: left;
    }

    .btn-applicant-link:hover {
        color: var(--admin-accent-hover);
        text-decoration: underline;
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
        margin-top: 1.5rem;
    }

    .section-title:first-child {
        margin-top: 0;
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

<div class="container-fluid admin-application-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <div>
                    <h2><i class="fas fa-file-signature me-2"></i>Pengurusan Data Masuk</h2>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-modern fade show">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
            @endif

            <!-- Referral Link Card -->
            @auth
            <div class="modern-card">
                <div class="modern-card-header">
                    <i class="fas fa-link me-2"></i> Pautan Rujukan Anda
                </div>
                <div class="modern-card-body">
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-3 mb-md-0">
                            <div class="qr-container position-relative">
                                {!! $qrCode !!}
                                <div class="qr-overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="opacity: 0; background-color: rgba(0,0,0,0.7); transition: opacity 0.3s ease; border-radius: 12px; cursor: pointer;">
                                    <span class="text-white fw-bold"><i class="fas fa-download me-1"></i> Muat Turun</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5 class="fw-bold mb-2 text-dark">Kongsi Peluang Bersama Kolej UNITI</h5>
                            <p class="text-muted mb-4">Kongsi pautan ini kepada yang berminat mendaftar / belajar di Kolej UNITI..</p>

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-link text-muted"></i></span>
                                <input type="text" id="referral_url" name="url" class="form-control" value="{{ $url }}" readonly>
                                <button class="btn btn-primary" id="copy-btn" onclick="copyToClipboard()">
                                    <i class="bi bi-clipboard me-1"></i> Salin
                                </button>
                            </div>

                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-outline-success flex-grow-1" onclick="shareOnWhatsApp()">
                                    <i class="bi bi-whatsapp me-2"></i> WhatsApp
                                </button>
                                <button class="btn btn-outline-primary flex-grow-1" onclick="shareOnFacebook()">
                                    <i class="bi bi-facebook me-2"></i> Facebook
                                </button>
                                <button class="btn btn-outline-info flex-grow-1" onclick="shareOnTelegram()">
                                    <i class="bi bi-telegram me-2"></i> Telegram
                                </button>
                            </div>
                            <div id="copy-alert" class="alert alert-success mt-3 py-2 px-3 small" style="display: none;">
                                <i class="fas fa-check-circle me-1"></i> Pautan telah disalin ke papan keratan!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Filter Section -->
            <div class="filter-card">
                <form method="POST" action="{{ route('admin.application') }}" class="row g-3 align-items-end">
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
                            <i class="fas fa-filter me-2"></i> Tapis Rekod
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
                            Senarai dari <strong>{{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }}</strong> hingga <strong>{{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</strong>
                        </caption>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>No. Kad Pengenalan</th>
                                <th>No. Telefon</th>
                                <th>Tarikh Masuk</th>
                                <th>Lokasi</th>
                                <th>Affiliate</th>
                                <th>Tarikh Agihan</th>
                                <th>Education Advisor</th>
                                <th>Catatan</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applicants as $index => $data)
                            @php
                            $rowClass = '';
                            if ($data->user_id !== null && $data->register_at === null && in_array($data->status_id, [1, 2, 3, 4, 5, 24, 26, 27])) {
                            $rowClass = 'row-danger';
                            } elseif ($data->user_id !== null && $data->register_at === null && $data->status_id === 19) {
                            $rowClass = 'row-info';
                            } elseif (in_array($data->user_id, [0, '0'], true) && $data->register_at === null) {
                            $rowClass = '';
                            } elseif ($data->user_id !== null && $data->register_at === null) {
                            $rowClass = 'row-warning';
                            } elseif ($data->user_id !== null && $data->register_at !== null) {
                            $rowClass = 'row-success';
                            }
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <button type="button" class="btn-applicant-link text-uppercase open-modal" data-ic="{{ $data->ic }}">
                                        <i class="fas fa-user-circle me-1"></i> {{ $data->name }}
                                    </button>
                                </td>
                                <td class="text-center font-monospace">{{ $data->ic }}</td>
                                <td class="text-center">{{ $data->phone }}</td>
                                <td class="text-center small">{{ \Carbon\Carbon::parse($data->created_at)->format('d/m/Y') }}</td>
                                <td class="text-center"><span class="badge badge-modern bg-light text-dark border">{{ $data->location }}</span></td>
                                <td class="text-uppercase small">
                                    @if (!empty($data->referral_code) && $data->referral_code !== 'null' && isset($affiliates[$data->id]))
                                    @foreach ($affiliates[$data->id] as $affiliate)
                                    <div class="mb-1"><i class="fas fa-handshake me-1 text-primary"></i> {{ $affiliate->name }}</div>
                                    @endforeach
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center small">{{ $data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y') : '-' }}</td>
                                <td class="text-uppercase small fw-bold text-primary">{{ $data->user }}</td>
                                <td class="small text-muted">{{ Str::limit($data->note, 30) }}</td>
                                <td class="small">{{ Str::limit($data->remark, 30) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Application Modal -->
            <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="applicationModalLabel">
                                <i class="fas fa-edit me-2"></i>Butiran Permohonan
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <!-- Personal Info Section -->
                            <div class="section-title">
                                <i class="fas fa-user"></i> Maklumat Peribadi
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 mb-3">
                                    <div class="info-label">Nama Penuh</div>
                                    <div class="info-value p-2 bg-light rounded border h5 mb-0" id="applicant-name"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="info-label">No. Kad Pengenalan / Passport</div>
                                    <div class="info-value font-monospace" id="applicant-ic"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="info-label">Tarikh Data Masuk</div>
                                    <div class="info-value" id="applicant-created_at"></div>
                                </div>
                            </div>

                            <!-- Contact Info Section -->
                            <div class="section-title">
                                <i class="fas fa-address-book"></i> Maklumat Hubungan
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <div class="info-label">No. Telefon</div>
                                    <div class="info-value" id="applicant-phone"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="info-label">Emel</div>
                                    <div class="info-value text-lowercase" id="applicant-email"></div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="info-label">Alamat</div>
                                    <div class="info-value" id="applicant-address1"></div>
                                    <div class="info-value" id="applicant-address2"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-label">Poskod</div>
                                    <div class="info-value" id="applicant-postcode"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-label">Bandar</div>
                                    <div class="info-value" id="applicant-city"></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-label">Negeri</div>
                                    <div class="info-value" id="applicant-state"></div>
                                </div>
                            </div>

                            <!-- Academic & Location Info -->
                            <div class="section-title">
                                <i class="fas fa-graduation-cap"></i> Akademik & Pilihan
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <div class="info-label">Tahun SPM</div>
                                    <div class="info-value" id="applicant-spm_year"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="info-label">Lokasi Pilihan</div>
                                    <div class="info-value" id="applicant-location"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-outline-primary btn-sm w-100 text-start" type="button" data-bs-toggle="collapse" data-bs-target="#spmResultCollapse" aria-expanded="false" aria-controls="spmResultCollapse">
                                    <i class="fas fa-file-alt me-2"></i> Lihat Keputusan SPM <i class="fas fa-chevron-down float-end mt-1"></i>
                                </button>
                                <div class="collapse mt-2" id="spmResultCollapse">
                                    <div class="card card-body bg-light border-0">
                                        <div id="file-container" class="text-center">
                                            <!-- File content will be injected here -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-light p-3 rounded border mb-3">
                                <h6 class="fw-bold mb-3 border-bottom pb-2">Program Yang Dipohon</h6>
                                <div id="programs-container">
                                    <!-- Programs will be loaded here dynamically -->
                                </div>
                            </div>

                            <!-- Status Update Form -->
                            <div class="section-title">
                                <i class="fas fa-tasks"></i> Kemaskini Status
                            </div>

                            <form id="application-form" action="" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row align-items-end">
                                    <div class="col-md-12 mb-3">
                                        <div id="status-container">
                                            <!-- Status Select will be loaded here -->
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div id="register_at-container">
                                            <!-- Register Date will be loaded here -->
                                        </div>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <div id="pic-container">
                                            <!-- Advisor/PIC will be loaded here -->
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
        // Initialize DataTables
        var t = $('#myTable').DataTable({
            columnDefs: [{
                targets: ['_all'],
                className: 'dt-head-center'
            }],
            layout: {
                top1Start: {
                    div: {
                        html: '<h2><i class="fas fa-list-ul me-2"></i>Senarai Data Masuk</h2>'
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

        // Add row numbering
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
                url: "{{ route('admin.application.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ic: ic
                },
                success: function(response) {

                    if (response.applicants) {
                        $('#application-form').attr('action', "{{ url('admin/kemaskini/permohonan') }}/" + response.applicants.id);
                        // Populate the modal with the returned data
                        $('#applicant-name').text(response.applicants.name);
                        $('#applicant-ic').text(response.applicants.ic);
                        $('#applicant-phone').text(response.applicants.phone);
                        $('#applicant-email').text(response.applicants.email);
                        $('#applicant-address1').text(response.applicants.address1);
                        $('#applicant-address2').text(response.applicants.address2);
                        $('#applicant-postcode').text(response.applicants.postcode);
                        $('#applicant-city').text(response.applicants.city);
                        $('#applicant-state').text(response.applicants.state);
                        $('#applicant-spm_year').text(response.applicants.spm_year);
                        $('#applicant-created_at').text(response.applicants.created_at);
                        $('#applicant-location').text(response.applicants.location);

                        // Handle applicant status
                        let statusOptions = response.statusApplications.map((statusApplication) =>
                            `<option value="${statusApplication.id}">${statusApplication.name}</option>`
                        ).join('');

                        if (response.applicants.status_id) {
                            $('#status-container').html(`
                                <div class="form-group">
                                    <label for="applicant-status" class="form-label">Status Terkini</label>
                                    <select name="statusApplication" id="applicant-status" class="form-select text-uppercase" required>
                                        <option value="${response.applicants.status_id}" selected>${response.applicants.status}</option>
                                        ${statusOptions}
                                    </select>    
                                </div>
                            `);
                        } else {
                            $('#status-container').html(`
                                <div class="form-group">
                                    <label for="applicant-status" class="form-label">Status Terkini</label>
                                    <select name="statusApplication" id="applicant-status" class="form-select text-uppercase">
                                        <option value="" selected disabled>Pilih Status</option>
                                        ${statusOptions}
                                    </select>    
                                </div>
                            `);
                        }

                        // Handle file URL
                        if (response.fileUrl) {
                            var extension = response.fileUrl.split('.').pop().toLowerCase();
                            if (extension === 'pdf') {
                                $('#file-container').html(`
                                    <object data="${response.fileUrl}" type="application/pdf" width="100%" height="400px" class="rounded border">
                                        <p><a href="${response.fileUrl}" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-download me-2"></i>Muat turun fail PDF</a></p>
                                    </object>
                                `);
                            } else {
                                $('#file-container').html(`
                                    <img src="${response.fileUrl}" loading="lazy" alt="Keputusan SPM" class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                                `);
                            }
                        } else {
                            $('#file-container').html('<div class="text-muted fst-italic py-3">Tiada fail keputusan peperiksaan SPM dimuat naik</div>');
                        }

                        // Handle programs
                        if (response.programs) {
                            var programsHtml = '';
                            $.each(response.programs, function(index, program) {
                                programsHtml += `
                                    <div class="program-item bg-white p-3 rounded border mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-md-1">
                                                <span class="badge bg-primary rounded-circle p-2">${index + 1}</span>
                                            </div>
                                            <div class="col-md-7">
                                                <small class="text-muted d-block text-uppercase">Program</small>
                                                <div class="fw-bold">${program.name}</div>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <span class="badge ${program.status === 'layak' ? 'bg-success' : 'bg-secondary'} text-uppercase">${program.status}</span>
                                            </div>
                                        </div>
                                `;

                                if (program.status !== 'baru' && program.status !== 'layak') {
                                    programsHtml += `
                                        <div class="mt-2 pt-2 border-top">
                                            <small class="text-muted d-block">Catatan:</small>
                                            <div class="fst-italic text-sm">${program.notes}</div>
                                        </div>
                                    `;
                                }

                                programsHtml += `</div>`;
                            });

                            $('#programs-container').html(programsHtml);
                        } else {
                            $('#programs-container').html('<div class="text-muted fst-italic">Tiada program pilihan ditemui</div>');
                        }

                        // Handle register date
                        if (response.applicants.register_at) {
                            $('#register_at-container').html(`
                                <div class="form-group">
                                    <label for="register_at" class="form-label">Tarikh Daftar Kolej</label>
                                    <input type="text" class="form-control" value="${response.applicants.register_at}" readonly>
                                </div>
                            `);
                        } else {
                            $('#register_at-container').html(`
                                <div class="form-group">
                                    <label for="applicant-register_at" class="form-label">Tarikh Daftar Kolej</label>
                                    <input type="date" name="register_at" id="applicant-register_at" class="form-control">
                                    <small class="text-muted">Isi jika pelajar telah mendaftar</small>
                                </div>
                            `);
                        }

                        // Handle users
                        let usersOptions = response.users.map((user) => `<option value="${user.id}">${user.name}</option>`).join('');

                        let currentPicHtml = '';
                        if (response.applicants.user_id) {
                            currentPicHtml = `<option value="${response.applicants.user_id}" selected>${response.applicants.user}</option>`;
                        }

                        $('#pic-container').html(`
                            <div class="form-group">
                                <label for="applicant-pic" class="form-label">Pegawai Perhubungan (Education Advisor)</label>
                                <select name="pic" id="applicant-pic" class="form-select text-uppercase">
                                    <option value="">-- Pilih Pegawai --</option>
                                    ${currentPicHtml}
                                    <option value="">TIADA PEGAWAI</option>
                                    ${usersOptions}
                                </select>
                            </div>
                        `);

                        // Show the modal
                        $('#applicationModal').modal('show');
                    } else {
                        console.error('No applicant data found');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("referral_url");
        copyText.select();
        document.execCommand("copy");

        var copyBtn = document.getElementById("copy-btn");
        var originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Disalin!';
        copyBtn.classList.remove('btn-primary');
        copyBtn.classList.add('btn-success');

        var copyAlert = document.getElementById("copy-alert");
        copyAlert.style.display = "block";

        setTimeout(function() {
            copyBtn.innerHTML = originalText;
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-primary');
            copyAlert.style.display = "none";
        }, 2000);
    }

    function shareOnWhatsApp() {
        var referralUrl = document.getElementById("referral_url").value;
        if (!referralUrl.includes('source=')) {
            referralUrl += (referralUrl.includes('?') ? '&' : '?') + 'source=whatsapp';
        }

        var text = "Jom masuk Kolej UNITI! Gunakan pautan ini untuk mendaftar: " + referralUrl;
        window.open("https://wa.me/?text=" + encodeURIComponent(text));
    }

    function shareOnFacebook() {
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(document.getElementById("referral_url").value));
    }

    function shareOnTelegram() {
        var text = "Jom masuk Kolej UNITI! Gunakan pautan ini untuk mendaftar: " + document.getElementById("referral_url").value;
        window.open("https://t.me/share/url?url=" + encodeURIComponent(document.getElementById("referral_url").value) + "&text=" + encodeURIComponent(text));
    }

    // Make QR code clickable to download
    document.addEventListener('DOMContentLoaded', function() {
        var qrContainer = document.querySelector('.qr-container');
        var qrOverlay = document.querySelector('.qr-overlay');

        if (qrContainer) {
            qrContainer.addEventListener('mouseenter', function() {
                qrOverlay.style.opacity = '1';
            });

            qrContainer.addEventListener('mouseleave', function() {
                qrOverlay.style.opacity = '0';
            });

            qrContainer.addEventListener('click', function() {
                // Get the SVG element
                var svg = qrContainer.querySelector('svg');
                if (!svg) {
                    // console.error('SVG not found in container');
                    // Fallback using html2canvas or just don't error
                    return;
                }

                // Create a canvas element
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');

                // Set canvas dimensions to match SVG
                canvas.width = svg.clientWidth || 200;
                canvas.height = svg.clientHeight || 200;

                // Add white background
                context.fillStyle = 'white';
                context.fillRect(0, 0, canvas.width, canvas.height);

                // Create an image from the SVG
                var image = new Image();
                var svgData = new XMLSerializer().serializeToString(svg);
                var svgURL = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgData);

                image.onload = function() {
                    // Draw the image on the canvas
                    context.drawImage(image, 0, 0);

                    // Create download link
                    var downloadLink = document.createElement('a');
                    downloadLink.download = 'UNITI-Referral-QR.png';
                    downloadLink.href = canvas.toDataURL('image/png');
                    document.body.appendChild(downloadLink);
                    downloadLink.click();
                    document.body.removeChild(downloadLink);
                };

                image.src = svgURL;
            });
        }
    });
</script>
@endsection