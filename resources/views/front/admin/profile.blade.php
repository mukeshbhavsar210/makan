@extends('front.layouts.app')

@section('main')

<section class="content-header">
    <div class="container">
        <div class="row">            
            <div class="col-md-3 col-12">
                <div class="progress-left">                    
                    <div class="card-body">
                        <div class="profile">
                            @if (Auth::user()->image != '')
                                <img src="{{ asset('uploads/profile/thumb/'.Auth::user()->image) }}" alt="avatar" class="profile-pic" >
                            @else
                                <div class="avatar" style="background-color: {{ $user->avatar_color ?? '#777' }};">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            @endif 
                            <div class="name">{{ Auth::user()->name }}</div>
                        </div>
                        <hr />
                
                        <h5 class="mb-3 mt-2">Change Password</h5>
                        <form action="" method="post" id="changePasswordForm" name="changePasswordForm" class="mt-3">
                            <div class="form-group">
                                <label for="" class="light-label">Old Password <span class="req">*</span></label>
                                <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                <p></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="light-label">New Password <span class="req">*</span></label>
                                <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                <p></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="light-label">Confirm Password <span class="req">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                <p></p>
                            </div>

                            <button type="submit" class="btn btn-primary btn-default">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="progress-right">                  
                    
                    @include('front.layouts.message')

                    <h5 class="mb-3">User Profile</h5>
                    <form id="profileForm" enctype="multipart/form-data" name="userForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="" class="light-label">Name<span class="req">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
                                    <p></p>                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="" class="light-label">Email<span class="req">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}">
                                    <p></p>                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="" class="light-label">Profile Picture<span class="req">*</span></label>
                                    <input type="file" id="profile" class="form-control" name="image">
                                    <p></p>                                    
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="" class="light-label">Mobile<span class="req">*</span></label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{ Auth::user()->mobile }}">
                                    <p></p>
                                </div>
                            </div>
                            
                            @if($user->role == 'Admin')                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role" class="light-label">Are you?<span class="req">*</span></label><br />
                                        <div class="custom-radio" role="group" aria-label="Is Role Switch">
                                            <input type="radio" class="btn-check" name="role" id="is_role_admin" value="user" autocomplete="off" checked="" 
                                            {{ old('role', $user->role ?? 'Admin') == 'Admin' ? 'checked' : '' }} >
                                            <label class="btn-radio" for="is_role_admin">Admin</label>

                                            <input type="radio" class="btn-check" name="role" id="is_role_user" value="user" autocomplete="off"  
                                            {{ old('role', $user->role ?? 'User') == 'User' ? 'checked' : '' }} >
                                            <label class="btn-radio" for="is_role_user">Customer</label>

                                            <input type="radio" class="btn-check" name="role" id="is_role_agent" value="agent" autocomplete="off"  
                                            {{ old('role', $user->role ?? 'Agent') == 'Agent' ? 'checked' : '' }} >
                                            <label class="btn-radio" for="is_role_agent">Agent</label>

                                            <input type="radio" class="btn-check" name="role" id="is_role_developer" value="builder" autocomplete="off"
                                            {{ old('role', $user->role ?? 'Builder') == 'Builder' ? 'checked' : '' }} >
                                            <label class="btn-radio" for="is_role_developer">Developer</label>
                                        </div> 
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role" class="light-label">Are you?<span class="req">*</span></label><br />
                                        <div class="custom-radio" role="group" aria-label="Is Role Switch">
                                            <input type="radio" class="btn-check" name="role" id="is_role_agent" value="user" autocomplete="off" checked="" 
                                            {{ old('role', $user->role ?? 'Agent') == 'Agent' ? 'checked' : '' }} >
                                            <label class="btn-radio" for="is_role_agent">Agent</label>

                                            <input type="radio" class="btn-check" name="role" id="is_role_user" value="user" autocomplete="off"  
                                            {{ old('role', $user->role ?? 'User') == 'User' ? 'checked' : '' }} >
                                            <label class="btn-radio" for="is_role_user">Customer</label>

                                            <input type="radio" class="btn-check" name="role" id="is_role_developer" value="builder" autocomplete="off"
                                            {{ old('role', $user->role ?? 'Builder') == 'Builder' ? 'checked' : '' }} >
                                            <label class="btn-radio" for="is_role_developer">Developer</label>
                                        </div> 
                                    </div>
                                </div>                                                              
                            @endif 
                        </div>
                        <button type="submit" class="btn btn-primary btn-default">Update</button>
                    </form>                                 
                                                
                    @if($user->role == 'Builder')
                        <hr class="mb-4 mt-4" />
                        <h5 class="mb-3">Developer details</h5>
                                
                        <div class="row">
                            <div class="col-md-2">
                                @if(!empty($developer) && $developer->image)
                                    <img src="{{ asset('uploads/developer/thumb/'.$developer->image) }}" alt="Builder Image" width="100%" style="display:block; margin-bottom:10px;">
                                @else
                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="Default" width="100%" class="rounded">
                                @endif 
                            </div>

                            <div class="col-md-10">
                                <form id="builderForm" enctype="multipart/form-data">
                                    @csrf                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="light-label">Company Logo<span class="req">*</span></label>
                                                <input type="file" name="image" id="developer_logo" accept="image/*" class="form-control">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="light-label">Company Name<span class="req">*</span></label>
                                                <input type="text" name="developer_name" id="developer_name" value="{{ old('developer_name', $developer->developer_name ?? '') }}" class="form-control">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="light-label">Email<span class="req">*</span></label>
                                                <input type="email" name="developer_email" id="developer_email" value="{{ old('developer_email', $developer->developer_email ?? '') }}" class="form-control">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="light-label">Mobile<span class="req">*</span></label>
                                                <input type="text" name="developer_mobile" id="developer_mobile" value="{{ old('developer_mobile', $developer->developer_mobile ?? '') }}" class="form-control">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="light-label">Address<span class="req">*</span></label>
                                                <textarea name="address" id="developer_address" cols="5" rows="5" class="form-control">{{ old('address', $developer->address ?? '') }}</textarea>
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="light-label">Landline</label>
                                                <input type="text" name="developer_landline" value="{{ old('developer_landline', $developer->developer_landline ?? '') }}" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label class="light-label">WhatsApp</label>
                                                <input type="text" name="developer_whatsapp" value="{{ old('developer_whatsapp', $developer->developer_whatsapp ?? '') }}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-default">Save Builder</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>                    
    </div>    
