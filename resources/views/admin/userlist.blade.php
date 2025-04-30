@extends('layouts.admin')

@section('content')

<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.css" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
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
                            <th>Status</th>
                            <th>Tarikh Daftar</th>
                            <th>Rujukan Oleh</th>
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
                            <td>{{ isset($leaders[$user->leader_id]) ? $leaders[$user->leader_id]->name : '' }}</td>
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
                                {{-- <div class="col-md-12">
                                    <label for="user-name" class="fw-bold">Nama Penuh</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="user-name"></label>                                   
                                </div> --}}
                                <div id="name-container">
                                    <!--Name will display here-->
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
                                    <div id="phone-container">
                                        <!--Phone will display here-->
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
                            <div class="row mb-2 row-cols-2">
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
                            <div class="row mb-2 row-cols-2">
                                <div class="col-md-4">
                                    <div id="affiliate_data-container">
                                        <!--Affiliate Data checkbox will display here-->
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12 col-sm-12 mb-3 mt-3">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        var t = $('#myTable').DataTable({
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'dt-head-center'
                }
            ],
            layout: {
                top1Start: {
                    div: {
                        html: '<h2>Senarai Pengguna</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Senarai Pengguna'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Senarai Pengguna'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Senarai Pengguna'
                        },
                        {
                            extend: 'print',
                            title: 'Senarai Pengguna'
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
                        // $('#user-name').text(response.users.name);

                        if (response.users.name) {
                            $('#name-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-name" class="fw-bold">Nama Penuh</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" id="user-name" class="form-control form-control-sm" value="${response.users.name}" required>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#phone-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-name" class="fw-bold">Nama Penuh</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="name" id="user-name" class="form-control form-control-sm" required>    
                                    </div>
                                </div>
                            `);
                        }

                        $('#user-ic').text(response.users.ic);     
                        $('#user-religion').text(response.users.religion);   
                        $('#user-nation').text(response.users.nation);     
                        $('#user-sex').text(response.users.sex);             
                        $('#user-email').text(response.users.email);

                        // Handle phone
                        if (response.users.phone) {
                            $('#phone-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-phone" class="fw-bold">No. Telefon</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="phone" id="user-phone" class="form-control form-control-sm" value="${response.users.phone}" required>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#phone-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-phone" class="fw-bold">No. Telefon</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="phone" id="user-phone" class="form-control form-control-sm" required>    
                                    </div>
                                </div>
                            `);
                        }
                        
                        // Handle bank account
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
                            $('#bank_account-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-bank_account" class="fw-bold">No. Akaun Bank</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="bank_account" id="user-bank_account" class="form-control form-control-sm" required>    
                                    </div>
                                </div>
                            `);
                        }

                        // Handle bank option
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

                        // Handle position
                        if (response.users.position) {
                            let positionOptions = '';

                            if (response.users.position === "AFFILIATE UNITI") {
                                positionOptions = `
                                            <option value="EDUCATION ADVISOR">EDUCATION ADVISOR</option>`;
                            } else if (response.users.position === "EDUCATION ADVISOR") {
                                positionOptions =  `
                                            <option value="AFFILIATE UNITI">AFFILIATE UNITI</option>`;
                            }

                            $('#position-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-position" class="fw-bold">Jawatan</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="position" id="user-position" class="form-control form-control-sm text-uppercase" required>
                                            <option value="${response.users.position}">${response.users.position}</option>
                                            ${positionOptions}
                                        </select>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#position-container').html(``);
                        }

                        // Handle status
                        if (response.users.status) {
                            let statusOptions = '';

                            if (response.users.status === "AKTIF") {
                                statusOptions = `
                                            <option value="TIDAK AKTIF">TIDAK AKTIF</option>`;
                            } else if (response.users.status === "TIDAK AKTIF") {
                                statusOptions =  `
                                            <option value="AKTIF">AKTIF</option>`;
                            }

                            $('#status-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-status" class="fw-bold">Status</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="status" id="user-status" class="form-control form-control-sm text-uppercase" required>
                                            <option value="${response.users.status}">${response.users.status}</option>
                                            ${statusOptions}
                                        </select>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#status-container').html(``);
                        }

                        // Handle Affiliate Data
                        if (response.users.affiliate_data !== undefined && response.users.affiliate_data !== null) {
                            const currentValue = String(response.users.affiliate_data); // Cast to string for comparison

                            const affiliateDataOptions = `
                                <option value="1" ${currentValue == "1" ? "selected" : ""}>YA</option>
                                <option value="0" ${currentValue == "0" ? "selected" : ""}>TIDAK</option>
                            `;

                            $('#affiliate_data-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="user-affiliate_data" class="fw-bold">Penerima Data Affiliate</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="affiliate_data" id="user-affiliate_data" class="form-control form-control-sm text-uppercase" required>
                                            ${affiliateDataOptions}
                                        </select>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#affiliate_data-container').html(``);
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
