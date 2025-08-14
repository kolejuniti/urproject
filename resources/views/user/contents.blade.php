@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row g-4">
    @foreach ($contents as $item)
        @php
            $imageUrl = $item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path)
                ? asset($item->file_path)
                : asset('images/placeholder.png');
        @endphp

        <div class="col-md-4">
            <div class="card h-100 shadow-sm">

                <div class="card-body text-center">
                    {{-- Image --}}
                    <img src="{{ $imageUrl }}" alt="{{ $item->title }}" style="max-width: 100%; height: auto;">

                    {{-- Image buttons --}}
                    <div class="mt-2">
                        <button class="btn btn-sm btn-outline-primary" onclick="copyImage('{{ $imageUrl }}')">
                            Copy Image
                        </button>
                        <a href="{{ $imageUrl }}" download class="btn btn-sm btn-outline-success">
                            Download Image
                        </a>
                    </div>

                    {{-- Title + Description in one textarea --}}
                    <textarea id="text-{{ $loop->index }}" class="form-control mt-3" rows="4" readonly>
{{ $item->title }} - {{ $item->description }}
                    </textarea>
                    <button class="btn btn-sm btn-outline-secondary mt-2" onclick="copyText('text-{{ $loop->index }}')">
                        Copy Text
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
    var textarea = document.getElementById(id);
    textarea.select();
    textarea.setSelectionRange(0, 99999); // for mobile
    document.execCommand("copy");
    alert("Text copied!");
}

async function copyImage(url) {
    if (navigator.clipboard && window.ClipboardItem) {
        try {
            const response = await fetch(url, { mode: 'cors' });
            const blob = await response.blob();
            await navigator.clipboard.write([
                new ClipboardItem({ [blob.type]: blob })
            ]);
            alert('Image copied to clipboard!');
        } catch (err) {
            console.error('Copy image failed:', err);
            window.open(url, '_blank'); // fallback
        }
    } else {
        // Fallback if Clipboard API not supported
        window.open(url, '_blank');
    }
}
</script>
@endsection
