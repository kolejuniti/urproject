@extends('layouts.app')

@section('content')
<div class="container px-4 py-1" id="featured-3">
    <h2 class="pb-2 border-bottom text">Kenapa Affiliate UNITI?</h2>
    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Peluang Menjana Pendapatan Tambahan</h3>
            <p class="fs-6">Anda akan menerima komisen bagi setiap pelajar yang mendaftar di Kolej UNITI melalui pautan atau rujukan anda. Ini adalah cara yang baik untuk menjana pendapatan tambahan tanpa perlu meninggalkan pekerjaan utama anda.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Memanfaatkan Rangkaian Anda</h3>
            <p class="fs-6">Jika anda mempunyai rangkaian yang luas dalam kalangan pelajar, ibu bapa, atau komuniti pendidikan, anda boleh memanfaatkan rangkaian ini dengan memperkenalkan Kolej UNITI. Dengan berkongsi maklumat dan testimoni tentang kolej, anda boleh membantu orang lain membuat keputusan pendidikan yang lebih baik.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Menyumbang kepada Pendidikan Berkualiti</h3>
            <p class="fs-6">Dengan memperkenalkan pelajar kepada Kolej UNITI, anda membantu mereka mendapatkan akses pendidikan berkualiti yang ditawarkan. Ini memberi impak positif kepada masa depan mereka dan menyumbang kepada pembangunan sumber manusia yang berkualiti.</p>
        </div>
    </div>
    <div class="row g-4 py-1 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Fleksibiliti dan Kebebasan</h3>
            <p class="fs-6">Pemasaran afiliasi memberikan anda kebebasan untuk bekerja mengikut keselesaan anda sendiri. Anda boleh mempromosikan Kolej UNITI pada masa dan tempat yang sesuai dengan jadual anda, tanpa terikat dengan jam kerja yang tetap.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Membangunkan Hubungan Profesional</h3>
            <p class="fs-6">Anda akan berpeluang untuk membina hubungan profesional dengan staf dan pengurusan Kolej UNITI. Ini boleh membuka pintu kepada peluang kerjaya atau kolaborasi lain di masa hadapan.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Menerima Sokongan dan Bahan Pemasaran</h3>
            <p class="fs-6">Kolej UNITI akan menyediakan pelbagai bahan pemasaran seperti banting, pautan teks, brosur dan video bagi membantu anda mempromosikan kolej dengan lebih berkesan. Sokongan ini memudahkan anda dalam menjalankan aktiviti pemasaran.</p>
        </div>
    </div>
    <div class="row g-4 py-1 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Reputasi dan Kredibiliti</h3>
            <p class="fs-6">Kerjasama dengan institusi pendidikan yang mempunyai reputasi seperti Kolej UNITI akan meningkatkan kredibiliti anda sebagai individu atau organisasi yang memperkenalkan pilihan pendidikan yang baik. Ini boleh meningkatkan kepercayaan dalam kalangan mereka yang berada di dalam rangkaian anda.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Ganjaran dan Pengiktirafan</h3>
            <p class="fs-6">Selain komisen, anda mungkin menerima ganjaran lain seperti bonus prestasi, sijil penghargaan atau pengiktirafan lain daripada Kolej UNITI sebagai tanda penghargaan atas sumbangan anda.</p>
        </div>
        <div class="feature col">
            <h3 class="fs-3 text-body-emphasis text-uppercase">Memberi Impak Positif kepada Masyarakat</h3>
            <p class="fs-6">Dengan memperkenalkan pelajar kepada Kolej UNITI, anda memberi peluang kepada mereka untuk mendapatkan pendidikan yang dapat mengubah kehidupan mereka. Ini bukan sahaja memberi manfaat kepada individu tetapi juga memberi impak positif kepada masyarakat secara keseluruhan.</p>
        </div>
    </div>
    <div class="row g-4 py-1 row-cols-1 mt-1">
        <div class="feature col text-center">
            <p class="fs-6">Adakah anda berminat untuk menjadi Affiliate UNITI?</p>
            <a href="{{ route('register') }}" class="btn btn-danger">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
