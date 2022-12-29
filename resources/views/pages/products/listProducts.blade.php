@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">

        <h2 class="card-title mt-3 text-center ">Products List</h2>

        <table id="example" class="display stripe table table-hover compact dataTable dtr-inline cell-border collapsed"
            style="width:100%">
            <thead>
                <tr>
                    <th>Featured Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th><a class="btn btn-primary" href="{{ Route('product.create') }}">Add</a></th>
                </tr>
            </thead>

        </table>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {


            var table = $('#example').DataTable({
                "ajax": "{{ route('product.data') }}",
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
                        "data": "name"
                    },
                    {
                        "data": "price",
                        render: function(data, type, row, meta) {
                            return data + " ₪";

                        }
                    },
                    {
                        "data": "vendorName",

                    },
                    {
                        "data": "status",
                        render: function(data, type, row, meta) {
                            var checked = (data) ? "checked" : "";
                            return '<div class="form-switch"><input data-id="' +
                                row.product_id +
                                '" class="form-check-input" type="checkbox" role="switch" id="statusSwitch" ' +
                                checked + '></div>';

                        }
                    },
                    {
                        "data": "product_id",
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

            //switch status
            $('#example').on('change', '#statusSwitch', function(e) {
                var id = $(this).data('id');
                var url = "{{ route('product.switch', ':id') }}";
                url = url.replace(':id', id);
                Swal.fire({
                    icon: 'info',
                    title: 'Are you sure ?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
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
                });
            });

            // Delete a record
            $('#example').on('click', '.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('product.destroy', ':id') }}";
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
                var url = "{{ route('product.edit', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
            });


        });
    </script>
@endsection
