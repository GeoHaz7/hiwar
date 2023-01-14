@extends('frontend.app')



@section('content')
    @if (!empty($products))
        <section class="h-100 h-custom " style="background-color: #eee; direction:ltr;">
            <div class="container py-3 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                            <div class="card-body p-4">

                                <div class="row">

                                    <div class="col-lg-7">
                                        <h5 class="mb-3"><a href="#!" class="text-body"><i
                                                    class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <p class="mb-1">Shopping cart</p>
                                                <p class="mb-0">You have 4 items in your cart</p>
                                            </div>

                                        </div>

                                        @foreach ($products as $item)
                                            <div class="card mb-3 card{{ $item->product_id }}">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div>

                                                                @if (isset($item->filename))
                                                                    <img src="{{ url('uploads/gallery') . '/' . $item->filename }}"
                                                                        class="img-fluid rounded-3" alt="Shopping item"
                                                                        style="width: 300px;">
                                                                @else
                                                                    <img src="{{ URL::asset('assets/noImage.png') }}"
                                                                        class="img-fluid rounded-3" alt="Shopping item"
                                                                        style="width: 300px;">
                                                                @endif


                                                            </div>
                                                            <div class="mx-3">
                                                                <h5>{{ $item->name }}</h5>
                                                                <p class="small mb-0">{!! $item->description !!}</p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">

                                                            <div>
                                                                <h5 class="mb-0" style="width: 100px">
                                                                    <span
                                                                        class="itemPrice{{ $item->product_id }}">{{ $item->price }}</span>
                                                                    <span>X</span>
                                                                    <span
                                                                        class="itemQuantiy{{ $item->product_id }}">{{ $item->quantiy }}</span>
                                                                    <span>=</span>
                                                                    <span
                                                                        class="itemTotal{{ $item->product_id }}">{{ $item->quantiy * $item->price }}</span>

                                                                    {{-- {{ $item->price . 'X' . $item->quantiy . '=' . $item->price * $item->quantiy }} --}}
                                                                </h5>
                                                            </div>

                                                            <a href="#!" style="color: red;"><i
                                                                    class="fas fa-trash-alt mx-2 delete"
                                                                    data-id="{{ $item->product_id }}"></i></a>
                                                        </div>
                                                    </div>
                                                    <a href="javascript:void(0)" data-id="{{ $item->product_id }}"
                                                        class="btn card-link plusOne"><i class="bi bi-file-plus-fill"
                                                            style="font-size: 2rem;"></i></a>
                                                    <a href="javascript:void(0)" data-id="{{ $item->product_id }}"
                                                        class="btn card-link minusOne" style="font-size: 2rem;"><i
                                                            class="bi bi-file-minus-fill"></i></a>
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                    <div class="col-lg-5 bigDiv">

                                        <div class="card bg-primary text-white rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h5 class="mb-0">Card details</h5>
                                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp"
                                                        class="img-fluid rounded-3" style="width: 45px;" alt="Avatar">
                                                </div>

                                                <p class="small mb-2">Card type</p>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-visa fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-amex fa-2x me-2"></i></a>
                                                <a href="#!" type="submit" class="text-white"><i
                                                        class="fab fa-cc-paypal fa-2x"></i></a>

                                                <form id="paymentInfo" class="mt-4">
                                                    @csrf
                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="text" id="first_name" name="first_name"
                                                                    class="form-control form-control-lg" placeholder="John"
                                                                    size="7" minlength="7" maxlength="7">
                                                                <label class="form-label" for="typeExp">First Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="text" id="typetext" name="last_name"
                                                                    class="form-control form-control-lg" placeholder="Doe"
                                                                    minlength="3" maxlength="15">
                                                                <label class="form-label" for="typeText">Last Name</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-outline form-white mb-4">
                                                        <input type="email" id="email" name="email"
                                                            class="form-control form-control-lg"
                                                            placeholder="example@example.com" minlength="7"
                                                            maxlength="19" />
                                                        <label class="form-label" for="typeText">Email</label>
                                                    </div>

                                                    <div class="row mb-4">
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="text" id="city" name="city"
                                                                    class="form-control form-control-lg"
                                                                    placeholder="Texas" />
                                                                <label class="form-label" for="typeExp">City</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-outline form-white">
                                                                <input type="number" id="phone" name="phone"
                                                                    class="form-control form-control-lg"
                                                                    placeholder="0598551550" />
                                                                <label class="form-label" for="typeText">Phone</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </form>

                                                <hr class="my-4">

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Subtotal</p>
                                                    <p>₪<span class="mb-2 subTotal">{{ $total }}</span></p>
                                                </div>

                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Shipping</p>
                                                    <p class="mb-2">₪20</p>
                                                </div>

                                                {{-- <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total(Incl. taxes)</p>
                                                <p class="mb-2">₪{{ $total + 20 }}</p>
                                            </div> --}}

                                                <button type="button" class="btn btn-info btn-block btn-lg checkout">
                                                    <div class="d-flex justify-content-between">
                                                        <span>₪<span class="checkTotal">{{ $total + 20 }}</span></span>

                                                        <span class="mx-2">Checkout <i
                                                                class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="row my-3">
            <div class="offset-lg-3 col-lg-6 col-md-12 col-12 text-center">
                <img src="{{ URL('assets/img/bag.svg') }}" alt="" class="img-fluid mb-4">
                <h2>Your shopping cart is empty</h2>
                <p class="mb-4">
                    Return to the store to add items for your delivery slot. Before proceed to checkout you must add some
                    products to your shopping cart. You will find a lot of interesting products on our shop page.
                </p>
                <a href="{{ route('cart.index') }}" class="btn btn-primary">Explore Products</a>
            </div>
        </div>
    @endif
