@extends('layouts.student')

@section('content')
<div class="album py-4">
  <div class="container">
    <div class="mb-3">
        <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/banner-samsung-tab.jpg" alt="" class="img-fluid">
    </div>
    <div class="row g-4 py-1 row-cols-sm-2">
      <div class="feature col text-center">
          <p class="fs-6">Adakah anda berminat untuk belajar di Kolej UNITI?</p>
          <input type="hidden" name="source" value="{{ $source }}">
          {{-- <a href="{{ route('student.register', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}" class="btn btn-danger">Daftar Sekarang</a> --}}
          {{-- <a href="{{ route('student.register') . (request()->has('source') ? '?source=' . request('source') : '') . (request()->has('ref') ? (request()->has('source') ? '&' : '?') . 'ref=' . request('ref') : '') }}" class="btn btn-success">Daftar Sekarang</a> --}}
          <a href="{{ route('student.register') . (request()->has('source') ? '?source=' . request('source') : '?source=website') . (request()->has('ref') ? '&ref=' . request('ref') : '') }}" class="btn btn-success">Daftar Sekarang</a>

      </div>
      <div class="feature col text-center">
          <p class="fs-6">Anda telah mendaftar? Semak permohonan anda sekarang.</p>
          <a href="{{ route('student.search', ['ref' => old('ref', $ref)]) }}" class="btn btn-warning">Semak Permohonan</a>
      </div>
    </div>
  </div>
</div>

<div class="album py-4">
  <div class="container">
    <h2 class="pb-2 border-bottom">Kenapa Pilih UNITI?</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/daftar.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Pendaftaran</h5>
            <p class="card-text">Yuran pendaftaran RM250 bagi semua program yang ditawarkan.</p>
            <p class="card-text fst-italic" style="font-size: 10px;">&nbsp;</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/elaun.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Elaun Semester</h5>
            <p class="card-text">Pelajar menerima elaun sebanyak RM750 selama 5 semester.</p>
            <p class="card-text fst-italic" style="font-size: 10px;">* Tertakluk kepada terma dan syarat.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/insentif.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Insentif</h5>
            <p class="card-text">Diskaun insentif minima RM5000 akan diberikan kepada pelajar sepanjang tempoh pengajian.</p>
            <p class="card-text fst-italic" style="font-size: 10px;">* Tertakluk kepada pakej kewangan siswa yang ditawarkan.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/konvo.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Program Diploma</h5>
            <p class="card-text">Diploma berkualiti, diiktiraf dan memenuhi keperluan industri.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/asrama.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Penginapan</h5>
            <p class="card-text">Jaminan penginapan selama 3 tahun di dalam kawasan kolej.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/unitifarm.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Program Keusahawanan</h5>
            <p class="card-text">Jana pendapatan menerusi aktiviti keusahawanan dan bekerja sambil belajar.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/ptptn.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Pinjaman PTPTN</h5>
            <p class="card-text">Pakej tajaan penuh yuran pengajian dan penginapan.</p>
            <p class="card-text fst-italic" style="font-size: 10px;">* Tertakluk kepada terma dan syarat.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/yu.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Yayasan UNITI</h5>
            <p class="card-text">Permohonan dana Yayasan UNITI disediakan bagi golongan B40.</p>
            <p class="card-text fst-italic" style="font-size: 10px;">* Tertakluk kepada terma dan syarat.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/myquest.jpg" loading="lazy" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">MyQUEST</h5>
            <p class="card-text">Beroperasi 27 tahun sebagai institusi pendidikan dan telah mendapat pengiktirafan MyQUEST.</p>
            <p class="card-text fst-italic" style="font-size: 10px;">&nbsp;</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4 py-1 row-cols-sm-2">
        <div class="feature col text-center">
            <p class="fs-6">Adakah anda berminat untuk belajar di Kolej UNITI?</p>
            <input type="hidden" name="source" value="{{ $source }}">
            <a href="{{ route('student.register', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}" class="btn btn-danger">Daftar Sekarang</a>
        </div>
        <div class="feature col text-center">
            <p class="fs-6">Anda telah mendaftar? Semak permohonan anda sekarang.</p>
            <a href="{{ route('student.search', ['ref' => old('ref', $ref)]) }}" class="btn btn-warning">Semak Permohonan</a>
        </div>
    </div>
  </div>
