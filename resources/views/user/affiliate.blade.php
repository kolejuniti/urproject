@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <style>
                .referral-card {
                    background: #ffffff;
                    border-radius: 20px;
                    border: none;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                    overflow: hidden;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .referral-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
                }

                .text-gradient {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    -webkit-background-clip: text;
                    background-clip: text;
                    -webkit-text-fill-color: transparent;
                }

                .input-group-modern {
                    background: #f8f9fa;
                    border: 2px solid #e9ecef;
                    border-radius: 12px;
                    padding: 5px;
                    transition: border-color 0.3s ease, box-shadow 0.3s ease;
                }

                .input-group-modern:focus-within {
                    border-color: #667eea;
                    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
                }

                .input-group-modern input {
                    border: none;
                    background: transparent;
                    font-weight: 500;
                    color: #495057;
                    box-shadow: none !important;
                }

                .btn-gradient {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    border: none;
                    font-weight: 600;
                    padding: 10px 24px;
                    border-radius: 8px;
                    transition: all 0.3s ease;
                }

                .btn-gradient:hover {
                    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
                    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
                    color: white;
                }

                .social-btn {
                    width: 45px;
                    height: 45px;
                    border-radius: 12px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                    border: 1px solid #e9ecef;
                    background: white;
                    color: #6c757d;
                    font-size: 1.2rem;
                }

                .social-btn:hover {
                    transform: translateY(-3px);
                    color: white;
                    border-color: transparent;
                }

                .social-btn.whatsapp:hover {
                    background: #25D366;
                    box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
                }

                .social-btn.facebook:hover {
                    background: #1877F2;
                    box-shadow: 0 5px 15px rgba(24, 119, 242, 0.3);
                }

                .social-btn.telegram:hover {
                    background: #0088cc;
                    box-shadow: 0 5px 15px rgba(0, 136, 204, 0.3);
                }

                .qr-wrapper {
                    background: white;
                    padding: 15px;
                    border-radius: 16px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                    display: inline-block;
                    border: 1px solid #f0f0f0;
                }

                .section-badge {
                    display: inline-block;
                    padding: 6px 16px;
                    background: rgba(102, 126, 234, 0.1);
                    color: #667eea;
                    border-radius: 50px;
                    font-size: 0.85rem;
                    font-weight: 700;
                    margin-bottom: 20px;
                    letter-spacing: 0.5px;
                }
            </style>

            <div class="col-md-12 mb-4">
                <div class="referral-card p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <div class="pe-lg-5">
                                <div class="section-badge">
                                    <i class="bi bi-people-fill me-1"></i> Jemputan Affiliate
                                </div>
                                <h2 class="fw-bold mb-3 display-6" style="color: #2d3748;">
                                    Kongsi Pautan <span class="text-gradient">Jana Pendapatan</span>
                                </h2>
                                <p class="text-muted mb-4 lead" style="font-size: 1.1rem;">
                                    Ajak rakan atau kenalan anda mendaftar sebagai affiliate Kolej UNITI dan nikmati ganjaran yang ditawarkan.
                                </p>

                                @auth
                                <div class="input-group-modern d-flex align-items-center mb-4">
                                    <span class="ps-3 text-muted"><i class="bi bi-link-45deg fs-4"></i></span>
                                    <input type="text" id="referral_url" name="url" class="form-control" value="{{ $url }}" readonly>
                                    <button class="btn btn-gradient m-1" id="copy-btn" onclick="copyToClipboard()">
                                        Salin Pautan
                                    </button>
                                </div>

                                <div class="d-flex align-items-center flex-wrap gap-3">
                                    <span class="text-muted fw-bold me-2">Kongsi ke:</span>
                                    <button class="social-btn whatsapp" onclick="shareOnWhatsApp()" title="Share on WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </button>
                                    <button class="social-btn facebook" onclick="shareOnFacebook()" title="Share on Facebook">
                                        <i class="bi bi-facebook"></i>
                                    </button>
                                    <button class="social-btn telegram" onclick="shareOnTelegram()" title="Share on Telegram">
                                        <i class="bi bi-telegram"></i>
                                    </button>
                                </div>

                                <!-- <div id="copy-alert" class="alert alert-success mt-4 mb-0 border-0 shadow-sm d-inline-flex align-items-center" style="display: none; background: #d1e7dd; color: #0f5132; border-radius: 12px;">
                                    <i class="bi bi-check-circle-fill me-2"></i> Pautan rujukan telah berjaya disalin!
                                </div> -->
                                @endauth
                            </div>
                        </div>

                        <div class="col-lg-4 order-1 order-lg-2 text-center mb-4 mb-lg-0">
                            @auth
                            <div class="position-relative d-inline-block">
                                <div class="qr-wrapper">
                                    <div class="qr-container position-relative">
                                        {!! $qrCode !!}
                                        <div class="qr-overlay position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center rounded" style="opacity: 0; background-color: rgba(102, 126, 234, 0.9); transition: opacity 0.3s ease; cursor: pointer;">
                                            <div class="text-center text-white">
                                                <i class="bi bi-download fs-2 mb-1"></i>
                                                <div class="fw-bold small">Muat Turun</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 text-muted small fw-bold">
                                    <i class="bi bi-qr-code-scan me-1"></i> Imbas Kod QR
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
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
                    width: 60px;
                    min-width: 60px;
                }

                /* # */
                #myTable thead th:nth-child(2) {
                    width: 30%;
                    min-width: 200px;
                }

                /* Nama */
                #myTable thead th:nth-child(3) {
                    width: 20%;
                    min-width: 140px;
                }

                /* No. Telefon */
                #myTable thead th:nth-child(4) {
                    width: 30%;
                    min-width: 200px;
                }

                /* Email */
                #myTable thead th:nth-child(5) {
                    width: 20%;
                    min-width: 140px;
                }

                /* Tarikh Daftar */

                #myTable tbody td {
                    padding: 14px 12px;
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
                    background-color: #f8f9fa;
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

                /* Text Styling */
                .text-cell {
                    font-weight: 500;
                    color: #212529;
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
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                    border-color: #667eea !important;
                    color: white !important;
                }
            </style>

            <div class="table-responsive">
                <table id="myTable" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No. Telefon</th>
                            <th>Email</th>
                            <th>Tarikh Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $affiliates as $affiliate )
                        <tr>
                            <td class="index-cell">{{ $loop->iteration }}</td>
                            <td class="text-start">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; border: 1px solid #e9ecef;">
                                        <i class="bi bi-person text-primary"></i>
                                    </div>
                                    <span class="text-uppercase fw-bold text-dark">{{ $affiliate->name }}</span>
                                </div>
                            </td>
                            <td>
                                @if($affiliate->phone)
                                <i class="bi bi-telephone me-2 text-muted"></i>{{ $affiliate->phone }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($affiliate->email)
                                <i class="bi bi-envelope me-2 text-muted"></i>{{ $affiliate->email }}
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="date-cell">
                                <i class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($affiliate->created_at)->format('d-m-Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal code removed as it was non-functional and structurally incorrect -->
        </div>
    </div>
</div>
<script>
    function toggleTextarea(uniqueId) {
        const layakRadio = document.getElementById('layak' + uniqueId);
        const container = document.getElementById('notes-container' + uniqueId);

        if (layakRadio.checked) {
            container.style.display = 'none';
        } else {
            container.style.display = 'block';
        }
    }
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
        var text = "Jom menjadi affiliate Kolej UNITI! Gunakan pautan ini untuk mendaftar: " + document.getElementById("referral_url").value;
        window.open("https://wa.me/?text=" + encodeURIComponent(text));
    }

    function shareOnFacebook() {
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(document.getElementById("referral_url").value));
    }

    function shareOnTelegram() {
        var text = "Jom menjadi affiliate Kolej UNITI! Gunakan pautan ini untuk mendaftar: " + document.getElementById("referral_url").value;
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
                        html: '<h2>Senarai Affiliate</h2>'
                    }
                },
                top1End: null,
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