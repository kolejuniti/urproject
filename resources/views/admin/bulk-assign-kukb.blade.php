@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-3">Agihan Pelajar KUKB (Bulk)</h2>

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
                        Jumlah pelajar menunggu agihan: <strong>{{ $pendingCount }}</strong>
                    </p>

                    <form method="POST" action="{{ route('admin.assign.kukb') }}">
                        @csrf
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