</div>
            
<div class="album py-4">
    <div class="container">
      <h2 class="pb-2 border-bottom">Fakulti & Program</h2>
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mb-4">
        <div class="col">
            <div class="card shadow-sm">
              <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/fppm.jpeg" class="card-img-top" alt="...">
              <div class="card-body" style="height: 480px">
                  <p class="card-text"><h4 class="text-center">FAKULTI PENDIDIKAN & PEMBANGUNAN MANUSIA</h4></p>
                  <ul class="small nav flex-column">
                      <li class="nav-item mb-3">
                        <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpakk">
                          DIPLOMA PENDIDIKAN AWAL KANAK-KANAK&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                        </a>
                      </li>
                      <li class="nav-item mb-3">
                        <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpisr">
                        DIPLOMA PENDIDIKAN ISLAM SEKOLAH RENDAH&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                        </a>
                      </li>
                      <li class="nav-item mb-3">
                        <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpk">DIPLOMA PSIKOLOGI KAUNSELING&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                        </a>
                      </li>
                  </ul>
              </div>
            </div>
        </div>
          <div class="modal fade" id="dpakk" tabindex="-1" aria-labelledby="dpakk" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPAKK.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpisr" tabindex="-1" aria-labelledby="dpisr" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPISR.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpk" tabindex="-1" aria-labelledby="dpk" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPK.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
        <div class="col">
            <div class="card shadow-sm">
            <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/ftk.jpg" class="card-img-top" alt="...">
            <div class="card-body" style="height: 480px">
                <p class="card-text text-center"><h4 class="text-center">FAKULTI TEKNOLOGI & KEJURUTERAAN</h4></p>
                <ul class="small nav flex-column">
                    {{-- <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dcn">DIPLOMA IN COMPUTER NETWORK
                      </a>
                    </li> --}}
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#digd">DIPLOMA IN GRAPHIC DESIGN&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#ditss">DIPLOMA IN INFORMATION TECHNOLOGY (SYSTEM SUPPORT)&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dkm">DIPLOMA KOMUNIKASI DAN MEDIA&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                      </a>
                    </li>
                </ul>
            </div>
            </div>
        </div>
          <div class="modal fade" id="digd" tabindex="-1" aria-labelledby="digd" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DIGD.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="ditss" tabindex="-1" aria-labelledby="ditss" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DITSS.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dkm" tabindex="-1" aria-labelledby="dkm" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DKM.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
        <div class="col">
            <div class="card shadow-sm">
            <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/fpih.jpg" class="card-img-top" alt="...">
            <div class="card-body" style="height: 480px">
                <p class="card-text"><h4 class="text-center">FAKULTI PENGURUSAN & INDUSTRI HALAL</h4></p>
                <ul class="small nav flex-column">
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dia">DIPLOMA IN ACCOUNTING [UiTM]&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dbs">DIPLOMA IN BUSINESS STUDIES [UiTM]&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dhpm">DIPLOMA IN HALAL PRODUCT MANUFACTURING&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#ditm">DIPLOMA IN TOURISM MANAGEMENT&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpi">DIPLOMA PENGAJIAN ISLAM&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpih">DIPLOMA PENGURUSAN INDUSTRI HALAL&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpm">DIPLOMA PENGURUSAN MUAMALAT&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpp">DIPLOMA PENGURUSAN PERNIAGAAN&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpa">DIPLOMA PERAKAUNAN&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                  <li class="nav-item mb-3">
                    <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpt">DIPLOMA PENGURUSAN TEKNOLOGI&nbsp;<i class="bi bi-arrow-left-circle-fill"></i>
                    </a>
                  </li>
                </ul>
            </div>
            </div>
        </div>
          <div class="modal fade" id="dia" tabindex="-1" aria-labelledby="dia" aria-hidden="true">
            <div class="modal-dialog modal-md">
              <div class="modal-content">
                <div class="modal-body">
                    <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DIA.jpg" loading="lazy" alt="" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="dbs" tabindex="-1" aria-labelledby="dbs" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DBS.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dhpm" tabindex="-1" aria-labelledby="dhpm" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DHMP.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="ditm" tabindex="-1" aria-labelledby="ditm" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DITM.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpi" tabindex="-1" aria-labelledby="dpi" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPI.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpih" tabindex="-1" aria-labelledby="dpih" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPIH.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpm" tabindex="-1" aria-labelledby="dpm" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPM.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpp" tabindex="-1" aria-labelledby="dpp" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPP.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpa" tabindex="-1" aria-labelledby="dpa" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPA.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="dpt" tabindex="-1" aria-labelledby="dpt" aria-hidden="true">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-body">
                      <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/programs/kupd/DPT.jpg" loading="lazy" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
          </div>
      </div>
      <div class="row g-4 py-1 row-cols-sm-2">
        <div class="feature col text-center">
            <p class="fs-6">Adakah anda berminat untuk belajar di Kolej UNITI?</p>
            <input type="hidden" name="source" value="{{ $source }}">
            <a href="{{ route('student.register', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}" class="btn btn-danger">Daftar Sekarang</a>
        </div>
        <div class="feature col text-center">
            <p class="fs-6">Anda telah mendaftar? Semak permohonan anda sekarang.</p>
            <a href="{{ route('student.search', ['ref' => old('ref', $ref)]) }}" class="btn btn-warning">Semak Permohonan</a>
        </div>
      </div>
    </div>
