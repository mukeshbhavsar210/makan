<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="format-detection" content="telephone=no">
<title>Housing.com</title>
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/bootstrap.min.css') }}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body >
	
@if (!View::hasSection('hideHeader'))
	<header>
		<nav class="navbar navbar-expand-lg shadow py-3">
			<div class="container">
				<a class="navbar-brand" href="{{ route('front.home') }}"><img src="{{ asset('front-assets/images/logo.png') }}" /></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<a class="btn btn-primary" href="" type="submit">Post a Job</a>
				</div>
				
				@if (Auth::check())
					<div class="sidebar-modal-btn" data-bs-toggle="offcanvas" data-bs-target="#sideModal" aria-controls="sideModal">
						<svg width="12px" height="12px" viewBox="0 -1 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">								
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
								<g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-210.000000, -887.000000)" fill="#666666">
									<path d="M229,895 L211,895 C210.448,895 210,895.448 210,896 C210,896.553 210.448,897 211,897 L229,897 C229.552,897 230,896.553 230,896 C230,895.448 229.552,895 229,895 L229,895 Z M229,903 L211,903 C210.448,903 210,903.448 210,904 C210,904.553 210.448,905 211,905 L229,905 C229.552,905 230,904.553 230,904 C230,903.448 229.552,903 229,903 L229,903 Z M211,889 L229,889 C229.552,889 230,888.553 230,888 C230,887.448 229.552,887 229,887 L211,887 C210.448,887 210,887.448 210,888 C210,888.553 210.448,889 211,889 L211,889 Z" id="hamburger" sketch:type="MSShapeGroup">
									</path>
								</g>
							</g>
						</svg>
						@if(Auth::user()->image)
							<img class="photo" src="{{ asset('uploads/profile/thumb/'.Auth::user()->image) }}" alt="" >
						@else
							<img class="photo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
						@endif
					</div>
				@else
					<div class="sidebar-modal-btn" data-bs-toggle="offcanvas" data-bs-target="#sideModal" aria-controls="sideModal">
						<svg width="12px" height="12px" viewBox="0 -1 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">								
							<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
								<g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-210.000000, -887.000000)" fill="#666666">
									<path d="M229,895 L211,895 C210.448,895 210,895.448 210,896 C210,896.553 210.448,897 211,897 L229,897 C229.552,897 230,896.553 230,896 C230,895.448 229.552,895 229,895 L229,895 Z M229,903 L211,903 C210.448,903 210,903.448 210,904 C210,904.553 210.448,905 211,905 L229,905 C229.552,905 230,904.553 230,904 C230,903.448 229.552,903 229,903 L229,903 Z M211,889 L229,889 C229.552,889 230,888.553 230,888 C230,887.448 229.552,887 229,887 L211,887 C210.448,887 210,887.448 210,888 C210,888.553 210.448,889 211,889 L211,889 Z" id="hamburger" sketch:type="MSShapeGroup">
									</path>
								</g>
							</g>
						</svg>
						<img class="photo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
					</div>					
				@endif					
			</div>
		</nav>
	</header>	
@endif

