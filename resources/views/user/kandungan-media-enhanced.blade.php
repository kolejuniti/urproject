@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --danger-gradient: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --card-hover-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .page-header {
        /* background: var(--primary-gradient);
        color: white; */
        padding: 1rem 0;
        /* margin-bottom: 3rem;
        border-radius: 0 0 50px 50px; */
        /* box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3); */
    }

    .page-header h1 {
        font-weight: 700;
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.95;
    }

    .media-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: none;
        height: 100%;
    }

    .media-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--card-hover-shadow);
    }

    .media-image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        background: rgba(0, 0, 0, 0.5);
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
    }

    .media-title {
        font-weight: 700;
        font-size: 1.2rem;
        color: #2d3748;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .action-btn-group {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .action-btn {
        flex: 1;
        min-width: 120px;
        padding: 0.6rem 1rem;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .btn-copy-image {
        background: var(--primary-gradient);
        color: white;
    }

    .btn-copy-image:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-download {
        background: var(--success-gradient);
        color: white;
    }

    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
    }

    .text-content-area {
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem;
        font-size: 0.9rem;
        line-height: 1.6;
        color: #4a5568;
        resize: none;
        transition: all 0.3s ease;
    }

    .text-content-area:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-copy-text {
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 0.5rem;
    }

    .btn-copy-text:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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
        border-left: 4px solid #38ef7d;
    }

    .toast-error {
        border-left: 4px solid #ff6a00;
    }

    .toast-icon {
        font-size: 1.5rem;
    }

    .toast-success .toast-icon {
        color: #38ef7d;
    }

    .toast-error .toast-icon {
        color: #ff6a00;
    }

    /* Video Container */
    .video-container {
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .url-input-group {
        background: #f7fafc;
        border-radius: 12px;
        padding: 0.75rem;
        margin-bottom: 1rem;
    }

    .url-input-group input {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.5rem;
        font-size: 0.9rem;
    }

    .url-input-group button {
        background: var(--primary-gradient);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .url-input-group button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
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

    /* Responsive */
    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .action-btn {
            min-width: 100px;
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem;
        }

        .social-share-buttons {
            grid-template-columns: 1fr;
        }
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
</style>

<div class="page-header">
    <div class="container">
        <h1><i class="bi bi-collection-play"></i> Kandungan Media</h1>
        <p>Kongsi kandungan menarik dengan mudah kepada orang ramai</p>
    </div>
</div>

<div class="container pb-5">
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
                        <i class="bi bi-clipboard-check"></i> Copy Text Content
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
                    {{-- Graphic/Icon for when video link is not YouTube --}}
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
                        <i class="bi bi-clipboard-check"></i> Copy Text Content
                    </button>
                </div>
                @endif

            </div>
        </div>
        @endforeach
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>

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

    // Initialize Bootstrap tooltips if needed
    document.addEventListener('DOMContentLoaded', function() {
        // Any initialization code here
        console.log('Media content page loaded successfully!');
    });
</script>

@endsection