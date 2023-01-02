@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">
        <div>
            <h2 class="headerText ">Edit A Product</h2>
            {{-- <p class="text-center">Get started with your free account</p> --}}

            <form id="productForm" class="mt-5 ">
                <div class="center mb-3">
                    <div class="form-input">
                        <div class="preview">
                            <img class="mx-auto mb-3 d-block" id="file-ip-1-preview"
                                src="{{ $product->thumbnail ? url('uploads/gallery') . '/' . $product->thumbnail->filename : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png' }}">


                        </div>

                        <label for="file-ip-1">Upload Image</label>
                        <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                    </div>
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-star"></i> </span>
                    </div>
                    <input id="productName" name="productName" value="{{ $product->name }}" class="form-control"
                        placeholder="Name" type="text">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-dollar"></i> </span>
                    </div>
                    <input id="productPrice" name="productPrice" value="{{ $product->price }}" class="form-control"
                        placeholder="Price" type="number">
                </div> <!-- form-group// -->

                <div class="col-12 p-0">
                    <select class="livesearch form-control" style="width: 100%" name="livesearch"></select>
                </div>
                <div class="mt-3">
                    <textarea class="ckeditor" type="text" class="form-control" id="productDescription" name="productDescription">{!! $product->description !!}</textarea>
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
                    url: "{{ route('image.show') }}?id={{ $product->product_id }}&type=product",
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

            // Fetch the preselected item, and add to the control
            var vendorSelect = $('.livesearch');
            $.ajax({
                type: 'GET',
                url: '{{ route('vendors.showDataAjax', ['id' => $product->vendor_id]) }}'
            }).then(function(data) {
                // create the option and append to Select2
                var option = new Option(data[0].full_name, data[0].vendor_id, true, true);

                vendorSelect.append(option).trigger('change');

                // manually trigger the `select2:select` event
                studentSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
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
                    name: {
                        required: true,
                    },
                    price: {
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
                    fd.append('vendor_id', $('.livesearch').select2('data')[0].id);
                    fd.append('file', $('#file-ip-1')[0].files[0]);
                    fd.append('image_array', array);
                    fd.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ route('product.update', ['id' => $product->product_id]) }}",
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
