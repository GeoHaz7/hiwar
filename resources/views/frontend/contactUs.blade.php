@extends('frontend.app')

@section('content')
    <section class="contact-us-section light-gray-bg">
        <div class="container">
            <div class="row justify-content-between">
                <div class="img-wrap h-100">
                    <div class="img-box h-100">
                        <img class="img-fluid" src="assets/img/about-company-croped-img.png" alt="">
                    </div>
                </div>
                <div class="form-wrap">
                    <div class="section-title">
                        <h3>تعزيز مشاركتهم بناء مجتمع فلسطيني</h3>
                        <h2>بناء مجتمع فلسطيني</h2>
                    </div>
                    <div class="contact-form">
                        <form action="#">
                            <div class="input-group-column2">
                                <div class="input-group">
                                    <label for="#">الحوار الاجتماعي</label>
                                    <input type="text">
                                </div>
                                <div class="input-group">
                                    <label for="#">المبني على</label>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="#">ونبذ العنف</label>
                                <textarea></textarea>
                            </div>
                            <div class="input-group">
                                <input type="submit" value="إرسال">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js')
@endsection
