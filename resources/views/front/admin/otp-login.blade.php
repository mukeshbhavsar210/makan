@extends('front.layouts.app')

@section('content')
    <section class="section-5">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-10">
        <div class="container">
            <div class="login-form">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif         

            <div id="sessionMessage" class="alert" style="display: none;"></div>

            <div id="otpSendForm">
                <form id="sendOtpForm" action="{{ route('otp.send') }}" method="POST">
                    @csrf
                    <h4 class="modal-title">OTP Login</h4>

                    <div class="form-group mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" required class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Send OTP</button>
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
                        <div class="col-md-12 col-12">
                            <label>OTP:</label>
                            <input type="text" name="otp" placeholder="Enter OTP" required class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Verify OTP</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Setup CSRF for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle Send OTP
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
                        }, 1000);

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
        });
    </script>
@endsection
