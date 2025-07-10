@extends('layouts.admin')

@section('content')
<div class="container py-4">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-header">{{ __('Maklumat Kandungan Media') }}</div>

        <div class="card-body">
            <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <!-- Title -->
                <div class="form-floating mb-2">
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" required value="{{ old('title') }}">
                    <label for="title">Tajuk</label>
                </div>

                <!-- Description -->
                <div class="form-floating mb-2">
                    <textarea name="description" id="description" class="form-control" style="height: 100px;" placeholder="Description" required>{{ old('description') }}</textarea>
                    <label for="description">Keterangan</label>
                </div>

                <!-- Content Type -->
                <div class="form-floating mb-2">
                    <select name="type" id="type" class="form-control" required>
                        <option value="">Pilihan Jenis Media</option>
                        <option value="image">Gambar</option>
                        <option value="video">Video</option>
                        <option value="link">Pautan</option>
                        <option value="text">Teks</option>
                    </select>
                    <label for="type">Jenis Media</label>
                </div>

                <!-- File Upload (no form-floating for file inputs) -->
                <div class="mb-2">
                    <label for="file" class="form-label">Muatnaik Fail</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>

                <!-- External Link -->
                <div class="form-floating mb-2">
                    <input type="url" name="external_link" id="external_link" class="form-control" placeholder="https://example.com" value="{{ old('external_link') }}">
                    <label for="external_link">Pautan</label>
                </div>

                <!-- Tags -->
                <div class="form-floating mb-2">
                    <input type="text" name="tags" id="tags" class="form-control" placeholder="e.g. promo, facebook" value="{{ old('tags') }}">
                    <label for="tags">Tag</label>
                </div>

                <!-- Target Platform (no form-floating for multi-selects) -->
                <div class="mb-2">
                    <label for="platform" class="form-label">Platform Sasaran</label>
                    <select name="platform[]" id="platform" class="form-select" multiple>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="tiktok">TikTok</option>
                        <option value="telegram">Telegram</option>
                    </select>
                    <div class="form-text">Tekan Ctrl (Cmd pada Mac) untuk memilih lebih daripada 1.</div>
                </div>

                <!-- Publish Toggle -->
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" name="is_published" id="is_published" checked>
                    <label class="form-check-label" for="is_published">Papar Sekarang</label>
                </div>

                <!-- Start Date -->
                <div class="form-floating mb-2">
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Start date" value="{{ old('start_date') }}">
                    <label for="start_date">Tarikh Mula</label>
                </div>

                <!-- End Date -->
                <div class="form-floating mb-2">
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End date" value="{{ old('end_date') }}">
                    <label for="end_date">Tarikh Tamat</label>
                </div>

                <!-- Submit -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">
                        Muat Naik Kandungan
                    </button>
                </div>
            </form>
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
