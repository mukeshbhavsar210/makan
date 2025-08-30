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
            <div class="col-md-9 col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                @if (Auth::user()->image != '')
                                    <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 200px;">
                                @else
                                    <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 50px;">
                                @endif 
                            </div>

                            <div class="col-md-10">
                                <h4 class="mb-3">User Profile</h4>
                                <form id="profileForm" enctype="multipart/form-data" name="userForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="mb-1">Name<span class="req">*</span></label>
                                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                                <span id="name-error" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="mb-1">Email<span class="req">*</span></label>
                                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                                <span id="email-error" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="mb-1">Profile Picture<span class="req">*</span></label>
                                                <input type="file" class="form-control" name="image">
                                                <span id="image-error" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="{{ $user->role == 'Admin' ? 'col-md-6' : 'col-md-3' }}">
                                            <div class="form-group">
                                                <label for="" class="mb-1">Mobile<span class="req">*</span></label>
                                                <input type="text" name="mobile" class="form-control" value="{{ Auth::user()->mobile }}">
                                                <span id="mobile-error" class="text-danger"></span>
                                            </div>
                                        </div>   
                                        @if($user->role == 'Admin')
                                            @else
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="role" class="mb-2">Are you?<span class="req">*</span></label><br />
                                                    <div class="btn-group" role="group" aria-label="Is Role Switch">
                                                        <input type="radio" class="btn-check" name="role" id="is_role_agent" value="user" autocomplete="off" checked="" 
                                                        {{ old('role', $user->role ?? 'Agent') == 'Agent' ? 'checked' : '' }} >
                                                        <label class="btn btn-outline-primary" for="is_role_agent">Agent</label>
                                                        <input type="radio" class="btn-check" name="role" id="is_role_developer" value="builder" autocomplete="off"
                                                        {{ old('role', $user->role ?? 'Builder') == 'Builder' ? 'checked' : '' }} >
                                                        <label class="btn btn-outline-primary" for="is_role_developer">Developer</label>
                                                    </div> 
                                                </div>
                                            </div>
                                        @endif                                                                             
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>                                 
                                <hr class="mb-4 mt-4" />
                            </div>
                        </div> 
                        
                        @if($user->role == 'Builder')
                            <div class="row">
                                <div class="col-md-2">
                                    @if(!empty($developer) && $developer->image)
                                        <img src="{{ asset('uploads/builder/'.$developer->image) }}" alt="Builder Image" width="120" style="display:block; margin-bottom:10px;">
                                    @endif 
                                </div>

                                <div class="col-md-10">
                                    <h4 class="mb-3">Developer details</h4>
                                    <form id="builderForm" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="mb-1">Company Logo<span class="req">*</span></label>
                                                <input type="file" name="image" accept="image/*" class="form-control">
                                                <span id="image_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Company Name<span class="req">*</span></label>
                                                    <input type="text" name="developer_name" 
                                                        value="{{ old('developer_name', $developer->developer_name ?? '') }}" class="form-control">
                                                    <span id="developer_name_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email<span class="req">*</span></label>
                                                    <input type="email" name="developer_email" 
                                                        value="{{ old('developer_email', $developer->developer_email ?? '') }}" class="form-control">
                                                    <span id="developer_email_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mobile<span class="req">*</span></label>
                                                    <input type="text" name="developer_mobile" 
                                                        value="{{ old('developer_mobile', $developer->developer_mobile ?? '') }}" class="form-control">
                                                    <span id="developer_mobile_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address<span class="req">*</span></label>
                                                    <textarea name="address" cols="5" rows="5" class="form-control">{{ old('address', $developer->address ?? '') }}</textarea>
                                                    <span id="address_error" class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Landline<span class="req">*</span></label>
                                                    <input type="text" name="developer_landline" 
                                                        value="{{ old('developer_landline', $developer->developer_landline ?? '') }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>WhatsApp</label>
                                                    <input type="text" name="developer_whatsapp" 
                                                        value="{{ old('developer_whatsapp', $developer->developer_whatsapp ?? '') }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Builder</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>            
            <div class="col-md-3 col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Change Password</h4>
                        <form action="" method="post" id="changePasswordForm" name="changePasswordForm" class="mt-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Old Password <span class="req">*</span></label>
                                <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                <p></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="mb-1">New Password <span class="req">*</span></label>
                                <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                <p></p>
                            </div>

                            <div class="form-group">
                                <label for="" class="mb-1">Confirm Password <span class="req">*</span></label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                <p></p>
                            </div>

                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </form>
                    </div>
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
                if(response.status === false){
                    var errors = response.errors;
                    if(errors.name)   $("#name-error").html(errors.name[0]);
                    if(errors.email)  $("#email-error").html(errors.email[0]);
                    if(errors.mobile) $("#mobile-error").html(errors.mobile[0]);
                    if(errors.role) $("#role-error").html(errors.role[0]);
                    if(errors.image)  $("#image-error").html(errors.image[0]);
                } else {
                    window.location.reload();
                }
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

            if(response.status === false){
                var errors = response.errors;
                if(errors.developer_name)     $("#developer_name_error").html(errors.developer_name[0]);
                if(errors.developer_email)    $("#developer_email_error").html(errors.developer_email[0]);
                if(errors.developer_mobile)   $("#developer_mobile_error").html(errors.developer_mobile[0]);
                if(errors.address)            $("#address_error").html(errors.address[0]);
            } else {
                alert(response.message);
                window.location.reload();
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



      //Similar property
     $('.relatedProperty').select2({
        ajax: {
            url: '{{ route('property.properties') }}',
            dataType: 'json',
            tags: true,
            multiple: true,
            minimumInputLength: 3,
            processResults: function (data) {
                return {
                    results: data.tags
                };
            }
        }
    });

    $("#builderForm").submit(function(event){
        event.preventDefault();
        var element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("developer.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);

                if(response["status"] == true){

                    window.location.href="{{ route('profile.index') }}"

                    $('#name').removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback').html("");

                } else {
                    var errors = response['errors']
                    if(errors['name']){
                        $('#name').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                    } else {
                        $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                    }

                }

            }, error: function(jqXHR, exception) {
                console.log("Something event wrong");
            }
        })
    });


    function deleteDeveloper(id){
        var url = '{{ route("developer.delete","ID") }}'
        var newUrl = url.replace("ID",id)

        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    if(response["status"]){
                        window.location.href="{{ route('profile.index') }}"
                    }
                }
            });
        }
    }



    Dropzone.autoDiscover = false;
    const dropzone = $("#image").dropzone({
        init: function() {
            this.on('addedfile', function(file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },
        url:  "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response){
            $("#image_id").val(response.image_id);
            //console.log(response)
        }
    });

</script>
@endsection
