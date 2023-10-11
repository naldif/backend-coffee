
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ $title }}</title>
    <meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
    <meta content="Themesdesign" name="author" />
    <link rel="shortcut icon" href="{{ asset('/be/assets/images/favicon.ico') }}">

    <link href="{{ asset('/be/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/be/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/be/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/be/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/be/assets/css/style.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
    <div class="accountbg"></div>

    <!-- Begin page -->
    <div class="wrapper-page">

        <div class="container">
            @yield('content')
            <!-- end row -->
        </div>
    </div>

    <!-- jQuery  -->
    <script src="{{ asset('/be/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/be/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/be/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('/be/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('/be/assets/js/waves.min.js') }}"></script>

    <script src="{{ asset('/be/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('/be/assets/js/app.js') }}"></script>

</body>

</html>