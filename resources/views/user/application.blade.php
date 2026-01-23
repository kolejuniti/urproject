@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3 shadow-sm">
                <div class="card-header" style="background-color: #8173b6; color: white; font-weight: bold;">{{ __('Pautan Rujukan')}}</div>

                <div class="card-body">
                    @auth
                    <div class="row col-12 col-sm-12 col-md-12">
                        <div class="col-12 col-sm-3 col-md-3 text-center mb-3">
                            <div class="qr-container position-relative">
                                {!! $qrCode !!}
                                <div class="qr-overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center" style="opacity: 0; background-color: rgba(0,0,0,0.7); transition: opacity 0.3s ease;">
                                    <span class="text-white fw-bold">Klik untuk muat turun</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-9 col-md-9">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <h5 class="card-title fw-bold">Kongsi Peluang Untuk Bersama Kolej UNITI</h5>
                                <p class="card-text">Kongsi pautan ini kepada yang berminat mendaftar / belajar di Kolej UNITI.</p>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" id="referral_url" name="url" class="form-control" value="{{ $url }}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" id="copy-btn" onclick="copyToClipboard()">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="share-buttons mt-3 d-flex gap-2">
                                <button class="btn btn-sm btn-outline-success" onclick="shareOnWhatsApp()">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </button>
                                <button class="btn btn-sm btn-outline-primary" onclick="shareOnFacebook()">
                                    <i class="bi bi-facebook"></i> Facebook
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="shareOnTelegram()">
                                    <i class="bi bi-telegram"></i> Telegram
                                </button>
                            </div>
                            <div id="copy-alert" class="alert alert-success mt-3" style="display: none;">
                                Pautan telah disalin!
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>

            <style>
                /* Custom Table Styling */
                #myTable {
                    border-collapse: separate;
                    border-spacing: 0;
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
                    font-size: 0.9rem;
                }

                #myTable thead th {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    padding: 16px 12px;
                    border: none;
                    position: sticky;
                    top: 0;
                    z-index: 10;
                }

                /* Column Width Adjustments */
                #myTable thead th:nth-child(1) {
                    width: 50px;
                    min-width: 50px;
                }

                /* # */
                #myTable thead th:nth-child(2) {
                    width: 200px;
                    min-width: 180px;
                }

                /* Nama */
                #myTable thead th:nth-child(3) {
                    width: 140px;
                    min-width: 130px;
                }

                /* Tarikh Data Masuk */
                #myTable thead th:nth-child(4) {
                    width: 150px;
                    min-width: 140px;
                }

                /* Status */
                #myTable thead th:nth-child(5) {
                    width: 100px;
                    min-width: 90px;
                }

                /* Insentif */
                #myTable thead th:nth-child(6) {
                    width: 140px;
                    min-width: 130px;
                }

                /* Tarikh Pendaftaran */
                #myTable thead th:nth-child(7) {
                    width: 140px;
                    min-width: 130px;
                }

                /* Tarikh Komisen */
                #myTable thead th:nth-child(8) {
                    width: 120px;
                    min-width: 110px;
                }

                /* Amaun Komisen */

                #myTable tbody td {
                    padding: 14px 10px;
                    vertical-align: middle;
                    border-bottom: 1px solid #e9ecef;
                    transition: all 0.3s ease;
                }

                #myTable tbody tr {
                    transition: all 0.3s ease;
                    background-color: white;
                }

                #myTable tbody tr:hover {
                    transform: scale(1.01);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                    z-index: 5;
                }

                /* Enhanced Row Colors with Gradients */
                #myTable tbody tr.table-danger {
                    background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);
                    border-left: 4px solid #dc3545;
                }

                #myTable tbody tr.table-info {
                    background: linear-gradient(135deg, #f0f8ff 0%, #e0f2ff 100%);
                    border-left: 4px solid #0dcaf0;
                }

                #myTable tbody tr.table-warning {
                    background: linear-gradient(135deg, #fffef5 0%, #fff9e5 100%);
                    border-left: 4px solid #ffc107;
                }

                #myTable tbody tr.table-success {
                    background: linear-gradient(135deg, #f0fff4 0%, #e5ffe5 100%);
                    border-left: 4px solid #198754;
                }

                /* Status Badge Styling */
                .status-badge {
                    display: inline-block;
                    padding: 6px 14px;
                    border-radius: 20px;
                    font-size: 0.75rem;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                /* Name Button Styling */
                #myTable .btn-link {
                    color: #667eea;
                    font-weight: 600;
                    text-decoration: none;
                    padding: 4px 8px;
                    border-radius: 6px;
                    transition: all 0.3s ease;
                }

                #myTable .btn-link:hover {
                    background-color: #667eea;
                    color: white;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
                }

                /* Amount Styling */
                .amount-cell {
                    font-weight: 700;
                    color: #198754;
                    font-size: 0.95rem;
                }

                /* Index Number Styling */
                .index-cell {
                    font-weight: 600;
                    color: #6c757d;
                    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                }

                /* Date Styling */
                .date-cell {
                    color: #495057;
                    font-weight: 500;
                }

                /* Responsive adjustments */
                @media (max-width: 768px) {
                    #myTable {
                        font-size: 0.8rem;
                    }

                    #myTable thead th,
                    #myTable tbody td {
                        padding: 10px 6px;
                    }
                }

                /* DataTable wrapper styling */
                .dataTables_wrapper {
                    padding: 20px;
                    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
                    border-radius: 12px;
                    margin-top: 20px;
                }

                /* Search and filter styling */
                .dataTables_filter input {
                    border: 2px solid #667eea;
                    border-radius: 8px;
                    padding: 8px 16px;
                    transition: all 0.3s ease;
                }

                .dataTables_filter input:focus {
                    outline: none;
                    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
                }

                /* Pagination styling */
                .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    border-color: #667eea;
                    color: white !important;
                }

                .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    border-color: #667eea;
                    color: white !important;
                }

                /* Modal enhancements */
                .modal-footer .btn-secondary:hover {
                    background: #5a6268 !important;
                    transform: translateY(-2px);
                    box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
                }

                .modal-content .btn-close:hover {
                    transform: rotate(90deg);
                    transition: transform 0.3s ease;
                }
            </style>

            <div class="table-responsive">
                <table id="myTable" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tarikh Data Masuk</th>
                            <th>Status</th>
                            <th>Insentif</th>
                            <th>Tarikh Pendaftaran</th>
                            <th>Tarikh Komisen</th>
                            <th>Amaun Komisen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicantsWithPrograms as $data)
                        @if ($data['applicant']->user_id !== null && $data['applicant']->register_at === null && in_array($data['applicant']->status_id, [1, 2, 3, 4, 5, 24, 26]))
                        <tr class="table-danger">
                            @elseif ($data['applicant']->user_id !== null && $data['applicant']->register_at === null && $data['applicant']->status_id === 19)
                        <tr class="table-info">
                            @elseif ($data['applicant']->user_id !== null && $data['applicant']->register_at === null)
                        <tr class="table-warning">
                            @elseif ($data['applicant']->user_id !== null && $data['applicant']->register_at !== null)
                        <tr class="table-success">
                            @else
                        <tr>
                            @endif
                            <td class="index-cell">&nbsp;</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#modal{{ $data['applicant']->ic }}">
                                    <i class="bi bi-person-circle me-1"></i>{{ $data['applicant']->name }}
                                </button>
                            </td>
                            <td class="date-cell">
                                <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d-m-Y') }}
                            </td>
                            <td>
                                <span class="status-badge">{{ $data['applicant']->status }}</span>
                            </td>
                            <td class="amount-cell">
                                RM {{ number_format($data['applicant']->incentive ?? 0, 2) }}
                            </td>
                            <td class="date-cell">
                                @if($data['applicant']->register_at)
                                <i class="bi bi-calendar-check me-1"></i>{{ \Carbon\Carbon::parse($data['applicant']->register_at)->format('d-m-Y') }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="date-cell">
                                @if($data['applicant']->commission_date)
                                <i class="bi bi-calendar-event me-1"></i>{{ \Carbon\Carbon::parse($data['applicant']->commission_date)->format('d-m-Y') }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="amount-cell">
                                RM {{ number_format($data['applicant']->commission ?? 0, 2) }}
                            </td>
                        </tr>
                        <div class="modal fade" id="modal{{ $data['applicant']->ic }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $data['applicant']->ic }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);">
                                    <!-- Enhanced Modal Header -->
                                    <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 16px 20px;">
                                        <div class="d-flex align-items-center">
                                            <div class="modal-icon me-2" style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                                <i class="bi bi-person-badge" style="font-size: 20px; color: white;"></i>
                                            </div>
                                            <div>
                                                <h5 class="modal-title mb-0" style="color: white; font-weight: 700; font-size: 1.1rem;">{{ $data['applicant']->name }}</h5>
                                                <small style="color: rgba(255, 255, 255, 0.9); font-size: 0.75rem;">
                                                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d M Y') }}
                                                </small>
                                            </div>
                                        </div>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Enhanced Modal Body -->
                                    <div class="modal-body" style="padding: 16px; background: #f8f9fa; max-height: 65vh; overflow-y: auto;">
                                        <!-- Personal Information Card -->
                                        <div class="info-card mb-2" style="background: white; border-radius: 8px; padding: 12px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);">
                                            <div class="section-header mb-1" style="border-left: 3px solid #667eea; padding-left: 8px;">
                                                <h6 class="mb-0" style="color: #667eea; font-weight: 700; font-size: 0.85rem;">
                                                    <i class="bi bi-person-lines-fill me-1"></i>Maklumat Data
                                                </h6>
                                            </div>

                                            <div class="info-row d-flex align-items-start mb-1 pb-1" style="border-bottom: 1px solid #e9ecef;">
                                                <div class="info-label" style="min-width: 140px; color: #6c757d; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="bi bi-person-fill me-1" style="color: #667eea; font-size: 0.8rem;"></i>Nama Penuh
                                                </div>
                                                <div class="info-value" style="color: #212529; font-weight: 500; flex: 1; font-size: 0.8rem;">
                                                    {{ $data['applicant']->name }}
                                                </div>
                                            </div>

                                            <div class="info-row d-flex align-items-start">
                                                <div class="info-label" style="min-width: 140px; color: #6c757d; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="bi bi-calendar-check me-1" style="color: #667eea; font-size: 0.8rem;"></i>Tarikh Data Masuk
                                                </div>
                                                <div class="info-value" style="color: #212529; font-weight: 500; font-size: 0.8rem;">
                                                    {{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d-m-Y') }}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Program Information Card -->
                                        <div class="info-card mb-2" style="background: white; border-radius: 8px; padding: 12px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);">
                                            <div class="section-header mb-1" style="border-left: 3px solid #764ba2; padding-left: 8px;">
                                                <h6 class="mb-0" style="color: #764ba2; font-weight: 700; font-size: 0.85rem;">
                                                    <i class="bi bi-mortarboard-fill me-1"></i>Maklumat Program
                                                </h6>
                                            </div>

                                            <div class="info-row d-flex align-items-start mb-1 pb-1" style="border-bottom: 1px solid #e9ecef;">
                                                <div class="info-label" style="min-width: 140px; color: #6c757d; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="bi bi-geo-alt-fill me-1" style="color: #764ba2; font-size: 0.8rem;"></i>Lokasi
                                                </div>
                                                <div class="info-value" style="color: #212529; font-weight: 500; font-size: 0.8rem;">
                                                    {{ $data['applicant']->location }}
                                                </div>
                                            </div>

                                            @foreach ($data['programs'] as $program)
                                            <div class="info-row d-flex align-items-start {{ !$loop->last ? 'mb-1 pb-1' : '' }}" style="{{ !$loop->last ? 'border-bottom: 1px solid #e9ecef;' : '' }}">
                                                <div class="info-label" style="min-width: 140px; color: #6c757d; font-weight: 600; font-size: 0.75rem;">
                                                    <i class="bi bi-bookmark-star-fill me-1" style="color: #764ba2; font-size: 0.8rem;"></i>Program {{ $loop->iteration }}
                                                </div>
                                                <div class="info-value" style="color: #212529; font-weight: 500; flex: 1; font-size: 0.8rem;">
                                                    {{ $program->name }}
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Status Information Card -->
                                        @if ($data['applicant']->status !== null)
                                        <div class="info-card" style="background: white; border-radius: 8px; padding: 12px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);">
                                            <div class="section-header mb-1" style="border-left: 3px solid #198754; padding-left: 8px;">
                                                <h6 class="mb-0" style="color: #198754; font-weight: 700; font-size: 0.85rem;">
                                                    <i class="bi bi-info-circle-fill me-1"></i>Status Terkini
                                                </h6>
                                            </div>

                                            <div class="info-row">
                                                <span class="status-badge" style="display: inline-block; padding: 5px 14px; border-radius: 14px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; box-shadow: 0 2px 6px rgba(102, 126, 234, 0.3);">
                                                    <i class="bi bi-check-circle-fill me-1"></i>{{ $data['applicant']->status }}
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Enhanced Modal Footer -->
                                    <div class="modal-footer" style="background: white; border: none; padding: 12px 20px;">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="padding: 8px 20px; border-radius: 6px; font-weight: 600; background: #6c757d; border: none; transition: all 0.3s ease;">
                                            <i class="bi bi-x-circle me-1"></i>Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
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
                        html: '<h2>Senarai Data Masuk</h2>'
                    }
                },
                top1End: {
                    buttons: [{
                            extend: 'copy',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'print',
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
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("referral_url");
        copyText.select();
        document.execCommand("copy");

        var copyBtn = document.getElementById("copy-btn");
        var originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="bi bi-check-circle"></i>';

        var copyAlert = document.getElementById("copy-alert");
        copyAlert.style.display = "block";

        setTimeout(function() {
            copyBtn.innerHTML = originalText;
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
                    console.error('SVG not found in container');
                    return;
                }

                // Create a canvas element
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');

                // Set canvas dimensions to match SVG
                canvas.width = svg.clientWidth || 200;
                canvas.height = svg.clientHeight || 200;

                // Create an image from the SVG
                var image = new Image();
                var svgData = new XMLSerializer().serializeToString(svg);
                var svgURL = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgData);

                image.onload = function() {
                    // Draw the image on the canvas
                    context.drawImage(image, 0, 0);

                    // Create download link
                    var downloadLink = document.createElement('a');
                    downloadLink.download = 'UNITI-QR-Code.png';
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