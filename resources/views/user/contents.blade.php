@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --card-hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        --border-radius: 16px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .page-header {
        background: var(--primary-gradient);
        color: white;
        padding: 3rem 0;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        animation: float 20s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }

    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        padding: 0 1rem;
    }

    .content-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        overflow: hidden;
        transition: var(--transition);
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .content-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--card-hover-shadow);
    }

    .card-image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
        background: linear-gradient(45deg, #f0f2f5, #e2e8f0);
    }

    .card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: var(--transition);
    }

    .content-card:hover .card-image {
        transform: scale(1.05);
    }

    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.1) 100%);
        opacity: 0;
        transition: var(--transition);
    }

    .content-card:hover .image-overlay {
        opacity: 1;
    }

    .card-content {
        padding: 2rem;
    }

    .content-textarea {
        background: rgba(248, 250, 252, 0.8);
        border: 2px solid rgba(226, 232, 240, 0.8);
        border-radius: 12px;
        padding: 1rem;
        font-size: 0.9rem;
        line-height: 1.6;
        resize: none;
        transition: var(--transition);
        font-family: inherit;
    }

    .content-textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 0.9);
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .btn-modern {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }

    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: var(--transition);
    }

    .btn-modern:hover::before {
        left: 100%;
    }

    .btn-copy {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-copy:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-download {
        background: var(--success-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
    }

    .btn-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
        color: white;
    }

    .btn-copy-text {
        background: rgba(99, 102, 241, 0.1);
        color: #6366f1;
        border: 2px solid rgba(99, 102, 241, 0.2);
        width: 100%;
        justify-content: center;
    }

    .btn-copy-text:hover {
        background: rgba(99, 102, 241, 0.2);
        border-color: rgba(99, 102, 241, 0.3);
        transform: translateY(-1px);
        color: #6366f1;
    }

    .placeholder-image {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
        color: #64748b;
        font-size: 1.2rem;
    }

    .stats-bar {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 1rem 2rem;
        margin-bottom: 2rem;
        border-radius: var(--border-radius);
        box-shadow: var(--card-shadow);
        text-align: center;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: #667eea;
        margin: 0;
    }

    .stats-label {
        color: #64748b;
        font-size: 0.9rem;
        margin: 0;
    }

    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    .toast {
        position: fixed;
        top: 20px;
        right: 20px;
        background: rgba(34, 197, 94, 0.95);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.3);
        transform: translateX(400px);
        transition: var(--transition);
        z-index: 1000;
        backdrop-filter: blur(10px);
    }

    .toast.show {
        transform: translateX(0);
    }

    .toast.error {
        background: rgba(239, 68, 68, 0.95);
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
    }

    @media (max-width: 768px) {
        .content-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .card-content {
            padding: 1.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title">Content Gallery</h1>
                <p class="page-subtitle">Discover, copy, and download amazing content</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Stats Bar -->
    <div class="stats-bar">
        <div class="stats-number">{{ count($contents) }}</div>
        <div class="stats-label">Total Content Items</div>
    </div>

    <!-- Content Grid -->
    <div class="content-grid">
        @foreach ($contents as $item)
            <div class="content-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Image Section -->
                <div class="card-image-container">
                    @if($item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                        <img src="{{ asset($item->file_path) }}" 
                             alt="{{ $item->title }}" 
                             class="card-image"
                             loading="lazy">
                        <div class="image-overlay"></div>
                        
                        <!-- Image Action Buttons -->
                        <div class="action-buttons" style="position: absolute; bottom: 1rem; left: 1rem; right: 1rem;">
                            <button class="btn-modern btn-copy flex-1" onclick="copyImage('{{ asset($item->file_path) }}')">
                                <i class="bi bi-clipboard"></i>
                                Copy Image
                            </button>
                            <button class="btn-modern btn-download flex-1" onclick="downloadImage('{{ asset($item->file_path) }}', '{{ $item->title }}.jpg')">
                                <i class="bi bi-download"></i>
                                Download
                            </button>
                        </div>
                    @else
                        <div class="placeholder-image">
                            <div class="text-center">
                                <i class="bi bi-image" style="font-size: 3rem; opacity: 0.5;"></i>
                                <div style="margin-top: 0.5rem; opacity: 0.7;">No image available</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Content Section -->
                <div class="card-content">
                    @php
                        $textContent = $item->title 
                            . "\n\n" 
                            . $item->description 
                            . "\n\n" 
                            . "Sekiranya berminat mendaftar / belajar di Kolej UNITI, sila layari: " . $url 
                            . "\n\n" 
                            . $item->tags;
                    @endphp
                    
                    <textarea id="text-{{ $loop->index }}" 
                              class="content-textarea" 
                              rows="5" 
                              readonly>{{ $textContent }}</textarea>
                    
                    <div class="action-buttons">
                        <button class="btn-modern btn-copy-text" onclick="copyText('text-{{ $loop->index }}')">
                            <i class="bi bi-clipboard"></i>
                            Copy Text Content
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Toast Notification -->
<div id="toast" class="toast">
    <div id="toast-message"></div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

<script>
// Initialize AOS animations
AOS.init({
    duration: 600,
    easing: 'ease-out-cubic',
    once: true
});

// Toast notification system
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    
    toastMessage.textContent = message;
    toast.className = `toast ${type} show`;
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// Enhanced copy text function
function copyText(id) {
    const copyText = document.getElementById(id);
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
    
    try {
        document.execCommand("copy");
        showToast("Text copied to clipboard!", "success");
    } catch (err) {
        showToast("Failed to copy text", "error");
    }
    
    // Add visual feedback
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="bi bi-check"></i> Copied!';
    button.style.background = 'rgba(34, 197, 94, 0.2)';
    button.style.color = '#22c55e';
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.style.background = '';
        button.style.color = '';
    }, 2000);
}

// Enhanced copy image function
async function copyImage(url) {
    if (navigator.clipboard && window.ClipboardItem) {
        try {
            showToast("Processing image...", "success");
            
            const response = await fetch(url, { mode: 'cors' });
            if (!response.ok) throw new Error('Failed to fetch image');
            
            const blob = await response.blob();

            // Convert to PNG if not PNG
            let finalBlob = blob;
            if (blob.type !== 'image/png') {
                const imgBitmap = await createImageBitmap(blob);
                const canvas = document.createElement('canvas');
                canvas.width = imgBitmap.width;
                canvas.height = imgBitmap.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(imgBitmap, 0, 0);
                finalBlob = await new Promise(resolve => canvas.toBlob(resolve, 'image/png'));
            }

            await navigator.clipboard.write([
                new ClipboardItem({ 'image/png': finalBlob })
            ]);

            showToast("Image copied to clipboard!", "success");
        } catch (err) {
            console.error('Copy image failed:', err);
            showToast("Failed to copy image", "error");
            window.open(url, '_blank');
        }
    } else {
        showToast("Clipboard not supported, opening image", "error");
        window.open(url, '_blank');
    }
}

// Enhanced download function
function downloadImage(url, filename) {
    showToast("Starting download...", "success");
    
    fetch(url, { mode: 'cors' })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();
        })
        .then(blob => {
            const blobUrl = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = blobUrl;
            link.download = filename || 'image.jpg';
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(blobUrl);
            
            showToast("Download started!", "success");
        })
        .catch(err => {
            console.error('Download failed:', err);
            showToast("Download failed, opening in new tab", "error");
            
            const link = document.createElement('a');
            link.href = url;
            link.download = filename || 'image.jpg';
            link.target = '_blank';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
}

// Add loading states and smooth interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth loading for images
    const images = document.querySelectorAll('.card-image');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
    });
    
    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'c') {
            const focusedTextarea = document.activeElement;
            if (focusedTextarea.tagName === 'TEXTAREA') {
                copyText(focusedTextarea.id);
            }
        }
    });
});
</script>

@endsection