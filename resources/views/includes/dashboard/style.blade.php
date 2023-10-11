<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<title>{{ $title }}</title>
<meta content="Responsive admin theme build on top of Bootstrap 4" name="description" />
<meta content="Themesdesign" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('/be/assets/images/favicon.ico') }}">

<link href="{{ asset('/be/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

<!--Morris Chart CSS -->
{{-- @vite('resources/css/app.css') --}}
<link rel="stylesheet" href="{{ asset('/be/plugins/morris/morris.css') }}">

<link href="{{ asset('/be/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/be/assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">

<!-- Sweet Alert -->
<link href="{{ asset('/be/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

<!-- DataTables -->
<link href="{{ asset('/be/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/be/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{asset('/be/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('/be/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/be/assets/css/style.css') }}" rel="stylesheet" type="text/css">