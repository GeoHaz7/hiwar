@extends('layouts.app')

@section('content')
    <div class="container">

        <h2 class="card-title mt-3 text-center ">Vendor Account List</h2>

        <table id="example"
            class="display stripe table table-striped hover compact dataTable dtr-inline cell-border collapsed"
            style="width:100%">
            <thead>
                <tr>
                    <th>Profile Image</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th><a class="btn btn-primary" href="{{ Route('vendor.create') }}">Add</a></th>
                </tr>
            </thead>

        </table>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {


            var table = $('#example').DataTable({
                "ajax": "{{ route('vendor.data') }}",

                "columns": [{
                        "data": "filename",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            if (data) {
                                return '<img class="listVendorProfile" src="{{ url('uploads/gallery') . '/' }}' +
                                    data + '" />';
                            }

                            return '<img class="listVendorProfile" src="https://www.kindpng.com/picc/m/24-248253_user-prof`ile-default-image-png-clipart-png-download.png" />';
                        }
                    },
                    {
                        "data": "full_name"
                    },
                    {
                        "data": "address"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "vendor_id",
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
                var url = "{{ route('vendor.destroy', ':id') }}";
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
                var url = "{{ route('vendor.edit', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
            });


        });
    </script>
@endsection
