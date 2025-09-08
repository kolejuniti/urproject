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
            {{-- <div class="col-md-8 col-sm-8 col-12 ms-auto text-end">
                <label>
                        <input type="checkbox" id="hideKolejbtmCheckbox">&nbsp;Tidak termasuk DATA KOLEJBTM
                </label>
            </div> --}}
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    @if ($start_date === null)
                    @else
                    <caption>N = data baru, R = data ulang.<br>Laporan yang dijana adalah bagi lokasi {{ $location_name }} bertarikh {{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d-m-Y') : '' }} sehingga {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d-m-Y') : '' }}</caption>
                    @endif
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="3">#</th>
                            <th rowspan="3">Sumber</th>
                            <th colspan="2" class="text-center">Data</th>
                            <th class="text-center" colspan="6">Data Masuk</th>
                            <th class="text-center" colspan="7">Pendaftaran</th>
                            <th rowspan="3">Data Ditolak</th>
                            <th rowspan="3">Baki Data</th>
                        </tr>
                        <tr>
                            <th rowspan="2" class="text-center">N</th>
                            <th rowspan="2" class="text-center">R</th>
                            <th colspan="2" class="text-center">Data Affiliate</th>
                            <th colspan="2" class="text-center">Data EA</th>
                            <th colspan="2" class="text-center">Tanpa Affiliate/EA</th>
                            <th colspan="3" class="text-center">Pra Pendaftaran</th>
                            <th colspan="4" class="text-center">Daftar Kolej</th>
                        </tr>
                        <tr>
                            <th class="text-center">N</th>
                            <th class="text-center">R</th>
                            <th class="text-center">N</th>
                            <th class="text-center">R</th>
                            <th class="text-center">N</th>
                            <th class="text-center">R</th>
                            <th>Data Affiliate >> EA</th>
                            <th>Data EA</th>
                            <th>Tanpa Affiliate >> EA</th>
                            <th>Data Affiliate >> EA</th>
                            <th>Data Affiliate >> EA Lain</th>
                            <th>Data EA</th>
                            <th>Tanpa Affiliate >> EA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sources as $item)
                        @php
                            $source = $item->source;
                            $totalN = $totalDataN[$source] ?? 0;
                            $totalR = $totalDataR[$source] ?? 0;
                            $withAffiliate = $totalDataWithAffiliate[$source] ?? 0;
                            $withAffiliateN = $totalDataWithAffiliateN[$source] ?? 0;
                            $withAffiliateR = $totalDataWithAffiliateR[$source] ?? 0;
                            $withEA = $totalDataWithEA[$source] ?? 0;
                            $withNEA = $totalDataWithEAN[$source] ?? 0;
                            $withREA = $totalDataWithEAR[$source] ?? 0;
                            $withoutAffiliate = $totalDataWithoutAffiliate[$source] ?? 0;
                            $withoutAffiliateN = $totalDataWithoutAffiliateN[$source] ?? 0;
                            $withoutAffiliateR = $totalDataWithoutAffiliateR[$source] ?? 0;
                            $preWithAff = $totalDataPreRegisterWithAffiliate[$source] ?? 0;
                            $preWithEA = $totalDataPreRegisterWithEA[$source] ?? 0;
                            $preWithoutAff = $totalDataPreRegisterWithoutAffiliate[$source] ?? 0;
                            $regWithAff = $totalDataRegisterWithAffiliate[$source] ?? 0;
                            $regOtherEA = $totalDataRegisterWithOtherEA[$source] ?? 0;
                            $regWithEA = $totalDataRegisterWithEA[$source] ?? 0;
                            $regWithoutAff = $totalDataRegisterWithoutAffiliate[$source] ?? 0;
                            $reject = $totalDataRejects[$source] ?? 0;
                        @endphp
                        <tr data-source="{{ $source }}"
                            data-aff="{{ $withAffiliate }}"
                            data-affn="{{ $withAffiliateN }}"
                            data-affr="{{ $withAffiliateR }}"
                            data-ea="{{ $withEA }}"
                            data-ean="{{ $withNEA }}"
                            data-ear="{{ $withREA }}"
                            data-noaff="{{ $withoutAffiliate }}"
                            data-noaffn="{{ $withoutAffiliateN }}"
                            data-noaffr="{{ $withoutAffiliateR }}"
                            data-preaff="{{ $preWithAff }}"
                            data-preea="{{ $preWithEA }}"
                            data-prenoaff="{{ $preWithoutAff }}"
                            data-regaff="{{ $regWithAff }}"
                            data-regea="{{ $regWithEA }}"
                            data-regnoaff="{{ $regWithoutAff }}"
                            data-reject="{{ $reject }}">
                            <td></td>
                            <td class="text-uppercase">{{ $source }}</td>
                            {{-- <td class="text-center">{{ $total }}</td> --}}
                            <td class="text-center">{{ $totalN }}</td>
                            <td class="text-center">{{ $totalR }}</td>
                            <td class="text-center">{{ $withAffiliateN }}</td>
                            <td class="text-center">{{ $withAffiliateR }}</td>
                            <td class="text-center">{{ $withNEA }}</td>
                            <td class="text-center">{{ $withREA }}</td>
                            <td class="text-center">{{ $withoutAffiliateN }}</td>
                            <td class="text-center">{{ $withoutAffiliateR }}</td>
                            <td class="text-center">{{ $preWithAff }}</td>
                            <td class="text-center">{{ $preWithEA }}</td>
                            <td class="text-center">{{ $preWithoutAff }}</td>
                            <td class="text-center">{{ $regWithAff }}</td>
                            <td class="text-center">{{ $regOtherEA }}</td>
                            <td class="text-center">{{ $regWithEA }}</td>
                            <td class="text-center">{{ $regWithoutAff }}</td>
                            <td class="text-center">{{ $reject }}</td>
                            <td class="text-center">{{ ($totalN + $totalR) - $reject }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-danger">
                    <tr>
                        <th rowspan="2"></th>
                        <th rowspan="2">Jumlah Keseluruhan</th>
                        <th class="text-center">{{ $totalNDataCount }}</th>
                        <th class="text-center">{{ $totalRDataCount }}</th>
                        <th class="text-center"><span id="aff-count">{{ $totalDataWithAffiliateNCount }}</span></th>
                        <th class="text-center"><span id="aff-count">{{ $totalDataWithAffiliateRCount }}</span></th>
                        <th class="text-center"><span id="ea-count">{{ $totalDataWithEANCount }}</span></th>
                        <th class="text-center"><span id="ea-count">{{ $totalDataWithEARCount }}</span></th>
                        <th class="text-center"><span id="noaff-count">{{ $totalDataWithoutAffiliateNCount }}</span></th>
                        <th class="text-center"><span id="noaff-count">{{ $totalDataWithoutAffiliateRCount }}</span></th>
                        <th class="text-center"><span id="preaff-count">{{ $totalDataPreRegisterWithAffiliateCount }}</span></th>
                        <th class="text-center"><span id="preea-count">{{ $totalDataPreRegisterWithEACount }}</span></th>
                        <th class="text-center"><span id="prenoaff-count">{{ $totalDataPreRegisterWithoutAffiliateCount }}</span></th>
                        <th class="text-center"><span id="regaff-count">{{ $totalDataRegisterWithAffiliateCount }}</span></th>
                        <th class="text-center"><span id="regotherea-count">{{ $totalDataRegisterWithOtherEACount }}</span></th>
                        <th class="text-center"><span id="regea-count">{{ $totalDataRegisterWithEACount }}</span></th>
                        <th class="text-center"><span id="regnoaff-count">{{ $totalDataRegisterWithoutAffiliateCount }}</span></th>
                        <th rowspan="2" class="text-center"><span id="reject-count">{{ $totalDataRejectCount }}</span></th>
                        <th rowspan="2" class="text-center"><span id="balance-count">{{ ($totalNDataCount + $totalRDataCount) - $totalDataRejectCount }}</span></th>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center"><strong><span id="entry-count">{{ $totalDataNR }}</span></strong></td>
                        <td colspan="6" class="text-center"><strong><span id="entry-count">{{ $totalDataEntryNR }}</span></strong></td>
                        <td colspan="3" class="text-center"><strong><span id="preregister-count">{{ $totalDataPreRegister }}</span></strong></td>
                        <td colspan="4" class="text-center"><strong><span id="register-count">{{ $totalDataRegister }}</span></strong></td>
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
        pageLength: 25,
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
    let total = 0, aff = 0, ea = 0, noaff = 0, preaff = 0, preea = 0, prenoaff = 0;
    let regaff = 0, regotherea = 0, regea = 0, regnoaff = 0, reject = 0;

    document.querySelectorAll('tbody tr').forEach(row => {
        if (row.style.display !== 'none') {
            total += parseInt(row.dataset.total || 0);
            aff += parseInt(row.dataset.aff || 0);
            ea += parseInt(row.dataset.ea || 0);
            noaff += parseInt(row.dataset.noaff || 0);
            preaff += parseInt(row.dataset.preaff || 0);
            preea += parseInt(row.dataset.preea || 0);
            prenoaff += parseInt(row.dataset.prenoaff || 0);
            regaff += parseInt(row.dataset.regaff);
            regotherea += parseInt(row.dataset.regotherea || 0);
            regea += parseInt(row.dataset.regea || 0);
            regnoaff += parseInt(row.dataset.regnoaff || 0);
            reject += parseInt(row.dataset.reject || 0);
        }
    });

    // Update footer cells
    document.getElementById('total-count').innerText = total;
    document.getElementById('aff-count').innerText = aff;
    document.getElementById('ea-count').innerText = ea;
    document.getElementById('noaff-count').innerText = noaff;
    document.getElementById('preaff-count').innerText = preaff;
    document.getElementById('preea-count').innerText = preea;
    document.getElementById('prenoaff-count').innerText = prenoaff;
    document.getElementById('regaff-count').innerText = regaff;
    document.getElementById('regotherea-count').innerText = regotherea;
    document.getElementById('regea-count').innerText = regea;
    document.getElementById('regnoaff-count').innerText = regnoaff;
    document.getElementById('reject-count').innerText = reject;
    document.getElementById('balance-count').innerText = total - reject;

    document.getElementById('entry-count').innerText = aff + ea + noaff;
    document.getElementById('preregister-count').innerText = preaff + preea + prenoaff;
    document.getElementById('register-count').innerText = regaff + regotherea + regea + regnoaff;
}
</script>
@endsection