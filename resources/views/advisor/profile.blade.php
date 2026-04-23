@extends('layouts.advisor')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style id="advisorProfileStyles">
    :root {
        --primary-color: #4f46e5;
        --secondary-color: #ec4899;
        --accent-color: #8b5cf6;
        --light-bg: #f8fafc;
        --card-bg: #ffffff;
        --input-bg: #f1f5f9;
        --border-color: #e2e8f0;
    }

    body {
        font-family: 'Outfit', sans-serif !important;
    }

    .profile-header-card {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        border-radius: 20px;
        padding: 30px;
        color: white;
        text-align: center;
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.2);
        position: relative;
        overflow: hidden;
    }

    .profile-header-card::before {
        content: '';
        position: absolute;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -30px;
        right: -30px;
    }

    .profile-header-card::after {
        content: '';
        position: absolute;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -20px;
        left: -20px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 40px;
        color: white;
        backdrop-filter: blur(5px);
        border: 3px solid rgba(255, 255, 255, 0.3);
    }

    .card-custom {
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card-header-simple {
        padding: 20px 25px;
        border-bottom: 1px solid var(--border-color);
        background: rgba(248, 250, 252, 0.5);
    }

    .card-header-simple h5 {
        margin: 0;
        color: var(--primary-color);
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    .card-header-simple h5 i {
        margin-right: 10px;
        background: #e0e7ff;
        padding: 8px;
        border-radius: 8px;
        font-size: 1rem;
    }

    .form-floating>.form-control,
    .form-floating>.form-select {
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background-color: var(--input-bg);
    }

    .form-floating>.form-control:focus,
    .form-floating>.form-select:focus {
        border-color: var(--accent-color);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
    }

    .form-control[readonly] {
        background-color: #e2e8f0;
        opacity: 0.8;
    }

    .btn-save {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        color: white;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(79, 70, 229, 0.4);
    }

    /* Staff Card (sample) */
    .staff-card-stage {
        background: rgba(248, 250, 252, 0.7);
        border: 1px dashed var(--border-color);
        border-radius: 16px;
        padding: 18px;
    }

    .staff-card {
        width: 54mm;
        height: 85.6mm; /* CR80 portrait */
        border-radius: 3.2mm;
        background: linear-gradient(135deg, #fbbf24, #f97316);
        color: #111827;
        overflow: hidden;
        position: relative;
        box-shadow: 0 12px 25px rgba(17, 24, 39, 0.25);
    }

    .staff-card::before {
        content: '';
        position: absolute;
        inset: -40px -60px auto auto;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.22);
        filter: blur(1px);
    }

    .staff-card::after {
        content: '';
        position: absolute;
        inset: auto auto -55px -55px;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: rgba(168, 85, 247, 0.22);
        filter: blur(1px);
    }

    .staff-card__inner {
        position: relative;
        z-index: 1;
        height: 100%;
        padding: 8mm 7mm 7mm;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
    }

    .staff-card__header {
        width: calc(100% + 14mm);
        display: flex;
        justify-content: center;
        margin-bottom: 4px;
        margin-top: -6mm;
        margin-left: -7mm;
        margin-right: -7mm;
    }

    .staff-card__brandbox {
        display: flex;
        align-items: center;
        gap: 7px;
        background: rgba(0, 0, 0, 0.9);
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-left: 0;
        border-right: 0;
        border-radius: 0;
        padding: 8px 10px;
        width: 100%;
        justify-content: flex-start;
    }

    .staff-card__brandbox img {
        width: 8.5mm;
        height: 8.5mm;
        object-fit: contain;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.95);
        padding: 1.1mm;
        flex: 0 0 auto;
    }

    .staff-card__brandtext {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 2px;
        min-width: 0;
    }

    .staff-card__brandtext-main {
        font-size: 24px;
        font-weight: 900;
        letter-spacing: 0.4px;
        line-height: 1.1;
        color: rgba(255, 255, 255, 0.98);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .staff-card__brandtext-sub {
        font-size: 10px;
        line-height: 1.05;
        color: rgba(255, 255, 255, 0.82);
        white-space: nowrap;
    }

    .staff-card__photo {
        width: 30mm;
        height: 30mm;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.35);
        border: 1px solid rgba(17, 24, 39, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(17, 24, 39, 0.9);
        font-size: 22px;
        overflow: hidden;
    }

    .staff-card__photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .staff-card__photo-icon {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: rgba(17, 24, 39, 0.9);
    }

    .staff-card__details {
        min-width: 0;
        width: 100%;
    }

    .staff-card__name {
        font-weight: 700;
        font-size: 13px;
        line-height: 1.1;
        margin: 2px 0 8px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .staff-card__title {
        margin: 0;
        font-size: 11px;
        line-height: 1.2;
        color: rgba(17, 24, 39, 0.85);
        letter-spacing: 0.3px;
        text-transform: uppercase;
        font-weight: 800;
    }

    .staff-card__title-box {
        width: calc(100% + 14mm);
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(17, 24, 39, 0.12);
        border-radius: 0;
        padding: 8px 8px;
        margin-top: 22px;
        margin-left: -7mm;
        margin-right: -7mm;
        border-left: 0;
        border-right: 0;
    }
</style>

<div class="container py-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0 mb-4" role="alert">
        <div class="d-flex align-items-center mb-2">
            <i class="fas fa-exclamation-triangle me-2"></i> <strong>Terdapat Ralat:</strong>
        </div>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <!-- Left Column: User Summary -->
        <div class="col-md-4 mb-4">
            <div class="profile-header-card mb-4">
                <div class="profile-avatar">
                    <i class="fas fa-user"></i>
                </div>
                <h4 class="fw-bold mb-1">{{ $user->name }}</h4>
                <p class="mb-0 text-white-50">{{ $user->email }}</p>
                <div class="mt-3 badge bg-white text-primary px-3 py-2 rounded-pill">
                    <i class="fas fa-id-card me-1"></i> {{ $user->ic }}
                </div>
            </div>

            <!-- Change Password Card -->
            <div class="card-custom">
                <div class="card-header-simple">
                    <h5><i class="fas fa-lock"></i> Keselamatan</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('advisor.profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Kata Laluan Baru" required>
                            <label for="password">Kata Laluan Baru</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Sah Kata Laluan" required>
                            <label for="password_confirmation">Sahkan Kata Laluan</label>
                            <div id="passwordMatchHelp" class="invalid-feedback">Kata laluan tidak sepadan.</div>
                        </div>
                        <button type="submit" class="btn btn-save w-100">
                            Simpan Kata Laluan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Edit Profile Form -->
        <div class="col-md-8">
            <div class="card-custom">
                <div class="card-header-simple">
                    <h5><i class="fas fa-user-edit"></i> Kemaskini Profil</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('advisor.profile.update') }}" method="POST" id="profileForm">
                        @csrf
                        @method('PUT')

                        <!-- Read Only Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                <label>Nama Penuh</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" value="{{ $user->ic }}" readonly>
                                <label>No. Kad Pengenalan</label>
                            </div>
                        </div>

                        <!-- Useable Info -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6 form-floating">
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}" placeholder="No. Telefon" required>
                                <label for="phone">No. Telefon</label>
                            </div>
                            <div class="col-md-6 form-floating">
                                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                <label>Emel (Tidak boleh diubah)</label>
                            </div>
                        </div>

                        <hr class="text-secondary opacity-25 my-4">

                        <!-- Banking Section -->
                        <div class="mb-4">
                            <label class="d-block form-label fw-bold mb-3 text-secondary"><i class="fas fa-university me-2"></i>Maklumat Perbankan</label>
                            <div class="row g-3">
                                <div class="col-md-6 form-floating">
                                    <select name="bank" id="bank" class="form-select" required>
                                        {{-- Current Bank --}}
                                        <option value="{{ $user->bank_id }}">{{ $user->bank }}</option>
                                        {{-- Other Banks --}}
                                        @foreach ($banks as $bank )
                                        @if($bank->id != $user->bank_id)
                                        <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    <label for="bank">Nama Bank</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" name="bank_account" id="bank_account" class="form-control" value="{{ $user->bank_account }}" placeholder="No. Akaun" required>
                                    <label for="bank_account">No. Akaun Bank</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-save px-5">
                                <i class="fas fa-save me-2"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Staff Card (Sample) -->
            <div class="card-custom">
                <div class="card-header-simple">
                    <h5><i class="fas fa-id-card"></i> Kad Staf</h5>
                </div>
                <div class="card-body p-4">

                    <div class="staff-card-stage mb-4" aria-label="Staff card stage">
                        <div class="staff-card mx-auto" id="staffCardPrintable" aria-label="Staff card preview">
                            <div class="staff-card__inner">
                                <div class="staff-card__header" aria-label="Branding">
                                    <div class="staff-card__brandbox">
                                        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/logo/kolej-uniti-logo.png" alt="Kolej UNITI logo" crossorigin="anonymous">
                                        <div class="staff-card__brandtext">
                                            <div class="staff-card__brandtext-main">KOLEJ UNITI</div>
                                            <div class="staff-card__brandtext-sub">www.uniti.edu.my</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="staff-card__photo" title="Photo placeholder">
                                    <img id="staffCardPhoto" src="" alt="Advisor photo" crossorigin="anonymous" data-primary-src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/advisor/{{ $user->ic }}.jpg">
                                </div>

                                <div class="staff-card__details">
                                    <p class="staff-card__name">{{ (\Illuminate\Support\Str::contains(\Illuminate\Support\Str::substr($user->name, 0, 8), ['PD', 'KB'])) ? \Illuminate\Support\Str::substr($user->name, 8) : $user->name }}</p>
                                    <div class="staff-card__title-box">
                                        <p class="staff-card__title">EKSEKUTIF PENGAMBILAN PELAJAR</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 justify-content-end mb-3">
                        <button type="button" class="btn btn-save" id="downloadStaffCardBtn">
                            <i class="fas fa-download me-2"></i> Muat turun (PDF)
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Loading with Timeout
        const staffCardPhoto = document.getElementById('staffCardPhoto');
        if (staffCardPhoto) {
            const primarySrc = staffCardPhoto.getAttribute('data-primary-src');
            const photoContainer = staffCardPhoto.parentElement;
            let imageLoadTimeout;

            function showIconFallback() {
                clearTimeout(imageLoadTimeout);
                staffCardPhoto.style.display = 'none';
                
                // Create and show icon fallback
                if (!photoContainer.querySelector('.staff-card__photo-icon')) {
                    const iconDiv = document.createElement('div');
                    iconDiv.className = 'staff-card__photo-icon';
                    iconDiv.innerHTML = '<i class="fas fa-user"></i>';
                    photoContainer.appendChild(iconDiv);
                }
            }

            // Try to load primary image with 5-second timeout
            imageLoadTimeout = setTimeout(showIconFallback, 5000);

            staffCardPhoto.onload = function() {
                clearTimeout(imageLoadTimeout);
            };

            staffCardPhoto.onerror = function() {
                clearTimeout(imageLoadTimeout);
                showIconFallback();
            };

            // Start loading primary image
            staffCardPhoto.src = primarySrc;
        }

        // Password Match Validation
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const downloadStaffCardBtn = document.getElementById('downloadStaffCardBtn');
        const staffCardPrintable = document.getElementById('staffCardPrintable');

        function validatePasswordMatch() {
            if (passwordConfirmInput.value && passwordInput.value !== passwordConfirmInput.value) {
                passwordConfirmInput.classList.add('is-invalid');
            } else {
                passwordConfirmInput.classList.remove('is-invalid');
            }
        }

        passwordInput.addEventListener('input', validatePasswordMatch);
        passwordConfirmInput.addEventListener('input', validatePasswordMatch);

        function downloadStaffCardAsPdf() {
            if (!staffCardPrintable) return;

            const button = downloadStaffCardBtn;
            const oldText = button ? button.innerHTML : null;

            const setBusy = (isBusy) => {
                if (!button) return;
                button.disabled = isBusy;
                button.style.opacity = isBusy ? '0.8' : '';
                button.style.pointerEvents = isBusy ? 'none' : '';
                if (isBusy) button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menjana PDF...';
                else if (oldText != null) button.innerHTML = oldText;
            };

            const fallbackPrint = () => {
                // Fallback: browser print dialog (user can choose Save as PDF)
                const printWindow = window.open('', '_blank', 'width=900,height=700');
                if (!printWindow) return;

                const cardHtml = staffCardPrintable.outerHTML;
                const pageStyles = `
                    <style>
                        @page { size: 54mm 85.6mm; margin: 0; }
                        html, body { margin: 0; padding: 0; }
                        body { width: 54mm; height: 85.6mm; display: grid; place-items: center; background: #fff; }
                        .staff-card { box-shadow: none !important; width: 54mm !important; height: 85.6mm !important; }
                        html, body, .staff-card { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                        /* minimal required styles for the card */
                        ${document.getElementById('advisorProfileStyles')?.innerHTML ?? ''}
                    </style>
                `;

                printWindow.document.open();
                printWindow.document.write(`<!doctype html><html><head><meta charset="utf-8">${pageStyles}<title>Staff Card</title></head><body>${cardHtml}</body></html>`);
                printWindow.document.close();

                setTimeout(() => {
                    try { printWindow.focus(); printWindow.print(); } catch (e) {}
                }, 250);
            };

            const downloadViaCanvasPdf = async () => {
                if (!window.html2canvas || !window.jspdf?.jsPDF) throw new Error('missing-libs');

                // Ensure images try to load with CORS for canvas export
                staffCardPrintable.querySelectorAll('img').forEach((img) => {
                    if (!img.getAttribute('crossorigin')) img.setAttribute('crossorigin', 'anonymous');
                });

                const canvas = await window.html2canvas(staffCardPrintable, {
                    backgroundColor: null,
                    scale: 3,
                    useCORS: true,
                    logging: false,
                });

                const imgData = canvas.toDataURL('image/png');
                const pdf = new window.jspdf.jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: [54, 85.6],
                });

                pdf.addImage(imgData, 'PNG', 0, 0, 54, 85.6);
                pdf.save('staff-card.pdf');
            };

            (async () => {
                setBusy(true);
                try {
                    await downloadViaCanvasPdf();
                } catch (e) {
                    fallbackPrint();
                } finally {
                    setBusy(false);
                }
            })();
        }

        downloadStaffCardBtn?.addEventListener('click', downloadStaffCardAsPdf);
    });
</script>
@endsection
