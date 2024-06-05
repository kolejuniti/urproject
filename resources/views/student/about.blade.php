@extends('layouts.student')

@section('content')
<div class="container px-4 py-1" id="featured-3">
    <h2 class="pb-2 border-bottom text">Kenapa UNITI?</h2>
    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">IPT YANG KUKUH</h3>
            <p class="fs-6">Kolej UNITI telah berpengalaman selama 26 tahun sebagai institusi pendidikan.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">KOLEJ KEUSAHAWANAN</h3>
            <p class="fs-6">Kolej UNITI sentiasa berusaha menyediakan peluang kepada pelajar untuk menjadi usahawan muda.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">JAMINAN PENGINAPAN</h3>
            <p class="fs-6">Kemudahan penginapan asrama disediakan sepenuhnya kepada semua pelajar sehingga tamat pengajian.</p>
        </div>
    </div>
    <div class="row g-4 py-1 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">LATIHAN INDUSTRI DISEDIAKAN</h3>
            <p class="fs-6">Pelajar akan dilatih melalui latihan industri mengikut bidang.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">TEMPAT BELAJAR STRATEGIK</h3>
            <p class="fs-6">Tempat yang sesuai untuk belajar dengan suasana tempat yang tenang dan selesa untuk pelajar.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-2 text-body-emphasis">YURAN YANG BERPATUTAN</h3>
            <p class="fs-6">Skim bayaran yang ber patutan akan disediakan untuk memudahkan pelajar membuat bayaran yuran semester.</p>
        </div>
    </div>
    <div class="row g-4 py-1 row-cols-sm-2">
        <div class="feature col text-center">
            <p class="fs-6">Adakah anda berminat untuk<br>belajar di Kolej UNITI?</p>
            <a href="{{ route('student.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-danger">Daftar Sekarang</a>
        </div>
        <div class="feature col text-center">
            <p class="fs-6">Anda telah mendaftar?<br>Semak permohonan anda sekarang.</p>
            <a href="{{ route('student.search') }}" class="btn btn-warning">Semak Permohonan</a>
        </div>
    </div>
</div>
@endsection