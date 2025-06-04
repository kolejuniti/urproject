@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="col-md-8 col-sm-8 col-12 ms-auto">
                <form method="POST" action="{{ route('admin.leadreports') }}">
                @csrf
                    <div class="input-group mb-3">
                        <button class="btn btn-secondary" disabled>Tarikh</button>
                        <input type="date" class="form-control" name="start_date" required>
                        <button class="btn btn-secondary" disabled>-</button>
                        <input type="date" class="form-control" name="end_date" required>
                        <button class="btn btn-secondary" disabled>Lokasi</button>
                        <select name="location" id="location" class="form-control" required>
                            <option value="">Pilihan Lokasi</option>
                            @foreach ($locations as $item)
                                <option value="{{ $item->id }}">{{ $item->code }}</option>
                            @endforeach
                            <option value="3">KUPD & KUKB</option>
                        </select>
                        <button class="btn btn-warning" type="submit">Cari</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    @if ($start_date === null)
                    @else
                    <caption>Laporan yang dijana adalah bagi lokasi {{ $location_name }} bertarikh {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '' }} sehingga {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '' }}</caption>
                    @endif
                    <thead class="table-dark">
                        <tr>
                           <th colspan="11" class="text-end">
                                <label>
                                        <input type="checkbox" id="hideKolejbtmCheckbox">&nbsp;Tidak termasuk DATA KOLEJBTM
                                </label>
                            </th> 
                        </tr>
                        <tr>
                            <th rowspan="3">#</th>
                            <th rowspan="3">Sumber</th>
                            <th rowspan="3">Jumlah Data</th>
                            <th class="text-center" colspan="2">Data Masuk</th>
                            <th class="text-center" colspan="4">Pendaftaran</th>
                            <th rowspan="3">Data Ditolak</th>
                            <th rowspan="3">Baki Data</th>
                          </tr>
                          <tr>
                            <th rowspan="2">Melalui Affiliate</th>
                            <th rowspan="2">Tanpa Affiliate</th>
                            <th colspan="2" class="text-center">Pra Pendaftaran</th>
                            <th colspan="2" class="text-center">Daftar Kolej</th>
                          </tr>
                          <tr>
                            <th>Melalui Affiliate</th>
                            <th>Tanpa Affiliate</th>
                            <th>Melalui Affiliate</th>
                            <th>Tanpa Affiliate</th>
                          </tr>
                    </thead>
                    <tbody>
                        @foreach ($sources as $item)
                        @php
                            $source = $item->source;
                            $total = $totalData[$source] ?? 0;
                            $withAffiliate = $totalDataWithAffiliate[$source] ?? 0;
                            $withoutAffiliate = $totalDataWithoutAffiliate[$source] ?? 0;
                            $preWithAff = $totalDataPreRegisterWithAffiliate[$source] ?? 0;
                            $preWithoutAff = $totalDataPreRegisterWithoutAffiliate[$source] ?? 0;
                            $regWithAff = $totalDataRegisterWithAffiliate[$source] ?? 0;
                            $regWithoutAff = $totalDataRegisterWithoutAffiliate[$source] ?? 0;
                            $reject = $totalDataRejects[$source] ?? 0;
                        @endphp
                        <tr data-source="{{ $source }}"
                            data-total="{{ $total }}"
                            data-aff="{{ $withAffiliate }}"
                            data-noaff="{{ $withoutAffiliate }}"
                            data-preaff="{{ $preWithAff }}"
                            data-prenoaff="{{ $preWithoutAff }}"
                            data-regaff="{{ $regWithAff }}"
                            data-regnoaff="{{ $regWithoutAff }}"
                            data-reject="{{ $reject }}">
                            <td></td>
                            <td class="text-uppercase">{{ $source }}</td>
                            <td class="text-center">{{ $total }}</td>
                            <td class="text-center">{{ $withAffiliate }}</td>
                            <td class="text-center">{{ $withoutAffiliate }}</td>
                            <td class="text-center">{{ $preWithAff }}</td>
                            <td class="text-center">{{ $preWithoutAff }}</td>
                            <td class="text-center">{{ $regWithAff }}</td>
                            <td class="text-center">{{ $regWithoutAff }}</td>
                            <td class="text-center">{{ $reject }}</td>
                            <td class="text-center">{{ $total - $reject }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-danger">
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">Jumlah Keseluruhan</th>
                        <th rowspan="2" class="text-center"><span id="total-count">{{ $totalDataCount }}</span></th>
                        <th class="text-center"><span id="aff-count">{{ $totalDataWithAffiliateCount }}</span></th>
                        <th class="text-center"><span id="noaff-count">{{ $totalDataWithoutAffiliateCount }}</span></th>
                        <th class="text-center"><span id="preaff-count">{{ $totalDataPreRegisterWithAffiliateCount }}</span></th>
                        <th class="text-center"><span id="prenoaff-count">{{ $totalDataPreRegisterWithoutAffiliateCount }}</span></th>
                        <th class="text-center"><span id="regaff-count">{{ $totalDataRegisterWithAffiliateCount }}</span></th>
                        <th class="text-center"><span id="regnoaff-count">{{ $totalDataRegisterWithoutAffiliateCount }}</span></th>
                        <th rowspan="2" class="text-center"><span id="reject-count">{{ $totalDataRejectCount }}</span></th>
                        <th rowspan="2" class="text-center"><span id="balance-count">{{ $totalDataCount - $totalDataRejectCount }}</span></th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center"><strong><span id="entry-count">{{ $totalDataEntry }}</span></strong></td>
                        <td colspan="2" class="text-center"><strong><span id="preregister-count">{{ $totalDataPreRegister }}</span></strong></td>
                        <td colspan="2" class="text-center"><strong><span id="register-count">{{ $totalDataRegister }}</span></strong></td>
                    </tr>
                </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
        columnDefs: [
            {
                targets: ['_all'],
                className: 'dt-head-center'
            }
        ],
        layout: {
                top1Start: {
                    div: {
                        html: '<h2>Data Masuk & Sumber {{ $location_name }}</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Data Masuk & Sumber'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Data Masuk & Sumber'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Data Masuk & Sumber'
                        },
                        {
                            extend: 'print',
                            title: 'Data Masuk & Sumber'
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
        });
        t.on('order.dt search.dt', function () {
            let i = 1;
        
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
<script>
    document.getElementById('hideKolejbtmCheckbox').addEventListener('change', function () {
        const shouldHide = this.checked;
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            const source = row.getAttribute('data-source');
            if (source === 'DATA KOLEJBTM') {
                row.style.display = shouldHide ? 'none' : '';
            }
        });
    });
</script>
<script>
document.getElementById('hideKolejbtmCheckbox').addEventListener('change', function () {
    const hide = this.checked;
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const source = row.getAttribute('data-source');
        if (source === 'DATA KOLEJBTM') {
            row.style.display = hide ? 'none' : '';
        }
    });

    updateTotals();
});

