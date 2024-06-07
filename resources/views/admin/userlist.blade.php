@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Senarai Pengguna')}}</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered small table-sm text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pengguna</th>
                                    <th>No. Kad Pengenalan</th>
                                    <th>No. Telefon</th>
                                    <th>Email</th>
                                    <th>Jawatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user )
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-link text-uppercase" data-bs-toggle="modal" data-bs-target="#modal{{ $user->ic }}">{{ $user->name }}</button>
                                    </td>
                                    <td class="text-center">{{ $user->ic }}</td>
                                    <td class="text-center">{{ $user->phone }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->position }}</td>
                                </tr>  
                                <div class="modal fade" id="modal{{ $user->ic }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $user->ic }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $user->ic }}"></h5>
                                            </div>
                                            <form action="{{ route('admin.userlist.update', ['id' => $user->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT') 
                                            <div class="modal-body small">
                                                <div class="col-md-12 col-sm-12 mb-3">
                                                    <label for="" class="fw-bold">Maklumat Pengguna</label>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Nama Pengguna</label>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <label for="name" class="text-uppercase">{{ $user->name }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">No. Kad Pengenalan</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="name">{{ $user->ic }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Agama</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">{{ $user->religion }}</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Bangsa</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">{{ $user->nation }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Jantina</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">{{ $user->sex }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">No. Telefon</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="{{ $user->phone }}" required>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Email</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="name">{{ $user->email }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">No. Akaun Bank</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <input type="text" name="bank_account" id="bank_account" class="form-control form-control-sm" value="{{ $user->bank_account }}" required>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Bank</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <select name="bank" id="bank" class="form-control form-control-sm">
                                                        <option value="{{ $user->bank_id }}">{{ $user->bank }}</option>
                                                        @foreach ($banks as $bank )
                                                            <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Jenis Pengguna</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <select name="type" id="type" class="form-control form-control-sm" required>>
                                                            @if ($user->type === "user")
                                                                <option value="0">AFFILIATE</option> 
                                                                <option value="1">ADVISOR</option> 
                                                            @elseif($user->type === "advisor")
                                                                <option value="1">ADVISOR</option>
                                                                <option value="0">AFFILIATE</option>  
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Jawatan</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <select name="position" id="position" class="form-control form-control-sm" required>
                                                            @if ($user->position === "AFFILIATE UNITI")
                                                                <option value="AFFILIATE UNITI">AFFILIATE UNITI</option>
                                                                <option value="MANAGER">MANAGER</option>
                                                                <option value="EDUCATION ADVISOR">EDUCATION ADVISOR</option>
                                                            @elseif ($user->position === "MANAGER")
                                                                <option value="MANAGER">MANAGER</option>
                                                                <option value="AFFILIATE UNITI">AFFILIATE UNITI</option>
                                                                <option value="EDUCATION ADVISOR">EDUCATION ADVISOR</option>
                                                            @elseif ($user->position === "EDUCATION ADVISOR")
                                                                <option value="EDUCATION ADVISOR">EDUCATION ADVISOR</option>
                                                                <option value="AFFILIATE UNITI">AFFILIATE UNITI</option>
                                                                <option value="MANAGER">MANAGER</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-12 mb-3 mt-3">
                                                    <label for="" class="fw-bold">Alamat Pengguna</label>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Alamat 1</label>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <label for="" class="text-uppercase">{{ $userAddress->address1 }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Alamat 2</label>
                                                    </div>
                                                    <div class="col-md-9 col-sm-9">
                                                        <label for="" class="text-uppercase">{{ $userAddress->address2 }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Poskod</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">{{ $userAddress->postcode }}</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Bandar</label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="" class="text-uppercase">{{ $userAddress->city }}</label>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="">Negeri</label>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label for="">{{ $userAddress->state }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'dt-head-center'
                }
            ]
        });
        t.on('order.dt search.dt', function () {
            let i = 1;
        
            t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                this.data(i++);
            });
        }).draw();
    });
</script>
@endsection
