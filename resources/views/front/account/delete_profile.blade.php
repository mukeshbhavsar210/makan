@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-lg-3">
                @include('front.layouts.sidebar')
            </div>
            <div class="col-lg-9">

                @include('front.layouts.message')

                <div class="card border-0 shadow mb-4">
                    <form action="" method="post" id="userForm" name="userForm">
                        <div class="card-body  p-4">
                            <h3 class="fs-4 mb-1">My Profile</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="" class="mb-2">Name*</label>
                                        <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="" class="mb-2">Email*</label>
                                        <input type="text" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label for="" class="mb-2">Designation*</label>
                                        <input type="text" id="designation" name="designation" placeholder="Designation" class="form-control" value="{{ $user->designation }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="">
                                        <label for="" class="mb-2">Mobile*</label>
                                        <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>

                <div class="card border-0 shadow mb-4">
                    <form action="" method="post" id="changePasswordForm" name="changePasswordForm">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="" class="mb-2">Old Password*</label>
                                        <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="" class="mb-2">New Password*</label>
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="" class="mb-2">Confirm Password*</label>
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $("#userForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("profile.update") }}',
            type: 'put',
            data: $("#userForm").serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type='submit']").prop('disabled', false);

                if(response.status == true){
                    $("#name").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#designation").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#mobile").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');

                    window.location.href='{{ route("profile.index") }}'

                } else {
                    var errors = response.errors;

                    if(errors.name){
                        $("#name").addClass('is-invalid').siblings("p").addClass('invalid-feedback').html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    }
                    if(errors.email){
                        $("#email").addClass('is-invalid').siblings("p").addClass('invalid-feedback').html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    }
                    if(errors.designation){
                        $("#designation").addClass('is-invalid').siblings("p").addClass('invalid-feedback').html(errors.designation);
                    } else {
                        $("#designation").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    }
                    if(errors.mobile){
                        $("#mobile").addClass('is-invalid').siblings("p").addClass('invalid-feedback').html(errors.mobile);
                    } else {
                        $("#mobile").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    }
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        })
    });


    $("#changePasswordForm").submit(function(event){
        event.preventDefault();

        //$("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("account.updatePassword") }}',
            type: 'POST',
            dataType: 'json',
            data: $("#changePasswordForm").serializeArray(),
            success: function(response){
                //$("button[type='submit']").prop('disabled', false);

                if(response.status == true){
                    $("#old_password").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#new_password").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#confirm_password").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    //window.location.href='{{ route("property.index") }}'
                } else {
                    var errors = response.errors;
                    if(errors.old_password){
                        $("#old_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.old_password);
                    } else {
                        $("#old_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.new_password){
                        $("#new_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.new_password);
                    } else {
                        $("#new_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.confirm_password){
                        $("#confirm_password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
                    } else {
                        $("#confirm_password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }

                    //window.location.href='{{ route("account.login") }}'
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        })
    });

</script>
@endsection
