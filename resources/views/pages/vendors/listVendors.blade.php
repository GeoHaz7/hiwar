@extends('layouts.app')

@section('content')
    <div class="container">

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
                        orderable: false,
                        "render": function() {
                            return '<img class="listVendorProfile" src="https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png" />';
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


        });
    </script>
@endsection
