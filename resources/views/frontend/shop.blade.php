@extends('frontend.app')

<style>
    .card-top-image {
        width: 286px;
        height: 160px;
    }

    .bi-cart3 {
        font-size: 2em;
    }
</style>

@section('content')
    <div class="container">
        <a href="{{ route('front.cart') }}" type="button" class="btn position-relative float-right mt-3 me-3">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger itemCount d-none">
                0
                <span class="visually-hidden">unread messages</span>
            </span>
            <i class="bi bi-cart3"></i>
        </a>
        <div class="row my-3">
            @foreach ($product->get() as $item)
                <div class="col-sm-4 mt-3 text-center">
                    <div class="card" style="width: 18rem;">
                        <img class="card-top-image"
                            src="{{ $item->filename ? url('uploads/gallery') . '/' . $item->filename : URL::asset('assets/noImage.png') }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{!! $item->description !!}</p>
                            <button class="btn btn-primary addToCart" data-id="{{ $item->product_id }}">Add To Cart</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {

            $.ajax({
                url: "{{ route('cart.totalItems') }}",
                type: "GET",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.message == "success") {
                        $(".itemCount").html(response.totalItems);
                        $(".itemCount").removeClass('d-none');
                    }
                },
                error: function(err) {}
            });


            $('.addToCart').on('click', function(e) {
                var id = $(this).data('id');
                var url = "{{ route('cart.addTo', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.message == "success") {
                            $.ajax({
                                url: "{{ route('cart.totalItems') }}",
                                type: "GET",
                                processData: false,
                                contentType: false,
                                success: function(response) {
                                    if (response.message == "success") {
                                        $(".itemCount").html(response.totalItems);
                                    }
                                },
                                error: function(err) {}
                            });
                        }
                    },
                    error: function(err) {}
                });
            });
        })
    </script>
@endsection
