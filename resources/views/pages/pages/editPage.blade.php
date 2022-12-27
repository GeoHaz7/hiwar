@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">
        <div>
            <h2 class="card-title mt-3 text-center ">Add A Page</h2>
            {{-- <p class="text-center">Get started with your free account</p> --}}

            <form id="pageForm" class="mt-5 ">
                <div class="center mb-3">
                    <div class="form-input">
                        <div class="preview">
                            <img class="mx-auto mb-3 d-block" id="file-ip-1-preview"
                                src="{{ $page->thumbnail ? url('uploads/gallery') . '/' . $page->thumbnail->filename : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png' }}">


                        </div>

                        <label for="file-ip-1">Upload Image</label>
                        <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                    </div>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-star"></i> </span>
                    </div>
                    <input id="pageTitle" name="pageTitle" class="form-control" value="{{ $page->title }}"
                        placeholder="Title" type="text">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-briefcase"></i> </span>
                    </div>
                    <input id="pageBrief" name="pageBrief" value="{{ $page->brief }}" class="form-control"
                        placeholder="Brief name" type="text">
                </div> <!-- form-group// -->


                <textarea class="ckeditor" type="text" class="form-control" id="pageDescription" name="pageDescription">{!! $page->description !!}</textarea>


                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-block"> Edit Page </button>
                </div> <!-- form-group// -->
                {{-- <p class="text-center">Have an account? <a href="">Log In</a> </p> --}}
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            document.getElementById('file-ip-1').addEventListener('change', function showPreview(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("file-ip-1-preview");
                    preview.src = src;
                    preview.style.display = "block";

                }
            });


            $('#pageForm').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    brief: {
                        required: true,
                        maxlength: 255

                    },
                    status: {
                        required: true,
                    }
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                    var fd = new FormData();
                    fd.append('pageTitle', $('#pageTitle').val());
                    fd.append('pageBrief', $('#pageBrief').val());
                    fd.append('pageDescription', CKEDITOR.instances['pageDescription'].getData());
                    fd.append('file', $('#file-ip-1')[0].files[0]);
                    fd.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ route('page.update', ['id' => $page->page_id]) }}",
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
                                    window.location = '/page';

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
