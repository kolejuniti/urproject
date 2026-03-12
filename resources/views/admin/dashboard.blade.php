@extends('layouts.admin')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
    :root {
        --admin-primary: #0f172a;
        /* Slate 900 */
        --admin-secondary: #3b82f6;
        /* Blue 500 */
        --admin-accent: #0ea5e9;
        /* Sky 500 */
        --admin-accent-hover: #0284c7;
        --admin-success: #10b981;
        --admin-warning: #f59e0b;
        --admin-danger: #ef4444;
        --admin-bg: #f8fafc;
        --admin-card-bg: #ffffff;
        --admin-border: #e2e8f0;
        --admin-text: #1e293b;
        --admin-text-muted: #64748b;
        --admin-gradient-1: linear-gradient(135deg, var(--admin-primary), var(--admin-accent));
        --admin-gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --admin-gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        --admin-gradient-4: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    body {
        font-family: 'Outfit', sans-serif;
        background: var(--admin-bg);
        color: var(--admin-text);
    }

    .admin-dashboard {
        padding: 2rem 0;
    }

    /* Header Styling */
    .dashboard-header {
        background: var(--admin-gradient-1);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.2);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: -20px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .dashboard-header h2 {
        font-weight: 700;
        font-size: 2rem;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .dashboard-header p {
        margin: 0.5rem 0 0 0;
        opacity: 0.9;
        font-weight: 300;
        position: relative;
        z-index: 1;
    }

    /* Modern Card Styling */
    .modern-card {
        background: var(--admin-card-bg);
        border-radius: 20px;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .modern-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .card-header-modern {
        background: #f8fafc;
        color: var(--admin-primary);
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        font-size: 1.1rem;
        border-bottom: 1px solid var(--admin-border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-header-modern i {
        margin-right: 0.75rem;
        font-size: 1.2rem;
        color: var(--admin-secondary);
        background: #eff6ff;
        padding: 8px;
        border-radius: 8px;
    }

    .card-body-modern {
        padding: 1.5rem;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.25rem;
        border: 1px solid var(--admin-border);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--admin-accent);
        transition: width 0.3s ease;
    }

    .stat-card:hover::before {
        width: 6px;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .stat-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--admin-text-muted);
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--admin-primary);
        line-height: 1;
    }

    /* Info Cards Grid */
    .info-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid var(--admin-border);
        height: 100%;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .info-card h6 {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--admin-text-muted);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--admin-border);
    }

    .info-card .list-group-item {
        border: none;
        border-bottom: 1px solid #f1f5f9;
        padding: 0.75rem 0;
        background: transparent;
    }

    .info-card .list-group-item:last-child {
        border-bottom: none;
    }

    .info-card .list-group-item span:first-child {
        color: var(--admin-text-muted);
        font-weight: 500;
    }

    .info-card .list-group-item span:last-child {
        color: var(--admin-primary);
        font-weight: 700;
    }

    /* Chart Container */
    .chart-container {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 1.5rem;
        border: 1px solid var(--admin-border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    /* Year Selector */
    .year-selector {
        min-width: 140px;
    }

    .year-selector .form-select {
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        padding: 0.5rem 1rem;
        font-weight: 600;
        color: var(--admin-primary);
        background-color: white;
        transition: all 0.3s ease;
    }

    .year-selector .form-select:focus {
        border-color: var(--admin-accent);
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    /* Table Styling */
    .modern-table {
        margin: 0;
    }

    .modern-table thead {
        background: #f8fafc;
    }

    .modern-table thead th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: var(--admin-text-muted);
        border-bottom: 2px solid var(--admin-border);
        padding: 1rem;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
    }

    .modern-table tbody tr:hover {
        background: #f8fafc;
    }

    .modern-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: var(--admin-text);
        border-bottom: 1px solid #f1f5f9;
    }

    /* Divider */
    .section-divider {
        border: none;
        height: 2px;
        background: linear-gradient(to right, transparent, var(--admin-border), transparent);
        margin: 2rem 0;
    }

    /* Badge Styling */
    .badge-modern {
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
        }

        .dashboard-header h2 {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }
    }

    /* Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modern-card {
        animation: fadeInUp 0.5s ease-out;
    }
</style>

<div class="container-fluid admin-dashboard">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Dashboard Header -->
            <div class="dashboard-header">
                <h2><i class="fas fa-chart-line me-2"></i>Dashboard Pentadbir</h2>
                <p>Selamat datang, {{ $user->name }}! Berikut adalah ringkasan sistem anda.</p>
            </div>

            <!-- Student Registrations by Month -->
            <div class="modern-card mb-4">
                <div class="card-header-modern">
                    <div>
                        <i class="fas fa-chart-bar"></i>
                        Jumlah Data Masuk Mengikut Bulan
                    </div>
                    <div class="year-selector">
                        <form method="GET" action="{{ route('admin.dashboard') }}">
                            <select name="year" class="form-select form-select-sm" onchange="this.form.submit()">
                                @for ($year = now()->year; $year >= now()->year - 3; $year--)
                                <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body-modern">
                    <!-- KUPD Monthly Stats -->
                    <div class="stats-grid">
                        @foreach ($monthlyStatsKUPD as $stat)
                        <div class="stat-card">
                            <div class="stat-label">{{ $stat['month_number'] }}/{{ $currentYear }}</div>
                            <div class="stat-value">{{ $stat['count'] }}</div>
                        </div>
                        @endforeach
                    </div>

                    <!-- KUPD Chart Container -->
                    <div class="chart-container">
                        <div style="position: relative; height: 400px; width: 100%;">
                            <canvas id="chartKUPD"></canvas>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const ctx = document.getElementById('chartKUPD').getContext('2d');
                            const rawData = @json($monthlyStatsKUPD);
                            const labels = rawData.map(item => item.month_name);
                            const dataCounts = rawData.map(item => item.count);

                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                            type: 'line',
                                            label: 'Trend Data Masuk',
                                            data: dataCounts,
                                            borderColor: '#3b82f6',
                                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                            borderWidth: 3,
                                            tension: 0.4,
                                            pointBackgroundColor: '#fff',
                                            pointBorderColor: '#3b82f6',
                                            pointRadius: 6,
                                            pointHoverRadius: 8,
                                            fill: true,
                                            order: 1
                                        },
                                        {
                                            type: 'bar',
                                            label: 'Jumlah Data Masuk',
                                            data: dataCounts,
                                            backgroundColor: 'rgba(99, 102, 241, 0.8)',
                                            borderColor: 'rgba(79, 70, 229, 1)',
                                            borderWidth: 0,
                                            borderRadius: 8,
                                            barPercentage: 0.7,
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
                                                    family: "'Outfit', sans-serif",
                                                    size: 13,
                                                    weight: '600'
                                                }
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Analisis Data Masuk KUPD (Kolej UNITI Port Dickson)',
                                            font: {
                                                size: 18,
                                                family: "'Outfit', sans-serif",
                                                weight: '700'
                                            },
                                            padding: {
                                                bottom: 30
                                            },
                                            color: '#1e293b'
                                        },
                                        tooltip: {
                                            backgroundColor: 'rgba(30, 41, 59, 0.95)',
                                            titleColor: '#fff',
                                            bodyColor: '#e2e8f0',
                                            borderColor: '#475569',
                                            borderWidth: 1,
                                            padding: 12,
                                            usePointStyle: true,
                                            titleFont: {
                                                size: 14,
                                                weight: '600'
                                            },
                                            bodyFont: {
                                                size: 13
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grid: {
                                                drawBorder: false,
                                                color: '#f1f5f9'
                                            },
                                            ticks: {
                                                precision: 0,
                                                font: {
                                                    family: "'Outfit', sans-serif",
                                                    size: 12
                                                },
                                                color: '#64748b'
                                            }
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            },
                                            ticks: {
                                                font: {
                                                    family: "'Outfit', sans-serif",
                                                    size: 12,
                                                    weight: '500'
                                                },
                                                color: '#64748b'
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>

                    <hr class="section-divider">

                    <!-- KUKB Monthly Stats -->
                    <div class="stats-grid">
                        @foreach ($monthlyStatsKUKB as $stat)
                        <div class="stat-card">
                            <div class="stat-label">{{ $stat['month_number'] }}/{{ $currentYear }}</div>
                            <div class="stat-value">{{ $stat['count'] }}</div>
                        </div>
                        @endforeach
                    </div>

                    <!-- KUKB Chart Container -->
                    <div class="chart-container">
                        <div style="position: relative; height: 400px; width: 100%;">
                            <canvas id="chartKUKB"></canvas>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const ctx = document.getElementById('chartKUKB').getContext('2d');
                            const rawData = @json($monthlyStatsKUKB);
                            const labels = rawData.map(item => item.month_name);
                            const dataCounts = rawData.map(item => item.count);

                            new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                            type: 'line',
                                            label: 'Trend Data Masuk',
                                            data: dataCounts,
                                            borderColor: '#f59e0b',
                                            backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                            borderWidth: 3,
                                            tension: 0.4,
                                            pointBackgroundColor: '#fff',
                                            pointBorderColor: '#f59e0b',
                                            pointRadius: 6,
                                            pointHoverRadius: 8,
                                            fill: true,
                                            order: 1
                                        },
                                        {
                                            type: 'bar',
                                            label: 'Jumlah Data Masuk',
                                            data: dataCounts,
                                            backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                            borderColor: 'rgba(5, 150, 105, 1)',
                                            borderWidth: 0,
                                            borderRadius: 8,
                                            barPercentage: 0.7,
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
                                                    family: "'Outfit', sans-serif",
                                                    size: 13,
                                                    weight: '600'
                                                }
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Analisis Data Masuk KUKB (Kolej UNITI Kota Bharu)',
                                            font: {
                                                size: 18,
                                                family: "'Outfit', sans-serif",
                                                weight: '700'
                                            },
                                            padding: {
                                                bottom: 30
                                            },
                                            color: '#1e293b'
                                        },
                                        tooltip: {
                                            backgroundColor: 'rgba(30, 41, 59, 0.95)',
                                            titleColor: '#fff',
                                            bodyColor: '#e2e8f0',
                                            borderColor: '#475569',
                                            borderWidth: 1,
                                            padding: 12,
                                            usePointStyle: true,
                                            titleFont: {
                                                size: 14,
                                                weight: '600'
                                            },
                                            bodyFont: {
                                                size: 13
                                            }
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            grid: {
                                                drawBorder: false,
                                                color: '#f1f5f9'
                                            },
                                            ticks: {
                                                precision: 0,
                                                font: {
                                                    family: "'Outfit', sans-serif",
                                                    size: 12
                                                },
                                                color: '#64748b'
                                            }
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            },
                                            ticks: {
                                                font: {
                                                    family: "'Outfit', sans-serif",
                                                    size: 12,
                                                    weight: '500'
                                                },
                                                color: '#64748b'
                                            }
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </div>
            </div>

            <!-- User Link Info -->
            <div class="modern-card mb-4">
                <div class="card-header-modern">
                    <div>
                        <i class="fas fa-database"></i>
                        Maklumat Data Masuk
                    </div>
                </div>
                <div class="card-body-modern">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <h6><i class="fas fa-clock me-2"></i>Data Masuk Terakhir</h6>
                                <ul class="list-group list-group-flush">
                                    @foreach ($lastRegisteredStudents as $location => $date)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $location }}</span>
                                        <span>{{ $date }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <h6><i class="fas fa-calendar-alt me-2"></i>Jumlah Data Masuk ({{ $currentYear }})</h6>
                                <div class="table-responsive">
                                    <table class="modern-table table table-sm table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th>Lokasi</th>
                                                <th class="text-center">EA</th>
                                                <th class="text-center">Affiliate</th>
                                                <th class="text-center">Non</th>
                                                <th class="text-center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($totalRegisteredCurrentYearBreakdown as $location => $counts)
                                            <tr>
                                                <td class="fw-semibold">{{ $location }}</td>
                                                <td class="text-center">{{ $counts['ea'] }}</td>
                                                <td class="text-center">{{ $counts['affiliate'] }}</td>
                                                <td class="text-center">{{ $counts['non'] }}</td>
                                                <td class="text-center fw-bold">{{ $counts['total'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <h6><i class="fas fa-user-check me-2"></i>Jumlah Data Daftar Kolej ({{ $currentYear }})</h6>
                                <div class="table-responsive">
                                    <table class="modern-table table table-sm table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th>Lokasi</th>
                                                <th class="text-center">EA</th>
                                                <th class="text-center">Affiliate</th>
                                                <th class="text-center">Non</th>
                                                <th class="text-center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($totalSuccessRegisteredCurrentYearBreakdown as $location => $counts)
                                            <tr>
                                                <td class="fw-semibold">{{ $location }}</td>
                                                <td class="text-center">{{ $counts['ea'] }}</td>
                                                <td class="text-center">{{ $counts['affiliate'] }}</td>
                                                <td class="text-center">{{ $counts['non'] }}</td>
                                                <td class="text-center fw-bold">{{ $counts['total'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <h6><i class="fas fa-users me-2"></i>Jumlah Data Masuk</h6>
                                <div class="table-responsive">
                                    <table class="modern-table table table-sm table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th>Lokasi</th>
                                                <th class="text-center">EA</th>
                                                <th class="text-center">Affiliate</th>
                                                <th class="text-center">Non</th>
                                                <th class="text-center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($totalRegisteredBreakdown as $location => $counts)
                                            <tr>
                                                <td class="fw-semibold">{{ $location }}</td>
                                                <td class="text-center">{{ $counts['ea'] }}</td>
                                                <td class="text-center">{{ $counts['affiliate'] }}</td>
                                                <td class="text-center">{{ $counts['non'] }}</td>
                                                <td class="text-center fw-bold">{{ $counts['total'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="info-card">
                                <h6><i class="fas fa-graduation-cap me-2"></i>Jumlah Data Daftar Kolej</h6>
                                <div class="table-responsive">
                                    <table class="modern-table table table-sm table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th>Lokasi</th>
                                                <th class="text-center">EA</th>
                                                <th class="text-center">Affiliate</th>
                                                <th class="text-center">Non</th>
                                                <th class="text-center">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($totalSuccessRegisteredBreakdown as $location => $counts)
                                            <tr>
                                                <td class="fw-semibold">{{ $location }}</td>
                                                <td class="text-center">{{ $counts['ea'] }}</td>
                                                <td class="text-center">{{ $counts['affiliate'] }}</td>
                                                <td class="text-center">{{ $counts['non'] }}</td>
                                                <td class="text-center fw-bold">{{ $counts['total'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 5 Students Table -->
            <div class="modern-card">
                <div class="card-header-modern">
                    <div>
                        <i class="fas fa-list-ol"></i>
                        5 Data Masuk Terkini
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="modern-table table table-hover m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Emel</th>
                                    <th>Tarikh Data Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($topStudents as $index => $student)
                                <tr>
                                    <td><span class="badge bg-primary">{{ $index + 1 }}</span></td>
                                    <td class="text-uppercase fw-semibold">{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td><i class="fas fa-calendar me-2 text-muted"></i>{{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        Tiada Data Masuk pelajar.
                                    </td>
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
