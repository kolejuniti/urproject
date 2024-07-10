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
                <h2>Senarai Permohonan</h2>
                <table id="myTable" class="table table-bordered small table-sm text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Pemohon</th>
                        <th>No. Kad Pengenalan</th>
                        <th>No. Telefon</th>
                        <th>Email</th>
                        <th>Tarikh Permohonan</th>
                        <th>Tarikh Agihan</th>
                        <th>Education Advisor</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applicants as $data)
                    @if ($data->user_id !== null && $data->register_at === null)
                    <tr class="table-warning">
                    @elseif ($data->user_id !== null && $data->register_at !== null)
                    <tr class="table-success">
                    @else
                    <tr>
                    @endif
                        <td>&nbsp;</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-link text-uppercase open-modal" data-ic="{{ $data->ic }}">{{ $data->name }}</button>
                        </td>
                        <td class="text-center">{{ $data->ic }}</td>
                        <td class="text-center">{{ $data->phone }}</td>
                        <td class="text-center">{{ $data->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                        <td>{{$data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d-m-Y') : '' }}</td>
                        <td class="text-uppercase">{{ $data->user }}</td>
                        <td>{{ $data->note }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body small">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="" class="fw-bold">Maklumat Pemohon</label>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-md-12 form-floating">
                                    <input type="text" name="name" id="applicant-name" class="form-control" value="applicant-name" readonly disabled>
                                    <label for="applicant-name" class="labels fw-bold">Nama Penuh</label>
                                </div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-md-12 form-floating">
                                    <input type="text" name="ic" id="applicant-ic" class="form-control" value="applicant-ic" readonly disabled>
                                    <label for="applicant-ic" class="labels fw-bold">No. Kad Pengenalan</label>
                                </div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-md-6 form-floating">
                                    <input type="text" name="phone" id="applicant-phone" class="form-control" value="applicant-phone" readonly disabled>
                                    <label for="applicant-phone" class="labels fw-bold">No. Telefon</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" name="email" id="applicant-email" class="form-control" value="applicant-email" readonly disabled>
                                    <label for="applicant-email" class="labels fw-bold">Emel</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-md-12 form-floating">
                                    <input type="text" name="address1" id="applicant-address1" class="form-control" value="applicant-address1" readonly disabled>
                                    <label for="applicant-address1" class="labels fw-bold">Alamat 1</label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="col-md-12 form-floating">
                                    <input type="text" name="address2" id="applicant-address2" class="form-control" value="applicant-address2" readonly disabled>
                                    <label for="applicant-address2" class="labels fw-bold">Alamat 2</label>
                                </div>
                            </div>
                            <div class="row g-2 mb-2 row-cols-2">
                                <div class="col-md-3 form-floating">
                                    <input type="text" name="postcode" id="applicant-postcode" class="form-control" value="applicant-postcode" readonly disabled>
                                    <label for="applicant-postcode" class="labels fw-bold">Poskod</label>
                                </div>
                                <div class="col-md-4 form-floating">
                                    <input type="text" name="city" id="applicant-city" class="form-control" value="applicant-city" readonly disabled>
                                    <label for="applicant-city" class="labels fw-bold">Bandar</label>
                                </div>
                                <div class="col-12 col-md-5 form-floating">
                                    <input type="text" name="state" id="applicant-state" class="form-control" value="applicant-state" readonly disabled>
                                    <label for="applicant-state" class="labels fw-bold">Negeri</label>
                                </div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-md-6 form-floating">
                                    <input type="text" name="spm_year" id="applicant-spm_year" class="form-control" value="applicant-spm_year" readonly disabled>
                                    <label for="applicant-spm_year" class="labels fw-bold">Tahun SPM</label>
                                </div>
                                <div class="col-md-6 form-floating">
                                    <input type="text" name="created_at" id="applicant-created_at" class="form-control" value="applicant-created_at" readonly disabled>
                                    <label for="applicant-created_at" class="labels fw-bold">Tarikh Permohonan</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12 col-sm-12">
                                    <a class="btn btn-sm btn-warning" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Keputusan SPM</a>
                                </div>
                            </div>
                            <div class="mb-2">
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <div id="file-container" class="form-group">
                                            <!-- File content will be injected here -->
                                        </div>
                                    </div>
                                </div> 
                            </div>                          
                            <div class="col-md-12 col-sm-12 mb-3 mt-3">
                                <label for="" class="fw-bold">Program Yang Dipohon</label>
                            </div>
                            <div class="mb-2">
                                <div class="col-md-6 form-floating">
                                    <input type="text" name="location" id="applicant-location" class="form-control" value="applicant-location" readonly disabled>
                                    <label for="applicant-location" class="labels fw-bold">Lokasi Pilihan</label>
                                </div>
                            </div>
                            <div id="programs-container">
                                <!-- Programs will be loaded here dynamically -->
                            </div>  
                            <div id="status-container">
                                <!-- Status will be loaded here -->
                            </div>
                            <form id="application-form" action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div id="register_at-container">
                                <!-- Register at will be loaded here -->
                            </div>
                            <div class="mt-3">
                                <div class="col-sm-3 col-md-3">
                                    <label for="" class="fw-bold">Pegawai Perhubungan</label>
                                </div>
                            </div>
                            <div id="pic-container">
                                <!-- Advisor will be loaded here -->
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
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.0.7/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTables
        var t = $('#myTable').DataTable({
            columnDefs: [
                {
                    targets: ['_all'],
                    className: 'dt-head-center'
                }
            ]
        });

        // Add row numbering
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
                url: "{{ route('admin.application.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ic: ic
                },
                success: function(response) {
                    console.log(response); // Debugging: log the response

                    if (response.applicants) {
                        $('#application-form').attr('action', "{{ url('admin/application') }}/" + response.applicants.id);
                        // Populate the modal with the returned data
                        $('#applicant-name').val(response.applicants.name);
                        $('#applicant-ic').val(response.applicants.ic);
                        $('#applicant-phone').val(response.applicants.phone);
                        $('#applicant-email').val(response.applicants.email);
                        $('#applicant-address1').val(response.applicants.address1);
                        $('#applicant-address2').val(response.applicants.address2);
                        $('#applicant-postcode').val(response.applicants.postcode);
                        $('#applicant-city').val(response.applicants.city);
                        $('#applicant-state').val(response.applicants.state);
                        $('#applicant-spm_year').val(response.applicants.spm_year);
                        $('#applicant-created_at').val(response.applicants.created_at);
                        $('#applicant-location').val(response.applicants.location);

                        // Handle applicant status
                        if (response.applicants.status) {
                            $('#status-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12 form-floating">
                                        <textarea name="status" id="applicant-status" class="form-control text-uppercase" style="height: 80px" readonly disabled>${response.applicants.status}</textarea>
                                        <label for="status" class="labels fw-bold">Status Permohonan</label>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#status-container').html('');
                        }

                        // Handle file URL
                        if (response.fileUrl) {
                            var extension = response.fileUrl.split('.').pop().toLowerCase();
                            if (extension === 'pdf') {
                                $('#file-container').html(`
                                    <object data="${response.fileUrl}" type="application/pdf" width="100%" height="500px">
                                        <p><a href="${response.fileUrl}">Click here to download the PDF file.</a></p>
                                    </object>
                                `);
                            } else {
                                $('#file-container').html(`
                                    <img src="${response.fileUrl}" loading="lazy" alt="Keputusan SPM" class="img-fluid">
                                `);
                            }
                        } else {
                            $('#file-container').html('<label for="">Tiada keputusan peperiksaan SPM</label>');
                        }

                        // Handle programs
                        if (response.programs) {
                            var programsHtml = '';
                            $.each(response.programs, function(index, program) {
                                programsHtml += `
                                    <div class="row g-2 mb-2 row-cols-1">
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="program${index + 1}" id="program${index + 1}" class="form-control" value="${program.name}" readonly disabled>
                                            <label for="program${index + 1}" class="fw-bold">Program Pilihan ${index + 1}</label>
                                        </div>
                                        <div class="col-md-6 form-floating">
                                            <input type="text" name="status${index + 1}" id="status${index + 1}" class="form-control text-uppercase" value="${program.status}" readonly disabled>
                                            <label for="status${index + 1}" class="labels fw-bold">Status</label>
                                        </div>
                                    </div>
                                `;

                                if (program.status !== 'baru' && program.status !== 'layak') {
                                    programsHtml += `
                                        <div class="mb-2">
                                            <div class="col-md-12 col-sm-12 form-floating">
                                                <textarea name="notes${index + 1}" id="notes${index + 1}" rows="2" class="form-control text-uppercase" disabled>${program.notes}</textarea>
                                                <label for="notes${index + 1}" class="fw-bold">Catatan</label>
                                            </div>
                                        </div>
                                    `;
                                }
                            });

                            $('#programs-container').html(programsHtml);
                        } else {
                            $('#programs-container').html('<label for="">Tiada program ditemukan</label>');
                        }

                        // Handle register date
                        if (response.applicants.register_at) {
                            $('#register_at-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-6 col-sm-6 form-floating">
                                        <input type="text" name="register_at" id="applicant-register_at" class="form-control" value="${response.applicants.register_at}" readonly disabled>
                                        <label for="register_at" class="labels fw-bold">Tarikh Daftar Kolej</label>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#register_at-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-6 col-sm-6 form-floating">
                                        <input type="date" name="register_at" id="applicant-register_at" class="form-control" placeholder="">
                                        <label for="applicant-register_at" class="fw-bold">Tarikh Daftar Kolej</label>
                                    </div>
                                </div>
                            `);
                        }

                        // Handle users
                        let usersOptions = response.users.map((user, index) => `<option value="${user.id}">${index + 1}. ${user.name}</option>`).join('');
                        if (response.applicants.user_id) {
                            $('#pic-container').html(`
                                <div class="mt-3">
                                    <div class="col-sm-12 col-md-12 form-floating">
                                        <select name="pic" id="applicant-pic" class="form-control text-uppercase">
                                            <option value="${response.applicants.user_id}">${response.applicants.user}</option>
                                            <option value="">TIADA PEGAWAI</option>
                                            ${usersOptions}
                                        </select>
                                        <label for="applicant-pic" class="fw-bold">Nama Pegawai</label>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#pic-container').html(`
                                <div class="mt-3">
                                    <div class="col-sm-12 col-md-12 form-floating">
                                        <select name="pic" id="applicant-pic" class="form-control text-uppercase">
                                            <option value=""></option>
                                            ${usersOptions}
                                        </select>
                                        <label for="applicant-pic" class="fw-bold">Nama Pegawai</label>
                                    </div>
                                </div>
                            `);
                        }

                        // Show the modal
                        $('#applicationModal').modal('show');
                    } else {
                        console.error('No applicant data found');
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
