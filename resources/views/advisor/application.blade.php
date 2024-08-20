@extends('layouts.advisor')

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
            <div class="card mb-3">
                <div class="card-header">{{ __('Senarai Permohonan') }}</div>

                <div class="card-body">
                    @auth
                    <div class="col-md-12 col-sm-12 mb-2">
                        <label for="">Kongsi pautan ini kepada yang berminat mendaftar / belajar di Kolej UNITI.</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" id="referral_url" name="url" class="form-control" value="{{ route('student.about', ['ref' => Auth::user()->referral_code]) }}" readonly>
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" onclick="copyToClipboard()"><i class="bi bi-clipboard"></i></button>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
            <div class="table-responsive">
                <table id="myTable" class="table table-bordered small table-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nama Pemohon</th>
                            <th>No. Kad Pengenalan</th>
                            <th>No. Telefon</th>
                            <th>Email</th>
                            <th>Tarikh Permohonan</th>
                            <th>Affiliate</th>
                            <th>Tarikh Agihan</th>
                            <th>Status</th>
                            <th>Tarikh Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicants as $data)
                        @if ($data->user_id !== null && $data->register_at === null && in_array($data->status_id, [1, 2, 3, 4, 5, 24, 26]))
                            <tr class="table-danger">
                        @elseif ($data->user_id !== null && $data->register_at === null && $data->status_id === 19)
                            <tr class="table-info">
                        @elseif ($data->user_id !== null && $data->register_at === null)
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
                            <td>{{ $data->email }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
                            <td class="text-uppercase">
                                @if($data->referral_code !== null)
                                    @if(isset($affiliates[$data->id]) && $affiliates[$data->id]->isNotEmpty())
                                        {{ $affiliates[$data->id]->first()->name }}
                                    @else
                                        {{ __('TIADA AFFILIATE') }}
                                    @endif
                                @else
                                    {{ __('TIADA AFFILIATE') }}
                                @endif
                            </td>
                            <td>{{$data->updated_at ? \Carbon\Carbon::parse($data->updated_at)->format('d-m-Y') : '' }}</td>
                            <td class="text-uppercase">{{ $data->status }}</td>
                            <td>{{$data->register_at ? \Carbon\Carbon::parse($data->register_at)->format('d-m-Y') : '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="applicationModal" tabindex="-1" aria-labelledby="applicationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content"> 
                    <form id="application-form" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body small">
                            <div class="col-md-12 col-sm-12 mb-3">
                                <label for="" class="fw-bold">Maklumat Pemohon</label>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="applicant-name" class="fw-bold">Nama Penuh</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="applicant-name"></label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="applicant-ic" class="fw-bold">No. Kad Pengenalan / Passport</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="applicant-ic"></label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <div class="col-md-12">
                                        <label for="applicant-phone" class="fw-bold">No. Telefon</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="applicant-phone"></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label for="applicant-email" class="fw-bold">Emel</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="applicant-email"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="applicant-address1" class="fw-bold">Alamat 1</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="applicant-address1"></label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="applicant-address2" class="fw-bold">Alamat 2</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="applicant-address2"></label>
                                </div>
                            </div>
                            <div class="row mb-2 row-cols-2">
                                <div class="col-md-3">
                                    <div class="col-md-12">
                                        <label for="applicant-postcode" class="fw-bold">Poskod</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="applicant-postcode"></label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2 mb-md-0">
                                    <div class="col-md-12">
                                        <label for="applicant-city" class="fw-bold">Bandar</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label id="applicant-city"></label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="col-12 col-md-12">
                                        <label for="applicant-state" class="fw-bold">Negeri</label>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <label id="applicant-state"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="applicant-spm_year" class="fw-bold">Tahun SPM</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="applicant-spm_year"></label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    <label for="applicant-created_at" class="fw-bold">Tarikh Permohonan</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="applicant-created_at"></label>
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
                                <div class="col-md-12">
                                    <label for="applicant-location" class="fw-bold">Lokasi Pilihan</label>
                                </div>
                                <div class="col-md-12">
                                    <label id="applicant-location"></label>
                                </div>
                            </div>
                            <div id="programs-container">
                                <!-- Programs will be loaded here dynamically -->
                            </div> 
                            <div id="status-container">
                                <!-- Status will be loaded here -->
                            </div> 
                            <div id="reason-container">
                                <!-- Reason will be loaded here -->
                            </div>
                            <div class="col-md-12 col-sm-12 mb-3 mt-3">
                                <label for="" class="fw-bold">Surat Tawaran</label>
                            </div>
                            <div id="offer-letter-container">
                                <!-- Offer letter date will be loaded here -->
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
<script>
    function toggleTextarea(uniqueId) {
        const layakRadio = document.getElementById('layak' + uniqueId);
        const container = document.getElementById('notes-container' + uniqueId);
        
        if (layakRadio.checked) {
            container.style.display = 'none';
        } else {
            container.style.display = 'block';
        }
    }
</script>
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("referral_url");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        navigator.clipboard.writeText(copyText.value).then(function() {
            alert("Referral URL copied to clipboard!");
        }, function(err) {
            console.error('Failed to copy text: ', err);
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTables
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
                        html: '<h2>Senarai Permohonan</h2>'
                    }
                },
                top1End: {
                    buttons: [
                        {
                            extend: 'copy',
                            title: 'Senarai Permohonan'
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Senarai Permohonan'
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Senarai Permohonan'
                        },
                        {
                            extend: 'print',
                            title: 'Senarai Permohonan'
                        }
                    ]
                },
                topStart: 'pageLength',
                topEnd: 'search',
                bottomStart: 'info',
                bottomEnd: 'paging'
            }
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
                url: "{{ route('advisor.application.detail') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ic: ic
                },
                success: function(response) {
                    console.log(response); // Debugging: log the response

                    if (response.applicants) {
                        $('#application-form').attr('action', "{{ url('advisor/application') }}/" + response.applicants.id);
                        // Populate the modal with the returned data
                        $('#applicant-name').text(response.applicants.name);
                        $('#applicant-ic').text(response.applicants.ic);
                        $('#applicant-phone').text(response.applicants.phone);
                        $('#applicant-email').text(response.applicants.email);
                        $('#applicant-address1').text(response.applicants.address1);
                        $('#applicant-address2').text(response.applicants.address2);
                        $('#applicant-postcode').text(response.applicants.postcode);
                        $('#applicant-city').text(response.applicants.city);
                        $('#applicant-state').text(response.applicants.state);
                        $('#applicant-spm_year').text(response.applicants.spm_year);
                        $('#applicant-created_at').text(response.applicants.created_at);
                        $('#applicant-location').text(response.applicants.location);

                        // Handle applicant status
                        let statusOptions = response.statusApplications.map((statusApplication) => 
                            `<option value="${statusApplication.id}">${statusApplication.name}</option>`
                        ).join('');

                        if (response.applicants.status_id) {
                            $('#status-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="applicant-status" class="fw-bold">Status Permohonan</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="statusApplication" id="applicant-status" class="form-control form-control-sm text-uppercase" required>
                                            <option value="${response.applicants.status_id}" selected>${response.applicants.status}</option>
                                            ${statusOptions}
                                        </select>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#status-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="applicant-status" class="fw-bold">Status Permohonan</label>
                                    </div>
                                    <div class="col-md-12">
                                        <select name="statusApplication" id="applicant-status" class="form-control form-control-sm text-uppercase" required>
                                            <option value="" selected disabled></option>
                                            ${statusOptions}
                                        </select>    
                                    </div>
                                </div>
                            `);
                        }

                        //Handle reason status
                        if (response.applicants.reason) {
                            $('#reason-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="applicant-status" class="fw-bold">Sebab Menolak Tawaran</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="reason" id="reason" rows="3" class="form-control">${response.applicants.reason}</textarea>    
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#reason-container').html(`
                                <div class="mb-2">
                                    <div class="col-md-12">
                                        <label for="applicant-status" class="fw-bold">Sebab Menolak Tawaran</label>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="reason" id="reason" rows="3" class="form-control"></textarea>    
                                    </div>
                                </div>
                            `);
                        }

                        // Handle applicant offer letter date

                        if (response.applicants.offer_letter_date) {
                            $('#offer-letter-container').html(`
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <div class="col-md-12">
                                            <label for="applicant-phone" class="fw-bold">Tarikh Tawaran</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="date" name="offer_letter_date" id="offer_letter_date" class="form-control form-control-sm" value="${response.applicants.offer_letter_date}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="applicant-email" class="fw-bold">Tarikh Pendaftaran</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="date" name="offer_letter_date" id="offer_letter_date" class="form-control form-control-sm" value="${response.applicants.register_letter_date}">
                                        </div>
                                    </div>
                                </div>
                            `);
                        } else {
                            $('#offer-letter-container').html(`
                                <div class="row mb-2">
                                    <div class="col-md-6 mb-2 mb-md-0">
                                        <div class="col-md-12">
                                            <label for="applicant-phone" class="fw-bold">Tarikh Tawaran</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="date" name="offer_letter_date" id="offer_letter_date" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-md-12">
                                            <label for="applicant-email" class="fw-bold">Tarikh Pendaftaran</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="date" name="register_letter_date" id="register_letter_date" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            `);
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
                            var uniqueId = 'program' + (index + 1); // Unique ID for each program
                            var notesHtml = '';

                            // Check if the status is 'tidak layak'
                            if (program.status === 'tidak layak') {
                                notesHtml = `
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <label for="notes${uniqueId}">Catatan</label>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea name="programs[${index + 1}][notes]" id="notes${uniqueId}" rows="2" class="form-control form-control-sm">${program.notes}</textarea>
                                        </div>
                                    </div>
                                `;
                            } else {
                                notesHtml = `
                                    <div id="notes-container${uniqueId}" style="display: none;">
                                        <div class="row mb-2">
                                            <div class="col-md-3 col-sm-3">
                                                <label for="notes${uniqueId}">Catatan</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <textarea name="programs[${index + 1}][notes]" id="notes${uniqueId}" rows="2" class="form-control form-control-sm"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }

                            programsHtml += `
                                <div class="row mb-2">
                                    <div class="col-md-8 mb-2 mb-md-0">
                                        <div class="col-md-12">
                                            <label for="program${index + 1}" class="fw-bold">Program Pilihan ${index + 1}</label>
                                        </div>
                                        <div class="col-md-12">
                                            <label id="program${index + 1}">${program.name}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="col-md-12">
                                            <label for="status${index + 1}" class="fw-bold">Status</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row mb-2">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="programs[${index + 1}][status]" id="layak${uniqueId}" value="layak" onchange="toggleTextarea('${uniqueId}')" ${program.status === 'layak' ? 'checked' : ''} required />
                                                        <label class="form-check-label" for="layak${uniqueId}">LAYAK</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="programs[${index + 1}][status]" id="tidaklayak${uniqueId}" value="tidak layak" onchange="toggleTextarea('${uniqueId}')" ${program.status === 'tidak layak' ? 'checked' : ''} required />
                                                        <label class="form-check-label" for="tidaklayak${uniqueId}">TIDAK LAYAK</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ${notesHtml}
                                <input type="hidden" name="programs[${index + 1}][id]" value="${program.id}">
                            `;
                        });

                            $('#programs-container').html(programsHtml);
                        } else {
                            $('#programs-container').html('<label for="">Tiada program ditemukan</label>');
                        }

                        // Handle register date
                        // if (response.applicants.register_at) {
                        //     $('#register_at-container').html(`
                        //         <div class="mb-2">
                        //             <div class="col-md-12">
                        //                 <label for="register_at" class="labels fw-bold">Tarikh Daftar Kolej</label>
                        //             </div>
                        //             <div class="col-md-12">
                        //                 <label for="register_at">${response.applicants.register_at}</label>
                        //             </div>
                        //         </div>
                        //     `);
                        // } else {
                        //     $('#register_at-container').html(`
                        //         <div class="mb-2">
                        //             <div class="col-md-6 col-sm-6 form-floating">
                        //                 <input type="date" name="register_at" id="applicant-register_at" class="form-control" placeholder="">
                        //                 <label for="applicant-register_at" class="fw-bold">Tarikh Daftar Kolej</label>
                        //             </div>
                        //         </div>
                        //     `);
                        // }

                        // Handle users
                        // let usersOptions = response.users.map((user) => `<option value="${user.id}">${user.name}</option>`).join('');
                        // if (response.applicants.user_id) {
                        //     $('#pic-container').html(`
                        //         <div class="mt-3">
                        //             <div class="col-sm-12 col-md-12 form-floating">
                        //                 <select name="pic" id="applicant-pic" class="form-control text-uppercase">
                        //                     <option value="${response.applicants.user_id}">${response.applicants.user}</option>
                        //                     <option value="">TIADA PEGAWAI</option>
                        //                     ${usersOptions}
                        //                 </select>
                        //                 <label for="applicant-pic" class="fw-bold">Nama Pegawai</label>
                        //             </div>
                        //         </div>
                        //     `);
                        // } else {
                        //     $('#pic-container').html(`
                        //         <div class="mt-3">
                        //             <div class="col-sm-12 col-md-12 form-floating">
                        //                 <select name="pic" id="applicant-pic" class="form-control text-uppercase">
                        //                     <option value=""></option>
                        //                     ${usersOptions}
                        //                 </select>
                        //                 <label for="applicant-pic" class="fw-bold">Nama Pegawai</label>
                        //             </div>
                        //         </div>
                        //     `);
                        // }

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
