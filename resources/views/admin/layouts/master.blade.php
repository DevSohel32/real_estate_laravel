<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">
    <title>Admin Panel</title>
    @include('admin.layouts.style')
    @include('admin.layouts.script')
    
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @yield('content')
        </div>
    </div>
    @include('admin.layouts.script-footer')
</body>

</html>
