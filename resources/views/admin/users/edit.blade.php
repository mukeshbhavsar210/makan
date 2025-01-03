@extends('admin.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-lg-3">
                @include('admin.layouts.sidebar')
            </div>
            <div class="col-lg-9">

                @include('front.message')

                <div class="card border-0 shadow mb-4">
                    <div class="card-form">
                        <form action="" method="post" id="userFormAdmin" name="userFormAdmin">
                            <div class="card-body">
                                <h3 class="fs-4 mb-1">User Edit</h3>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Name*</label>
                                            <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" value="{{ $user->name }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label for="" class="mb-2">Email*</label>
                                            <input type="text" id="email" name="email" placeholder="Enter Email" class="form-control" value="{{ $user->email }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <label for="" class="mb-2">User Type*</label>
                                            <input type="text" id="designation" name="designation" placeholder="Designation" class="form-control" value="{{ $user->designation }}">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
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
            url: '{{ route("admin.users.update",$user->id ) }}',
            type: 'put',
            data: $("#userFormAdmin").serializeArray(),
            dataType: 'json',
            success: function(response){

                if(response.status == true){
                    $("#name").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#email").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#designation").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
                    $("#mobile").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');

                    window.location.href="{{ route('admin.users') }}";

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
