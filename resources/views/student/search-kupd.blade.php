@extends('layouts.student-kupd')

@section('title', 'Semakan | Kolej UNITI Port Dickson')

@section('content')
<style>
    /* Page Specific Styles */
    body main,
    main {
        padding-top: 0 !important;
    }

    .page-hero {
        padding: 8rem 0 4rem;
        background: radial-gradient(circle at top right, rgba(217, 119, 6, 0.1), transparent 40%),
            linear-gradient(to bottom, #ffffff, #eff6ff);
        position: relative;
        overflow: hidden;
    }

    .card-theme {
        border: 1px solid #e2e8f0;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        background: var(--surface);
        transition: transform 0.3s ease;
    }

    .card-theme:hover {
        transform: translateY(-5px);
    }

    .card-header-custom {
        background: rgba(239, 246, 255, 0.6);
        border-bottom: 1px solid #e2e8f0;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .input-group-search .form-control {
        border-radius: 50px 0 0 50px;
        border: 1px solid #cbd5e1;
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
    }

    .input-group-search .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
    }

    .input-group-search .btn {
        border-radius: 0 50px 50px 0;
        background-color: var(--accent);
        border-color: var(--accent);
        color: white;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    .input-group-search .btn:hover {
        background-color: var(--accent-hover);
        border-color: var(--accent-hover);
    }

    .badge-status {
        padding: 0.5em 1em;
        border-radius: 50px;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .badge-status-warning {
        background-color: rgba(217, 119, 6, 0.1);
        color: var(--accent);
        border: 1px solid rgba(217, 119, 6, 0.2);
    }

    .info-label {
        font-weight: 600;
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .info-value {
        font-weight: 500;
        color: var(--text-main);
    }

    .section-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 1.5rem 0;
    }

    .section-title {
        color: var(--primary);
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: var(--accent);
    }

    @media print {
        @page {
            size: portrait;
            margin: 1cm;
        }

        body {
            background: white !important;
            color: black;
        }

        body * {
            visibility: hidden;
        }

        .printableArea,
        .printableArea * {
            visibility: visible;
        }

        .printableArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
        }

        .card-footer,
        .no-print {
            display: none !important;
        }

        .page-hero,
        .search-card,
        footer,
        nav {
            display: none !important;
        }
    }
</style>

<div class="position-relative">
    <!-- Hero Decoration -->
    <div class="hero-bg-accent"></div>

    <section class="page-hero">
        <div class="container position-relative" style="z-index: 1;">
            <div class="row justify-content-center text-center" data-aos="fade-up">
                <div class="col-lg-8">
                    <span class="badge bg-white text-primary border px-3 py-2 rounded-pill mb-3 fw-semibold shadow-sm">
                        <i class="bi bi-search me-1 text-warning"></i> Semakan Permohonan
                    </span>
                    <h1 class="display-5 fw-bold mb-3">Semak Status <span class="text-warning">Permohonan</span></h1>
                    <p class="lead text-muted mx-auto" style="max-width: 600px;">
                        Masukkan nombor kad pengenalan untuk melihat status terkini permohonan anda,
                        kemas kini maklumat, atau muat turun surat tawaran.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5 mb-5 position-relative" style="z-index: 1;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    @if(!isset($ic))
                    <div class="card card-theme mb-4 search-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-header-custom">
                            <span><i class="bi bi-person-badge me-2"></i> Carian Pemohon</span>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <form action="{{ route('semak.permohonan.kupd') }}" method="GET">
                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <label for="ic" class="form-label text-muted fw-semibold small text-uppercase">Nombor Kad Pengenalan</label>
                                        <div class="input-group input-group-search mb-2">
                                            <input type="text" name="ic" id="ic" class="form-control" placeholder="Contoh: 010101101234" maxlength="12" required oninput="this.value = this.value.replace(/[-\s]/g, '')">
                                            <button class="btn" type="submit">
                                                <i class="bi bi-search me-1"></i> Cari
                                            </button>
                                        </div>
                                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i> Masukkan 12 digit tanpa sempang (-)</small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    @if(isset($ic))
                    @if($students->isEmpty())
                    <div class="card card-theme mb-4 text-center p-5">
                        <div class="mb-3">
                            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                <i class="bi bi-exclamation-triangle fs-1"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-2">Tiada Maklumat Dijumpai</h4>
                        <p class="text-muted mb-4">Maaf, nombor kad pengenalan <strong>{{ $ic }}</strong> tidak dijumpai dalam sistem kami.</p>
                        <div>
                            <a href="{{ route('semak.permohonan.kupd') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i> Cuba Semula
                            </a>
                            <a href="{{ route('student.register-kupd') }}" class="btn btn-primary-custom ms-2">
                                Daftar Baru <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                    @else
                    @foreach($students as $student)
                    <div class="card card-theme printableArea mb-5">
                        <div class="card-header-custom">
                            <span>STATUS PERMOHONAN</span>
                            <span class="badge badge-status badge-status-warning"><i class="bi bi-hash me-1"></i> {{ $student->ic }}</span>
                        </div>
                        <div class="card-body p-4 p-md-5">

                            <!-- Maklumat Pemohon -->
                            <div class="section-title">
                                <i class="bi bi-person-lines-fill"></i> Maklumat Pemohon
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">Nama Penuh</div>
                                        <div class="col-sm-8 info-value text-uppercase">{{ $student->name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">No. MyKad</div>
                                        <div class="col-sm-8 info-value">{{ $student->ic }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">No. Telefon</div>
                                        <div class="col-sm-8 info-value">{{ $student->phone }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">Emel</div>
                                        <div class="col-sm-8 info-value">{{ $student->email }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Kemaskini -->
                            <form action="{{ route('kemaskini.permohonan.kupd', [$student->ic, $student->email]) }}" method="POST" enctype="multipart/form-data" class="bg-light p-4 rounded-3 border mb-4 no-print">
                                @csrf
                                @method('PUT')
                                <h6 class="fw-bold mb-3 text-secondary">Kemas Kini Maklumat</h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="info-label small mb-1">Alamat Baris 1</label>
                                        @if (empty($student->address1) || trim($student->address1) === '')
                                        <input type="text" name="address1" class="form-control form-control-sm border-secondary-subtle" required placeholder="No. Rumah, Jalan...">
                                        @else
                                        <div class="form-control form-control-sm bg-white text-uppercase border-0">{{ $student->address1 }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="info-label small mb-1">Alamat Baris 2</label>
                                        @if (empty($student->address2))
                                        <input type="text" name="address2" class="form-control form-control-sm border-secondary-subtle" required placeholder="Taman / Kampung...">
                                        @else
                                        <div class="form-control form-control-sm bg-white text-uppercase border-0">{{ $student->address2 }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="info-label small mb-1">Poskod</label>
                                        @if (empty($student->postcode))
                                        <input type="text" name="postcode" class="form-control form-control-sm border-secondary-subtle" required>
                                        @else
                                        <div class="form-control form-control-sm bg-white border-0">{{ $student->postcode }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="info-label small mb-1">Bandar</label>
                                        @if (empty($student->city))
                                        <input type="text" name="city" class="form-control form-control-sm border-secondary-subtle" required>
                                        @else
                                        <div class="form-control form-control-sm bg-white text-uppercase border-0">{{ $student->city }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="info-label small mb-1">Negeri</label>
                                        @if (empty($student->state))
                                        <select name="state" class="form-select form-select-sm border-secondary-subtle" required>
                                            <option value="">Pilihan Negeri</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <div class="form-control form-control-sm bg-white border-0">{{ $student->state }}</div>
                                        @endif
                                    </div>

                                    <div class="col-md-4">
                                        <label class="info-label small mb-1">Tahun SPM</label>
                                        @if (empty($student->spm_year))
                                        <select name="year" class="form-select form-select-sm border-secondary-subtle" required>
                                            <option value="">Pilihan Tahun</option>
                                            @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        <div class="form-control form-control-sm bg-white border-0">{{ $student->spm_year }}</div>
                                        @endif
                                    </div>

                                    @if ($foundFile === null)
                                    <div class="col-md-12">
                                        <label class="info-label small mb-1 text-danger">Muat Naik Keputusan SPM (Wajib)</label>
                                        <div class="input-group input-group-sm">
                                            <input type="file" class="form-control border-danger" name="file" id="file" required accept=".jpeg,.jpg,.png,.pdf">
                                        </div>
                                        <small class="text-muted d-block mt-1 fst-italic">Format: JPG, PNG, PDF (Max 5MB)</small>
                                    </div>

                                    <div class="col-12 text-end mt-3">
                                        <button type="submit" class="btn btn-primary-custom btn-sm rounded-pill px-4">
                                            <i class="bi bi-save me-1"></i> Simpan Maklumat
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </form>

                            <div class="section-divider"></div>

                            <!-- Program Info -->
                            <div class="section-title">
                                <i class="bi bi-mortarboard-fill"></i> Program Dipohon
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">Tarikh</div>
                                        <div class="col-sm-8 info-value">{{ \Carbon\Carbon::parse($student->created_at)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4 info-label">Lokasi</div>
                                        <div class="col-sm-8 info-value">{{ $student->location }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                @foreach ( $studentPrograms as $program )
                                <div class="bg-primary bg-opacity-10 p-3 rounded-3 mb-2 border border-primary-subtle">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Program Pilihan {{ $loop->iteration }}</small>
                                            <h6 class="fw-bold text-primary mb-1">{{ $program->program }}</h6>

                                            @if($program->status === 'layak')
                                            <div class="mt-2 text-success fw-bold small">
                                                <i class="bi bi-check-circle-fill me-1"></i> TAHNIAH! Anda Layak Ditawarkan
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-md-4 text-md-end mt-2 mt-md-0">
                                            <span class="badge {{ $program->status == 'layak' ? 'bg-success' : ($program->status == 'baru' ? 'bg-info text-dark' : 'bg-secondary') }} rounded-pill px-3 py-2">
                                                {{ strtoupper($program->status) }}
                                            </span>

                                            @if ($program->status === 'layak')
                                            <div class="mt-2">
                                                <a href="#" onclick="openOfferLetter(event, '{{ $student->ic }}')" class="btn btn-sm btn-dark rounded-pill px-3">
                                                    <i class="bi bi-file-earmark-pdf me-1"></i> Surat Tawaran
                                                </a>
                                            </div>
                                            @elseif ($program->status !== 'baru')
                                            @if($program->notes)
                                            <div class="mt-2 small text-muted fst-italic">
                                                "{{ $program->notes }}"
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="section-divider"></div>

                            <!-- Pegawai Info -->
                            <div class="section-title">
                                <i class="bi bi-headset"></i> Pegawai Perhubungan
                            </div>

                            @if( $student->user !== null )
                            <div class="d-flex align-items-center gap-3 bg-white border rounded-3 p-3">
                                <div class="bg-light rounded-circle p-3 text-secondary">
                                    <i class="bi bi-person-circle fs-3"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $student->user }}</h6>
                                    <p class="text-muted small mb-0">{{ $student->user_phone }}</p>
                                </div>
                                <div class="ms-auto">
                                    <a href="https://wa.me/6{{ str_replace(['-', ' '], '', $student->user_phone) }}" target="_blank" class="btn btn-success btn-sm rounded-circle" data-bs-toggle="tooltip" title="WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <a href="tel:{{ $student->user_phone }}" class="btn btn-primary btn-sm rounded-circle ms-1" data-bs-toggle="tooltip" title="Call">
                                        <i class="bi bi-telephone-fill"></i>
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="alert alert-info border-0 bg-info bg-opacity-10 text-info-emphasis">
                                <i class="bi bi-info-circle me-2"></i> Pegawai yang dilantik akan menghubungi anda dalam masa terdekat.
                            </div>
                            @endif

                        </div>
                        <div class="card-footer bg-white text-center border-top-0 pb-4 pt-0">
                            <button class="btn btn-outline-secondary rounded-pill px-4" type="button" onclick="printCardBody()">
                                <i class="bi bi-printer me-2"></i> Cetak Maklumat
                            </button>
                            <a href="{{ route('semak.permohonan.kupd') }}" class="btn btn-link text-decoration-none text-muted ms-2">Kembali</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function openOfferLetter(event, ic) {
        event.preventDefault();
        var url = "{{ route('student.offerletter') }}" + "?ic=" + encodeURIComponent(ic);
        window.open(url, '_blank');
    }

    function printCardBody() {
        window.print();
    }
</script>
@endsection