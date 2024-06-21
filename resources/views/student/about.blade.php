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
            
<div class="album py-4 bg-body-tertiary">
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
                            DIPLOMA PENDIDIKAN AWAL KANAK-KANAK
                          </a>
                        </li>
                        <li class="nav-item mb-3">
                          <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpisr">
                          DIPLOMA PENDIDIKAN ISLAM SEKOLAH RENDAH
                          </a>
                        </li>
                        <li class="nav-item mb-3">
                          <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpk">DIPLOMA PSIKOLOGI KAUNSELING
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
                        <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#digd">DIPLOMA IN GRAPHIC DESIGN
                        </a>
                      </li>
                      <li class="nav-item mb-3">
                        <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#ditss">DIPLOMA IN INFORMATION TECHNOLOGY (SYSTEM SUPPORT)
                        </a>
                      </li>
                      <li class="nav-item mb-3">
                        <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dkm">DIPLOMA KOMUNIKASI DAN MEDIA
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
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dia">DIPLOMA IN ACCOUNTING [UiTM]
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dbs">DIPLOMA IN BUSINESS STUDIES [UiTM]
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dhpm">DIPLOMA IN HALAL PRODUCT MANUFACTURING
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#ditm">DIPLOMA IN TOURISM MANAGEMENT
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpi">DIPLOMA PENGAJIAN ISLAM
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpih">DIPLOMA PENGURUSAN INDUSTRI HALAL
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpm">DIPLOMA PENGURUSAN MUAMALAT
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpp">DIPLOMA PENGURUSAN PERNIAGAAN
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpa">DIPLOMA PERAKAUNAN
                      </a>
                    </li>
                    <li class="nav-item mb-3">
                      <a type="button" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" data-bs-toggle="modal" data-bs-target="#dpt">DIPLOMA PENGURUSAN TEKNOLOGI
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
              <p class="fs-6">Adakah anda berminat untuk<br>belajar di Kolej UNITI?</p>
              <a href="{{ route('student.register', ['ref' => old('ref', $ref)]) }}" class="btn btn-danger">Daftar Sekarang</a>
          </div>
          <div class="feature col text-center">
              <p class="fs-6">Anda telah mendaftar?<br>Semak permohonan anda sekarang.</p>
              <a href="{{ route('student.search') }}" class="btn btn-warning">Semak Permohonan</a>
          </div>
      </div>
    </div>
</div>
@endsection