</section>
@endsection

@section('customJs')
<script>
    $("#profileForm").submit(function(event){
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("profile.update") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                if(response.status == true){
                    $("#name").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#email").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#mobile").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#profile").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                } else {
                    var errors = response.errors;
                    if(errors.name){
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.email){
                        $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.mobile){
                        $("#mobile").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.mobile);
                    } else {
                        $("#mobile").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.profile){
                        $("#profile").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.profile);
                    } else {
                        $("#profile").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        });
    });


   $("#builderForm").submit(function(event){
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: '{{ route("builder.save") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                console.log("Response:", response);
                if(response.status == true){
                    $("#developer_logo").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#developer_name").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#developer_email").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#developer_mobile").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#developer_address").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                } else {
                    var errors = response.errors;
                    if(errors.developer_logo){
                        $("#developer_logo").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.developer_logo);
                    } else {
                        $("#developer_logo").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.developer_name){
                        $("#developer_name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.developer_name);
                    } else {
                        $("#developer_name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.developer_email){
                        $("#developer_email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.developer_email);
                    } else {
                        $("#developer_email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.developer_mobile){
                        $("#developer_mobile").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.developer_mobile);
                    } else {
                        $("#developer_mobile").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    if(errors.developer_address){
                        $("#developer_address").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.developer_address);
                    } else {
                        $("#developer_address").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                }
            },
            error: function(xhr){
                console.log("AJAX error:", xhr.responseText);
            }
        });
    });






   
    $("#changePasswordForm").submit(function(event){
        event.preventDefault();

        //$("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("password.update") }}',
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
