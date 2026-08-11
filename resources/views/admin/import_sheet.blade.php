@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --admin-primary: #0f172a;
        --admin-secondary: #3b82f6;
        --admin-accent: #0ea5e9;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
        --admin-bg: #f8fafc;
        --admin-card-bg: #ffffff;
        --admin-text-main: #334155;
        --admin-text-muted: #64748b;
        --admin-border: #e2e8f0;
    }

    body {
        font-family: 'Outfit', sans-serif;
        background-color: var(--admin-bg);
        color: var(--admin-text-main);
    }

    .import-container {
        padding: 2rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .admin-card {
        background: var(--admin-card-bg);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        border: 1px solid var(--admin-border);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .admin-card-header {
        background: linear-gradient(to right, var(--admin-primary), #1e293b);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .admin-card-header h2 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .admin-card-header i {
        font-size: 1.5rem;
        color: var(--admin-accent);
    }

    .admin-card-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--admin-text-main);
    }

    .file-upload-wrapper {
        position: relative;
        width: 100%;
        height: 150px;
        border: 2px dashed var(--admin-border);
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: var(--admin-bg);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-upload-wrapper:hover {
        border-color: var(--admin-accent);
        background-color: #f0f9ff;
    }

    .file-upload-wrapper i {
        font-size: 3rem;
        color: var(--admin-text-muted);
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .file-upload-wrapper:hover i {
        color: var(--admin-accent);
        transform: translateY(-5px);
    }

    .file-upload-wrapper input[type="file"] {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        opacity: 0;
        cursor: pointer;
    }

    .file-upload-text {
        font-weight: 500;
        color: var(--admin-text-main);
    }

    .file-upload-hint {
        font-size: 0.875rem;
        color: var(--admin-text-muted);
        margin-top: 0.5rem;
    }

    .btn-admin {
        background: linear-gradient(135deg, var(--admin-secondary), var(--admin-accent));
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        width: 100%;
        justify-content: center;
    }

    .btn-admin:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
    }

    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #ef4444;
    }

    .info-box {
        background-color: #f0fdf4;
        border-left: 4px solid var(--admin-success);
        padding: 1rem;
        border-radius: 0 8px 8px 0;
        margin-bottom: 1.5rem;
    }

    .info-box h4 {
        color: #166534;
        margin-top: 0;
        margin-bottom: 0.5rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-box ul {
        margin: 0;
        padding-left: 1.5rem;
        color: #15803d;
        font-size: 0.9rem;
    }

    .file-name-display {
        margin-top: 1rem;
        font-weight: 600;
        color: var(--admin-secondary);
        display: none;
    }
</style>

<div class="import-container">
    <div class="admin-card">
        <div class="admin-card-header">
            <i class="fas fa-file-excel"></i>
            <h2>Import Students Data</h2>
        </div>
        
        <div class="admin-card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="info-box">
                <h4><i class="fas fa-info-circle"></i> Import Guidelines</h4>
                <ul>
                    <li>Only students with status <strong>BERMINAT</strong> will be imported.</li>
                    <li>Existing IC numbers will be <strong>skipped</strong> to prevent duplicates.</li>
                    <li>Required columns: <code>nama</code>, <code>no. kp</code>, <code>no. telefon</code>, <code>email</code>, <code>kod rujukan</code>, <code>status</code>.</li>
                </ul>
            </div>

            <form action="{{ route('admin.import_students.process') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Upload Excel or CSV File</label>
                    <div class="file-upload-wrapper" id="upload-wrapper">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span class="file-upload-text">Drag and drop file here or click to browse</span>
                        <span class="file-upload-hint">Supported formats: .xlsx, .xls, .csv</span>
                        <input type="file" name="file" id="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required onchange="showFileName()">
                    </div>
                    <div id="file-name-display" class="file-name-display">
                        <i class="fas fa-file-alt"></i> <span id="file-name"></span>
                    </div>
                    @error('file')
                        <span style="color: var(--admin-danger); font-size: 0.875rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-admin">
                    <i class="fas fa-file-import"></i> Extract & Import Data
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function showFileName() {
        const input = document.getElementById('file');
        const display = document.getElementById('file-name-display');
        const nameSpan = document.getElementById('file-name');
        const wrapper = document.getElementById('upload-wrapper');
        
        if (input.files && input.files.length > 0) {
            nameSpan.textContent = input.files[0].name;
            display.style.display = 'block';
            wrapper.style.borderColor = 'var(--admin-success)';
            wrapper.querySelector('i').style.color = 'var(--admin-success)';
        } else {
            display.style.display = 'none';
            wrapper.style.borderColor = 'var(--admin-border)';
            wrapper.querySelector('i').style.color = 'var(--admin-text-muted)';
        }
    }
</script>
@endsection
