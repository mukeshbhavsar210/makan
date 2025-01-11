@extends('admin.layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6 text-right">
                
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container-fluid">
        @include('admin.layouts.message')
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" id="userForm" name="userForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Name*</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                                            <p></p>
                                        </div>
                                    </div>                            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Email*</label>
                                            <input type="text" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                                            <p></p>
                                        </div>                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="mb-2">Mobile*</label>
                                            <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>                
                    </div>

                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" id="changePasswordForm" name="changePasswordForm">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Old Password*</label>
                                        <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="mb-2">New Password*</label>
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Confirm Password*</label>
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="fs-4 mb-1">Profile Pic</h3>                        
                                @if (Auth::user()->image != '')
                                    <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 100px;">
                                @else
                                    <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 100px;">
                                @endif 
                            
                                <form id="profilePicForm" name="profilePicForm" action="" method="post" class="my-3">
                                    <div class="form-group">
                                        <input type="file" class="form-control" id="image" name="image">
                                        <p class="text-danger" id="image-error"></p>
                                    </div>                                    
                                    <button type="submit" class="btn btn-primary">Update Photo</button>                                                    
                                </form>
                            </div>
                        </div> 
                    </div>
                </div> 
            </div>
        </div>
    </div>    
</section>
@endsection


@section('customJs')
<script>
    $("#profilePicForm").submit(function(event){
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '{{ route("profile.updatePic") }}',
            type: 'post',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response){
                if(response.status == false){
                    var errors = response.errors;
                    if(errors.image){
                        $("#image-error").html(errors.name);
                    }
                } else {
                    window.location.href='{{ url()->current() }}'
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        })
    });




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
