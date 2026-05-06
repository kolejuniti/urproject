@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<style>
    .bg-orange {
        background-color: #fd7e14 !important;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="mb-3">
            <div class="fw-semibold mb-2">Petunjuk Warna Status (Hari Data Direkodkan)</div>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge rounded-pill bg-primary">Tiada Status</span>
                <span class="badge rounded-pill bg-success">&le; 7 Hari</span>
                <span class="badge rounded-pill bg-warning text-dark">8 - 14 Hari</span>
                <span class="badge rounded-pill bg-orange text-white">15 - 21 Hari</span>
                <span class="badge rounded-pill bg-danger">&ge; 22 Hari</span>
            </div>
        </div>
        @php
            $dayClass = function ($days) {
                if ($days === null) {
                    return '';
                }
                $days = (int) $days;
                if ($days === 0) {
                    return '';
                }
                if ($days <= 7) {
                    return 'bg-success text-white';
                }
                if ($days <= 14) {
                    return 'bg-warning text-dark';
                }
                if ($days <= 21) {
                    return 'bg-orange text-white';
                }

                return 'bg-danger text-white';
            };
        @endphp
        @php
            $catatanCounts = collect($applications ?? [])
                ->map(function ($application) {
                    $reason = $application->reason ?? null;
                    $reason = is_string($reason) ? trim($reason) : $reason;

                    return $reason ? strtoupper($reason) : 'TIADA CATATAN';
                })
                ->countBy()
                ->sortDesc();
            $catatanTotal = $catatanCounts->sum();
            $badgePalette = [
                'bg-primary',
                'bg-success',
                'bg-warning text-dark',
                'bg-danger',
                'bg-info text-dark',
                'bg-dark',
                'bg-secondary',
            ];
            $badgeClassFor = function (string $key) use ($badgePalette) {
                $idx = abs((int) crc32($key)) % count($badgePalette);
                return $badgePalette[$idx];
            };
        @endphp
        <div class="mb-3">
            <div class="card">
                <div class="card-header fw-semibold">Ringkasan Catatan</div>
                <div class="card-body">
                    <div class="small text-muted mb-2">Jumlah rekod: {{ $catatanTotal }}</div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($catatanCounts as $catatan => $count)
                            <span class="badge rounded-pill {{ $badgeClassFor((string) $catatan) }}">
                                {{ $catatan }}: {{ $count }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="myTable" class="table table-bordered small table-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Tarikh Data Masuk</th>
                        <th rowspan="2">Tarikh Diagihkan</th>
                        <th rowspan="2">Affiliate</th>
                        <th rowspan="2">Sumber</th>
                        <th rowspan="2">Status Terkini</th>
                        <th rowspan="2">Catatan</th>
                        <th colspan="5" class="text-center">Julat Hari</th>
                    </tr>
                    <tr>
                        <th>Data Proses</th>
                        <th>Pra Pendaftaran</th>
                        <th>Daftar Masuk</th>
                        <th>Daftar Masuk EA Lain</th>
                        <th>Data Ditolak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $item)
                    <tr>
                        <td></td>
                        <td class="text-uppercase">{{ $item->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $item->updated_at ? \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') : '' }}</td>
                        <td class="text-uppercase">{{ $item->affiliate ?? 'TIADA AFFILIATE' }}</td>
                        <td class="text-uppercase">{{ $item->source }}</td>
                        <td class="text-uppercase">{{ $item->status ?? 'PERMOHONAN BARU' }}</td>
                        <td class="text-uppercase">{{ $item->reason ?? '' }}</td>
                        {{-- Group 1: status_id in [7–18] [29-31] --}}
                        @php
                        $isNoStatus = is_null($item->status_id) || (int) $item->status_id === 0;
                        $processStatusIds = array_merge(range(7, 18), range(29, 31));
                        $isProcessStatus = $isNoStatus || in_array((int) $item->status_id, $processStatusIds);
                        $days_process = $isProcessStatus ? $item->days_since_update : 0;
                        $class_process = $isNoStatus ? 'bg-primary text-white' : $dayClass($days_process);

                        $days_pre = $item->status_id === 19 ? $item->days_since_update : 0;
                        $class_pre = $dayClass($days_pre);
                        @endphp
                        <td class="text-center fw-semibold {{ $class_process }}">{{ $days_process }}</td>
                        <td class="text-center fw-semibold {{ $class_pre }}">{{ $days_pre }}</td>
                            {{-- Group 3: status_id in [20, 21, 22] --}}
                            <td class="text-center">
                                {{ in_array($item->status_id, [20, 21]) ? $item->days_since_update : 0 }}
                            </td>
                            {{-- Group 3: status_id in [22] --}}
                            <td class="text-center">
                                {{ $item->status_id === 22 ? $item->days_since_update : 0 }}
                            </td>
                            {{-- Group 4: status_id in [1–5, 24, 26, 27, 32, 33] --}}
                            <td class="text-center">
                                {{ in_array($item->status_id, [1,2,3,4,5,24,26,27,32,33]) ? $item->days_since_update : 0 }}
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
            columnDefs: [{
                targets: ['_all'],
                className: 'dt-head-center'
            }],
            layout: {
                top1Start: {
                    div: {
                        html: '<h2>Pencapaian EA {{ $user->name }}</h2>'
                    }
                },
                top1End: {
                    buttons: [{
                            extend: 'copy',
                            title: 'Pencapaian EA'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Pencapaian EA'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Pencapaian EA'
                        },
                        {
                            extend: 'print',
                            title: 'Pencapaian EA'
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        });
        t.on('order.dt search.dt', function() {
            let i = 1;

            t.cells(null, 0, {
                search: 'applied',
                order: 'applied'
            }).every(function(cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
@endsection
