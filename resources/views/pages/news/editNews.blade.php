@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">
        <div>
            <h2 class="headerText">Edit News</h2>
            {{-- <p class="text-center">Get started with your free account</p> --}}

            <form id="newsForm" class="mt-5 ">
                <div class="center mb-3">
                    <div class="form-input">
                        <div class="preview">
                            <img class="mx-auto mb-3 d-block" id="file-ip-1-preview"
                                src="{{ $news->thumbnail ? url('uploads/gallery') . '/' . $news->thumbnail->filename : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png' }}">


                        </div>

                        <label for="file-ip-1">Upload Image</label>
                        <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
                    </div>
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-star"></i> </span>
                    </div>
                    <input id="newsTitle" name="newsTitle" class="form-control" value="{{ $news->title }}"
                        placeholder="Title" type="text">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-star"></i> </span>
                    </div>
                    <input id="newsCategory" name="newsCategory" class="form-control" value="{{ $news->category }}"
                        placeholder="Category" type="text">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-briefcase"></i> </span>
                    </div>
                    <input id="newsBrief" name="newsBrief" value="{{ $news->brief }}" class="form-control"
                        placeholder="Brief name" type="text">
                </div> <!-- form-group// -->


                <textarea class="ckeditor" type="text" class="form-control" id="newsDescription" name="newsDescription">{!! $news->description !!}</textarea>

                <div class="dropzone mt-3" id="myDropzone">

                    <div class="dz-default dz-message">
                        <h4>Drop Files Here</h4>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-block"> Edit News </button>
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
        $('#myDropzone').dropzone({
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
                    url: "{{ route('image.show') }}?id={{ $news->news_id }}&type=news",
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

            document.getElementById('file-ip-1').addEventListener('change', function showPreview(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("file-ip-1-preview");
                    preview.src = src;
                    preview.style.display = "block";

                }
            });


            $('#newsForm').validate({
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
                    fd.append('newsTitle', $('#newsTitle').val());
                    fd.append('newsCategory', $('#newsCategory').val());
                    fd.append('newsBrief', $('#newsBrief').val());
                    fd.append('newsDescription', CKEDITOR.instances['newsDescription'].getData());
                    fd.append('file', $('#file-ip-1')[0].files[0]);
                    fd.append('image_array', array);
                    fd.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: "{{ route('news.update', ['id' => $news->news_id]) }}",
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
                                    window.location = '/news';

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
