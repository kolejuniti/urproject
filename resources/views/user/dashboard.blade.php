@extends('layouts.user')

@section('content')
<div class="container">
    <style>
        .dashboard-card {
            background: #ffffff;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .bg-gradient-primary-soft {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            color: #667eea;
        }

        .bg-gradient-success-soft {
            background: linear-gradient(135deg, rgba(25, 135, 84, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
            color: #198754;
        }

        .bg-gradient-info-soft {
            background: linear-gradient(135deg, rgba(13, 202, 240, 0.1) 0%, rgba(13, 110, 253, 0.1) 100%);
            color: #0dcaf0;
        }

        .bg-gradient-warning-soft {
            background: linear-gradient(135deg, rgba(255, 193, 7, 0.1) 0%, rgba(255, 235, 59, 0.1) 100%);
            color: #d69e2e;
        }

        .section-header {
            position: relative;
            padding-left: 15px;
            margin-bottom: 1.5rem;
            font-weight: 700;
            color: #495057;
        }

        .section-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 5px;
            height: 25px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        .table-custom thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: #6c757d;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e9ecef;
            padding: 15px;
        }

        .table-custom tbody td {
            padding: 15px;
            vertical-align: middle;
            color: #495057;
            border-bottom: 1px solid #f0f0f0;
        }

        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 0.25rem;
            color: #2d3748;
        }

        .stat-label {
            color: #718096;
            font-size: 0.875rem;
            font-weight: 600;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-12">

            <!-- Dashboard Header -->
            <div class="mb-5 d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="fw-bold display-6 mb-1">Hi, <span class="text-gradient">{{ $user->name }}</span>!</h2>
                    <!-- <p class="text-muted lead mb-0" style="font-size: 1.1rem;">Selamat kembali ke papan pemuka anda.</p> -->
                </div>
                <div class="d-none d-md-block">
                    <span class="badge rounded-pill bg-light text-dark p-3 shadow-sm border">
                        <i class="bi bi-calendar3 me-2 text-primary"></i> {{ \Carbon\Carbon::now()->format('d M Y') }}
                    </span>
                </div>
            </div>

            <!-- Main Stats Row -->
            <h5 class="section-header">Prestasi Keseluruhan</h5>
            <div class="row mb-5">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="dashboard-card p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="stat-icon bg-gradient-info-soft">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <span class="badge bg-light text-muted rounded-pill">Data Masuk</span>
                        </div>
                        <h3 class="stat-value">{{ $totalRegistered }}</h3>
                        <p class="stat-label mb-0">Jumlah Data Masuk Melalui Pautan</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="dashboard-card p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="stat-icon bg-gradient-success-soft">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <span class="badge bg-light text-muted rounded-pill">Berjaya</span>
                        </div>
                        <h3 class="stat-value">{{ $totalSuccessRegistered }}</h3>
                        <p class="stat-label mb-0">Jumlah Data Daftar Kolej</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="stat-icon bg-gradient-primary-soft">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <span class="badge bg-light text-muted rounded-pill">Terkini</span>
                        </div>
                        <h3 class="stat-value">{{ $lastRegisteredDate ?? '-' }}</h3>
                        <p class="stat-label mb-0">Tarikh Data Terakhir</p>
                    </div>
                </div>
            </div>

            <!-- Financial Stats Row -->
            <h5 class="section-header">Ringkasan Pendapatan</h5>
            <div class="row mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="dashboard-card p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="stat-icon bg-gradient-warning-soft">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                            <span class="badge bg-light text-muted rounded-pill">Insentif</span>
                        </div>
                        <h3 class="stat-value">RM {{ number_format($totalIncentive, 2) }}</h3>
                        <p class="stat-label mb-0">Jumlah Insentif Diterima</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dashboard-card p-4">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="stat-icon bg-gradient-success-soft">
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <span class="badge bg-light text-muted rounded-pill">Komisen</span>
                        </div>
                        <h3 class="stat-value">RM {{ number_format($totalCommission, 2) }}</h3>
                        <p class="stat-label mb-0">Jumlah Komisen Diterima</p>
                    </div>
                </div>
            </div>

            <!-- Monthly Stats Row -->
            <h5 class="section-header">Statistik Bulanan (3 Bulan Terakhir)</h5>
            <div class="row mb-5">
                @forelse ($monthlyStats as $stat)
                <div class="col-md-4 mb-3">
                    <div class="dashboard-card p-3 border-start border-4 border-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-muted fw-bold mb-1 text-uppercase small">Bulan {{ $stat['month_name'] }}</h6>
                                <h4 class="mb-0 fw-bold">{{ $stat['count'] }} <small class="text-muted fs-6 font-weight-normal">data</small></h4>
                            </div>
                            <div class="text-end text-muted opacity-25">
                                <i class="bi bi-bar-chart-fill fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-light border shadow-sm rounded-3 text-center p-4">
                        Tiada data bulanan untuk dipaparkan.
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Recent Students Table -->
            <div class="row">
                <div class="col-12">
                    <div class="dashboard-card">
                        <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="fw-bold mb-0">5 Data Masuk Terkini</h5>
                                <a href="{{ route('user.application') }}" class="btn btn-sm btn-light border fw-bold text-muted rounded-pill px-3">
                                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0 mt-3">
                            <div class="table-responsive">
                                <table class="table table-custom mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">No.</th>
                                            <th>Nama</th>
                                            <!-- <th>Emel</th> -->
                                            <th class="pe-4 text-end">Tarikh Data Masuk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topStudents as $index => $student)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="badge bg-light text-dark border">{{ $index + 1 }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3 bg-gradient-primary-soft rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; font-weight: bold;">
                                                        {{ substr($student->name, 0, 1) }}
                                                    </div>
                                                    <span class="text-uppercase fw-bold text-dark">{{ $student->name }}</span>
                                                </div>
                                            </td>
                                            <!-- <td>{{ $student->email }}</td> -->
                                            <td class="pe-4 text-end">
                                                <span class="text-muted fw-medium">
                                                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($student->created_at)->format('d-m-Y') }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="bi bi-inbox text-muted mb-2" style="font-size: 2rem;"></i>
                                                    <p class="text-muted mb-0">Tiada rekod data masuk terkini.</p>
                                                </div>
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
    </div>
</div>
@endsection