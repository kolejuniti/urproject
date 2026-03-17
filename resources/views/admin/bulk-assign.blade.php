@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-3">Agihan Pelajar (Bulk)</h2>

            @if(session('msg_error'))
            <div class="alert alert-danger">
                {{ session('msg_error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <p class="mb-3">
                        KUPD menunggu agihan: <strong>{{ $pendingCountKupd }}</strong><br>
                        KUKB menunggu agihan: <strong>{{ $pendingCountKukb }}</strong>
                    </p>

                    <form method="POST" action="{{ route('admin.assign.bulk') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="location_id" class="form-label">Pilih lokasi</label>
                            <select id="location_id" name="location_id" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">KUPD</option>
                                <option value="2">KUKB</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="return confirm('Teruskan agihan pelajar secara bulk?');">
                            Jalankan Agihan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
