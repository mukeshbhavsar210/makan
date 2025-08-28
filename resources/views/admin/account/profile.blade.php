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

        <div class="card-body pt-0">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#users" role="tab" aria-selected="true">Home</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#developer" role="tab" aria-selected="false" tabindex="-1">Developer <span class="badge rounded text-blue bg-blue-subtle">{{ $counts }}</span></a>
                </li>                                                                
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="users" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Profile</h3>
                            <div class="row mt-2">
                                <div class="col-md-9 col-12">
                                    <form action="" method="post" id="userForm" name="userForm">
                                        <div class="row">
                                            <div class="col-md-3">
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="mb-2">Mobile*</label>
                                                    <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-primary mt-4">Update</button>
                                            </div>
                                        </div>                                                                          
                                    </form>

                                    <form action="" method="post" id="changePasswordForm" name="changePasswordForm" class="mt-3">
                                        <h3 class="card-title">Change Password</h3>
                                        <div class="row mt-2">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="mb-2">Old Password*</label>
                                                    <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="mb-2">New Password*</label>
                                                    <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="" class="mb-2">Confirm Password*</label>
                                                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                                    <p></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary mt-3">Change Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 col-12">
                                    @if (Auth::user()->image != '')
                                        <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 50px;">
                                    @else
                                        <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 50px;">
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

                <div class="tab-pane" id="developer" role="tabpanel">
                    <div class="modal fade drawer right-align" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Builder</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="" method="post" id="builderForm" name="builderForm">
                                        <div class="modal-body">                                    
                                            <div class="row"> 
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                                        <p></p>
                                                    </div>
                                                </div> 
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="year_estd">Year Estd.</label>
                                                        <input type="text" name="year_estd" id="year_estd" class="form-control" placeholder="Year Estd.">
                                                        <p></p>
                                                    </div>
                                                </div>  
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                                        <p></p>
                                                    </div>
                                                </div> 
                                                <div class="col-md-12">  
                                                    <div class="form-group">
                                                        <label>Similar property</label>
                                                        <select multiple class="relatedProperty" name="related_properties[]" >

                                                        </select>
                                                    </div>                    
                                                </div>      
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                                        <p></p>
                                                    </div>
                                                </div>  
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile">
                                                        <p></p>
                                                    </div>                                                          
                                                </div>  
                                            </div>  
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="whatsapp">Whatsapp</label>
                                                        <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="Whatsapp">
                                                        <p></p>
                                                    </div>
                                            
                                                    <div class="form-group">
                                                        <label for="landline">Landline</label>
                                                        <input type="text" name="landline" id="landline" class="form-control" placeholder="Landeline">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" id="image_id" name="image_id" value=" ">
                                                        <label for="image">Logo</label>
                                                        <div id="image" class="dropzone dz-clickable">
                                                            <div class="dz-message needsclick">
                                                                <br>Drop files here or click to upload.<br><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>                                
                                        </div>
                                        <div class="modal-footer">  
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>                                    
                                        </div>                            
                                    </form>                        
                                </div>                   
                            </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-3">Developer Profile</h3>
                            <div class="row">
                                @foreach($builders as $value)                                        
                                    <div class="col-md-3">
                                        <div class="card">
                                            <img class="card-img-top" src="{{ asset('uploads/builder/'.$value->logo) }}" alt="" />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $value->name }}</h5>
                                                <p class="card-text">{{ $value->address }}</p>
                                                <p class="card-text"><a href="mailto:{{ $value->email }}">{{ $value->email }}</a><br /> 
                                                    L: {{ $value->landline }}<br /> 
                                                    M: {{ $value->mobile }}<br /> 
                                                    W: {{ $value->whatsapp }}<br /> 
                                                </p>
                                                
                                                <a href="{{ route('developer.edit', $value->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                                <a href="#" class="btn btn-primary btn-sm" onclick="deleteDeveloper( {{ $value->id }} )">Delete</a>
                                            </div>                                            
                                        </div>
                                    </div>
                                @endforeach                                
                            </div>
                    
                            <div class="card-footer clearfix">
                                {{ $builders->links() }}
                            </div>

                            <form action="" method="post" id="builderForm" name="builderForm">
                                <div class="modal-body">                                    
                                    <div class="row"> 
                                        <div class="col-md-9">
                                            <div class="row"> 
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="year_estd">Year Estd.</label>
                                                        <input type="text" name="year_estd" id="year_estd" class="form-control" placeholder="Year Estd.">
                                                        <p></p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class="form-control" placeholder="Address">
                                                <p></p>
                                            </div>
                                            <div class="form-group">
                                                <label>Similar property</label>
                                                <select multiple class="relatedProperty" name="related_properties[]" >

                                                </select>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="landline">Landline</label>
                                                        <input type="text" name="landline" id="landline" class="form-control" placeholder="Landeline">
                                                        <p></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="mobile">Mobile</label>
                                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile">
                                                        <p></p>
                                                    </div> 
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="whatsapp">Whatsapp</label>
                                                        <input type="text" name="whatsapp" id="whatsapp" class="form-control" placeholder="Whatsapp">
                                                        <p></p>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="hidden" id="image_id" name="image_id" value=" ">
                                                <label for="image">Logo</label>
                                                <div id="image" class="dropzone dz-clickable">
                                                    <div class="dz-message needsclick">
                                                        <br>Drop files here or click to upload.<br><br>
                                                    </div>
                                                </div>
                                            </div>
                                                                               
                                            
                                            
                                        </div>  
                                    </div>                                  
                                </div>
                                <div class="modal-footer">  
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>                                    
                                </div>                            
                            </form>  
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