</div>

<div class="album py-4">
  <div class="container">
    <h2 class="pb-2 border-bottom">Kemudahan & Fasiliti</h2>
    <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/cafe.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Cafetaria</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/koop.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Kedai Runcit Koop</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/atm.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Mesin ATM</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/library.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Perpustakaan</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/bk.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Bilik Kuliah</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/halal.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Bengkel Halal</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/kaunseling.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Bilik Kaunseling</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/komputer.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Makmal Komputer</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-3 mb-4">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/guard.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Kawalan Keselamatan 24 Jam</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/bus.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Perkhidmatan Bas Awam</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/court.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Gelanggang Sukan</h6>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/dobi.jpg" class="card-img" alt="...">
          <div class="card-img-overlay">
            <h6 class="card-title position-absolute bottom-0 start-0 fw-bold text-white bg-dark px-3 py-1">Dobi Layan Diri</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4 py-1 row-cols-sm-2">
        <div class="feature col text-center">
            <p class="fs-6 text-wrap">Adakah anda berminat untuk belajar di Kolej UNITI?</p>
            <input type="hidden" name="source" value="{{ $source }}">
            <a href="{{ route('student.register', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}" class="btn btn-danger">Daftar Sekarang</a>
        </div>
        <div class="feature col text-center">
            <p class="fs-6 text-wrap">Anda telah mendaftar? Semak permohonan anda sekarang.</p>
            <a href="{{ route('student.search', ['ref' => old('ref', $ref)]) }}" class="btn btn-warning">Semak Permohonan</a>
        </div>
    </div>
  </div>
</div>

<div class="album py-4">
  <div class="container">
    <h2 class="pb-2 border-bottom">Alumni Kolej UNITI</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/alumniftk.jpg" loading="lazy" class="card-img" alt="...">
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/alumnifppm.jpg" loading="lazy" class="card-img" alt="...">
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="https://ku-storage-object.ap-south-1.linodeobjects.com/urproject/images/banners/alumnifpih.jpg" loading="lazy" class="card-img" alt="...">
        </div>
      </div>
    </div>
    <div class="row g-4 py-1 row-cols-sm-2">
        <div class="feature col text-center">
          <p class="fs-6 text-wrap">Adakah anda berminat untuk belajar di Kolej UNITI?</p>
            <input type="hidden" name="source" value="{{ $source }}">
            <a href="{{ route('student.register', ['source' => old('source', $source), 'ref' => old('ref', $ref)]) }}" class="btn btn-danger">Daftar Sekarang</a>
        </div>
        <div class="feature col text-center">
            <p class="fs-6">Anda telah mendaftar? Semak permohonan anda sekarang.</p>
            <a href="{{ route('student.search', ['ref' => old('ref', $ref)]) }}" class="btn btn-warning">Semak Permohonan</a>
        </div>
    </div>
  </div>
</div>
@endsection
