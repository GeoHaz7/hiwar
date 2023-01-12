@extends('layouts.app')

@section('content')
    <div class="container col-10 py-3">

        <h2 class="headerText">{{ __('generalBack.optionsList') }}</h2>

        <table id="example" class="display stripe table table-hover compact dataTable dtr-inline cell-border collapsed "
            style="width:100%">
            <thead>
                <tr>
                    <th>{{ __('generalBack.name') }}</th>
                    <th width="450">{{ __('generalBack.value') }}</th>
                    <th></th>
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
                "order": [2, 'ASC'],
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
                                return '<img class="listVendorProfile" src="{{ url('uploads/gallery') . '/' }}' +
                                    data + '" />';
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
                                    text = '{{ __('generalBack.websiteName') }}';
                                    break;

                                case ('website_description'):
                                    text = '{{ __('generalBack.websiteDescription') }}';
                                    break;

                                case ('website_lang'):
                                    text = '{{ __('generalBack.websiteDefaultLang') }}';
                                    break;

                                case ('website_photo'):
                                    text = '{{ __('generalBack.websiteLogo') }}';
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
                var optionName = $(this).data('name');
                var url = "{{ route('news.edit', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: "{{ route('option.data') }}",
                    type: "GET",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        var websiteName = response.data[0].value;
                        var websiteDescription = response.data[1].value;
                        var websiteLang = response.data[2].value;
                        var websiteLogo = response.data[3].value;

                        (async () => {
                            if (optionName ==
                                '{{ __('generalBack.websiteDefaultLang') }}') {

                                const inputOptions = new Promise((resolve) => {
                                    resolve({
                                        'AR': 'Arabic',
                                        'EN': 'English',
                                    })
                                })


                                const {
                                    value: lang
                                } = await Swal.fire({
                                    title: '{{ __('generalBack.selectDefaultLanguage') }}',
                                    input: 'radio',
                                    inputValue: websiteLang,
                                    inputOptions: inputOptions,
                                    showCancelButton: true,
                                    inputValidator: (value) => {

                                    }
                                })

                                if (lang) {
                                    var fd = new FormData();

                                    fd.append('websiteLang', lang);
                                    fd.append('_token', '{{ csrf_token() }}');

                                    $.ajax({
                                        url: "{{ route('option.update') }}",
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
                                                table.ajax
                                                    .reload(
                                                        null
                                                    );


                                            });
                                        },
                                        error: function(err) {}
                                    });
                                }

                            } else if (optionName ==
                                '{{ __('generalBack.websiteLogo') }}') {
                                const {
                                    value: file
                                } = await Swal.fire({
                                    title: '{{ __('generalBack.selectLogo') }}',
                                    input: 'file',
                                    showCancelButton: true,
                                    inputAttributes: {
                                        'accept': 'image/*',
                                        'aria-label': 'Upload your new logo'
                                    }
                                })

                                if (file) {
                                    const reader = new FileReader()
                                    reader.onload = (e) => {
                                        Swal.fire({
                                            title: 'Your uploaded logo',
                                            imageUrl: e.target.result,
                                            imageAlt: 'The uploaded logo',
                                            showCancelButton: true
                                        })
                                    }

                                    var fd = new FormData();

                                    fd.append('file', $('.swal2-file')[0].files[
                                        0]);
                                    fd.append('_token', '{{ csrf_token() }}');

                                    $.ajax({
                                        url: "{{ route('option.update') }}",
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
                                                reader
                                                    .readAsDataURL(
                                                        file)
                                                table.ajax
                                                    .reload(
                                                        null
                                                    );


                                            });
                                        },
                                        error: function(err) {}
                                    });

                                }

                            } else if (optionName ==
                                '{{ __('generalBack.websiteDescription') }}') {
                                const {
                                    value: description
                                } = await Swal.fire({
                                    title: '{{ __('generalBack.editTheWebsiteDescription') }}',
                                    input: 'textarea',
                                    inputValue: websiteDescription,
                                    inputPlaceholder: 'Type your message here...',
                                    inputAttributes: {
                                        'aria-label': 'Type your message here'
                                    },
                                    showCancelButton: true
                                })

                                if (description) {
                                    var fd = new FormData();

                                    fd.append('websiteDescription', description);
                                    fd.append('_token', '{{ csrf_token() }}');

                                    $.ajax({
                                        url: "{{ route('option.update') }}",
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
                                                table.ajax
                                                    .reload(
                                                        null
                                                    );


                                            });
                                        },
                                        error: function(err) {}
                                    });
                                }

                            } else if (optionName ==
                                '{{ __('generalBack.websiteName') }}') {
                                const {
                                    value: name
                                } = await Swal.fire({
                                    title: '{{ __('generalBack.editTheWebsiteName') }}',
                                    input: 'text',
                                    inputValue: websiteName,
                                    inputPlaceholder: 'Enter New Webiste Name',
                                    showCancelButton: true

                                })

                                if (name) {
                                    var fd = new FormData();

                                    fd.append('websiteName', name);
                                    fd.append('_token', '{{ csrf_token() }}');

                                    $.ajax({
                                        url: "{{ route('option.update') }}",
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
                                                table.ajax
                                                    .reload(
                                                        null
                                                    );
                                            });
                                        },
                                        error: function(err) {}
                                    });
                                }
                            }
                        })()
                    },
                    error: function(err) {

                    }
                });




            });


        });
    </script>
@endsection
