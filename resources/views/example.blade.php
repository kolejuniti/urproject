<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-3">
        <div class="card mb-3">
            <div class="card-header">Laporan Pelajar R</div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <label for="">Tarikh Mula</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="date" name="" id="" class="form-control form-control-sm">
                    </div>
                    <div class="col-sm-3">
                        <label for="">Tarikh Akhir</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="date" name="" id="" class="form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button class="btn btn-success btn-sm">Search</button>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="">Jumlah Pelajar Mengikut Bulan</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">:&nbsp;70</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="">Jumlah Pelajar Mengikut Minggu</label>
                    </div>
                    <div class="col-sm-9">
                        <table class="table table-sm table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th class="col-6">Minggu</th>
                                    <th class="col-6">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="">Jumlah Pelajar Mengikut Hari</label>
                    </div>
                    <div class="col-sm-9">
                        <table class="table table-sm table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th class="col-6">Tarikh</th>
                                    <th class="col-6">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01-06-2024</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>02-06-2024</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>03-06-2024</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>04-06-2024</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>05-06-2024</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>06-06-2024</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>07-06-2024</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>08-06-2024</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>09-06-2024</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>10-06-2024</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>11-06-2024</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>12-06-2024</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>13-06-2024</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>14-06-2024</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>15-06-2024</td>
                                    <td>2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- <table class="table table-sm table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Block</th>
                    <th>No. Unit</th>
                    <th>Register Date</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>C4 - UNITI VILLAGE</td>
                    <td>13</td>
                    <td>13-11-2023</td>
                    <td>OUT</td>
                    <td>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>A1 - UNITI VILLAGE</td>
                    <td>01</td>
                    <td>23-06-2024</td>
                    <td>IN</td>
                    <td>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Resident</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-sm-3">
                                    <label for="">Name</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </tbody>
        </table> --}}
    </div>
</body>
</html>