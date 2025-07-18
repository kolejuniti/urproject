@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Dashboard Header -->
            <h2 class="mb-4">Hi {{ $user->name }},</h2>

            <!-- Student Registrations by Month -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header" style="background-color: #4682b4; color: white; font-weight: bold;">Jumlah Pemohon (3 Bulan Terakhir)</div>
                <div class="card-body" style="background-color: #e7f1f9;">
                    <div class="row text-center">
                        @foreach ($monthlyStats as $stat)
                            <div class="col-md-4 mb-2">
                                <div class="bg-light border rounded p-3 shadow-sm">
                                    <h6 class="text-muted">Bulan {{ $stat['month_number'] }} ({{ $stat['month_name'] }})</h6>
                                    <div class="fs-5 fw-bold">{{ $stat['count'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- User Link Info Styled Like Monthly Cards -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header" style="background-color: #4682b4; color: white; font-weight: bold;">Maklumat Permohonan</div>
                <div class="card-body" style="background-color: #e7f1f9;">
                    <div class="row text-center">
                        <div class="col-md-4 mb-2">
                            <div class="bg-light border rounded p-3 shadow-sm">
                                <h6 class="text-muted">Permohonan Terakhir</h6>
                                <div class="fs-5 fw-bold">{{ $lastRegisteredDate }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="bg-light border rounded p-3 shadow-sm">
                                <h6 class="text-muted">Jumlah Permohonan</h6>
                                <div class="fs-5 fw-bold">{{ $totalRegistered }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="bg-light border rounded p-3 shadow-sm">
                                <h6 class="text-muted">Jumlah Permohonan Daftar Kolej</h6>
                                <div class="fs-5 fw-bold">{{ $totalSuccessRegistered }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 5 Students Table -->
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #4682b4; color: white; font-weight: bold;">
                    5 Pemohon Terkini
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Emel</th>
                                    <th>Tarikh Permohonan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topStudents as $index => $student)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="text-uppercase">{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Tiada permohonan pelajar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
