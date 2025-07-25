@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Dashboard Header -->
            <h2 class="mb-4">Hi {{ $user->name }},</h2>

            <!-- Student Registrations by Month -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header" style="background-color: #4682b4; color: white; font-weight: bold;">Jumlah Pemohon Mengikut Bulan</div>
                <div class="card-body" style="background-color: #e7f1f9;">
                    <div class="d-flex justify-content-end mb-3">
                        <div style="min-width: 120px;">
                            <form method="GET" action="{{ route('admin.dashboard') }}">
                                <div class="input-group">
                                    <select name="year" class="form-select" onchange="this.form.submit()">
                                        @for ($year = now()->year; $year >= now()->year - 3; $year--)
                                            <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row text-center">
                        @foreach ($monthlyStatsKUPD as $stat)
                            <div class="col-md-1 mb-2">
                                <div class="bg-light border rounded p-3 shadow-sm">
                                    <h6 class="text-muted">{{ $stat['month_number'] }}/{{ $currentYear }}</h6>
                                    <div class="fs-5 fw-bold">{{ $stat['count'] }}</div>
                                </div>
                            </div>
                        @endforeach
                        <canvas id="monthlyApplicantsChartKUPD" height="200"></canvas>
                        <script>
                            const ctxKUPD = document.getElementById('monthlyApplicantsChartKUPD').getContext('2d');

                            const chartKUPD = new Chart(ctxKUPD, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        @foreach ($monthlyStatsKUPD as $stat)
                                            '{{ $stat["month_name"] }}',
                                        @endforeach
                                    ],
                                    datasets: [
                                        {
                                            type: 'line',
                                            label: 'Jumlah Pemohon',
                                            data: [
                                                @foreach ($monthlyStatsKUPD as $stat)
                                                    {{ $stat["count"] }},
                                                @endforeach
                                            ],
                                            borderColor: '#ff9800',
                                            backgroundColor: 'rgba(255,152,0,0.2)',
                                            borderWidth: 2,
                                            fill: false,
                                            tension: 0.3,
                                            pointBackgroundColor: '#ff9800'
                                        },
                                        {
                                            type: 'bar',
                                            label: 'Jumlah Pemohon',
                                            data: [
                                                @foreach ($monthlyStatsKUPD as $stat)
                                                    {{ $stat["count"] }},
                                                @endforeach
                                            ],
                                            backgroundColor: '#4682b4',
                                            borderColor: '#2c6491',
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        },
                                        title: {
                                            display: true,
                                            text: 'Graf Jumlah Pemohon KUPD',
                                            font: {
                                                size: 18
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                precision:0
                                            }
                                        }
                                    }
                                }
                            });
                        </script>

                        <hr class="my-4">

                        @foreach ($monthlyStatsKUKB as $stat)
                            <div class="col-md-1 mb-2">
                                <div class="bg-light border rounded p-3 shadow-sm">
                                    <h6 class="text-muted">{{ $stat['month_number'] }}/{{ $currentYear }}</h6>
                                    <div class="fs-5 fw-bold">{{ $stat['count'] }}</div>
                                </div>
                            </div>
                        @endforeach
                        <canvas id="monthlyApplicantsChartKUKB" height="200"></canvas>
                        <script>
                            const ctxKUKB = document.getElementById('monthlyApplicantsChartKUKB').getContext('2d');

                            const chartKUKB = new Chart(ctxKUKB, {
                                type: 'bar',
                                data: {
                                    labels: [
                                        @foreach ($monthlyStatsKUKB as $stat)
                                            '{{ $stat["month_name"] }}',
                                        @endforeach
                                    ],
                                    datasets: [
                                        {
                                            type: 'line',
                                            label: 'Jumlah Pemohon',
                                            data: [
                                                @foreach ($monthlyStatsKUKB as $stat)
                                                    {{ $stat["count"] }},
                                                @endforeach
                                            ],
                                            borderColor: '#ff9800',
                                            backgroundColor: 'rgba(255,152,0,0.2)',
                                            borderWidth: 2,
                                            fill: false,
                                            tension: 0.3,
                                            pointBackgroundColor: '#ff9800'
                                        },
                                        {
                                            type: 'bar',
                                            label: 'Jumlah Pemohon',
                                            data: [
                                                @foreach ($monthlyStatsKUKB as $stat)
                                                    {{ $stat["count"] }},
                                                @endforeach
                                            ],
                                            backgroundColor: '#e53935',
                                            borderColor: '#b71c1c',
                                            borderWidth: 1
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    plugins: {
                                        legend: {
                                            display: false
                                        },
                                        title: {
                                            display: true,
                                            text: 'Graf Jumlah Pemohon KUKB',
                                            font: {
                                                size: 18
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                precision:0
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
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
                                <h6 class="text-muted">Jumlah Permohonan ({{ $currentYear }})</h6>
                                <div class="fs-5 fw-bold">{{ $totalRegisteredCurrentYear }}</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="bg-light border rounded p-3 shadow-sm">
                                <h6 class="text-muted">Jumlah Permohonan Daftar Kolej ({{ $currentYear }})</h6>
                                <div class="fs-5 fw-bold">{{ $totalSuccessRegisteredCurrentYear }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
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
