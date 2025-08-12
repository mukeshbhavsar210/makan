<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="format-detection" content="telephone=no">
<title>Housing.com</title>

<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container-fluid">
			<a class="navbar-brand" href="{{ route('front.home') }}">Housing.com</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<a class="btn btn-primary" href="" type="submit">Post a Job</a>
			</div>

			@if (Auth::check())
						<a href="{{ route('profile.index')}}" class="nav-link text-dark">My Account</a>
					@else
						{{-- <a href="{{ route('account.login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link text-dark">Login/Register</a> --}}
						<a href="{{ route('account.login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link text-dark">Login</a>						
					@endif
										
					<!-- Modal -->
					<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

							<div class="modal-body">	
								<div class="row">
									<div class="col-md-4">Housing.com</div>
									<div class="col-md-8">
										<ul class="nav">
											<li class="nav-item" >
												<a class="active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" >Home</a>
											</li>
											<li class="nav-item">
												<a class="" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile">Register Account</a>
											</li>
										</ul>

										<div class="tab-content" id="pills-tabContent">
											<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
												<div class="">
													<form action="{{ route('account.authenticate') }}" method="post">
														@csrf
														
														<div class="form-group">
															<label class="rh_modal_labels" for="login_email">Email</label>
															<input type="text" value="{{ old('email') }}" name="email" id="login_email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com">
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
														
														<button class="btn btn-primary">Login</button>
														<a href="{{ route('account.forgotPassword') }}" class="rh_forget_password_trigger">Forgot Password?</a>
													</form>
												</div>
											</div>
					
											<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
												<form action="" name="registrationForm" id="registrationForm" class="formPadding">
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="rh_modal_labels" for="name">Name</label>                                    
																<input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
																<p></p>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="email" class="mb-2">Email*</label>
																<input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
																<p></p>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="password">Password*</label>
																<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
																<p></p>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label for="confirm_password">Confirm Password*</label>
																<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Confirm Password">
																<p></p>
															</div>
														</div>
													</div>														
													<button class="btn btn-primary">Register Account</button>
												</form>																						
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
		</div>
	</nav>
</header>	

@yield('main')

<footer class="site-footer">
	<div class="site-footer-bg site-footer-default-bg"></div>
	<div class="container">
		<div class="site-footer-contacts-wrapper">
			<div class="site-footer-contacts">
				<span class="rh-ultra-footer-help">Need Help?</span>
				<a class="rh-ultra-footer-number rh-ultra-user-phone-footer" target="_blank" href="tel://9978835005">
					<svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
						<path d="M0 0h24v24H0V0z" fill="none" />
						<path d="M19 17.47c-.88-.07-1.75-.22-2.6-.45l-1.19 1.19c1.2.41 2.48.67 3.8.75v-1.49zM6.54 5h-1.5c.09 1.32.35 2.59.75 3.8l1.2-1.2c-.24-.84-.39-1.71-.45-2.6z" opacity=".3" />
						<path d="M20 21c.55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17zm-3.6-3.98c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19zM5.03 5h1.5c.07.89.22 1.76.46 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79z" />
					</svg> 
					<span>9978835005</span>
				</a>

				<a class="rh-ultra-footer-number rh-ultra-user-whatsapp-footer" target="_blank"
					href="https://api.whatsapp.com/send?phone=9978835005">
					<svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" width="24" height="24">
						<g><path d="M12 19.3c-1.3 0-2.6-.4-3.8-1l-.3-.2-2.8.7.7-2.7-.2-.3c-.7-1.2-1.1-2.5-1.1-3.9 0-4.1 3.3-7.4 7.4-7.4 2 0 3.8.8 5.2 2.2 1.4 1.4 2.3 3.3 2.3 5.2.1 4.1-3.3 7.4-7.4 7.4z" opacity=".3" /><g>
						<path d="M12 4.8c1.9 0 3.7.7 5 2.1 1.4 1.4 2.2 3.2 2.2 5 0 3.9-3.2 7.1-7.2 7.1-1.2 0-2.4-.3-3.4-.9l-.6-.3-.7.2-1.7.4.4-1.5.2-.7-.4-.7c-.6-1.1-.9-2.3-.9-3.6C4.9 8 8.1 4.8 12 4.8M12 3c-4.9 0-8.9 4-8.9 8.9 0 1.6.4 3.1 1.2 4.5L3 21l4.7-1.2c1.3.7 2.8 1.1 4.3 1.1 4.9 0 9-4 9-8.9 0-2.4-1-4.6-2.7-6.3S14.4 3 12 3z" />
						</g>
						<path d="M16.1 13.8c-.2-.1-1.3-.7-1.5-.7-.3-.1-.4-.1-.6.1-.1.2-.6.7-.7.9-.1.1-.3.2-.5.1-1.3-.7-2.2-1.2-3-2.7-.2-.4.2-.4.7-1.2.1-.1 0-.3 0-.4-.1-.1-.5-1.2-.7-1.7-.2-.4-.4-.4-.5-.4h-.4c-.1 0-.4.1-.6.3-.3.2-.8.7-.8 1.8s.8 2.2.9 2.3c.1.1 1.6 2.4 3.8 3.4 1.4.6 2 .7 2.7.6.4-.1 1.3-.5 1.5-1.1.2-.5.2-1 .1-1.1-.1 0-.2-.1-.4-.2z" />
						</g>
					</svg> 
					<span>9978835005</span>
				</a>

				<a class="rh-ultra-footer-number rh-ultra-user-email-footer" target="_blank"
					href="mailto:hello&#64;y&#111;&#117;&#114;sit&#101;&#46;co&#109;">
					<svg class="rh-ultra-dark" xmlns="http://www.w3.org/2000/svg" height="24" width="24">
						<path d="M0 0h24v24H0V0z" fill="none" />
						<path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3" />
						<path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z" />
					</svg> 
					<span>h&#101;&#108;lo&#64;&#121;oursi&#116;&#101;&#46;&#99;om</span>
				</a>
			</div>
		</div>
		<div class="site-footer-bottom space-between">
			<p class="copyrights">&copy; 2024. All rights reserved. </p>
			<p class="designed-by">Powred by: <a href="http://www.uxteam.in/">Uxteam.in</a> </p>
		</div>
	</div>
</footer>

<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }} "></script>
<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }} "></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/lightbox.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script type="text/javascript">
    $('.textarea').trumbowyg();
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