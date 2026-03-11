@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

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

    .admin-contents-page {
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

    .page-header .btn-add {
        background: white;
        color: var(--admin-primary);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
    }

    .page-header .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .page-header .btn-add i {
        margin-right: 0.5rem;
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

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid var(--admin-danger);
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

    /* Content Cards */
    .content-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .content-card:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }

    .content-card .card-body {
        flex: 1;
        padding: 1.5rem;
    }

    .content-card .card-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--admin-primary);
        margin-bottom: 0.75rem;
    }

    .content-card .card-text {
        color: var(--admin-text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .content-card .info-label {
        font-weight: 600;
        color: var(--admin-text);
        font-size: 0.85rem;
    }

    .content-card .info-value {
        color: var(--admin-text-muted);
        font-size: 0.85rem;
    }

    .content-card .card-footer {
        background: #f8fafc;
        border-top: 1px solid var(--admin-border);
        padding: 1rem 1.5rem;
    }

    .content-card img {
        border-radius: 12px;
        object-fit: cover;
        height: 220px;
        width: 100%;
    }

    .content-card .ratio {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    /* Badges */
    .badge-modern {
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        margin-right: 0.25rem;
        margin-bottom: 0.25rem;
        display: inline-block;
    }

    .badge-kupd {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-kukb {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-active {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-inactive {
        background: #fef3c7;
        color: #92400e;
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

    .modal-header .btn-close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 1.5rem;
        max-height: 70vh;
        overflow-y: auto;
    }

    /* Form Styling */
    .form-floating>.form-control,
    .form-floating>.form-select,
    .form-select,
    .form-control {
        border-radius: 10px;
        border: 1px solid var(--admin-border);
        transition: all 0.3s ease;
    }

    .form-floating>.form-control:focus,
    .form-floating>.form-select:focus,
    .form-select:focus,
    .form-control:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-floating>label {
        color: var(--admin-text-muted);
    }

    .form-label {
        font-weight: 600;
        color: var(--admin-text);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .form-text {
        font-size: 0.75rem;
        color: var(--admin-text-muted);
    }

    .form-check-label {
        color: var(--admin-text);
        font-weight: 500;
    }

    /* Buttons */
    .btn {
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-primary {
        background: var(--admin-accent);
    }

    .btn-primary:hover {
        background: var(--admin-accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    }

    .btn-warning {
        background: var(--admin-warning);
        color: white;
    }

    .btn-warning:hover {
        background: #d97706;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(245, 158, 11, 0.3);
    }

    .btn-danger {
        background: var(--admin-danger);
    }

    .btn-danger:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
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

    .content-card {
        animation: fadeInUp 0.5s ease-out;
    }

    /* Platform Badges Colors */
    .bg-facebook {
        background: #1877f2 !important;
    }

    .bg-instagram {
        background: #e4405f !important;
    }

    .bg-whatsapp {
        background: #25d366 !important;
    }

    .bg-telegram {
        background: #0088cc !important;
    }

    .bg-tiktok {
        background: #000000 !important;
    }
</style>

<div class="container-fluid admin-contents-page">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Page Header -->
            <div class="page-header">
                <h2><i class="fas fa-photo-video me-2"></i>Pengurusan Kandungan Media</h2>
                <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="fas fa-plus-circle"></i>Tambah Bahan Media
                </button>
            </div>

            <!-- Alert Messages -->
            @if(session('msg_error'))
            <div class="alert alert-danger alert-modern">
                <i class="fas fa-exclamation-circle"></i>
                <div>{{ session('msg_error') }}</div>
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success alert-modern">
                <i class="fas fa-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif
            @if(session('danger'))
            <div class="alert alert-danger alert-modern">
                <i class="fas fa-exclamation-triangle"></i>
                <div>{{ session('danger') }}</div>
            </div>
            @endif

            <!-- Add Content Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="cancelModalLabel">
                                <i class="fas fa-plus-circle me-2"></i>Maklumat Bahan Media
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.content.add') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf

                                <!-- Title -->
                                <div class="form-floating mb-3">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" required value="{{ old('title') }}">
                                    <label for="title"><i class="fas fa-heading me-2"></i>Tajuk</label>
                                </div>

                                <!-- Description -->
                                <div class="form-floating mb-3">
                                    <textarea name="description" id="description" class="form-control" style="height: 100px;" placeholder="Description" required>{{ old('description') }}</textarea>
                                    <label for="description"><i class="fas fa-align-left me-2"></i>Keterangan</label>
                                </div>

                                <!-- Content Type -->
                                <div class="form-floating mb-3">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="">Pilihan Jenis Media</option>
                                        <option value="image">Gambar</option>
                                        <option value="video">Video</option>
                                        <option value="link">Pautan</option>
                                        <option value="text">Teks</option>
                                    </select>
                                    <label for="type"><i class="fas fa-file-alt me-2"></i>Jenis Media</label>
                                </div>

                                <!-- File Upload -->
                                <div class="mb-3" id="file-upload-group" style="display: none;">
                                    <label for="file" class="form-label"><i class="fas fa-upload me-2"></i>Muatnaik Fail</label>
                                    <input type="file" name="file" id="file" class="form-control">
                                </div>

                                <!-- External Link -->
                                <div class="form-floating mb-3" id="external-link-group" style="display: none;">
                                    <input type="url" name="external_link" id="external_link" class="form-control" placeholder="https://example.com" value="{{ old('external_link') }}">
                                    <label for="external_link"><i class="fas fa-link me-2"></i>Pautan</label>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
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
                                <div class="form-floating mb-3">
                                    <input type="text" name="tags" id="tags" class="form-control" placeholder="e.g. promo, facebook" value="{{ old('tags') }}">
                                    <label for="tags"><i class="fas fa-tags me-2"></i>Tag</label>
                                </div>

                                <!-- Target Platform -->
                                <div class="mb-3">
                                    <label for="platform" class="form-label"><i class="fas fa-share-alt me-2"></i>Platform Sasaran</label>
                                    <select name="platform[]" id="platform" class="form-select" multiple>
                                        <option value="facebook">Facebook</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="whatsapp">WhatsApp</option>
                                        <option value="tiktok">TikTok</option>
                                        <option value="telegram">Telegram</option>
                                    </select>
                                    <div class="form-text">Tekan Ctrl (Cmd pada Mac) untuk memilih lebih daripada 1.</div>
                                </div>

                                <!-- Location -->
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-map-marker-alt me-2"></i>Lokasi</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="location" id="location_kupd" value="kupd" required>
                                        <label class="form-check-label" for="location_kupd">
                                            Kolej UNITI Port Dickson
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="location" id="location_kukb" value="kukb" required>
                                        <label class="form-check-label" for="location_kukb">
                                            Kolej UNITI Kota Bahru
                                        </label>
                                    </div>
                                </div>

                                <!-- Publish Toggle -->
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" name="is_published" id="is_published" checked>
                                    <label class="form-check-label" for="is_published">Papar Sekarang</label>
                                </div>

                                <!-- Start Date -->
                                <div class="form-floating mb-3">
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Start date" value="{{ old('start_date') }}">
                                    <label for="start_date"><i class="fas fa-calendar-alt me-2"></i>Tarikh Mula</label>
                                </div>

                                <!-- End Date -->
                                <div class="form-floating mb-3">
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End date" value="{{ old('end_date') }}">
                                    <label for="end_date"><i class="fas fa-calendar-check me-2"></i>Tarikh Tamat</label>
                                </div>

                                <!-- Submit -->
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Muat Naik Kandungan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Cards Grid -->
            <div class="row g-4">
                @foreach ($contents as $item)
                <div class="col-md-4">
                    <div class="content-card">
                        <div class="card-body">

                            {{-- Image --}}
                            @if($item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                            <img src="{{ asset($item->file_path) }}"
                                alt="{{ $item->title }}"
                                class="img-fluid mb-3">
                            @endif

                            {{-- YouTube Embed --}}
                            @if(strtolower($item->type) === 'video' && $item->external_link)
                            @php
                            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $item->external_link, $matches);
                            $youtubeId = $matches[1] ?? null;
                            @endphp

                            @if($youtubeId)
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allowfullscreen></iframe>
                            </div>
                            @endif
                            @endif

                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">
                                {{ Str::limit($item->description, 80) }}
                            </p>

                            <div class="mb-2">
                                <span class="info-label">Jenis:</span>
                                <span class="badge badge-modern bg-secondary">
                                    <i class="fas fa-{{ $item->type === 'image' ? 'image' : ($item->type === 'video' ? 'video' : ($item->type === 'link' ? 'link' : 'file-alt')) }} me-1"></i>
                                    {{ ucfirst($item->type) }}
                                </span>
                            </div>

                            @if($item->tags)
                            <div class="mb-2">
                                <span class="info-label">Tag:</span>
                                <span class="badge badge-modern bg-info text-white">
                                    <i class="fas fa-tag me-1"></i>{{ $item->tags }}
                                </span>
                            </div>
                            @endif

                            {{-- Location --}}
                            <div class="mb-2">
                                <span class="info-label">Lokasi:</span>
                                @if($item->location == 'kupd')
                                <span class="badge badge-kupd">
                                    <i class="fas fa-map-marker-alt me-1"></i>KUPD
                                </span>
                                @elseif($item->location == 'kukb')
                                <span class="badge badge-kukb">
                                    <i class="fas fa-map-marker-alt me-1"></i>KUKB
                                </span>
                                @endif
                            </div>

                            {{-- Platform badges --}}
                            @php
                            $platforms = is_array($item->platform) ? $item->platform : json_decode($item->platform, true);
                            @endphp
                            @if(!empty($platforms))
                            <div class="mb-2">
                                <span class="info-label d-block mb-1">Platform:</span>
                                @foreach($platforms as $p)
                                <span class="badge badge-modern bg-{{ $p }} text-white">
                                    <i class="fab fa-{{ $p }} me-1"></i>{{ ucfirst($p) }}
                                </span>
                                @endforeach
                            </div>
                            @endif

                            @if($item->start_date)
                            <div class="mb-2">
                                <span class="info-label">Tarikh Promosi:</span>
                                <span class="info-value">
                                    <i class="fas fa-calendar me-1"></i>
                                    {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
                                </span>
                            </div>
                            @endif

                            {{-- Status --}}
                            <div>
                                @if($item->status_id == 1)
                                <span class="badge badge-active">
                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                </span>
                                @else
                                <span class="badge badge-inactive">
                                    <i class="fas fa-times-circle me-1"></i>Tidak Aktif
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="button"
                                class="btn btn-sm btn-warning me-2"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}">
                                <i class="fas fa-edit me-1"></i>Kemaskini
                            </button>
                            <form action="{{ route('admin.contents.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Adakah anda pasti mahu hapuskan kandungan ini?')">
                                    <i class="fas fa-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal for {{ $item->title }} -->
                <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="editModalLabel{{ $item->id }}">
                                    <i class="fas fa-edit me-2"></i>Edit Kandungan Media
                                </h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.content.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    @method('PUT')

                                    <!-- Title -->
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title" id="title{{ $item->id }}" class="form-control" placeholder="Title" required value="{{ $item->title }}">
                                        <label for="title{{ $item->id }}"><i class="fas fa-heading me-2"></i>Tajuk</label>
                                    </div>

                                    <!-- Description -->
                                    <div class="form-floating mb-3">
                                        <textarea name="description" id="description{{ $item->id }}" class="form-control" style="height: 100px;" placeholder="Description" required>{{ $item->description }}</textarea>
                                        <label for="description{{ $item->id }}"><i class="fas fa-align-left me-2"></i>Keterangan</label>
                                    </div>

                                    <!-- Content Type -->
                                    <div class="form-floating mb-3">
                                        <select name="type" id="type{{ $item->id }}" class="form-control" required>
                                            <option value="">Pilihan Jenis Media</option>
                                            <option value="image" {{ $item->type == 'image' ? 'selected' : '' }}>Gambar</option>
                                            <option value="video" {{ $item->type == 'video' ? 'selected' : '' }}>Video</option>
                                            <option value="link" {{ $item->type == 'link' ? 'selected' : '' }}>Pautan</option>
                                            <option value="text" {{ $item->type == 'text' ? 'selected' : '' }}>Teks</option>
                                        </select>
                                        <label for="type{{ $item->id }}"><i class="fas fa-file-alt me-2"></i>Jenis Media</label>
                                    </div>

                                    <!-- File Upload -->
                                    <div class="mb-3" id="file-upload-group{{ $item->id }}" style="display: {{ $item->type == 'image' ? 'block' : 'none' }};">
                                        <label for="file{{ $item->id }}" class="form-label"><i class="fas fa-upload me-2"></i>Muatnaik Fail Baru (Opsional)</label>
                                        <input type="file" name="file" id="file{{ $item->id }}" class="form-control">
                                        @if($item->file_path)
                                        <small class="text-muted">Fail sedia ada: {{ basename($item->file_path) }}</small>
                                        @endif
                                    </div>

                                    <!-- External Link -->
                                    <div class="form-floating mb-3" id="external-link-group{{ $item->id }}" style="display: {{ in_array($item->type, ['video', 'link']) ? 'block' : 'none' }};">
                                        <input type="url" name="external_link" id="external_link{{ $item->id }}" class="form-control" placeholder="https://example.com" value="{{ $item->external_link }}">
                                        <label for="external_link{{ $item->id }}"><i class="fas fa-link me-2"></i>Pautan</label>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            function toggleFields {
                                                {
                                                    $item - > id
                                                }
                                            }() {
                                                var typeElement = document.getElementById('type{{ $item->id }}');
                                                if (!typeElement) return;

                                                var type = typeElement.value;
                                                var fileGroup = document.getElementById('file-upload-group{{ $item->id }}');
                                                var linkGroup = document.getElementById('external-link-group{{ $item->id }}');

                                                if (fileGroup) fileGroup.style.display = (type === 'image') ? 'block' : 'none';
                                                if (linkGroup) linkGroup.style.display = (type === 'video' || type === 'link') ? 'block' : 'none';
                                            }

                                            var typeSelect {
                                                {
                                                    $item - > id
                                                }
                                            } = document.getElementById('type{{ $item->id }}');
                                            if (typeSelect {
                                                    {
                                                        $item - > id
                                                    }
                                                }) {
                                                typeSelect {
                                                    {
                                                        $item - > id
                                                    }
                                                }.addEventListener('change', toggleFields {
                                                    {
                                                        $item - > id
                                                    }
                                                });
                                                // Initial call to set correct state
                                                toggleFields {
                                                    {
                                                        $item - > id
                                                    }
                                                }();
                                            }
                                        });
                                    </script>

                                    <!-- Tags -->
                                    <div class="form-floating mb-3">
                                        <input type="text" name="tags" id="tags{{ $item->id }}" class="form-control" placeholder="e.g. promo, facebook" value="{{ $item->tags }}">
                                        <label for="tags{{ $item->id }}"><i class="fas fa-tags me-2"></i>Tag</label>
                                    </div>

                                    <!-- Target Platform -->
                                    <div class="mb-3">
                                        <label for="platform{{ $item->id }}" class="form-label"><i class="fas fa-share-alt me-2"></i>Platform Sasaran</label>
                                        @php
                                        $selectedPlatforms = is_array($item->platform) ? $item->platform : json_decode($item->platform, true) ?? [];
                                        @endphp
                                        <select name="platform[]" id="platform{{ $item->id }}" class="form-select" multiple>
                                            <option value="facebook" {{ in_array('facebook', $selectedPlatforms) ? 'selected' : '' }}>Facebook</option>
                                            <option value="instagram" {{ in_array('instagram', $selectedPlatforms) ? 'selected' : '' }}>Instagram</option>
                                            <option value="whatsapp" {{ in_array('whatsapp', $selectedPlatforms) ? 'selected' : '' }}>WhatsApp</option>
                                            <option value="tiktok" {{ in_array('tiktok', $selectedPlatforms) ? 'selected' : '' }}>TikTok</option>
                                            <option value="telegram" {{ in_array('telegram', $selectedPlatforms) ? 'selected' : '' }}>Telegram</option>
                                        </select>
                                        <div class="form-text">Tekan Ctrl (Cmd pada Mac) untuk memilih lebih daripada 1.</div>
                                    </div>

                                    <!-- Location -->
                                    <div class="mb-3">
                                        <label class="form-label"><i class="fas fa-map-marker-alt me-2"></i>Lokasi</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="location" id="location_kupd{{ $item->id }}" value="kupd" {{ $item->location == 'kupd' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="location_kupd{{ $item->id }}">
                                                Kolej UNITI Port Dickson
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="location" id="location_kukb{{ $item->id }}" value="kukb" {{ $item->location == 'kukb' ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="location_kukb{{ $item->id }}">
                                                Kolej UNITI Kota Bahru
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Publish Toggle -->
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_published" id="is_published{{ $item->id }}" {{ $item->status_id == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_published{{ $item->id }}">Papar Sekarang</label>
                                    </div>

                                    <!-- Start Date -->
                                    <div class="form-floating mb-3">
                                        <input type="date" name="start_date" id="start_date{{ $item->id }}" class="form-control" placeholder="Start date" value="{{ $item->start_date }}">
                                        <label for="start_date{{ $item->id }}"><i class="fas fa-calendar-alt me-2"></i>Tarikh Mula</label>
                                    </div>

                                    <!-- End Date -->
                                    <div class="form-floating mb-3">
                                        <input type="date" name="end_date" id="end_date{{ $item->id }}" class="form-control" placeholder="End date" value="{{ $item->end_date }}">
                                        <label for="end_date{{ $item->id }}"><i class="fas fa-calendar-check me-2"></i>Tarikh Tamat</label>
                                    </div>

                                    <!-- Submit -->
                                    <div class="d-grid mt-4">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-save me-2"></i>Kemaskini Kandungan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>

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