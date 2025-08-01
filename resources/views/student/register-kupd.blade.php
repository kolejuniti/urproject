@extends($isEmbedded ? 'layouts.embedded' : 'layouts.student-kupd')

@section('title', 'Daftar | Kolej UNITI Port Dickson')   

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('msg_error'))
                <div class="alert alert-danger">
                    {{ session('msg_error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Borang Pendaftaran | Kolej UNITI Port Dickson') }}</div>
                <form action="{{ route('student.register-kupd.post') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="card-body bg-white">
                    @csrf
                    <div class="col-md-12 col-sm-12 mb-3">
                        <label for="" class="fw-bold">Maklumat Peribadi</label>
                    </div>
                    <div class="row g-2 mb-2 row-cols-1">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="name" id="name" class="form-control" placeholder="" required autofocus>
                            <label for="name" class="form-label">Nama Penuh</label>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="ic" id="ic" class="form-control" maxlength="12" placeholder="" required oninput="this.value = this.value.replace(/[-\s]/g, '')">
                            <label for="ic" class="form-label">No. Kad Pengenalan</label>
                        </div>
                    </div>
                    <div class="row g-2 mb-2 row-cols-1">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="tel" name="phone" id="phone" placeholder="" oninput="formatPhoneNumber(this)" class="form-control" maxlength="13" required>
                            <label for="phone">No. Telefon</label>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" name="email" id="email" placeholder="" class="form-control" required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row g-2 mb-2 row-cols-2">
                        <div class="col-12 col-md-6 col-sm-6 form-floating">
                            <input type="text" name="address1" id="address1" class="form-control form-control-sm" placeholder="" required>
                            <label for="address1">Alamat 1</label>
                        </div>
                        <div class="col-12 col-md-6 col-sm-6 form-floating">
                            <input type="text" name="address2" id="address2" class="form-control" placeholder="" required>
                            <label for="address2">Alamat 2</label>
                        </div>
                    </div>
                    <div class="row g-2 mb-2 row-cols-2">
                        <div class="col-md-3 col-sm-3 form-floating">
                            <input type="text" name="postcode" id="postcode" class="form-control" placeholder="" maxlength="5" required>
                            <label for="postcode">Poskod</label>
                        </div>
                        <div class="col-md-3 col-sm-3 form-floating">
                            <input type="text" name="city" id="city" class="form-control" placeholder="" required>
                            <label for="city">Bandar</label>
                        </div>
                        <div class="col-12 col-md-6 col-sm-6 form-floating">
                            <select name="state" id="state" class="form-control" required>
                                <option value="">Pilihan Negeri</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <label for="state">Negeri</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <select name="year" id="year" class="form-control" required>
                                <option value="">Pilihan Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            <label for="year">Tahun SPM</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 mb-3 mt-3">
                        <label for="" class="fw-bold">Program Pilihan</label>
                    </div>
                    <div class="mb-2">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" id="location" name="location" value="KOLEJ UNITI PORT DICKSON" class="form-control form-control-sm" readonly>
                            <label for="ref">Lokasi Kampus</label>
                        </div>
                    </div>
                    <div class="row g-2 mb-2 row-cols-1">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <select name="programA" id="programA" class="form-control" required>
                                <option value="">Pilihan Program 1</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                            <label for="programA">Program 1</label>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <select name="programB" id="programB" class="form-control" required>
                                <option value="">Pilihan Program 2</option>
                                @foreach ($programs as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                            <label for="programB">Program 2</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="file" class="form-control" name="file" id="file" required>
                            <label for="file">Keputusan SPM</label>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <small class="text-danger">* Salinan SPM mestilah dalam format jpg, jpeg, png atau pdf.</small>
                        </div>
                        <div class="col-md-6 col-sm-6 form-floating">
                            <small class="text-danger">* Saiz salinan SPM mestilah tidak melebihi 5MB.</small>
                        </div>
                    </div>
                    @if ($ref !== null)
                    <div class="col-sm-12">
                        <hr>
                    </div>
                    <div class="mb-2">
                        <div class="col-md-6 col-sm-6 form-floating">
                            <input type="text" id="ref" name="referral_code" value="{{ old('ref', $ref) }}" class="form-control form-control-sm" @if($ref) readonly @endif>
                            <label for="ref">Kod Rujukan</label>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <div class="col-sm-12 text-center">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="source" id="source" value="{{ $source }}">
                        <button class="btn btn-primary" type="submit">Daftar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#location').change(function() {
            var locationId = $(this).val();

            // Clear the program dropdown
            $('#programA').empty().append('<option value="">Pilih Program</option>');
            $('#programB').empty().append('<option value="">Pilih Program</option>');

            if (locationId) {
                // Send an AJAX request to get the programs for the selected location
                $.ajax({
                    url: '/student/location/' + locationId, // Adjust the URL according to your route
                    type: 'GET',
                    success: function(data) {
                        // Populate the program dropdown with the received data
                        $.each(data, function(key, value) {
                            $('#programA').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $.each(data, function(key, value) {
                            $('#programB').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('An error occurred while fetching programs:', error);
                    }
                });
            }
        });
    });
</script> 
<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script> 
<script>
    function formatPhoneNumber(input) {
    // Get the input value and remove non-digits
    let value = input.value.replace(/\D/g, '');
    
    // Remove leading '0' if present
    if (value.startsWith('0')) {
        value = value.substring(1);
    }
    
    // Add '6' prefix if not present
    if (!value.startsWith('60')) {
        value = '60' + value;
    }
    
    // Limit length to 13 digits
    value = value.substring(0, 13);
    
    // Update the input value
    input.value = value;
}
</script>
@endsection
