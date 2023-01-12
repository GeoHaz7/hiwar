@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">

        <h2 class="headerText">{{ __('generalBack.videoList') }}</h2>

        <table id="example" class="display stripe table table-hover compact dataTable dtr-inline cell-border collapsed"
            style="width:100%">
            <thead>
                <tr>
                    <th>{{ __('generalBack.videoName') }}</th>
                    <th>{{ __('generalBack.videoLink') }}</th>
                    <th><button id="addLink" class="btn btn-primary">{{ __('generalBack.add') }}</button></th>
                </tr>
            </thead>

        </table>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {


            var table = $('#example').DataTable({
                "ajax": "{{ route('videoAlbum.data') }}",

                "columns": [{
                        "data": "name"
                    },
                    {
                        "data": "link",
                        orderable: false,

                        render: function(data, type, row, meta) {
                            return ('<a href=' + data + '>' + data + '</a>');
                        }
                    },
                    {
                        "data": "video_id",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return ('<i class="fa fa-edit text-primary" data-id="' +
                                data +
                                '"></i> <i class="fa fa-trash text-danger editor-delete" data-id="' +
                                data +
                                '"> </i>');
                        }
                    }
                ]
            });

            function validateYouTubeUrl() {
                var url = $('#youTubeUrl').val();
                if (url != undefined || url != '') {
                    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                    var match = url.match(regExp);
                    if (match && match[2].length == 11) {
                        // Do anything for being valid
                        // if need to change the url to embed url then use below line
                        $('#ytplayerSide').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=0');
                    } else {
                        // Do anything for not being valid
                    }
                }
            }

            $('#example').on('click', '#addLink', function(e) {
                Swal.fire({
                    title: '{{ __('generalBack.addVideoLink') }}',
                    html: `<input type="text" id="videoName" class="swal2-input" placeholder="{{ __('generalBack.videoName') }}">
  <input type="text" id="videoLink" class="swal2-input" placeholder="{{ __('generalBack.videoLink') }}">`,
                    confirmButtonText: '{{ __('generalBack.addLink') }}',
                    focusConfirm: false,
                    preConfirm: () => {
                        const videoName = Swal.getPopup().querySelector('#videoName').value
                        const videoLink = Swal.getPopup().querySelector('#videoLink').value
                        if (!videoName || !videoLink) {
                            Swal.showValidationMessage(`Please enter a name and a link`)
                        } else {
                            var regExp =
                                /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                            var match = videoLink.match(regExp);
                            if (match && match[2].length == 11) {
                                // Do anything for being valid

                            } else {
                                Swal.showValidationMessage(
                                    `Please enter a valid youtube link`)
                            }
                        }


                        return {
                            videoName: videoName,
                            videoLink: videoLink
                        }
                    }
                }).then((result) => {
                    var fd = new FormData();
                    fd.append('videoName', result.value.videoName);
                    fd.append('videoLink', result.value.videoLink);
                    fd.append('_token', '{{ csrf_token() }}');


                    $.ajax({
                        url: "{{ route('videoAlbum.store') }}",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        data: fd,
                        success: function(response) {
                            if (response == 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: response,
                                    showDenyButton: false,
                                    showCancelButton: false,
                                    confirmButtonText: 'Yes'
                                }).then((result) => {
                                    if (response == 'success') {
                                        table.ajax.reload(null);

                                    }
                                });
                            }
                        },
                        error: function(err) {}
                    });
                })
            });



            // Delete a record
            $('#example').on('click', '.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('videoAlbum.destroy', ':id') }}";
                url = url.replace(':id', id);
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure ?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            table.ajax.reload(null);
                            if (response == 'success') {}
                        },
                        error: function(err) {}
                    });
                });
            });

        });
    </script>
@endsection
