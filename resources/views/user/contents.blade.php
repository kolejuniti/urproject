@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row g-4">
        @foreach ($contents as $item)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">

                        {{-- Image --}}
                        @if($item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                            <img src="{{ asset($item->file_path) }}" 
                                alt="{{ $item->title }}" 
                                class="img-fluid mb-3" 
                                style="max-height: 200px; object-fit: cover;">

                            <div class="btn-group mb-3">
                                <button class="btn btn-sm btn-primary" onclick="copyImage('{{ asset($item->file_path) }}')">
                                    <i class="bi bi-clipboard"></i> Copy Image
                                </button>
                                <a href="{{ asset($item->file_path) }}" class="btn btn-sm btn-success" download>
                                    <i class="bi bi-download"></i> Download
                                </a>
                            </div>
                        @else
                            <img src="{{ asset('images/placeholder.png') }}" 
                                alt="No image" 
                                class="img-fluid mb-3" 
                                style="max-height: 200px; object-fit: cover;">
                        @endif

                        {{-- Title + Description --}}
                        @php
                            $textContent = $item->title . "\n\n" . $item->description;
                        @endphp
                        <textarea id="text-{{ $loop->index }}" class="form-control mb-2" rows="4" readonly>{{ $textContent }}</textarea>
                        <button class="btn btn-sm btn-outline-secondary" onclick="copyText('text-{{ $loop->index }}')">
                            <i class="bi bi-clipboard"></i> Copy Text
                        </button>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>

{{-- Copy Functions --}}


<script>
function copyText(id) {
    var copyText = document.getElementById(id);
    copyText.select();
    document.execCommand("copy");
    alert("Text copied!");
}

async function copyImage(url) {
    if (navigator.clipboard && window.ClipboardItem) {
        try {
            const response = await fetch(url, { mode: 'cors' });
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

            alert('Image copied to clipboard!');
        } catch (err) {
            console.error('Copy image failed:', err);
            window.open(url, '_blank'); // fallback
        }
    } else {
        window.open(url, '_blank');
    }
}

function downloadImage(url, filename) {
    fetch(url, { mode: 'cors' })
        .then(response => response.blob())
        .then(blob => {
            const blobUrl = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = blobUrl;
            link.download = filename || 'download.jpg';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(blobUrl);
        })
        .catch(err => {
            console.error('Download failed:', err);
            window.open(url, '_blank'); // fallback
        });
}
</script>
@endsection
