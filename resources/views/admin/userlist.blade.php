@extends('layouts.admin')

@section('content')
<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(isset($success))
                <div class="alert alert-success">
                    {{ $success }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Senarai Pengguna')}}</div>

                <div class="card-body">
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
                                    <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#modal{{ $user->ic }}">{{ $user->name }}</button>
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
                                    <div class="modal-body small">
                                        <div class="col-md-12 col-sm-12 mb-3">
                                            <label for="" class="fw-bold">Maklumat Pengguna</label>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Nama Pengguna</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <label for="name">{{ $user->name }}</label>
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
                                                <label for="">No. Telefon</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $user->phone }}</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="">Email</label>
                                            </div>
                                            <div class="col-md-3 col-sm-3">
                                                <label for="name">{{ $user->email }}</label>
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
