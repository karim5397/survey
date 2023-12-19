<head>

    <meta charset="utf-8" />
    <title>Admin | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <link rel="canonical" href="{{ url()->current() }}">
    <!-- App favicon -->
    <link rel="shortcut icon"  href="{{asset('backend/assets/images/favicon.ico')}}">

    <!-- Plugins css -->
    <link href="{{asset('backend/assets/css/all.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
 
    <!-- icons -->
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/toastr-notification/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{asset('backend/assets/js/head.js')}}"></script>
    <link href="{{asset('backend/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />

    @yield('style')
    

</head>