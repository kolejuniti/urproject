@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
        --admin-bg: #f8fafc;
        --admin-card-bg: #ffffff;
        --admin-border: #e2e8f0;
        --admin-text: #1e293b;
        --admin-text-muted: #64748b;
        --admin-gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --admin-gradient-2: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --admin-gradient-3: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--admin-bg);
        color: var(--admin-text);
    }

    .admin-media-page {
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

    /* Media Cards */
    .media-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid var(--admin-border);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .media-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .media-image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: var(--admin-gradient-1);
        cursor: pointer;
    }

    .media-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .media-image-container:hover img {
        transform: scale(1.1);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .media-image-container:hover .image-overlay {
        opacity: 1;
    }

    .image-overlay i {
        font-size: 3rem;
        color: white;
    }

    .media-card-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .media-title {
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--admin-primary);
        margin-bottom: 0.75rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .media-description {
        color: var(--admin-text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    /* Info Labels */
    .info-section {
        margin-bottom: 0.75rem;
    }

    .info-label {
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--admin-text-muted);
        display: block;
        margin-bottom: 0.25rem;
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

    /* Action Buttons */
    .action-btn-group {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
        margin-top: auto;
    }

    .action-btn {
        flex: 1;
        min-width: 120px;
        padding: 0.65rem 1rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
        color: white;
    }

    .btn-copy-image {
        background: var(--admin-accent);
    }

    .btn-copy-image:hover {
        background: var(--admin-accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
    }

    .btn-download {
        background: var(--admin-success);
    }

    .btn-download:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
    }

    /* Text Content Area */
    .text-content-area {
        background: #f8fafc;
        border: 1px solid var(--admin-border);
        border-radius: 10px;
        padding: 1rem;
        font-size: 0.875rem;
        line-height: 1.6;
        color: var(--admin-text);
        resize: none;
        transition: all 0.3s ease;
        font-family: 'Inter', sans-serif;
    }

    .text-content-area:focus {
        outline: none;
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .btn-copy-text {
        width: 100%;
        background: var(--admin-gradient-1);
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 0.5rem;
    }

    .btn-copy-text:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    /* Video Container */
    .video-container {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .url-input-group {
        background: #f8fafc;
        border-radius: 10px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border: 1px solid var(--admin-border);
    }

    .url-input-group input {
        background: white;
        border: 1px solid var(--admin-border);
        border-radius: 8px;
        padding: 0.5rem;
        font-size: 0.875rem;
    }

    .url-input-group .btn {
        border-radius: 8px;
        font-weight: 600;
    }

    /* Toast Notification */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .custom-toast {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        min-width: 300px;
        animation: slideIn 0.3s ease;
        border: 1px solid var(--admin-border);
    }

    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .toast-success {
        border-left: 4px solid var(--admin-success);
    }

    .toast-error {
        border-left: 4px solid var(--admin-danger);
    }

    .toast-icon {
        font-size: 1.5rem;
    }

    .toast-success .toast-icon {
        color: var(--admin-success);
    }

    .toast-error .toast-icon {
        color: var(--admin-danger);
    }

    /* Image Preview Modal */
    .image-preview-modal .modal-dialog {
        max-width: 90vw;
    }

    .image-preview-modal .modal-content {
        background: transparent;
        border: none;
    }

    .image-preview-modal .modal-body {
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-preview-modal img {
        max-width: 100%;
        max-height: 90vh;
        border-radius: 12px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .image-preview-modal .btn-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: white;
        opacity: 1;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        z-index: 10;
    }

    /* Loading Animation */
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: white;
        animation: spin 0.6s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
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

    .media-card {
        animation: fadeInUp 0.5s ease-out;
    }

    /* Platform Badges */
    .bg-facebook {
        background: #1877f2 !important;
        color: white !important;
    }

    .bg-instagram {
        background: #e4405f !important;
        color: white !important;
    }

    .bg-whatsapp {
        background: #25d366 !important;
        color: white !important;
    }

    .bg-telegram {
        background: #0088cc !important;
        color: white !important;
    }

    .bg-tiktok {
        background: #000000 !important;
        color: white !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header h2 {
            font-size: 1.75rem;
        }

        .action-btn {
            min-width: 100px;
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem;
        }
    }
</style>

<div class="container-fluid admin-media-page">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="page-header">
                <h2><i class="bi bi-collection-play me-2"></i>Bahan Media</h2>
            </div>

            <div class="row g-4">
                @foreach ($contents as $item)
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="media-card">

                        {{-- Image Section --}}
                        @if($item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                        <div class="media-image-container" onclick="previewImage('{{ url('/image-proxy?url=' . urlencode($item->file_path)) }}', {{ json_encode($item->title) }})">
                            <img src="{{ url('/image-proxy?url=' . urlencode($item->file_path)) }}"
                                alt="{{ $item->title }}"
                                loading="lazy">
                            <div class="image-overlay">
                                <i class="bi bi-zoom-in"></i>
                            </div>
                        </div>

                        <div class="media-card-body">
                            <h5 class="media-title">{{ $item->title }}</h5>
                            <p class="media-description">{{ Str::limit($item->description, 100) }}</p>

                            {{-- Tags --}}
                            @if($item->tags)
                            <div class="info-section">
                                <span class="info-label">Tag</span>
                                <span class="badge badge-modern bg-secondary text-white">
                                    <i class="fas fa-tag me-1"></i>{{ $item->tags }}
                                </span>
                            </div>
                            @endif

                            {{-- Location --}}
                            @if($item->location)
                            <div class="info-section">
                                <span class="info-label">Lokasi</span>
                                @if($item->location == 'kupd')
                                <span class="badge badge-kupd">
                                    <i class="fas fa-map-marker-alt me-1"></i>KUPD - Kolej UNITI Port Dickson
                                </span>
                                @elseif($item->location == 'kukb')
                                <span class="badge badge-kukb">
                                    <i class="fas fa-map-marker-alt me-1"></i>KUKB - Kolej UNITI Kota Bahru
                                </span>
                                @endif
                            </div>
                            @endif

                            {{-- Platform badges --}}
                            @php
                            $platforms = is_array($item->platform) ? $item->platform : json_decode($item->platform, true);
                            @endphp
                            @if(!empty($platforms))
                            <div class="info-section">
                                <span class="info-label">Platform</span>
                                <div>
                                    @foreach($platforms as $p)
                                    <span class="badge badge-modern bg-{{ $p }}">
                                        <i class="fab fa-{{ $p }} me-1"></i>{{ ucfirst($p) }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <div class="action-btn-group">
                                <button class="action-btn btn-copy-image"
                                    onclick="copyImage('{{ url('/image-proxy?url=' . urlencode($item->file_path)) }}', this)">
                                    <i class="bi bi-clipboard"></i>
                                    <span>Copy Image</span>
                                </button>

                                <button class="action-btn btn-download"
                                    onclick="downloadImage('{{ url('/image-proxy?url=' . urlencode($item->file_path)) }}', {{ json_encode($item->title . '.jpg') }})">
                                    <i class="bi bi-download"></i>
                                    <span>Download</span>
                                </button>
                            </div>

                            @php
                            $textContent = $item->title
                            . "\n\n"
                            . $item->description
                            . "\n\n"
                            . "Sekiranya anda berminat menyambung pelajaran, Kolej UNITI menawarkan peluang pendidikan berkualiti untuk masa depan yang lebih cemerlang."
                            . "\n\n"
                            . "Daftar melalui pautan rasmi: " . $url
                            . "\n\n"
                            . $item->tags;
                            @endphp
                            <textarea id="text-{{ $loop->index }}" class="form-control text-content-area" rows="5" readonly>{{ $textContent }}</textarea>
                            <button class="btn-copy-text" onclick="copyText('text-{{ $loop->index }}')">
                                <i class="bi bi-clipboard-check me-2"></i>Copy Text Content
                            </button>
                        </div>
                        @endif

                        {{-- YouTube/Video Section --}}
                        @if(strtolower($item->type) === 'video' && $item->external_link)
                        @php
                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $item->external_link, $matches);
                        $youtubeId = $matches[1] ?? null;
                        @endphp

                        <div class="media-card-body">
                            <h5 class="media-title">{{ $item->title }}</h5>
                            <p class="media-description">{{ Str::limit($item->description, 100) }}</p>

                            {{-- Tags --}}
                            @if($item->tags)
                            <div class="info-section">
                                <span class="info-label">Tag</span>
                                <span class="badge badge-modern bg-secondary text-white">
                                    <i class="fas fa-tag me-1"></i>{{ $item->tags }}
                                </span>
                            </div>
                            @endif

                            {{-- Location --}}
                            @if($item->location)
                            <div class="info-section">
                                <span class="info-label">Lokasi</span>
                                @if($item->location == 'kupd')
                                <span class="badge badge-kupd">
                                    <i class="fas fa-map-marker-alt me-1"></i>KUPD - Kolej UNITI Port Dickson
                                </span>
                                @elseif($item->location == 'kukb')
                                <span class="badge badge-kukb">
                                    <i class="fas fa-map-marker-alt me-1"></i>KUKB - Kolej UNITI Kota Bahru
                                </span>
                                @endif
                            </div>
                            @endif

                            {{-- Platform badges --}}
                            @php
                            $platforms = is_array($item->platform) ? $item->platform : json_decode($item->platform, true);
                            @endphp
                            @if(!empty($platforms))
                            <div class="info-section">
                                <span class="info-label">Platform</span>
                                <div>
                                    @foreach($platforms as $p)
                                    <span class="badge badge-modern bg-{{ $p }}">
                                        <i class="fab fa-{{ $p }} me-1"></i>{{ ucfirst($p) }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if($youtubeId)
                            <div class="video-container">
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                        title="YouTube video player"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                            @else
                            <div class="video-container bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <div class="text-center">
                                    <i class="bi bi-play-circle-fill text-danger display-1"></i>
                                    <p class="mt-2 text-muted small">Video External</p>
                                </div>
                            </div>
                            @endif

                            <div class="url-input-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="url-input-{{ $loop->index }}" value="{{ $item->external_link }}" readonly>
                                    <button type="button" class="btn btn-outline-secondary" onclick="copyInputValue('url-input-{{ $loop->index }}')" title="Copy URL">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                    <a href="{{ $item->external_link }}" target="_blank" class="btn btn-primary" title="Open Video">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                </div>
                            </div>

                            @php
                            $textContent = $item->title
                            . "\n\n"
                            . $item->description
                            . "\n\n"
                            . "Sekiranya anda berminat menyambung pelajaran, Kolej UNITI menawarkan peluang pendidikan berkualiti untuk masa depan yang lebih cemerlang."
                            . "\n\n"
                            . "Daftar melalui pautan rasmi: " . $url
                            . "\n\n"
                            . $item->tags;
                            @endphp
                            <textarea id="text-video-{{ $loop->index }}" class="form-control text-content-area" rows="5" readonly>{{ $textContent }}</textarea>
                            <button class="btn-copy-text" onclick="copyText('text-video-{{ $loop->index }}')">
                                <i class="bi bi-clipboard-check me-2"></i>Copy Text Content
                            </button>
                        </div>
                        @endif

                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

{{-- Toast Container --}}
<div class="toast-container" id="toastContainer"></div>

{{-- Image Preview Modal --}}
<div class="modal fade image-preview-modal" id="imagePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            <div class="modal-body">
                <img id="previewImage" src="" alt="Preview">
            </div>
        </div>
    </div>
</div>

<script>
    // Toast Notification Function
    function showToast(message, type = 'success') {
        const toastContainer = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = `custom-toast toast-${type}`;

        const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill';

        toast.innerHTML = `
        <i class="bi ${icon} toast-icon"></i>
        <div>
            <strong>${type === 'success' ? 'Success!' : 'Error!'}</strong>
            <div>${message}</div>
        </div>
    `;

        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideIn 0.3s ease reverse';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // Copy Text Function
    function copyText(id) {
        const copyText = document.getElementById(id);
        copyText.select();
        copyText.setSelectionRange(0, 99999);

        try {
            document.execCommand("copy");
            showToast('Text content copied to clipboard!', 'success');
        } catch (err) {
            showToast('Failed to copy text', 'error');
        }
    }

    // Copy Image Function
    async function copyImage(url, button) {
        const originalContent = button.innerHTML;
        button.innerHTML = '<span class="loading-spinner"></span> Copying...';
        button.disabled = true;

        try {
            const response = await fetch(url, {
                mode: "cors"
            });
            const blob = await response.blob();

            let finalBlob = blob;

            if (blob.type !== "image/png") {
                const imgBitmap = await createImageBitmap(blob);
                const canvas = document.createElement("canvas");
                canvas.width = imgBitmap.width;
                canvas.height = imgBitmap.height;
                const ctx = canvas.getContext("2d");
                ctx.drawImage(imgBitmap, 0, 0);
                finalBlob = await new Promise(resolve => canvas.toBlob(resolve, "image/png"));
            }

            await navigator.clipboard.write([
                new ClipboardItem({
                    "image/png": finalBlob
                })
            ]);

            showToast('Image copied to clipboard!', 'success');
        } catch (err) {
            console.warn("Image copy failed, fallback to URL:", err);
            try {
                await navigator.clipboard.writeText(url);
                showToast('Image URL copied to clipboard!', 'success');
            } catch {
                showToast('Failed to copy image', 'error');
            }
        } finally {
            button.innerHTML = originalContent;
            button.disabled = false;
        }
    }

    // Download Image Function
    function downloadImage(url, filename) {
        const link = document.createElement('a');
        link.href = url + '&download=1';
        link.setAttribute('download', filename || 'image.jpg');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showToast('Download started!', 'success');
    }

    // Copy Input Value Function
    function copyInputValue(id) {
        const input = document.getElementById(id);
        input.select();
        input.setSelectionRange(0, 99999);

        try {
            document.execCommand("copy");
            showToast('URL copied to clipboard!', 'success');
        } catch (err) {
            showToast('Failed to copy URL', 'error');
        }
    }

    // Image Preview Function
    function previewImage(url, title) {
        const modalElement = document.getElementById('imagePreviewModal');
        const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
        document.getElementById('previewImage').src = url;
        document.getElementById('previewImage').alt = title;
        modal.show();
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Media content page loaded successfully!');
    });
</script>

@endsection