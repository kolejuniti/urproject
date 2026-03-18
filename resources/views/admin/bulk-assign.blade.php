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
                        Jumlah Data Masuk KUPD menunggu agihan: <strong>{{ $pendingCountKupd }}</strong><br>
                        Jumlah Data Masuk KUKB menunggu agihan: <strong>{{ $pendingCountKukb }}</strong>
                    </p>

                    <form method="POST" action="{{ route('admin.assign.bulk') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="location_id" class="form-label">Pilih lokasi</label>
                            <select id="location_id" name="location_id" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="1">KUPD - Kolej UNITI Port Dickson</option>
                                <option value="2">KUKB - Kolej UNITI Kota Bharu</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="return confirm('Teruskan agihan pelajar secara bulk?');">
                            Jalankan Agihan
                        </button>
                    </form>
                </div>
            </div>

            @if(isset($duplicatesByIc) && $duplicatesByIc->count())
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Data Duplikat Mengikut IC</h5>
                        <form id="bulk-delete-form" method="POST" action="{{ route('admin.students.bulk-delete') }}" onsubmit="return confirm('Padam semua data pelajar yang dipilih?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">Delete Selected</button>
                        </form>
                    </div>
                    @php
                        $locationLabels = [
                            1 => 'KUPD',
                            2 => 'KUKB',
                        ];
                    @endphp
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 40px;">
                                        <input type="checkbox" id="select-all-duplicates">
                                    </th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>No. Kad Pengenalan</th>
                                    <th>Tarikh & Masa</th>
                                    <th>Lokasi</th>
                                    <th>Tarikh Agihan</th>
                                    <th>Education Advisor</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($duplicatesByIc as $item)
                                    @continue(empty($item->ic))
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="student_ids[]" value="{{ $item->id }}" form="bulk-delete-form" class="duplicate-checkbox">
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name ?? '-' }}</td>
                                        <td>{{ $item->ic }}</td>
                                        <td>{{ $item->created_at ?? '-' }}</td>
                                        <td>{{ $locationLabels[$item->location_id ?? null] ?? $item->location ?? '-' }}</td>
                                        <td>{{ $item->updated_at ?? '-' }}</td>
                                        <td>{{ $item->advisor_name ?? $item->advisor ?? '-' }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.students.delete', $item->id) }}" onsubmit="return confirm('Padam data pelajar ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var selectAll = document.getElementById('select-all-duplicates');
        if (!selectAll) return;

        selectAll.addEventListener('change', function () {
            var checkboxes = document.querySelectorAll('.duplicate-checkbox');
            checkboxes.forEach(function (cb) {
                cb.checked = selectAll.checked;
            });
        });
    })();
</script>
@endpush
