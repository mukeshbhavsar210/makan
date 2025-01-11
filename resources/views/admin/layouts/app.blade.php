<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Housing.com</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }} ">
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }} ">
        <link rel="stylesheet" href="{{ asset('admin-assets/css/datetimepicker.css') }} ">
        <meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Right navbar links -->
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
						@if (Auth::user()->image != '')
							<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
								<img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="avatar" class='img-circle elevation-2' width="40" height="40" alt="">
							</a>
						@else
							<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
								<img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar" class='img-circle elevation-2' width="40" height="40" alt="">								
							</a>
						@endif
						
						<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
							<div class="dropdown-item">
								<i class="fas fa-lock mr-2"></i> {{ Auth::user()->name }}
							</div>
							
							<div class="dropdown-divider"></div>
							<a href="{{ route('profile.index') }}" class="dropdown-item">
								<i class="fas fa-lock mr-2"></i> Profile
							</a>
							
							<div class="dropdown-divider"></div>
							@if( Auth::user()->role == 'admin')
								<a href="{{ route('users.index') }}" class="dropdown-item">
									<i class="fas fa-users mr-2"></i> Users
								</a>
							@endif					

							<div class="dropdown-divider"></div>
							<a href="{{ route('account.logout') }}" class="dropdown-item text-danger">
								<i class="fas fa-sign-out-alt mr-2"></i> Logout
							</a>
						</div>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->

            @include('admin/layouts/sidebar')

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
                @yield('content')
			</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				<strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
			</footer>

		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
        <script src="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('admin-assets/js/datetimepicker.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('admin-assets/js/demo.js') }}"></script>
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