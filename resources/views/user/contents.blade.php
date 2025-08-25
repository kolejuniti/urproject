@extends('layouts.user')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <h1 class="my-4">Kandungan Media</h1>
    <div class="row g-4">
    @foreach ($contents as $item)
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">

                    {{-- Image --}}
                    @if($item->file_path && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $item->file_path))
                        <img src="{{ url('/image-proxy?url=' . urlencode($item->file_path)) }}" 
                            alt="{{ $item->title }}" 
                            class="img-fluid rounded mb-3"
                            style="object-fit: cover; height: 220px; width: 100%;">

                        <div class="btn-group mb-3">
                            <button id="copyBtn" class="btn btn-sm btn-primary" 
                                onclick="copyImage('{{ url('/image-proxy?url=' . urlencode($item->file_path)) }}')">
                                <i class="bi bi-clipboard"></i> Copy Image
                            </button>

                            <button class="btn btn-sm btn-success" 
                                onclick="downloadImage('{{ url('/image-proxy?url=' . urlencode($item->file_path)) }}', '{{ $item->title }}.jpg')">
                                <i class="bi bi-download"></i> Download
                            </button>
                        </div>
                    @endif

                    {{-- YouTube Embed & URL --}}
                    @if(strtolower($item->type) === 'video' && $item->external_link)
                    @php
                        // Convert YouTube link to embed format
                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $item->external_link, $matches);
                        $youtubeId = $matches[1] ?? null;
                    @endphp

                    @if($youtubeId)
                        <div class="ratio ratio-16x9 mb-2">
                            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allowfullscreen></iframe>
                        </div>
                        <div class="mb-2 row align-items-center">
                            <label class="col-auto col-form-label fw-bold">URL</label>
                            <div class="col">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="url-input-{{ $loop->index }}" value="{{ $item->external_link }}" readonly>
                                    <button class="btn btn-outline-secondary" type="button" onclick="copyInputValue('url-input-{{ $loop->index }}')">
                                        <i class="bi bi-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <script>
                        function copyInputValue(id) {
                            var input = document.getElementById(id);
                            input.select();
                            input.setSelectionRange(0, 99999); // For mobile devices
                            document.execCommand("copy");
                            alert("URL copied!");
                        }
                        </script>
                    @endif
                @endif

                    {{-- Title + Description --}}
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

// Detect clipboard support on page load
document.addEventListener("DOMContentLoaded", async () => {
    let copyBtn = document.getElementById("copyBtn");

    if (!(navigator.clipboard && window.ClipboardItem)) {
        copyBtn.innerHTML = '<i class="bi bi-clipboard"></i> Copy URL';
        copyBtn.dataset.mode = "url";
    } else {
        // Check permission status
        try {
            const result = await navigator.permissions.query({ name: "clipboard-write" });
            if (result.state === "denied") {
                copyBtn.innerHTML = '<i class="bi bi-clipboard"></i> Copy URL';
                copyBtn.dataset.mode = "url";
            }
        } catch (err) {
            // Some browsers (Brave, Safari) may not fully support query()
            copyBtn.innerHTML = '<i class="bi bi-clipboard"></i> Copy URL';
            copyBtn.dataset.mode = "url";
        }
    }
});

// Copy image to clipboard
async function copyImage(url) {
    let copyBtn = document.getElementById("copyBtn");

    try {
        const response = await fetch(url, { mode: "cors" });
        const blob = await response.blob();

        let finalBlob = blob;

        // Convert non-PNG to PNG for better compatibility
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
            new ClipboardItem({ "image/png": finalBlob })
        ]);

        alert("Image copied to clipboard!");
    } catch (err) {
        console.warn("Image copy failed, fallback to URL:", err);
        try {
            await navigator.clipboard.writeText(url);
            alert("Image URL copied to clipboard!");
        } catch {
            alert("Copy failed. Clipboard not supported.");
        }
    }
}

// Download image (force download via proxy route)
function downloadImage(url, filename) {
    const link = document.createElement('a');
    link.href = url + '&download=1';   // force "Content-Disposition: attachment"
    link.setAttribute('download', filename || 'image.jpg');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
@endsection