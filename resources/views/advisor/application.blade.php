@extends('layouts.advisor')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                /* Table Styles */
                #myTable {
                    border-collapse: separate;
                    border-spacing: 0;
                    border-radius: 12px;
                    overflow: hidden;
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
                    font-size: 0.85rem;
                }

                #myTable thead th {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    padding: 16px 12px;
                    border: none;
                    vertical-align: middle;
                }

                #myTable tbody td {
                    padding: 14px 10px;
                    vertical-align: middle;
                    border-bottom: 1px solid #e9ecef;
                    transition: all 0.3s ease;
                }

                #myTable tbody tr:hover {
                    background-color: #f8f9fa;
                    transform: scale(1.005);
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                    z-index: 5;
                    position: relative;
                }

                /* Modal Styling */
                .modal-header-custom {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    border: none;
                    padding: 16px 20px;
                    color: white;
                }

                .info-card {
                    background: white;
                    border-radius: 8px;
                    padding: 15px;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
                    margin-bottom: 15px;
                }

                .info-section-title {
                    font-weight: 700;
                    font-size: 0.9rem;
                    margin-bottom: 10px;
                    padding-bottom: 5px;
                    border-bottom: 1px solid #eee;
                    color: #555;
                }

                .label-custom {
                    font-weight: 600;
                    color: #6c757d;
                    font-size: 0.8rem;
                }

                .value-custom {
                    font-weight: 500;
                    color: #212529;
                    font-size: 0.9rem;
                }
            </style>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="col-md-12 mb-4">
                <div class="referral-card p-4 p-md-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8 order-2 order-lg-1">
                            <div class="pe-lg-5">
                                <div class="section-badge">
                                    <i class="bi bi-stars me-1"></i> Program Affiliate
                                </div>
                                <h2 class="fw-bold mb-3 display-6" style="color: #2d3748;">
                                    Jana Pendapatan Dengan <span class="text-gradient">Berkongsi Peluang Belajar di Kolej UNITI</span>
                                </h2>
                                <p class="text-muted mb-4 lead" style="font-size: 1.1rem;">
                                    Kongsi pautan ini kepada yang berminat mendaftar / belajar di Kolej UNITI.
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

                                <div id="copy-alert" class="alert alert-success mt-3 border-0 shadow-sm" style="display: none; background: #d1e7dd; color: #0f5132; border-radius: 12px;">
                                    <i class="bi bi-check-circle-fill me-2"></i> Pautan rujukan telah berjaya disalin!
                                </div>
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

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-body p-4">
                    <div class="mb-3 d-flex align-items-center">
                        <i class="bi bi-info-circle-fill text-primary me-2"></i>
                        <h6 class="mb-0 fw-bold text-muted">Petunjuk Warna Status (Hari Data Direkodkan)</h6>
                    </div>
                    <div class="d-flex flex-wrap gap-2 mb-2">
                        <span class="badge rounded-pill" style="background-color: #0d6efd;">Tiada Status</span>
                        <span class="badge rounded-pill" style="background-color: #28a745;">&le; 7 Hari</span>
                        <span class="badge rounded-pill" style="background-color: #ffc107; color: #000;">8 - 14 Hari</span>
                        <span class="badge rounded-pill" style="background-color: #fd7e14;">15 - 21 Hari</span>
                        <span class="badge rounded-pill" style="background-color: #dc3545;">&ge; 22 Hari</span>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="myTable" class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th style="width: 20px;"></th>
                            <th>#</th>
                            <th>Nama</th>
                            <th>No. Kad Pengenalan</th>
                            <th>No. Telefon</th>
                            <th>Email</th>
                            <th>Tarikh Data Masuk</th>
                            <th>Lokasi</th>
                            <th>Affiliate</th>
                            <th>Tarikh Agihan</th>
                            <th>Status</th>
                            <th>Tarikh Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicants as $index => $data)
                        @if ($data->user_id !== null && $data->register_at === null && in_array($data->status_id, [1, 2, 3, 4, 5, 24, 26]))
                        <tr class="table-danger">
                            @elseif ($data->user_id !== null && $data->register_at === null && $data->status_id === 19)
                        <tr class="table-info">
                            @elseif ($data->user_id !== null && ($data->status_id === null || $data->status_id === 0))
                        <tr>
                            @elseif ($data->user_id !== null && $data->register_at === null)
                        <tr class="table-warning">
                            @elseif ($data->user_id !== null && $data->register_at !== null)
                        <tr class="table-success">
                            @else
                        <tr>
                            @endif
                            @php
                            if ($data->days_since_created <= 7 && in_array($data->status_id, [null])) {
                                $style = 'background-color: #0d6efd;'; // blue
                                } elseif ($data->days_since_created <= 7 && in_array($data->status_id, [7,8,9,10,11,12,13,14,15,16,17,18])) {
                                    $style = 'background-color: #28a745;'; // green
                                    } elseif ($data->days_since_created >= 8 && $data->days_since_created <= 14 && in_array($data->status_id, [null, 7,8,9,10,11,12,13,14,15,16,17,18])) {
                                        $style = 'background-color: #ffc107;'; // yellow
                                        } elseif ($data->days_since_created >= 15 && $data->days_since_created <= 21 && in_array($data->status_id, [null, 7,8,9,10,11,12,13,14,15,16,17,18])) {
                                            $style = 'background-color: #fd7e14;'; // orange
                                            } elseif ($data->days_since_created >= 22 && in_array($data->status_id, [null, 7,8,9,10,11,12,13,14,15,16,17,18])) {
                                            $style = 'background-color: #dc3545;'; // red
                                            } else {
                                            $style = '';
                                            }
                                            @endphp
                                            <td style="{{ $style }} padding: 0;"></td>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-link text-uppercase fw-bold open-modal" style="text-decoration: none; color: #667eea;" data-ic="{{ $data->ic }}">{{ $data->name }}</button>
                                            </td>
                                            <td class="text-center">{{ $data->ic }}</td>
                                            <td class="text-center">{{ $data->phone }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                                            <td>{{ $data->location }}</td>
                                            <td class="text-uppercase">
                                                @if($data->referral_code !== null)
                                                @if(isset($affiliates[$data->id]) && $affiliates[$data->id]->isNotEmpty())
                                                {{ $affiliates[$data->id]->first()->name }}
                                                @else
                                                {{ __('TIADA AFFILIATE') }}
                                                @endif
                                                @else
                                                {{ __('TIADA AFFILIATE') }}
                                                @endif
                                            </td>
                                            <td>{{$data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d-m-Y') : '' }}</td>
                                            <td class="text-uppercase">
                                                <span class="badge bg-light text-dark border">{{ $data->status }}</span>
                                            </td>
                                            <td>{{$data->register_at ? \Carbon\Carbon::parse($data->register_at)->format('d-m-Y') : '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Modal -->
            <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content border-0 rounded-4 overflow-hidden shadow-lg">
                        <div class="modal-header-custom d-flex justify-content-between align-items-center">
                            <h5 class="modal-title fw-bold">
                                <i class="bi bi-pencil-square me-2"></i>Kemaskini Maklumat Pelajar
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form id="application-form" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body p-4 bg-light">
                                <!-- Student Info Section -->
                                <div class="info-card">
                                    <div class="info-section-title">
                                        <i class="bi bi-person-badge-fill me-2 text-primary"></i>Maklumat Peribadi
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="label-custom">Nama Penuh</div>
                                            <div class="value-custom" id="applicant-name">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="label-custom">No. Kad Pengenalan</div>
                                            <div class="value-custom" id="applicant-ic">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="label-custom">No. Telefon</div>
                                            <div class="value-custom" id="applicant-phone">Loading...</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="label-custom">Emel</div>
                                            <div class="value-custom" id="applicant-email">Loading...</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Section -->
                                <div class="info-card">
                                    <div class="info-section-title">
                                        <i class="bi bi-geo-alt-fill me-2 text-danger"></i>Alamat
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-12 value-custom" id="applicant-address1"></div>
                                        <div class="col-12 value-custom" id="applicant-address2"></div>
                                        <div class="col-md-4">
                                            <span class="label-custom">Poskod: </span><span class="value-custom" id="applicant-postcode"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="label-custom">Bandar: </span><span class="value-custom" id="applicant-city"></span>
                                        </div>
                                        <div class="col-md-4">
                                            <span class="label-custom">Negeri: </span><span class="value-custom" id="applicant-state"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- SPM & Status Section -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-card h-100">
                                            <div class="info-section-title">
                                                <i class="bi bi-book-fill me-2 text-success"></i>Akademik
                                            </div>
                                            <div class="mb-3">
                                                <div class="label-custom">Tahun SPM</div>
                                                <div class="value-custom" id="applicant-spm_year"></div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="label-custom">Tarikh Data Masuk</div>
                                                <div class="value-custom" id="applicant-created_at"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="info-card h-100">
                                            <div class="info-section-title">
                                                <i class="bi bi-gear-fill me-2 text-secondary"></i>Tindakan & Status
                                            </div>

                                            <div class="mb-3">
                                                <label class="label-custom mb-1">Lokasi Pilihan</label>
                                                <div class="value-custom" id="applicant-location"></div>
                                            </div>

                                            <div id="status-container"></div> <!-- Dynamic Status Select -->
                                            <div id="reason-container"></div> <!-- Dynamic Reason Textarea -->

                                        </div>
                                    </div>
                                </div>

                                <!-- SPM Result Section (Full Width) -->
                                <div class="info-card mt-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                        <div class="info-section-title mb-0 border-0 p-0">
                                            <i class="bi bi-file-earmark-image-fill me-2 text-danger"></i>Keputusan SPM
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" href="#collapseSPM">
                                            <i class="bi bi-eye me-1"></i> Papar / Sembunyi
                                        </button>
                                    </div>
                                    <div class="collapse show" id="collapseSPM">
                                        <div id="file-container" class="mt-2 text-center bg-light p-3 rounded rounded-3">
                                            <!-- JS injects here -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Programs Section -->
                                <div class="info-card mt-3">
                                    <div class="info-section-title">
                                        <i class="bi bi-mortarboard-fill me-2 text-info"></i>Program Yang Dipohon
                                    </div>
                                    <div id="programs-container"></div>
                                </div>

                                <!-- Offer Letter Section -->
                                <div class="info-card mt-3">
                                    <div class="info-section-title">
                                        <i class="bi bi-envelope-paper-heart-fill me-2 text-warning"></i>Maklumat Tawaran
                                    </div>
                                    <div id="offer-letter-container"></div>
                                </div>

                            </div>
                            <div class="modal-footer bg-white border-top-0">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-gradient px-4">Simpan Maklumat</button>
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
    function toggleTextarea(uniqueId) {
        const layakRadio = document.getElementById('layak' + uniqueId);
        const container = document.getElementById('notes-container' + uniqueId);

        if (layakRadio.checked) {
            container.style.display = 'none';
        } else {
            container.style.display = 'block';
        }
    }

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
                        html: '<h5 class="fw-bold text-secondary mb-0">Senarai Data Masuk</h5>'
                    }
                },
                top1End: {
                    buttons: [{
                            extend: 'copy',
                            text: '<i class="bi bi-clipboard me-1"></i> Copy',
                            className: 'btn btn-sm btn-light border',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="bi bi-file-earmark-excel me-1"></i> Excel',
                            className: 'btn btn-sm btn-light border',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="bi bi-file-earmark-pdf me-1"></i> PDF',
                            className: 'btn btn-sm btn-light border',
                            title: 'Senarai Data Masuk'
                        },
                        {
                            extend: 'print',
                            text: '<i class="bi bi-printer me-1"></i> Print',
                            className: 'btn btn-sm btn-light border',
                            title: 'Senarai Data Masuk'
                        }
                    ]
                },
                topStart: {
                    pageLength: {
                        menu: [10, 25, 50, 100],
                    }
                },
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        });

        // Add row numbering
        t.on('order.dt search.dt', function() {
            let i = 1;
            t.cells(null, 1, { // Index is now column 1 because column 0 is the color indicator
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
                url: "{{ route('advisor.application.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ic: ic
                },
                success: function(response) {
                    console.log(response); // Debugging: log the response

                    if (response.applicants) {
                        $('#application-form').attr('action', "{{ url('advisor/application') }}/" + response.applicants.id);
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
                            <div class="mb-3">
                                <label for="applicant-status" class="label-custom mb-1">Status Terkini</label>
                                <select name="statusApplication" id="applicant-status" class="form-select form-select-sm text-uppercase border-primary" required>
                                    <option value="${response.applicants.status_id}" selected>${response.applicants.status}</option>
                                    ${statusOptions}
                                </select>    
                            </div>
                        `);
                        } else {
                            $('#status-container').html(`
                             <div class="mb-3">
                                <label for="applicant-status" class="label-custom mb-1">Status Terkini</label>
                                <select name="statusApplication" id="applicant-status" class="form-select form-select-sm text-uppercase border-primary" required>
                                    <option value="" selected disabled>Pilih Status</option>
                                    ${statusOptions}
                                </select>    
                            </div>
                        `);
                        }

                        //Handle reason status
                        if (response.applicants.reason) {
                            $('#reason-container').html(`
                            <div class="mb-3">
                                <label for="reason" class="label-custom mb-1">Catatan</label>
                                <textarea name="reason" id="reason" rows="3" class="form-control form-control-sm">${response.applicants.reason}</textarea>    
                            </div>
                        `);
                        } else {
                            $('#reason-container').html(`
                             <div class="mb-3">
                                <label for="reason" class="label-custom mb-1">Catatan</label>
                                <textarea name="reason" id="reason" rows="3" class="form-control form-control-sm" placeholder="Nyatakan catatan (jika ada)"></textarea>    
                            </div>
                        `);
                        }

                        // Handle applicant offer letter date

                        if (response.applicants.offer_letter_date) {
                            $('#offer-letter-container').html(`
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="label-custom">Tarikh Tawaran</label>
                                    <input type="date" name="offer_letter_date" id="offer_letter_date" class="form-control form-control-sm" value="${response.applicants.offer_letter_date}">
                                </div>
                                <div class="col-md-6">
                                    <label class="label-custom">Tarikh Pendaftaran</label>
                                    <input type="date" name="register_letter_date" id="register_letter_date" class="form-control form-control-sm" value="${response.applicants.register_letter_date}">
                                </div>
                            </div>
                        `);
                        } else {
                            $('#offer-letter-container').html(`
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label class="label-custom">Tarikh Tawaran</label>
                                    <input type="date" name="offer_letter_date" id="offer_letter_date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-6">
                                    <label class="label-custom">Tarikh Pendaftaran</label>
                                     <input type="date" name="register_letter_date" id="register_letter_date" class="form-control form-control-sm">
                                </div>
                            </div>
                        `);
                        }

                        // Handle file URL
                        if (response.fileUrl) {
                            var extension = response.fileUrl.split('.').pop().toLowerCase();
                            if (extension === 'pdf') {
                                $('#file-container').html(`
                                <div class="d-flex justify-content-end mb-2">
                                     <a href="${response.fileUrl}" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-file-pdf me-1"></i> Buka PDF (Tab Baru)
                                    </a>
                                </div>
                                <object data="${response.fileUrl}" type="application/pdf" width="100%" height="600px" style="min-height: 500px;" class="rounded border">
                                    <p class="small text-muted">Pelayar anda tidak menyokong paparan PDF. <a href="${response.fileUrl}" target="_blank">Klik sini untuk muat turun PDF</a></p>
                                </object>
                            `);
                            } else {
                                $('#file-container').html(`
                                <div class="d-flex justify-content-end mb-2">
                                     <a href="${response.fileUrl}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-zoom-in me-1"></i> Lihat Imej Penuh
                                    </a>
                                </div>
                                <img src="${response.fileUrl}" loading="lazy" alt="Keputusan SPM" class="img-fluid rounded border shadow-sm" style="max-height: 600px;">
                            `);
                            }
                        } else {
                            $('#file-container').html('<div class="text-muted small py-4 fst-italic">Tiada muat naik keputusan SPM.</div>');
                        }

                        // Handle programs
                        if (response.programs) {
                            var programsHtml = '';
                            $.each(response.programs, function(index, program) {
                                var uniqueId = 'program' + (index + 1); // Unique ID for each program
                                var notesHtml = '';

                                // Check if the status is 'tidak layak'
                                if (program.status === 'tidak layak') {
                                    notesHtml = `
                                <div class="mb-3">
                                    <label for="notes${uniqueId}" class="label-custom">Catatan</label>
                                    <textarea name="programs[${index + 1}][notes]" id="notes${uniqueId}" rows="2" class="form-control form-control-sm">${program.notes}</textarea>
                                </div>
                            `;
                                } else {
                                    notesHtml = `
                                <div id="notes-container${uniqueId}" style="display: none;" class="mb-3">
                                     <label for="notes${uniqueId}" class="label-custom">Catatan</label>
                                    <textarea name="programs[${index + 1}][notes]" id="notes${uniqueId}" rows="2" class="form-control form-control-sm"></textarea>
                                </div>
                            `;
                                }

                                programsHtml += `
                            <div class="border rounded p-3 mb-3 bg-light">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="fw-bold text-primary">Program Pilihan ${index + 1}</div>
                                        <div class="small">${program.name}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="label-custom mb-1">Status Kelayakan</div>
                                        <div class="d-flex gap-3 mb-2">
                                             <div class="form-check">
                                                <input class="form-check-input" type="radio" name="programs[${index + 1}][status]" id="layak${uniqueId}" value="layak" onchange="toggleTextarea('${uniqueId}')" ${program.status === 'layak' ? 'checked' : ''} required />
                                                <label class="form-check-label small" for="layak${uniqueId}">LAYAK</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="programs[${index + 1}][status]" id="tidaklayak${uniqueId}" value="tidak layak" onchange="toggleTextarea('${uniqueId}')" ${program.status === 'tidak layak' ? 'checked' : ''} required />
                                                <label class="form-check-label small" for="tidaklayak${uniqueId}">TIDAK LAYAK</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${notesHtml}
                                <input type="hidden" name="programs[${index + 1}][id]" value="${program.id}">
                            </div>
                        `;
                            });

                            $('#programs-container').html(programsHtml);
                        } else {
                            $('#programs-container').html('<div class="text-muted small">Tiada program ditemukan</div>');
                        }

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

    function copyToClipboard() {
        var copyText = document.getElementById("referral_url");
        copyText.select();
        document.execCommand("copy");

        var copyBtn = document.getElementById("copy-btn");
        var originalText = copyBtn.innerHTML;
        copyBtn.innerHTML = '<i class="bi bi-check-circle"></i> Disalin';

        var copyAlert = document.getElementById("copy-alert");
        if (copyAlert) {
            copyAlert.style.display = "block";
            setTimeout(function() {
                copyBtn.innerHTML = originalText;
                copyAlert.style.display = "none";
            }, 2000);
        }
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
                var svg = qrContainer.querySelector('svg');
                if (!svg) return;

                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');

                canvas.width = svg.clientWidth || 200;
                canvas.height = svg.clientHeight || 200;

                var image = new Image();
                var svgData = new XMLSerializer().serializeToString(svg);
                var svgURL = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgData);

                image.onload = function() {
                    context.drawImage(image, 0, 0);
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