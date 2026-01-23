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
            <div class="card mb-3 shadow-sm">
                <div class="card-header" style="background-color: #8173b6; color: white; font-weight: bold;">{{ __('Pautan Rujukan') }}</div>

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
                                <p class="card-text">Kongsi pautan ini kepada yang berminat untuk mendaftar sebagai affiliate Kolej UNITI.</p>
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