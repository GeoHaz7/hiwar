@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">

        <h2 class="headerText">Options List</h2>

        <table id="example" class="display stripe table table-hover compact dataTable dtr-inline cell-border collapsed "
            style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th width="450">Value</th>
                    <th><a class="btn btn-primary" href="{{ Route('news.create') }}">Add</a></th>
                </tr>
            </thead>

        </table>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {


            var table = $('#example').DataTable({
                "ajax": "{{ route('option.data') }}",
                "columns": [{
                        "data": "name",
                        render: function(data, type, row, meta) {
                            // __('core.website_name')
                            switch (data) {

                                case ('website_name'):
                                    return 'Website Name';
                                    break;

                                case ('website_description'):
                                    return 'Website Description';
                                    break;

                                case ('website_lang'):
                                    return 'Default Language';
                                    break;

                                case ('website_photo'):
                                    return 'Website logo';
                                    break;

                            }
                        }
                    },
                    {
                        "data": "value",
                        "className": "text-center",
                        render: function(data, type, row, meta) {
                            if (row.name == 'website_photo') {
                                return '<img class="listVendorProfile" src="{{ URL::asset('assets/') }}/' +
                                    data + '" />'
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        "data": "option_id",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            var text = '';
                            switch (row.name) {
                                case ('website_name'):
                                    text = 'Website Name';
                                    break;

                                case ('website_description'):
                                    text = 'Website Description';
                                    break;

                                case ('website_lang'):
                                    text = 'Default Language';
                                    break;

                                case ('website_photo'):
                                    text = 'Website logo';
                                    break;
                            }
                            return '<button class="btn btn-primary edit" data-id="' + data +
                                '" data-name="' + text + '" > Edit </button>';
                        }
                    }
                ]
            });



            // edit a record
            $('#example').on('click', '.edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('news.edit', ':id') }}";
                url = url.replace(':id', id);
                Swal.fire({
                    title: 'Add Video Link',
                    html: `<input type="text" id="videoName" class="swal2-input" placeholder="Video Name">
  <input type="text" id="videoLink" class="swal2-input" placeholder="Video Link">`,
                    confirmButtonText: 'Add Link',
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


        });
    </script>
@endsection
