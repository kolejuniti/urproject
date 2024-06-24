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
            <div class="card-header">Hostel Registration</div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <label for="">Block</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">A1 - UNITI VILLAGE</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">No. Unit</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">01</label>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <label for="">Name / IC / Matrics No.</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" name="" id="" class="form-control form-control-sm col-sm-3">
                    </div>
                    <div class="col-sm-6">
                        <select name="" id="" class="form-control form-control-sm">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <label for=""><strong>Student Information</strong></label>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <label for="">Name</label>
                    </div>
                    <div class="col-sm-9">
                        <label for="">ABYANA SALSABILLA BINTI AMIN</label>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <label for="">Program</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">DIPLOMA IN GRAPHIC DESIGN</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Matrics No.</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">22230414</label>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <label for="">Current Session</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">MAC 2023/2024</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Semester</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">4</label>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3">
                        <label for="">Date</label>
                    </div>
                    <div class="col-sm-3">
                        <label for="">24-06-2024</label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button class="btn btn-success btn-sm">Register</button>
            </div>
        </div>
        <table class="table table-sm table-bordered text-center">
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
        </table>
    </div>
</body>
</html>