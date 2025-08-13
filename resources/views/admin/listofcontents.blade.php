@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h1 class="mb-4">Content Bank</h1>
    <div class="row g-4">
        @foreach($contents as $content)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $content->title }}</h5>
                        <p class="card-text">{{ $content->description }}</p>

                        {{-- Display based on type --}}
                        @if($content->type === 'image' && $content->file_path)
                            <img src="{{ $content->file_path }}" alt="{{ $content->title }}" class="img-fluid rounded mb-2">
                        @elseif($content->type === 'video' && $content->external_link)
                        @php
                            $videoUrl = $content->external_link;

                            // YouTube Shorts
                            if (preg_match('/youtube\.com\/shorts\/([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
                                $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                                $embedType = 'youtube';
                            }
                            // YouTube normal watch link
                            elseif (preg_match('/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
                                $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                                $embedType = 'youtube';
                            }
                            // YouTube short link (youtu.be)
                            elseif (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
                                $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                                $embedType = 'youtube';
                            }
                            // TikTok video
                            elseif (preg_match('/tiktok\.com\/.*\/video\/(\d+)/', $videoUrl, $matches)) {
                                $tiktokId = $matches[1];
                                $embedType = 'tiktok';
                            }
                        @endphp

                            @if(!empty($embedType) && $embedType === 'youtube')
                                <div class="ratio ratio-16x9 mb-2">
                                    <iframe src="{{ $videoUrl }}" allowfullscreen></iframe>
                                </div>
                            @elseif(!empty($embedType) && $embedType === 'tiktok')
                                <blockquote class="tiktok-embed" cite="{{ $content->external_link }}" data-video-id="{{ $tiktokId }}" style="max-width: 605px; min-width: 325px;">
                                    <section></section>
                                </blockquote>
                                <script async src="https://www.tiktok.com/embed.js"></script>
                            @endif
                        @elseif($content->type === 'link' && $content->external_link)
                            <a href="{{ $content->external_link }}" target="_blank" class="btn btn-primary mb-2">
                                🔗 Visit Link
                            </a>
                        @elseif($content->type === 'text')
                            <div class="p-3 bg-light rounded mb-2">
                                {!! nl2br(e($content->description)) !!}
                            </div>
                        @endif

                        {{-- Tags --}}
                        @if(!empty($content->tags))
                            <p>
                                @foreach(explode(',', $content->tags) as $tag)
                                    <span class="badge bg-secondary">{{ trim($tag) }}</span>
                                @endforeach
                            </p>
                        @endif

                        {{-- Platforms --}}
                        @if(!empty($content->platform) && is_array($content->platform))
                            <div class="mt-2">
                                @php
                                    $shareLinks = [
                                        'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=',
                                        'whatsapp' => 'https://wa.me/?text=',
                                        'telegram' => 'https://t.me/share/url?url=',
                                        'instagram' => '#',
                                        'tiktok' => '#',
                                    ];
                                    $platformColors = [
                                        'facebook' => 'primary',
                                        'instagram' => 'danger',
                                        'whatsapp' => 'success',
                                        'telegram' => 'info',
                                        'tiktok' => 'dark',
                                    ];
                                    $shareContent = $content->file_path ?? $content->external_link ?? '';
                                @endphp
                                @foreach($content->platform as $platform)
                                    <a href="{{ $shareLinks[$platform] }}{{ urlencode($shareContent) }}"
                                       target="_blank"
                                       class="btn btn-sm btn-{{ $platformColors[$platform] ?? 'secondary' }} me-1">
                                        Share on {{ ucfirst($platform) }}
                                    </a>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
