<!DOCTYPE html>
<!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
    <html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html lang="ar" dir="rtl">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مؤسسة حوار للتنمية المجتمعية</title>
    <!-- Meta Tags -->
    <meta name="title" content="مؤسسة حوار للتنمية المجتمعية">
    <meta name="description"
        content="مؤسسة حوار للتنمية المجتمعية هي مؤسسة أهلية فلسطينية غير ربحية، متخصصة في العمل الشبابي والنسوي. تأسست عام 2010 من قبل مجموعة فلسطينية شابة، و تركز في برامجها على تدريب وتمكين الشباب والنساء من أجل تعزيز مشاركتهم في بناء مجتمع فلسطيني تسوده العدالة الاجتماعية والديمقراطية والمساواة وتدعيم لغة الحوار ونبذ العنف المبني على النوع الاجتماعي.">
    <meta name="keywords" content="Ramallah, Women youth, hiwar">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Arabic">
    <meta name="revisit-after" content="7 days">
    <meta name="author" content="Element Media">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://hiwar.ps/">
    <meta property="og:title" content="مؤسسة حوار للتنمية المجتمعية">
    <meta property="og:description"
        content="مؤسسة حوار للتنمية المجتمعية هي مؤسسة أهلية فلسطينية غير ربحية، متخصصة في العمل الشبابي والنسوي. تأسست عام 2010 من قبل مجموعة فلسطينية شابة، و تركز في برامجها على تدريب وتمكين الشباب والنساء من أجل تعزيز مشاركتهم في بناء مجتمع فلسطيني تسوده العدالة الاجتماعية والديمقراطية والمساواة وتدعيم لغة الحوار ونبذ العنف المبني على النوع الاجتماعي.">
    <meta property="og:image" content="assets/img/slider-img1.png">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://hiwar.ps/">
    <meta property="twitter:title" content="مؤسسة حوار للتنمية المجتمعية">
    <meta property="twitter:description"
        content="مؤسسة حوار للتنمية المجتمعية هي مؤسسة أهلية فلسطينية غير ربحية، متخصصة في العمل الشبابي والنسوي. تأسست عام 2010 من قبل مجموعة فلسطينية شابة، و تركز في برامجها على تدريب وتمكين الشباب والنساء من أجل تعزيز مشاركتهم في بناء مجتمع فلسطيني تسوده العدالة الاجتماعية والديمقراطية والمساواة وتدعيم لغة الحوار ونبذ العنف المبني على النوع الاجتماعي.">
    <meta property="twitter:image" content="assets/img/slider-img1.png">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.rtl.min.css') }}" />
    <!-- <link rel="stylesheet" type="text/css" href="../../../public/assets/css/bootstrap.rtl.min.css"> -->
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.2/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/styleFront.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/responsive.css') }}">

    <!--End ALL STYLESHEET -->

</head>

<body>

    @include('frontend.header', ['pages' => $pages])

    <!-- main -->
    <main class="mainContent toggled ">
        @yield('content')
    </main>

    @include('frontend.footer')

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js"
        integrity="sha512-72WD92hLs7T5FAXn3vkNZflWG6pglUDDpm87TeQmfSg8KnrymL2G30R7as4FmTwhgu9H7eSzDCX3mjitSecKnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>

    @yield('js')

    <script>
        var url = "{{ route('changeLangFront') }}";

        $(".langAR").click(function() {
            window.location.href = url + "?lang=ar";
        });
        $(".langEN").click(function() {
            window.location.href = url + "?lang=en";
        });
    </script>
</body>




</html>
