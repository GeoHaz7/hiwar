@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">
        <div>
            <h2 class="card-title mt-3 text-center ">Add A Product</h2>
            {{-- <p class="text-center">Get started with your free account</p> --}}

            <form id="productForm" class="mt-5 ">
                <div class="center mb-3">
                    <div class="form-input">
                        <div class="preview">
                            <img class="mx-auto mb-3" id="file-ip-1-preview">
                        </div>

                        <label for="file-ip-1">Upload Image</label>
                        <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                    </div>
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-star"></i> </span>
                    </div>
                    <input id="productName" name="productName" class="form-control" placeholder="Name" type="text">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-dollar"></i> </span>
                    </div>
                    <input id="productPrice" name="productPrice" class="form-control" placeholder="Price" type="number">
                </div> <!-- form-group// -->


                @if (!Auth::user()->type == 2)
                    <div class="col-12 p-0">
                        <select class="livesearch form-control" style="width: 100%" name="livesearch"></select>
                    </div>
                @endif



                <div class="mt-3">
                    <textarea class="ckeditor" type="text" class="form-control" id="productDescription" name="productDescription"></textarea>
                </div>

                <div class="dropzone mt-3" id="dropzone">

                    <div class="dz-default dz-message">
                        <h4>Drop Files Here</h4>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-block"> Create Product </button>
                </div> <!-- form-group// -->
                {{-- <p class="text-center">Have an account? <a href="">Log In</a> </p> --}}
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        var array = [];
        Dropzone.autoDiscover = false;
        $('#dropzone').dropzone({
            maxFiles: 5,
            url: "{{ route('image.store') }}",
            method: 'post',
            maxFilesize: 4,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            init: function() {
                // Get images
                var myDropzone = this;
                $.ajax({
                    url: "",
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {

                            var file = {
                                name: value.name,
                                size: value.size
                            };
                            myDropzone.options.addedfile.call(myDropzone, file);
                            myDropzone.options.thumbnail.call(myDropzone, file,
                                value.path);
                            myDropzone.emit("complete", file);
                        });
                    }
                });
            },
            removedfile: function(file) {
                if (this.options.dictRemoveFile) {
                    return Dropzone.confirm("Are You Sure to " + this.options.dictRemoveFile,
                        function() {
                            if (file.previewElement.id != "") {
                                var name = file.previewElement.id;
                            } else {
                                var name = file.name;
                            }

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                type: 'POST',
                                url: "{{ route('image.delete') }}",
                                data: {
                                    filename: name
                                },
                                success: function(data) {
                                    alert(data.success +
                                        " File has been successfully removed!");
                                },
                                error: function(e) {
                                    console.log(e);
                                }
                            });
                            var fileRef;
                            return (fileRef = file.previewElement) != null ?
                                fileRef.parentNode.removeChild(file.previewElement) : void 0;
                        });
                }
            },

            success: function(file, response) {
                file.previewElement.id = response.success;

                array.push(response.image_id);
                file.previewElement.querySelector("img").alt = response.success;
            },
            error: function(file, response) {
                if ($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }

        });
        $(document).ready(function() {

            $('.livesearch').select2({
                placeholder: 'Select an item',
                allowClear: true,

                ajax: {
                    url: '{{ route('vendors.dataAjax') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.full_name,
                                    id: item.vendor_id
                                }
                            })
                        };
                    },
                }
            });


            document.getElementById('file-ip-1').addEventListener('change', function showPreview(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("file-ip-1-preview");
                    preview.src = src;
                    preview.style.display = "block";

                }
            });


            $('#productForm').validate({
                rules: {
                    title: {
                        required: true,
                    },
                    brief: {
                        required: true,
                        maxlength: 255

                    },
                    description: {
                        required: true,
                        maxlength: 255

                    },
                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {
                    var fd = new FormData();
                    fd.append('productName', $('#productName').val());
                    fd.append('productPrice', $('#productPrice').val());
                    fd.append('productDescription', CKEDITOR.instances['productDescription'].getData());

                    if ($('.livesearch').length != 0) {
                        fd.append('vendor_id', $('.livesearch').select2('data')[0].id);
                    }
                    fd.append('file', $('#file-ip-1')[0].files[0]);
                    fd.append('image_array', array);
                    fd.append('_token', '{{ csrf_token() }}');


                    $.ajax({
                        url: "{{ route('product.store') }}",
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
                                    window.location = '/product';

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
