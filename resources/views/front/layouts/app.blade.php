<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="format-detection" content="telephone=no">
<title>Housing.com</title>
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/custom.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />

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

				@include('front.layouts.login_header')
			</div>
		</nav>
	</header>	
@endif

<div class="offcanvas offcanvas-end" tabindex="-1" id="sideModal" aria-labelledby="sideModalLabel">  
	<div class="sidebar">
		<div class="user-details">
			<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			@if (Auth::check())
				<div class="details">
					<div class="user-photo">
						@if (!empty(Auth::user()->image))
							<img src="{{ asset('uploads/profile/thumb/' . Auth::user()->image) }}" alt="avatar" class="profile-pic">
						@else
							<div class="avatar" style="background-color: {{ Auth::user()->avatar_color ?? '#777' }};">
								{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
							</div>
						@endif
					</div>							
					<div class="name">
						<p><b>Hello {{ Auth::user()->name }}</b><br />
							{{ Auth::user()->email }}<br /> +91-{{ Auth::user()->mobile }}
						</p>
						<ul class="sidebar-login">
							<li><a href="{{ route('profile.index') }}" class="btn btn-secondary small-btn">Edit</a></li>
							<li><a href="{{ route('account.logout') }}" class="btn btn-primary small-btn">Logout</a></li>
						</ul>
					</div>							
				</div>
			@else
				<div class="details">
					<div class="user-photo">
						<img class="photo" decoding="async" fetchpriority="low" src="//c.housingcdn.com/demand/s/client/common/assets/tenant-avatar.cedc2f44.png">
					</div>							
					<div class="name">
						<p><b>Hello 👋🏻</b><br />Easy Contact with sellers<br />Personalized experience</p>
						<div class="custom-radio-buttons mt-2">
							<input type="radio" name="optionRadio" id="radio2" value="2" class="radio-hidden">
							<label for="radio2" class="radio-btn">Register Account</label>		

							<input type="radio" name="optionRadio" id="radio1" value="1" class="radio-hidden" checked>
							<label for="radio1" class="radio-btn">Login</label>
						</div>
					</div>
				</div>
			</div>

			<div class="divider"></div>

			<div class="login-wrapper">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="div1">
						<h5 class="mb-3">Login</h5>
						<form id="loginForm" action="{{ route('account.authenticate') }}" method="post">
							@csrf	
							<div class="form-group">
								<label for="login_email" class="light-label">Email<span class="req">*</span></label>
								<input type="text" value="{{ old('email') }}" name="email" id="login_email" class="form-control" placeholder="email">
								<p class="invalid-feedback d-none" id="error_email"></p>								
							</div>

							<div class="form-group">
								<label for="login_password" class="light-label">Password<span class="req">*</span></label>
								<input type="password" name="password" id="login_password" class="form-control" placeholder="Enter Password">
								<p class="invalid-feedback d-none" id="error_password"></p>
							</div>

							<div class="flex-wrapper mt-3">
								<button class="btn btn-primary">Login</button>
								<div class="custom-radio-buttons">
									<input type="radio" name="optionRadio" id="radio3" value="3" class="radio-hidden">
									<label for="radio3" class="radio-link">Forgot Password?</label>									
								</div>
							</div>
						</form>	

						<div class="mt-3">
							<a href="{{ url('auth/google') }}" class="btn btn-danger ">
								Login with Google
							</a>

							<a href="{{ url('auth/facebook') }}" class="btn btn-primary">
								Login with Facebook
							</a>
						</div>

						<div id="sessionMessage" class="alert" style="display: none;"></div>
						<div id="otpSendForm" style="display: none;">
							<form id="sendOtpForm" action="{{ route('otp.send') }}" method="POST">
								@csrf
								<div class="form-group mb-3">
									<label>Email:</label>
									<input type="email" name="email" required class="form-control">
								</div>
								<div class="form-group mb-0 row">
									<div class="col-12">
										<div class="d-grid mb-3">
											<button type="submit" class="btn btn-primary" type="button">Send OTP <i class="fas fa-sign-in-alt ms-1"></i></button>
										</div>
									</div>
								</div>                                        
							</form>
						</div>

						<div id="otpVerifyForm" style="display: none;">
							<form id="verifyOtpForm" action="{{ route('otp.verify') }}" method="POST">
								@csrf

								<div class="row">
									<div class="col-md-12 col-12">
										<div class="form-group">
											<label>Email:</label>
											<input type="email" name="email" placeholder="Enter Email" required class="form-control" id="verifyEmail">
										</div>
									</div>
									<div class="col-md-12 col-12 mt-2">
										<label>OTP:</label>
										<input type="text" name="otp" placeholder="Enter OTP" required class="form-control">
									</div>
								</div>

								<div class="form-group mb-0 row">
									<div class="col-12">
										<div class="d-grid mt-3">
											<button class="btn btn-primary" type="button">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
										</div>
									</div> 
								</div>

								<button type="submit" class="btn btn-primary mt-2">Verify OTP</button>
							</form>
						</div>						
					</div>

					<div class="tab-pane fade" id="div2">
						<h5 class="mb-3">Register Account</h5>
						<form action="" name="registrationForm" id="registrationForm" class="formPadding">
							<div class="form-group">
								<label class="light-label" for="name">Name<span class="req">*</span></label>                                    
								<input type="text" name="name" id="name" class="form-control" placeholder="Name">
								<p></p>
							</div>
							<div class="form-group">
								<label for="email" class="light-label">Email<span class="req">*</span></label>
								<input type="text" name="email" id="email" class="form-control" placeholder="Email">
								<p></p>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="password" class="light-label">Password<span class="req">*</span></label>
										<input type="password" name="password" id="password" class="form-control" placeholder="Password">
										<p></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="confirm_password" class="light-label">Confirm Password<span class="req">*</span></label>
										<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
										<p></p>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="role" class="light-label">Are you Agent/Developer?<span class="req">*</span></label><br />
								<div class="btn-group mt-2" role="group" aria-label="Is Role Switch">
									<input type="radio" class="btn-check" name="role" id="is_role_agent" value="user" autocomplete="off"  
									{{ old('role', $user->role ?? 'Agent') == 'Agent' ? 'checked' : '' }} >
									<label class="btn btn-outline-secondary" for="is_role_agent">Agent</label>

									<input type="radio" class="btn-check" name="role" id="is_role_developer" value="builder" autocomplete="off" >
									<label class="btn btn-outline-secondary" for="is_role_developer">Developer</label>
								</div> 
							</div>								
							<button class="btn btn-primary mt-3">Register</button>
						</form>
					</div>

					<div class="tab-pane fade" id="div3">
						<h5 class="mb-3">Forgot Password?</h5>
						<form id="forgotPasswordForm" action="{{ route('account.processForgotPassword') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="forgot_email" class="light-label">Email<span class="req">*</span></label>
								<input type="text" value="{{ old('email') }}" name="email" id="forgot_email" class="form-control" placeholder="example@example.com">
								<p class="invalid-feedback d-none" id="error_email">Enter your email</p>
							</div>

							<div class="flex-wrapper mt-3">
								<button class="btn btn-primary">Send Rest Link</button>						
							</div>	
						</form>
					</div>
				</div>
				</div>
			</div>
		@endif	

		<div class="divider"></div>

		@if (Auth::check())
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
								<li><a href="{{ route('front.home') }}" class="{{ request()->routeIs('front.home') ? 'active' : '' }}">Home</a></li>
								<li><a href="{{ route('properties.index') }}" class="{{ request()->routeIs('properties.index') ? 'active' : '' }}">Properties</a></li>
								<li><a href="{{ route('account.myPropertyApplications') }}" class="{{ request()->routeIs('account.myPropertyApplications') ? 'active' : '' }}">Interested</a></li>
								<li><a href="{{ route('property.savedProperties') }}" class="{{ request()->routeIs('property.savedProperties') ? 'active' : '' }}">Saved</a></li>
							</ul>								
							@if(Auth::user()->role === 'Admin')
								<ul class="inside-link mt-4">
									<li><a href="{{ route('orders.index') }}">Orders</a></li>
									<li><a href="{{ route('properties.pending') }}">Approval</a></li>
									<li><a href="{{ route('areas.index') }}">Area</a></li>
									<li><a href="{{ route('users.index') }}">User</a></li>
								</ul>
							@endif
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h2 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<div class="icon icon_02">1</div>
							My Activity
						</button>
					</h2>
					<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
						<div class="accordion-body">
							<div class="activities">
								<ul class="nav nav-pills" id="pills-tab" role="tablist">
									<li class="nav-item" role="presentation">
										<a href="#" class="nav-link active" id="pills-tab_01" data-bs-toggle="pill" data-bs-target="#tab_01" aria-controls="tab_01" aria-selected="true">
											<p>Contacted <br />Properties</p>
											@php
												$countsApplied  = isset($countsApplied ) ? $countsApplied  : 0;
											@endphp

											<p class="count">{{ $countsApplied  }}</p>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="pills-tab_02" data-bs-toggle="pill" data-bs-target="#tab_02" aria-controls="tab_02" aria-selected="false">
											<p>Seen <br />Properties</p>
											@php
												$propertyIds = array_filter(array_keys($seenProperties), fn($id) => $id > 0);
												$totalSeen = count($propertyIds);
											@endphp
											<p class="count">{{ $totalSeen }}</p>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="pills-tab_03" data-bs-toggle="pill" data-bs-target="#tab_03" aria-controls="tab_03" aria-selected="false">
											<p>Saved<br /> Properties</p>
											@php
												$countsSaved  = isset($countsSaved ) ? $countsSaved  : 0;
											@endphp
											<p class="count">{{ $countsSaved  }}</p>
										</a>
									</li>
								</ul>
								<div class="tab-content" id="pills-tabContent">
									<div class="tab-pane fade show active" id="tab_01" role="tabpanel" aria-labelledby="pills-tab_01">
										<div class="gallery-body">
											@php
												$appliedProperties = isset($appliedProperties) ? $appliedProperties : collect();
											@endphp

											@if(isset($appliedProperties) && $appliedProperties->isNotEmpty())
												<div class="sidebar-gallery">
													@foreach ($appliedProperties as $value)
														<div class="gallery-item">
															@php
																$PropertyImage = $value->property->property_images->first();
															@endphp
															<a href="{{ $value->url }}" target="_blank">
																@if ($PropertyImage && !empty($PropertyImage->image))
																	<img src="{{ asset('uploads/property/thumb/' . $PropertyImage->image) }}" class="thumb">
																@else
																	<img src="{{ asset('admin-assets/img/default-150x150.png') }}" class="thumb">
																@endif
															</a>
															<h5>{{ $value->property->title }}</h5>
															<p>{{ $value->property->location }}, {{ $value->property->area->name }}, {{ $value->property->city->name ?? '' }}</p>
															<a href="#" class="btn btn-primary mt-2">Contact</a>
														</div>
													@endforeach
												</div>									
												@else
													<a href="{{ route('front.home') }}" class="btn btn-primary">Start New Search</a>
												@endif	
										</div>						
									</div>

									<div class="tab-pane fade" id="tab_02" role="tabpanel" aria-labelledby="pills-tab_02">
										<div class="gallery-body">
											@php
												$uniqueSeen = collect($seenProperties)->unique(); 
											@endphp
												<div class="sidebar-gallery">
													@foreach($uniqueSeen as $propertyId => $count)
														@php
															$property = \App\Models\Property::with('property_images','area','city')
																->find($propertyId);
														@endphp

														@if($property)
															<div class="gallery-item">
																<a href="{{ $property->url }}" target="_blank">
																	@if($property->property_images->first())
																		<img src="{{ asset('uploads/property/thumb/' . $property->property_images->first()->image) }}" class="thumb">
																	@else
																		<img src="{{ asset('admin-assets/img/default-150x150.png') }}" class="thumb">
																	@endif
																</a>
																<h5>{{ $property->title }}</h5>
																<p>{{ $property->area->name ?? '' }}, {{ $property->city->name ?? '' }}</p>
																<p class="seen-status">Seen {{ $count }} time{{ $count > 1 ? 's' : '' }}</p>
																<a href="#" class="btn btn-primary mt-2">Contact</a>														
															</div>
														@endif
													@endforeach
												</div>
											</div>
										</div>
									</div>

									<div class="tab-pane fade" id="tab_03" role="tabpanel" aria-labelledby="pills-tab_03">
										<div class="gallery-body">
											@php
												$savedProperties = isset($savedProperties) ? $savedProperties : collect();
											@endphp

											@if(isset($savedProperties) && $savedProperties->isNotEmpty())
												<div class="sidebar-gallery">
													@foreach ($savedProperties as $value)
														<div class="gallery-item">
															@php
																$PropertyImage = $value->property->property_images->first();
															@endphp
															<a href="{{ $value->url }}" target="_blank">
																@if ($PropertyImage && !empty($PropertyImage->image))
																	<img src="{{ asset('uploads/property/thumb/' . $PropertyImage->image) }}" class="thumb">
																@else
																	<img src="{{ asset('admin-assets/img/default-150x150.png') }}" class="thumb">
																@endif
															</a>
															<h5>{{ $value->property->title }}</h5>
															<p>{{ $value->property->location }}, {{ $value->property->area->name }}, {{ $value->property->city->name ?? '' }}</p>
															<a href="#" class="btn btn-primary mt-2">Contact</a>
														</div>
													@endforeach
												</div>									
												@else
													<a href="{{ route('front.home') }}" class="btn btn-primary">Start New Search</a>
												@endif	
										</div>						
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
		@endif
			</div>
		</div>	
	</div>
</div>

@yield('main')

<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('front-assets/js/dropzone.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<script src="{{ asset('front-assets/js/filters.js') }}"></script>
<script src="{{ asset('front-assets/js/gallery.js') }}"></script>

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
	$('#sendOtpForm').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: $(this).attr('action'),
			method: 'POST',
			data: $(this).serialize(),
			success: function(response) {

				// Hide first form and show second
				$('#otpSendForm').hide();
				$('#otpVerifyForm').show();

				$('#sessionMessage')
					.removeClass('alert-success')
					.addClass('alert alert-success')
					.text('OTP sent successfully!')
					.fadeIn();

				// $('#sessionMessage')
				//     .removeClass('alert-success')
				//     .addClass('alert alert-danger')
				//     .text(error)
				//     .fadeIn();

				setTimeout(() => {
					$('#sessionMessage').fadeOut();
				}, 1500);

				// Set email value in second form
				let email = $('#sendOtpForm input[name="email"]').val();
				$('#verifyEmail').val(email);
			},
			error: function(xhr) {
				let error = xhr.responseJSON?.message || 'Something went wrong';
				alert(error);
			}
		});
	});

	$('#verifyOtpForm').on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			url: $(this).attr('action'),
			method: 'POST',
			data: $(this).serialize(),
			success: function(response) {
				$('#sessionMessage')
					.removeClass('alert-danger')
					.addClass('alert alert-success')
					.text(response.message)
					.fadeIn();

				// 🔁 Redirect after 1 second (you can make it 0 for instant redirect)
				setTimeout(function() {
					var redirectUrl = response.redirect; // the URL from the response
					
					if (response.redirect) {
						window.location.href = redirectUrl;
					} else {
						window.location.href = 'account/profile'; // Change '/defaultRoute' to any route
					}
				}, 1000); // Adjust timeout duration as needed
			},
			error: function(xhr) {
				const errorMsg = xhr.responseJSON?.message || 'OTP verification failed';

				$('#sessionMessage')
					.removeClass('alert-success')
					.addClass('alert alert-danger')
					.text(errorMsg)
					.fadeIn();
			}
		});
	});



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