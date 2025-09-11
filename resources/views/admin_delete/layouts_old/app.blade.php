<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Housing.com</title>

<link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/bootstrap.min.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <div class="navbar-nav pl-2">
            <!-- <ol class="breadcrumb p-0 m-0 bg-white">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol> -->
        </div>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
                    <img src="{{ asset('uploads/profile/thumb/'.Auth::user()->image) }}" class='img-circle elevation-2' width="40" height="40" alt="">                    
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
                    <h4 class="h4 mb-0"><strong>{{ Auth::user()->name }}</strong></h4>
                    <div class="mb-3">{{ Auth::user()->email }}</div>
                    
                    <div class="dropdown-divider"></div>

                    @if( Auth::user()->role == 'admin')
                        <a class="dropdown-item" href=""><i class="las la-user fs-18 me-1 align-text-bottom"></i> User</a>
                    @endif	
                    <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>                                                                
                    <a class="dropdown-item text-danger" href="{{ route('account.logout') }}"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
                                                        
                </div>
            </li>
        </ul>
    </nav>

    @include('admin/layouts/header')

	<div class="content-wrapper">
        @yield('content')
	</div>

    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
    </footer>
</div>

<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>

<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/datetimepicker.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('admin-assets/js/demo.js') }}"></script> --}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $(".summernote").summernote({
            //height:250;
        });
    })
    //Alert timeout
    setTimeout(function () {
        $('.alert').fadeOut(300);
    }, 1500);
</script>

@yield('customJs')
</body>
</html>