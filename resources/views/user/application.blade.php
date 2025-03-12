@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">{{ __('Pautan Rujukan')}}</div>

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

            <div class="table-responsive">
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Pemohon</th>
                            <th>Tarikh Permohonan</th>
                            <th>Status</th>
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
                            <td>&nbsp;</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#modal{{ $data['applicant']->ic }}">{{ $data['applicant']->name }}</button>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($data['applicant']->created_at)->format('d-m-Y') }}</td>
                            <td class="text-uppercase">{{ $data['applicant']->status }}</td>
                            <td>{{$data['applicant']->register_at ? \Carbon\Carbon::parse($data['applicant']->register_at)->format('d-m-Y') : '' }}</td>
                            <td>{{$data['applicant']->commission_date ? \Carbon\Carbon::parse($data['applicant']->commission_date)->format('d-m-Y') : '' }}</td>
                            <td class="text-center">{{ $data['applicant']->commission }}</td>
                        </tr>
                        <div class="modal fade" id="modal{{ $data['applicant']->ic }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $data['applicant']->ic }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $data['applicant']->ic }}"></h5>
                                </div>
                                <div class="modal-body small">
                                    <div class="col-md-12 col-sm-12 mb-3">
                                        <label for="" class="fw-bold">Maklumat Pemohon</label>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3 col-sm-3">
                                            <label for="">Nama Penuh</label>
                                        </div>
                                        <div class="col-md-9 col-sm-9">
                                            <label for="name">{{ $data['applicant']->name }}</label>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3 col-sm-3">
                                            <label for="">Tarikh Permohonan</label>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label for="name">{{ \Carbon\Carbon::parse( $data['applicant']->created_at )->format('d-m-Y') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mb-3 mt-3">
                                        <label for="" class="fw-bold">Program Yang Dipohon</label>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3 col-sm-3">
                                            <label for="">Lokasi</label>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label for="name">{{ $data['applicant']->location }}</label>
                                        </div>
                                    </div>
                                    @foreach ($data['programs'] as $program)
                                    <div class="row mb-2">
                                        <div class="col-md-3 col-sm-3">
                                            <label for="">Program Pilihan {{ $loop->iteration }}</label>
                                        </div>
                                        <div class="col-md-9 col-sm-9">
                                            <label for="name">{{ $program->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if ($data['applicant']->status !== null)
                                    <div class="col-md-12 col-sm-12">
                                        <hr>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-3 col-sm-3">
                                            <label for="">Status Permohonan</label>
                                        </div>
                                        <div class="col-md-9 col-sm-9">
                                            <label for="" class="text-uppercase">{{ $data['applicant']->status }}</label>
                                        </div>
                                    </div>                                            
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
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
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'dt-head-center'
                }
            ],
            layout: {
                top1Start: {
                    div: {
                        html: '<h2>Senarai Permohonan</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Senarai Permohonan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Senarai Permohonan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Senarai Permohonan'
                        },
                        {
                            extend: 'print',
                            title: 'Senarai Permohonan'
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        });
        t.on('order.dt search.dt', function () {
            let i = 1;
        
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
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
        var text = "Jom masuk Kolej UNITI! Gunakan pautan ini untuk mendaftar: " + document.getElementById("referral_url").value;
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
