@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">

        <h2 class="headerText">Pages List</h2>

        <table id="example" class="display stripe table table-hover compact dataTable dtr-inline cell-border collapsed"
            style="width:100%">
            <thead>
                <tr>
                    <th>Featured Image</th>
                    <th>Title</th>
                    <th>Brief</th>
                    <th>Status</th>
                    <th>Show In Menu</th>
                    <th><a class="btn btn-primary" href="{{ Route('page.create') }}">Add</a></th>
                </tr>
            </thead>

        </table>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {


            var table = $('#example').DataTable({
                "ajax": "{{ route('page.data') }}",
                "columns": [{
                        "data": "filename",
                        orderable: false,
                        render: function(data, type, row, meta) {
                            if (data) {
                                return '<img class="listVendorProfile" src="{{ url('uploads/gallery') . '/' }}' +
                                    data + '" />';
                            }

                            return '<img class="listVendorProfile" src="{{ URL::asset('assets/noImage.png') }}" />';
                        }
                    }, {
                        "data": "title"
                    },
                    {
                        "data": "brief"
                    },
                    {
                        "data": "status",
                        render: function(data, type, row, meta) {
                            var checked = (data) ? "checked" : "";
                            return '<div class="form-switch"><input data-id="' +
                                row.page_id +
                                '" class="form-check-input" type="checkbox" role="switch" id="statusSwitch" ' +
                                checked + '></div>';

                        }
                    }, {
                        "data": "sideMenu",
                        render: function(data, type, row, meta) {
                            var checked = (data) ? "checked" : "";
                            return '<div class="form-switch"><input data-id="' +
                                row.page_id +
                                '" class="form-check-input" type="checkbox" role="switch" id="menuSwitch" ' +
                                checked + '></div>';

                        }
                    },
                    {
                        "data": "page_id",
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
                var url = "{{ route('page.switch', ':id') }}";
                url = url.replace(':id', id);
                Swal.fire({
                    icon: 'info',
                    title: 'Are you sure ?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
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
                    } else {
                        table.ajax.reload(null);
                    }
                });
            });

            //menu status
            $('#example').on('change', '#menuSwitch', function(e) {
                var id = $(this).data('id');
                var url = "{{ route('page.switchMenu', ':id') }}";
                url = url.replace(':id', id);
                Swal.fire({
                    icon: 'info',
                    title: 'Are you sure ?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {

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
                    } else {
                        table.ajax.reload(null);
                    }
                });
            });

            // Delete a record
            $('#example').on('click', '.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('page.destroy', ':id') }}";
                url = url.replace(':id', id);
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure ?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {

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
                    }
                });
            });
            // edit a record
            $('#example').on('click', '.fa-edit', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = "{{ route('page.edit', ':id') }}";
                url = url.replace(':id', id);
                window.location.href = url;
            });


        });
    </script>
@endsection
