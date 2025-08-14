@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-12 col-sm-12">
            @if(session('msg_error'))
                <div class="alert alert-danger">
                    {{ session('msg_error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('danger'))
                <div class="alert alert-danger mt-2">
                    {{ session('danger') }}
                </div>
            @endif

            <div class="col-md-12 col-sm-12">
                <div style="display: flex; justify-content: right; align-items: right;">
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Kandungan Media</button>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-bold" id="cancelModalLabel">Maklumat Kandungan Media</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.content.add') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf

                                <!-- Title -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" required value="{{ old('title') }}">
                                    <label for="title">Tajuk</label>
                                </div>

                                <!-- Description -->
                                <div class="form-floating mb-2">
                                    <textarea name="description" id="description" class="form-control" style="height: 100px;" placeholder="Description" required>{{ old('description') }}</textarea>
                                    <label for="description">Keterangan</label>
                                </div>

                                <!-- Content Type -->
                                <div class="form-floating mb-2">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Pilihan Jenis Media</option>
                                        <option value="image">Gambar</option>
                                        <option value="video">Video</option>
                                        <option value="link">Pautan</option>
                                        <option value="text">Teks</option>
                                    </select>
                                    <label for="type">Jenis Media</label>
                                </div>

                                <!-- File Upload (no form-floating for file inputs) -->
                                <div class="mb-2" id="file-upload-group" style="display: none;">
                                    <label for="file" class="form-label">Muatnaik Fail</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>

                                <!-- External Link -->
                                <div class="form-floating mb-2" id="external-link-group" style="display: none;">
                                    <input type="url" name="external_link" id="external_link" class="form-control" placeholder="https://example.com" value="{{ old('external_link') }}">
                                    <label for="external_link">Pautan</label>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        function toggleFields() {
                                            var type = document.getElementById('type').value;
                                            document.getElementById('file-upload-group').style.display = (type === 'image') ? 'block' : 'none';
                                            document.getElementById('external-link-group').style.display = (type === 'video' || type === 'link') ? 'block' : 'none';
                                        }
                                        document.getElementById('type').addEventListener('change', toggleFields);
                                        toggleFields();
                                    });
                                </script>

                                <!-- Tags -->
                                <div class="form-floating mb-2">
                                    <input type="text" name="tags" id="tags" class="form-control" placeholder="e.g. promo, facebook" value="{{ old('tags') }}">
                                    <label for="tags">Tag</label>
                                </div>

                                <!-- Target Platform (no form-floating for multi-selects) -->
                                <div class="mb-2">
                                    <label for="platform" class="form-label">Platform Sasaran</label>
                                    <select name="platform[]" id="platform" class="form-select" multiple>
                                        <option value="facebook">Facebook</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="whatsapp">WhatsApp</option>
                                        <option value="tiktok">TikTok</option>
                                        <option value="telegram">Telegram</option>
                                    </select>
                                    <div class="form-text">Tekan Ctrl (Cmd pada Mac) untuk memilih lebih daripada 1.</div>
                                </div>

                                <!-- Publish Toggle -->
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_published" id="is_published" checked>
                                    <label class="form-check-label" for="is_published">Papar Sekarang</label>
                                </div>

                                <!-- Start Date -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Start date" value="{{ old('start_date') }}">
                                    <label for="start_date">Tarikh Mula</label>
                                </div>

                                <!-- End Date -->
                                <div class="form-floating mb-2">
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End date" value="{{ old('end_date') }}">
                                    <label for="end_date">Tarikh Tamat</label>
                                </div>

                                <!-- Submit -->
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        Muat Naik Kandungan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4">
        @foreach ($contents as $item)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    
                    {{-- Show file preview if it's an image --}}
                    @if($item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                        <img src="{{ asset($item->file_path) }}" 
                            class="card-img-top" 
                            alt="{{ $item->title }}" 
                            style="object-fit: cover; height: 200px;">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $item->title }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($item->description, 80) }}
                        </p>

                        <p class="mb-1">
                            <strong>Jenis:</strong> {{ ucfirst($item->type) }}
                        </p>

                        @if(!$item->file_path || !preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                            {{-- If it's not an image, still give a link --}}
                            @if($item->file_path)
                                <p class="mb-1">
                                    <a href="{{ asset($item->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Paparan</a>
                                </p>
                            @endif
                        @endif

                        @if($item->external_link)
                            <p class="mb-1">
                                <a href="{{ $item->external_link }}" target="_blank" class="btn btn-sm btn-outline-info">Pautan</a>
                            </p>
                        @endif

                        <p class="mb-1">
                            <strong>Tag:</strong> {{ Str::limit($item->tags, 30) }}
                        </p>

                        {{-- Platform badges --}}
                        <div class="mb-2">
                            @php
                                $platforms = is_array($item->platform) 
                                    ? $item->platform 
                                    : json_decode($item->platform, true);

                                $colors = [
                                    'facebook' => 'primary',
                                    'whatsapp' => 'success',
                                    'telegram' => 'info',
                                    'instagram' => 'danger',
                                    'tiktok' => 'dark',
                                ];
                            @endphp

                            @if(!empty($platforms))
                                @foreach($platforms as $p)
                                    <span class="badge bg-{{ $colors[$p] ?? 'secondary' }}">
                                        {{ ucfirst($p) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </div>

                        @if($item->start_date)
                            <!-- Tarikh Promosi -->
                            <p class="mb-1">
                                <strong>Tarikh Promosi:</strong>
                                {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}
                                -
                                {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                            </p>
                        @endif

                        {{-- Status --}}
                        <p>
                            @if($item->status_id == 1)
                                <span class="badge bg-success">Aktif</span>
                            @elseif($item->status_id == 0)
                                <span class="badge bg-warning">Tidak Aktif</span>
                            @endif
                        </p>
                    </div>

                    <div class="card-footer text-end">
                        <form action="{{ route('admin.contents.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Adakah anda pasti mahu hapuskan kandungan ini?')">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
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
                        html: '<h2>Senarai Kandungan Media</h2>'
                    }
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
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection
