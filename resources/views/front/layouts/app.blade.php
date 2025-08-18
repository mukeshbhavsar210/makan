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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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

				{{-- <form action="{{ route('properties') }}" > 
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="areasDropdown" data-bs-toggle="dropdown" aria-expanded="false">
							Areas
						</button>
						<ul class="dropdown-menu p-2" aria-labelledby="areasDropdown" style="min-width: 200px;">
							@foreach ($areas as $value)
								<li>
									<label class="dropdown-item custom-checkbox-label {{ is_array(request('areas')) && in_array($value->id, request('areas')) ? 'active' : '' }}">
										<input type="checkbox" name="areas[]" value="{{ $value->id }}"
											data-label="{{ $value->name }}"
											{{ is_array(request('areas')) && in_array($value->id, request('areas')) ? 'checked' : '' }}>
										<span class="checkmark"></span>
										{{ $value->name }}
									</label>
								</li>
							@endforeach
						</ul>
					</div>
				</form> --}}

				@if (Auth::check())
					<a href="{{ route('profile.index')}}" class="btn btn-primary">My Account</a>
				@else
					{{-- <a href="{{ route('account.login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link text-dark">Login/Register</a> --}}
					<a href="{{ route('account.login')}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Login</a>						
				@endif
		</nav>
	</header>	
@endif

@yield('main')

<footer>
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-body">					
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
</footer>

<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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