<div class="offcanvas offcanvas-end" tabindex="-1" id="sideModal" aria-labelledby="sideModalLabel">  
	<div class="sidebar">
		<div class="user-details">
			@if (Auth::check())
				<div class="details">
					<div class="user-photo">
						@if(Auth::user()->image)
							<img class="photo" src="{{ asset('uploads/profile/thumb/'.Auth::user()->image) }}" alt="" >
						@else
							<img class="photo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
						@endif					
					</div>		
					
					<div class="name">
						<p><b>Hello {{ Auth::user()->name }}</b><br />
							{{ Auth::user()->email }}<br /> +91-{{ Auth::user()->mobile }}
						</p>

						<ul class="sidebar-login">
							<li><a href="{{ route('profile.index') }}">Edit Profile</a></li>
							<li><a href="{{ route('account.logout') }}">Logout</a></li>													
						</ul>
					</div>							
				</div>
			@else
				<div class="details">
					<div class="user-photo">
						<img class="photo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
					</div>		
					
					<div class="name">
						<p><b>Hello 👋🏻</b><br />
						Easy Contact with sellers<br />
						Personalized experience</p>

						<ul class="sidebar-login">
							<li><a class="" href="#" data-bs-toggle="modal" data-bs-target="#registerAccountModal">Register Account</a></li>
							<li><a class="" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>						
						</ul>
					</div>	
				</div>								
			@endif	

			<div class="divider"></div>

			<div class="activities">
				<h6>My Activity</h6>
				<ul class="nav nav-pills" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<a href="#" class="nav-link active" id="pills-tab_01" data-bs-toggle="pill" data-bs-target="#tab_01" aria-controls="tab_01" aria-selected="true">
							<p>Contacted <br />Properties</p>
							<p class="count">00</p>
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="pills-tab_02" data-bs-toggle="pill" data-bs-target="#tab_02" aria-controls="tab_02" aria-selected="false">
							<p>Seen <br />Properties</p>
							<p class="count">00</p>									
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="pills-tab_03" data-bs-toggle="pill" data-bs-target="#tab_03" aria-controls="tab_03" aria-selected="false">
							<p>Saved<br /> Properties</p>
							<p class="count">00</p>
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="pills-tab_04" data-bs-toggle="pill" data-bs-target="#tab_04" aria-controls="tab_04" aria-selected="false">
							<p>Recent<br /> Searches</p>
							<p class="count">00</p>																		
						</a>
					</li>
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="tab_01" role="tabpanel" aria-labelledby="pills-tab_01">
						<h2>Home</h2>							
					</div>

					<div class="tab-pane fade" id="tab_02" role="tabpanel" aria-labelledby="pills-tab_02">
						<h2>Profile</h2>							
					</div>

					<div class="tab-pane fade" id="tab_03" role="tabpanel" aria-labelledby="pills-tab_03">
						<h2>Contact</h2>							
					</div>

					<div class="tab-pane fade" id="tab_04" role="tabpanel" aria-labelledby="pills-tab_04">
						<h2>Contact 4</h2>							
					</div>
				</div>
			</div>
	
			<div class="accordion" id="accordionExample">
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<div class="icon icon_01">1</div>
							Quick Links
						</button>
					</h2>
					<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<ul class="inside-link">
								<li><a href="#">Home</a></li>
								<li><a href="#">Post Properties</a></li>							
								<li><a href="#">Research</a></li>							
							</ul>
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<div class="icon icon_02">1</div>
							Residential Packages
						</button>
					</h2>
					<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							<div class="icon icon_03">1</div>
							Services
						</button>
					</h2>
					<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							Coming
						</div>
					</div>
				</div>
			</div>

			<div class="css-x4croi">
				<div class="css-1502bnp"> Visit Help Center</div>
				<div class="css-cq89je"></div>
				<div class="css-yibggk">
					<div class="css-13ewv5y">
						<div class="css-1b3xa19">Download Housing App</div>
						<div class="css-1qwz5j2">
							<span class="css-0">
								<img class="css-p6vbf2" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/app-store.10009972.png"></span><span class="css-0"><img class="css-p6vbf2" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/google-play.2c209e8c.png">
							</span>
						</div>
					</div>
				<img class="img css-fkxcmo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/qr-code.f143ed3a.png">
			</div>
			</div>			
		</div>			
	</div>
</div>

{{-- @if(Route::is('properties') || Route::is('properties.show'))
<header class="control-header">
    <div id="pageLoader" class="page-loader">
        <img src="{{ asset('front-assets/images/loader.gif') }}" />    
    </div>

    <div class="strip">
        <a class="navbar-brand" href="{{ route('front.home') }}"><img src="{{ asset('front-assets/images/logo.png') }}" /></a>
        <a class="toggleHeader toggleControl">
            @if(!empty($categoryWord))
				{{ $categoryWord }}
			@endif

			@if(!empty($citySelected))
				in {{ $citySelected->name }}
			@endif
            
            <i class="fa-solid fa-angle-down down-arrow"></i>
            <i class="fa-solid fa-angle-up up-arrow"></i>            
        </a>  

        @include('front.home.results.search') 
        @include('front.home.results.login')
        @include('front.home.results.search_slide')
		
        <div class="overlay"></div>
    </div>
</header>
@endif --}}

