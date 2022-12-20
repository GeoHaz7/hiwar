@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div>
            <h2 class="card-title mt-3 text-center">Create Account as a Vendor</h2>
            <p class="text-center">Get started with your free account</p>

            <form id="vendorForm" class="mainForm ">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input id="vendorFullName" name="vendorFullName" class="form-control" placeholder="Full name"
                        type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input id="vendorEmail" name="vendorEmail" class="form-control" placeholder="Email address"
                        type="email">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <select class="custom-select" style="max-width: 120px;">
                        <option value="+970" selected="">+970</option>
                        <option value="+972">+972</option>
                    </select>
                    <input id="vendorPhone" name="vendorPhone" class="form-control" placeholder="Phone number"
                        type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-home"></i> </span>
                    </div>
                    <input id="vendorAddress" name="vendorAddress" class="form-control" placeholder="Address"
                        type="text">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                    </div>
                    <input id="vendorBio" name="vendorBio" class="form-control" placeholder="Bio" type="text">
                </div> <!-- form-group// -->
                {{-- <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                    </div>
                    <select class="form-control">
                        <option selected=""> Select job type</option>
                        <option>Designer</option>
                        <option>Manager</option>
                        <option>Accaunting</option>
                    </select>
                </div> <!-- form-group end.// --> --}}
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input id="vendorPassword" name="vendorPassword" class="form-control" placeholder="Create password"
                        type="password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input id="vendorPassword_confirm" name="vendorPassword_confirm" class="form-control"
                        placeholder="Repeat password" type="password">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Create Account </button>
                </div> <!-- form-group// -->
                <p class="text-center">Have an account? <a href="">Log In</a> </p>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('#vendorForm').validate({
                rules: {
                    vendorFullName: {
                        required: true,
                    },
                    vendorEmail: {
                        required: true,
                        email: true
                    },
                    vendorPhone: {
                        required: true,
                    },
                    vendorAddress: {
                        required: true,
                    },
                    vendorBio: {
                        required: true,
                    },
                    vendorPassword: {
                        minlength: 6,
                    },
                    vendorPassword_confirm: {
                        minlength: 6,
                        equalTo: "#vendorPassword"
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                    var fd = new FormData();
                    fd.append('vendorFullName', $('#vendorFullName').val());
                    fd.append('vendorEmail', $('#vendorEmail').val());
                    fd.append('vendorPhone', $('#vendorPhone').val());
                    fd.append('vendorAddress', $('#vendorAddress').val());
                    fd.append('vendorBio', $('#vendorBio').val());
                    fd.append('vendorPassword', $('#vendorPassword').val());
                    fd.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ route('vendor.store') }}",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        data: fd,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: response,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (response == 'success') {
                                    window.location = '/';

                                }
                            });
                        },
                        error: function(err) {}
                    });
                }
            });
        })
    </script>
@endsection
