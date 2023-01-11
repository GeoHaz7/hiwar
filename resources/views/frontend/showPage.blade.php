@extends('frontend.app')
@section('content')
    <section class="about-us-section light-gray-bg">
        <div class="container">
            <div class="row g-md-5 g-3 align-items-center">
                <div class="col-lg-8">
                    <div class="content-text">
                        <h3>{{ $page->title }}</h3>
                        <h2>{{ $page->brief }}</h2>
                        <p>{!! $page->description !!}</p>
                    </div>
                </div>
                <div class="col-lg-4 order-lg-1 order-first">
                    <div class="img-box" dir="ltr">
                        <img src="{{ $page->thumbnail ? url('uploads/gallery') . '/' . $page->thumbnail->filename : URL::asset('assets/noImage.png') }}"
                            alt="">
                    </div>
                </div>
            </div>
        </div>
    </section><!-- about-us-section end -->
@endsection
