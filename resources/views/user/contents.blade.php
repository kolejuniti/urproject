@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row g-4">
        @foreach ($contents as $item)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ $item->file_path }}" class="card-img-top" alt="Content Image">

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->description }}</p>

                        <button onclick="copyImage('{{ $item->file_path }}')" class="btn btn-primary btn-sm">
                            <i class="bi bi-clipboard"></i> Copy Image
                        </button>

                        <button onclick="downloadImage('{{ $item->file_path }}', 'UNITI-Content.jpg')" class="btn btn-success btn-sm">
                            <i class="bi bi-download"></i> Download
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
    try {
        const response = await fetch(url, { mode: 'cors' });
        const blob = await response.blob();

        // Ensure Clipboard API is supported
        if (!navigator.clipboard || !window.ClipboardItem) {
            alert('Clipboard API not supported in this browser.');
            return;
        }

        await navigator.clipboard.write([
            new ClipboardItem({ [blob.type]: blob })
        ]);

        console.log('Image copied to clipboard');
        alert('Image copied!');
    } catch (err) {
        console.error('Copy image failed:', err);
        alert('Failed to copy image.');
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
