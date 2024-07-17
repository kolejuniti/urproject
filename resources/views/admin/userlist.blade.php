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
            
            <div class="table-responsive">
                <h2>Senarai Pengguna</h2>
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Pengguna</th>
                            <th>No. Kad Pengenalan</th>
                            <th>No. Telefon</th>
                            <th>Email</th>
                            <th>Jawatan</th>
                            <th>Status</th>
                            <th>Tarikh Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user )
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-link text-uppercase open-modal" data-ic="{{ $user->ic }}">{{ $user->name }}</button>
                            </td>
                            <td class="text-center">{{ $user->ic }}</td>
                            <td class="text-center">{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->position }}</td>
                            <td>{{ $user->status }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
              
            <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <form id="user-form" action="" method="POST">
                        @csrf
                        @method('PUT') 
                        <div class="modal-body small">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="" class="fw-bold">Maklumat Pengguna</label>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="user-name" class="fw-bold">Nama Penuh</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="user-name"></label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="user-ic" class="fw-bold">No. Kad Pengenalan</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="user-ic"></label>
                                </div>
                            </div>
                            <div class="row mb-2 row-cols-2">
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label for="user-religion" class="fw-bold">Agama</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="user-religion"></label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <div class="col-md-12">
                                        <label for="user-nation" class="fw-bold">Bangsa</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="user-nation"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <label for="user-sex" class="fw-bold">Jantina</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="user-sex"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <div class="col-md-12">
                                        <label for="user-phone" class="fw-bold">No. Telefon</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="user-phone"></label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="col-md-12">
                                        <label for="user-email" class="fw-bold">Emel</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="user-email"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div id="bank_account-container">
                                        <!--Bank account will display here-->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="bank-container">
                                        <!--Bank will display here-->
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <div id="position-container">
                                        <!--Position account will display here-->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="status-container">
                                        <!--Status will display here-->
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mb-2">
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
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Status</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <select name="status" id="status" class="form-control form-control-sm" required>
                                        @if ($user->status === "AKTIF")
                                            <option value="AKTIF">AKTIF</option>
                                            <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                                        @elseif ($user->status === "TIDAK AKTIF")
                                            <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                                            <option value="AKTIF">AKTIF</option>
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
                                    <label for="" class="text-uppercase">{{ $user->address1 }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Alamat 2</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <label for="" class="text-uppercase">{{ $user->address2 }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Poskod</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="">{{ $user->postcode }}</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Bandar</label>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <label for="" class="text-uppercase">{{ $user->city }}</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-3 col-sm-3">
                                    <label for="">Negeri</label>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="">{{ $user->state }}</label>
                                </div>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                        </form>
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

        // Event delegation for dynamically added elements
        $(document).on('click', '.open-modal', function() {
            var ic = $(this).data('ic');

            $.ajax({
                url: "{{ route('admin.userlist.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ic: ic
                },
                success: function(response) {
                    console.log(response); // Debugging: log the response

                    if (response.users) {
                        $('#user-form').attr('action', "{{ url('admin/userlist') }}/" + response.users.id);
                        // Populate the modal with the returned data
                        $('#user-name').text(response.users.name);  
                        $('#user-ic').text(response.users.ic);     
                        $('#user-religion').text(response.users.religion);   
                        $('#user-nation').text(response.users.nation);     
                        $('#user-sex').text(response.users.sex);           
                        $('#user-phone').text(response.users.phone);         
                        $('#user-email').text(response.users.email);
                        
                        // Handle register date
                        if (response.users.bank_account) {
                            $('#bank_account-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-bank_account" class="fw-bold">No. Akaun Bank</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="bank_account" id="user-bank_account" class="form-control form-control-sm" value="${response.users.bank_account}" required>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#bank_account-container').html(``);
                        }

                        let bankOptions = response.banks.map((bank) => `<option value="${bank.id}">${bank.name}</option>`).join('');
                        if (response.users.bank_id) {
                            $('#bank-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-bank_account" class="fw-bold">Jenis Bank</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="bank" id="user-bank" class="form-control form-control-sm text-uppercase" required>
                                            <option value="${response.users.bank_id}">${response.users.bank}</option>
                                            ${bankOptions}
                                        </select>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#bank-container').html(``);
                        }

                        // Show the modal
                        $('#userModal').modal('show');
                    } else {
                        console.error('No user data found');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
@endsection
