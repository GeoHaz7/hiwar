@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">

        <h2 class="card-title mt-3 text-center ">News List</h2>

        <table id="example" class="display stripe table table-hover compact dataTable dtr-inline cell-border collapsed"
            style="width:100%">
            <thead>
                <tr>
                    <th>Featured Image</th>
                    <th>Title</th>
                    <th>Brief</th>
                    <th>Category</th>
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
                "ajax": "{{ route('news.data') }}",
                "columns": [{
                        "data": "filename",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            if (data) {
                                return '<img class="listVendorProfile" src="{{ url('uploads/gallery') . '/' }}' +
                                    data + '" />';
                            }

                            return '<img class="listVendorProfile" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/2048px-No_image_available.svg.png" />';
                        }
                    }, {
                        "data": "title"
                    },
                    {
                        "data": "brief"
                    },
                    {
                        "data": "category"

                    },
                    {
                        "data": "news_id",
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



            // Delete a record
            $('#example').on('click', '.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('news.destroy', ':id') }}";
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
            // edit a record
            $('#example').on('click', '.fa-edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('news.edit', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
            });


        });
    </script>
@endsection
