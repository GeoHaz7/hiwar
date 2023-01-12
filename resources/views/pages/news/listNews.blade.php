@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">

        <h2 class="headerText">{{ __('generalBack.newsList') }}</h2>

        <table id="example" class="display stripe table table-hover compact dataTable dtr-inline cell-border collapsed"
            style="width:100%">
            <thead>
                <tr>
                    <th>{{ __('generalBack.featredImage') }}</th>
                    <th>{{ __('generalBack.title') }}</th>
                    <th>{{ __('generalBack.brief') }}</th>
                    <th>{{ __('generalBack.category') }}</th>
                    <th><a class="btn btn-primary" href="{{ Route('news.create') }}">{{ __('generalBack.add') }}</a></th>
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

                            return '<img class="listVendorProfile" src="{{ URL::asset('assets/noImage.png') }}" />';
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