@endsection

{{-- cart.minus --}}
@section('js')
    <script>
        $(document).ready(function() {
            $('.plusOne').click(function() {
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
                            var q = +$('.itemQuantiy' + id).html();
                            $('.itemQuantiy' + id).html(q + 1);

                            var t = +$('.itemTotal' + id).html();
                            var p = +$('.itemPrice' + id).html();
                            $('.itemTotal' + id).html(t + p);

                            var ct = +$('.checkTotal').html();
                            $('.checkTotal').html((ct + p));

                            var st = +$('.subTotal').html();
                            $('.subTotal').html((st + p));

                        }
                    },
                    error: function(err) {}
                });
            })

            $('.minusOne').click(function() {
                var id = $(this).data('id');
                var url = "{{ route('cart.minus', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.message == "success") {
                            var q = +$('.itemQuantiy' + id).html();
                            $('.itemQuantiy' + id).html(q - 1);

                            var t = +$('.itemTotal' + id).html();
                            var p = +$('.itemPrice' + id).html();
                            $('.itemTotal' + id).html(t - p);

                            var ct = +$('.checkTotal').html();
                            $('.checkTotal').html((ct - p));

                            var st = +$('.subTotal').html();
                            $('.subTotal').html((st - p));

                        } else if (response.message == "removed") {
                            var t = +$('.itemTotal' + id).html();
                            var p = +$('.itemPrice' + id).html();
                            $('.itemTotal' + id).html(t - p);

                            var ct = +$('.checkTotal').html();
                            $('.checkTotal').html((ct - p));

                            var st = +$('.subTotal').html();
                            $('.subTotal').html((st - p));
                            $('.card' + id).remove();
                        }
                    },
                    error: function(err) {}
                });
            })

            $('.delete').click(function() {
                var id = $(this).data('id');
                var url = "{{ route('cart.delete', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: "GET",
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.message == "success") {
                            var t = +$('.itemTotal' + id).html();

                            var ct = +$('.checkTotal').html();
                            $('.checkTotal').html((ct - t));

                            var st = +$('.subTotal').html();
                            $('.subTotal').html((st - t));

                            $('.card' + id).remove();

                        }
                    },
                    error: function(err) {}
                });
            })


            $('#paymentInfo').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },

                },
                errorElement: "div",
                errorPlacement: function(error, element) {
                    error.insertAfter(element.parent());
                },
                submitHandler: function(form) {

                    var fd = new FormData(form);
                    fd.append('total_price', +$('.checkTotal').html());


                    $.ajax({
                        url: "{{ route('order.store') }}",
                        type: "POST",
                        processData: false,
                        contentType: false,
                        data: fd,
                        success: function(response) {
                            if (response.message == 'success') {
                                var fd = new FormData();
                                fd.append('order_id', response.order_id);
                                fd.append('_token', '{{ csrf_token() }}');
                                $.ajax({
                                    url: "{{ route('cart.checkout') }}",
                                    type: "POST",
                                    processData: false,
                                    contentType: false,
                                    data: fd,
                                    success: function(response) {

                                        if (response.message == "success") {
                                            console.log('ddddddd');
                                        }
                                    },
                                    error: function(err) {}
                                });
                            }
                        },
                        error: function(err) {

                        }
                    });
                }
            });
            $('.checkout').click(function() {
                $("#paymentInfo").submit();
            })

        });
    </script>
@endsection
