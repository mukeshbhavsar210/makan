<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Housing.com</title>

<link href="{{ asset('admin-assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('admin-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('admin-assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('admin-assets/css/custom.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('admin-assets/plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('admin-assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" >
<link href="{{ asset('admin-assets/css/datetimepicker.css') }}" rel="stylesheet" >
<link href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}" rel="stylesheet" >
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body data-sidebar-size="collapsed">
		<div class="topbar d-print-none">
            <div class="container-xxl">
                <nav class="topbar-custom d-flex justify-content-between nav-sticky" id="topbar-custom">    
                    <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">                        
                        <li>
                            <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                                <i class="iconoir-menu-scale"></i>
                            </button>
                        </li> 
                        <li class="mx-3 welcome-text">
                            <h4 class="mb-0 fw-bold text-truncate">Good Morning, {{ Auth::user()->name }}!</h4>
                        </li>                   
                    </ul>

                    <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                        <li class="hide-phone app-search">
                            <form role="search" action="#" method="get">
                                <input type="search" name="search" class="form-control top-search mb-0" placeholder="Search here...">
                                <button type="submit"><i class="iconoir-search"></i></button>
                            </form>
                        </li>                             
                        <li class="topbar-item">
                            <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                                <i class="icofont-moon dark-mode"></i>
                                <i class="icofont-sun light-mode"></i>
                            </a>                    
                        </li>                          
                        <li class="dropdown topbar-item">
                            <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="" class="thumb-lg rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end py-0" style="">
                                <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                                    <div class="flex-shrink-0">
										{{ Auth::user()->name }}
                                    </div>
                                    <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                        <h6 class="my-0 fw-medium text-dark fs-13"></h6>
                                        <small class="text-muted mb-0"></small>
                                    </div>
                                </div>
                                <div class="dropdown-divider mt-0"></div>
								@if( Auth::user()->role == 'admin')
									<a class="dropdown-item" href=""><i class="las la-user fs-18 me-1 align-text-bottom"></i> User</a>
								@endif	
                                <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Profile</a>
                                <a class="dropdown-item" href=""><i class="las la-cog fs-18 me-1 align-text-bottom"></i> Settings</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item text-danger" href="{{ route('account.logout') }}"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
		
        <div class="startbar d-print-none">
            <div class="brand">
                <a href="{{ route('front.home') }}" class="logo" target="_blank">
                    <span>
                        <img src="{{ asset('admin-assets/img/logo-small.png') }}" alt="logo-small" class="logo-sm">
                    </span>
                    <span class="">
                        <img src="{{ asset('admin-assets/img/logo.png') }}" alt="logo-large" class="logo-lg logo-light">
                        <img src="{{ asset('admin-assets/img/logo.png') }}" alt="logo-large" class="logo-lg logo-dark">
                    </span>
                </a>
            </div>

            <div class="startbar-menu">
                <div class="startbar-collapse simplebar-scrollable-y" id="startbarCollapse" data-simplebar="init">
                    <div class="simplebar-wrapper" style="margin: 0px -16px -16px;">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                    <div class="simplebar-content" >
                                        <div class="d-flex align-items-start flex-column w-100">
                                            @include('admin/layouts/sidebar')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="simplebar-placeholder" style="width: 70px; height: 657px;"></div>
                    </div>
                    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                        <div class="simplebar-scrollbar" style="width: 0px; transform: translate3d(0px, 0px, 0px); display: none;">
                        </div>
                    </div>
                    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                        <div class="simplebar-scrollbar" style="height: 413px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="startbar-overlay d-print-none"></div>
			<div class="page-wrapper">
            	<div class="page-content">
                	<div class="container-xxl">
                		@yield('content')
					</div>
				</div>

				{{-- <footer class="footer text-center text-sm-start d-print-none">
                    <div class="container-xxl">
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-0 rounded-bottom-0">
                                    <div class="card-body">
                                        <p class="text-muted mb-0"> © <script> document.write(new Date().getFullYear()) </script> Heaven Prints </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer> --}}
			</div>		

		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('admin-assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('admin-assets/js/simplebar.js') }}"></script>
		<script src="{{ asset('admin-assets/js/app.js') }}"></script>

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