function updateTotals() {
    let total = 0, aff = 0, noaff = 0, preaff = 0, prenoaff = 0;
    let regaff = 0, regnoaff = 0, reject = 0;

    document.querySelectorAll('tbody tr').forEach(row => {
        if (row.style.display !== 'none') {
            total += parseInt(row.dataset.total);
            aff += parseInt(row.dataset.aff);
            noaff += parseInt(row.dataset.noaff);
            preaff += parseInt(row.dataset.preaff);
            prenoaff += parseInt(row.dataset.prenoaff);
            regaff += parseInt(row.dataset.regaff);
            regnoaff += parseInt(row.dataset.regnoaff);
            reject += parseInt(row.dataset.reject);
        }
    });

    // Update footer cells
    document.getElementById('total-count').innerText = total;
    document.getElementById('aff-count').innerText = aff;
    document.getElementById('noaff-count').innerText = noaff;
    document.getElementById('preaff-count').innerText = preaff;
    document.getElementById('prenoaff-count').innerText = prenoaff;
    document.getElementById('regaff-count').innerText = regaff;
    document.getElementById('regnoaff-count').innerText = regnoaff;
    document.getElementById('reject-count').innerText = reject;
    document.getElementById('balance-count').innerText = total - reject;

    document.getElementById('entry-count').innerText = aff + noaff;
    document.getElementById('preregister-count').innerText = preaff + prenoaff;
    document.getElementById('register-count').innerText = regaff + regnoaff;
}
</script>
@endsection