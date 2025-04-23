<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex , nofollow" />
    <title>Tool - Analytics Dashboard</title>

    <link href="{{asset('web_assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('web_assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    {{-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"> --}}

    <!-- Vendor CSS Files -->
    <link href="{{asset('web_assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('web_assets/admin/assets/css/admin.css')}}" rel="stylesheet">
</head>

<body>

    @include('admin.includes.header')
    @include('admin.includes.sidebar')
      
    <main id="main" class="main">
        @yield('content')
    </main>

    @include('admin.includes.footer')
</body>

</html>
