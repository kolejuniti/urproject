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

                        <!-- KUPD Chart Container -->
                        <div class="card mt-3 shadow-sm border-0">
                            <div class="card-body">
                                <div style="position: relative; height: 400px; width: 100%;">
                                    <canvas id="chartKUPD"></canvas>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const ctx = document.getElementById('chartKUPD').getContext('2d');

                                // Safely pass PHP data to JavaScript using json_encode
                                const rawData = @json($monthlyStatsKUPD);

                                // Extract labels and data
                                const labels = rawData.map(item => item.month_name);
                                const dataCounts = rawData.map(item => item.count);

                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                                type: 'line',
                                                label: 'Trend Permohonan',
                                                data: dataCounts,
                                                borderColor: '#FF9800', // Orange
                                                backgroundColor: 'rgba(255, 152, 0, 0.2)',
                                                borderWidth: 3,
                                                tension: 0.4, // Smooth curve
                                                pointBackgroundColor: '#fff',
                                                pointBorderColor: '#FF9800',
                                                pointRadius: 5,
                                                pointHoverRadius: 7,
                                                fill: true,
                                                order: 1 // Layer on top
                                            },
                                            {
                                                type: 'bar',
                                                label: 'Jumlah Pemohon',
                                                data: dataCounts,
                                                backgroundColor: 'rgba(70, 130, 180, 0.7)', // Steel Blue
                                                borderColor: 'rgba(70, 130, 180, 1)',
                                                borderWidth: 1,
                                                borderRadius: 5, // Rounded corners for bars
                                                barPercentage: 0.6,
                                                order: 2
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        interaction: {
                                            mode: 'index',
                                            intersect: false,
                                        },
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                                labels: {
                                                    usePointStyle: true,
                                                    padding: 20,
                                                    font: {
                                                        family: "'Nunito', sans-serif",
                                                        size: 12
                                                    }
                                                }
                                            },
                                            title: {
                                                display: true,
                                                text: 'Analisis Permohonan KUPD (Kolej UNITI Port Dickson)',
                                                font: {
                                                    size: 16,
                                                    family: "'Nunito', sans-serif",
                                                    weight: 'bold'
                                                },
                                                padding: {
                                                    bottom: 20
                                                }
                                            },
                                            tooltip: {
                                                backgroundColor: 'rgba(255, 255, 255, 0.9)',
                                                titleColor: '#333',
                                                bodyColor: '#666',
                                                borderColor: '#ddd',
                                                borderWidth: 1,
                                                padding: 10,
                                                usePointStyle: true
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                grid: {
                                                    drawBorder: false,
                                                    color: '#f0f0f0'
                                                },
                                                ticks: {
                                                    precision: 0,
                                                    font: {
                                                        family: "'Nunito', sans-serif"
                                                    }
                                                }
                                            },
                                            x: {
                                                grid: {
                                                    display: false
                                                },
                                                ticks: {
                                                    font: {
                                                        family: "'Nunito', sans-serif"
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
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

                        <!-- KUKB Chart Container -->
                        <div class="card mt-3 shadow-sm border-0">
                            <div class="card-body">
                                <div style="position: relative; height: 400px; width: 100%;">
                                    <canvas id="chartKUKB"></canvas>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                const ctx = document.getElementById('chartKUKB').getContext('2d');

                                // Safely pass PHP data to JavaScript using json_encode
                                const rawData = @json($monthlyStatsKUKB);

                                // Extract labels and data
                                const labels = rawData.map(item => item.month_name);
                                const dataCounts = rawData.map(item => item.count);

                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                                type: 'line',
                                                label: 'Trend Permohonan',
                                                data: dataCounts,
                                                borderColor: '#FF9800', // Orange
                                                backgroundColor: 'rgba(255, 152, 0, 0.2)',
                                                borderWidth: 3,
                                                tension: 0.4, // Smooth curve
                                                pointBackgroundColor: '#fff',
                                                pointBorderColor: '#FF9800',
                                                pointRadius: 5,
                                                pointHoverRadius: 7,
                                                fill: true,
                                                order: 1
                                            },
                                            {
                                                type: 'bar',
                                                label: 'Jumlah Pemohon',
                                                data: dataCounts,
                                                backgroundColor: 'rgba(229, 57, 53, 0.7)', // Red for KUKB
                                                borderColor: 'rgba(183, 28, 28, 1)', // Dark Red
                                                borderWidth: 1,
                                                borderRadius: 5,
                                                barPercentage: 0.6,
                                                order: 2
                                            }
                                        ]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        interaction: {
                                            mode: 'index',
                                            intersect: false,
                                        },
                                        plugins: {
                                            legend: {
                                                position: 'top',
                                                labels: {
                                                    usePointStyle: true,
                                                    padding: 20,
                                                    font: {
                                                        family: "'Nunito', sans-serif",
                                                        size: 12
                                                    }
                                                }
                                            },
                                            title: {
                                                display: true,
                                                text: 'Analisis Permohonan KUKB (Kolej UNITI Kota Bharu)',
                                                font: {
                                                    size: 16,
                                                    family: "'Nunito', sans-serif",
                                                    weight: 'bold'
                                                },
                                                padding: {
                                                    bottom: 20
                                                }
                                            },
                                            tooltip: {
                                                backgroundColor: 'rgba(255, 255, 255, 0.9)',
                                                titleColor: '#333',
                                                bodyColor: '#666',
                                                borderColor: '#ddd',
                                                borderWidth: 1,
                                                padding: 10,
                                                usePointStyle: true
                                            }
                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true,
                                                grid: {
                                                    drawBorder: false,
                                                    color: '#f0f0f0'
                                                },
                                                ticks: {
                                                    precision: 0,
                                                    font: {
                                                        family: "'Nunito', sans-serif"
                                                    }
                                                }
                                            },
                                            x: {
                                                grid: {
                                                    display: false
                                                },
                                                ticks: {
                                                    font: {
                                                        family: "'Nunito', sans-serif"
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });
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
                        <div class="col-md-4 mb-3">
                            <div class="border rounded shadow-sm p-3 bg-white h-100">
                                <h6 class="text-muted mb-3">Permohonan Terakhir</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($lastRegisteredStudents as $location => $date)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                                        <span class="text-muted">{{ $location }}</span>
                                        <span class="fw-semibold">{{ $date }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded shadow-sm p-3 bg-white h-100">
                                <h6 class="text-muted mb-3">Jumlah Permohonan ({{ $currentYear }})</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($totalRegisteredCurrentYear as $location => $count)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                                        <span class="text-muted">{{ $location }}</span>
                                        <span class="fw-semibold">{{ $count }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded shadow-sm p-3 bg-white h-100">
                                <h6 class="text-muted mb-3">Jumlah Permohonan Daftar Kolej ({{ $currentYear }})</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($totalSuccessRegisteredCurrentYear as $location => $count)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                                        <span class="text-muted">{{ $location }}</span>
                                        <span class="fw-semibold">{{ $count }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <div class="border rounded shadow-sm p-3 bg-white h-100">
                                <h6 class="text-muted mb-3">Jumlah Permohonan</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($totalRegistered as $location => $count)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                                        <span class="text-muted">{{ $location }}</span>
                                        <span class="fw-semibold">{{ $count }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="border rounded shadow-sm p-3 bg-white h-100">
                                <h6 class="text-muted mb-3">Jumlah Permohonan Daftar Kolej</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($totalSuccessRegistered as $location => $count)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-3">
                                        <span class="text-muted">{{ $location }}</span>
                                        <span class="fw-semibold">{{ $count }}</span>
                                    </li>
                                    @endforeach
                                </ul>
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