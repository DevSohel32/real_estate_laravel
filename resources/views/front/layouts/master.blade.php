<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <title>The Home</title>

    <link rel="icon" type="image/png" href="uploads/favicon.png">

    <!-- All CSS -->
    @include('front.layouts.style')
    <!-- All Javascripts -->
    @include('front.layouts.script')

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap" rel="stylesheet">
</head><body>

    <div class="navbar-area" id="stickymenu">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav">
            <a href="index.html" class="logo">
                <img src="uploads/logo.png" alt="">
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        @include('front.layouts.nav')
    </div>
       @yield('content')

   @include('front.layouts.footer')
    @include('front.layouts.bottom-footer')

    <div class="scroll-top">
        <i class="fas fa-angle-up"></i>
    </div>

   @include('front.layouts.script-footer')
</body>
</html>