@yield('main')

<footer>
	
	<div class="modal fade bd-example-modal-lg" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content login-modal">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-header">Login</div>
				<div class="modal-body">									
					<form action="{{ route('account.authenticate') }}" method="post">
						@csrf					
						<div class="form-group">
							<label class="rh_modal_labels" for="login_email">Email</label>
							<input type="text" value="{{ old('email') }}" name="email" id="login_email" class="form-control @error('email') is-invalid @enderror" placeholder="email">
							@error('email')
								<p class="invalid-feedback">{{ $message }}</p>
							@enderror
						</div>

						<div class="form-group">
							<label class="rh_modal_labels rh_modal_label_password" for="login_password">Password</label>
							<input type="password" name="password" id="login_password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password">
							@error('password')
								<p class="invalid-feedback">{{ $message }}</p>
							@enderror
						</div>
					</div>
						
					<div class="modal-footer">
						<a href="{{ route('account.forgotPassword') }}" class="rh_forget_password_trigger">Forgot Password?</a>
						<button class="btn btn-primary">Login</button>
					</div>
				</form>				
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-lg" id="registerAccountModal" tabindex="-1" aria-labelledby="registerAccountLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content login-modal">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-header">Register Account</div>
				<div class="modal-body">										
					<form action="" name="registrationForm" id="registrationForm" class="formPadding">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="rh_modal_labels" for="name">Name</label>                                    
									<input type="text" name="name" id="name" class="form-control" placeholder="Name">
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="email" class="mb-2">Email*</label>
									<input type="text" name="email" id="email" class="form-control" placeholder="Email">
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="password">Password*</label>
									<input type="password" name="password" id="password" class="form-control" placeholder="Password">
									<p></p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="confirm_password">Confirm Password*</label>
									<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
									<p></p>
								</div>
							</div>
						</div>														
					</div>
					<div class="modal-footer">
						<button class="btn btn-primary">Register Account</button>
					</div>
				</form>					
			</div>
		</div>
	</div>
</footer>

<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>

<script type="text/javascript">
    //$('.textarea').trumbowyg();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

@yield('customJs')

<script>
    $("#registrationForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("account.processRegistration") }}',
            type: 'post',
            data: $("#registrationForm").serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type='submit']").prop('disabled', false);

                var errors = response.errors;

                if(response.status == false){
                    if(errors.name){
                        $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
                        $("#name").addClass('is-invalid');
                    } else {
                        $("#name").siblings("p").removeClass('invalid-feedback').html();
                        $("#name").removeClass('is-invalid');
                    }

                    if(errors.email){
                        $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
                        $("#email").addClass('is-invalid');
                    } else {
                        $("#email").siblings("p").removeClass('invalid-feedback').html();
                        $("#email").removeClass('is-invalid');
                    }

                    if(errors.password){
                        $("#password").siblings("p").addClass('invalid-feedback').html(errors.password);
                        $("#password").addClass('is-invalid');
                    } else {
                        $("#password").siblings("p").removeClass('invalid-feedback').html();
                        $("#password").removeClass('is-invalid');
                    }

                    if(errors.confirm_password){
                        $("#confirm_password").siblings("p").addClass('invalid-feedback').html(errors.confirm_password);
                        $("#confirm_password").addClass('is-invalid');
                    } else {
                        $("#confirm_password").siblings("p").removeClass('invalid-feedback').html();
                        $("#confirm_password").removeClass('is-invalid');
                    }
                } else {
                    $("#name").siblings("p").removeClass('invalid-feedback').html();
                    $("#name").removeClass('is-invalid');
                    $("#email").siblings("p").removeClass('invalid-feedback').html();
                    $("#email").removeClass('is-invalid');
                    $("#password").siblings("p").removeClass('invalid-feedback').html();
                    $("#password").removeClass('is-invalid');
                    $("#confirm_password").siblings("p").removeClass('invalid-feedback').html();
                    $("#confirm_password").removeClass('is-invalid');

                    window.location.href='{{ route("front.home") }}'
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        })
    });
</script>

</body>
</html>