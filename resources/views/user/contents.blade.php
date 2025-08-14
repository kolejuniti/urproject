@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row g-4">
    @foreach ($contents as $index => $item)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">

                    {{-- Image with Copy Image & Download --}}
                    @if($item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                        <img src="{{ asset($item->file_path) }}" 
                            class="card-img-top" 
                            alt="{{ $item->title }}" 
                            style="object-fit: cover; height: 200px;">

                        <div class="mt-2 d-flex gap-2">
                            <!-- Copy Button -->
                            <button class="btn btn-sm btn-outline-primary"
                                id="copy-img-btn-{{ $loop->index }}"
                                onclick="copyImageToClipboard('{{ url('/image-proxy') }}?url={{ urlencode($item->file_path) }}', 'copy-img-btn-{{ $loop->index }}')">
                                📋 Copy Image
                            </button>

                            <!-- Download Button -->
                            <a href="{{ url('/image-proxy') }}?url={{ urlencode($item->file_path) }}&download=1" 
                            class="btn btn-sm btn-outline-success">
                                ⬇ Download
                            </a>
                        </div>
                    @endif

                    {{-- Combined Title & Description --}}
                    <label class="fw-bold">Content:</label>
                    <textarea id="content_text_{{ $index }}" class="form-control mb-2" rows="4" readonly>{{ $item->title }}

{{ $item->description }}</textarea>
                    <button class="btn btn-sm btn-outline-primary" 
                            id="copy-content-btn-{{ $index }}" 
                            onclick="copyInputValue('content_text_{{ $index }}','copy-content-btn-{{ $index }}')">
                        📋 Copy
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
function copyInputValue(inputId, btnId) {
    var copyField = document.getElementById(inputId);
    copyField.select();
    document.execCommand("copy");

    var btn = document.getElementById(btnId);
    var originalHTML = btn.innerHTML;
    btn.innerHTML = '✔';
    setTimeout(() => btn.innerHTML = originalHTML, 1500);
}

function copyImageToClipboard(url, btnId) {
    fetch(url)
        .then(res => res.blob())
        .then(blob => {
            const item = new ClipboardItem({ [blob.type]: blob });
            return navigator.clipboard.write([item]);
        })
        .then(() => {
            let btn = document.getElementById(btnId);
            let originalHTML = btn.innerHTML;
            btn.innerHTML = '✔ Copied!';
            setTimeout(() => btn.innerHTML = originalHTML, 1500);
        })
        .catch(err => {
            alert("Copy image failed: " + err);
            console.error(err);
        });
}

function downloadFile(url) {
    fetch(url)
        .then(res => res.blob())
        .then(blob => {
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            const ext = blob.type.split('/')[1] || 'png';
            link.download = `image.${ext}`;
            link.click();
        });
}
</script>
@endsection
