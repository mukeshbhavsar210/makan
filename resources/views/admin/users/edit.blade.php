@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit User</h1>
            </div>
            
        </div>
    </div>
</section>

<section class="section-5 bg-2">
    <div class="container-fluid">
        @include('admin.layouts.message')
                <div class="card">                    
                    <form action="" method="post" id="userFormAdmin" name="userFormAdmin">
                        <div class="card-body">
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
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="mb-2">Mobile*</label>
                                        <input type="text" id="mobile" name="mobile" placeholder="Mobile" class="form-control" value="{{ $user->mobile }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option {{ ($user->status == 1 ? 'selected' : '')}} value="1">Active</option>
                                            <option {{ ($user->status == 0 ? 'selected' : '')}} value="0">Block</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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
    $("#userFormAdmin").submit(function(event){
        event.preventDefault();

        $.ajax({
            url: '{{ route("users.index.update",$user->id ) }}',
            type: 'put',
            data: $("#userFormAdmin").serializeArray(),
            dataType: 'json',
            success: function(response){

                if(response.status == true){
                    $("#name").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#designation").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#mobile").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');

                    window.location.href="{{ route('users.index') }}";

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
</script>
@endsection
