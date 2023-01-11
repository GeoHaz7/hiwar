<!-- about-us-section -->
<section class="about-us-section light-gray-bg">
    <div class="container">

        <div class="row g-md-5 g-3 align-items-center">
            <div class="col-lg-8">
                <div class="content-text">
                    <h3>{{ $pages[0]->title }}</h3>
                    <h2>{{ $pages[0]->brief }}</h2>
                    <p>{{ $pages[0]->description }}.</p>
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 order-first">
                <div class="img-box" dir="ltr">
                    <img src="{{ url('uploads/gallery') . '/' . $pages[0]->thumbnail->filename }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section><!-- about-us-section end -->
