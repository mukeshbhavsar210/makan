@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Add Property</h1>
            </div>            
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('admin.message')

        <form action="" method="post" id="createJobForm" name="createJobForm">
            <div class="card border-0 shadow mb-3 ">
                <div class="card-body card-form p-4">
                    <h3 class="fs-4 mb-1"></h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="mb-1">Property name<span class="req">*</span></label>
                            <input type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                            <p></p>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="" class="mb-1">City<span class="req">*</span></label>
                            <select name="city" id="city" class="form-control">
                                <option value="">Select a City</option>
                                @if ($cities->isNotEmpty())
                                    @foreach ($cities as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <select name="area" id="area" class="form-control">
                                <option value="">Select Area</option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="" class="mb-1">Property Type<span class="req">*</span></label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>
                    
                        <div class="col-md-3 mb-3">
                            <label for="jobtype" class="mb-1">Job Type<span class="req">*</span></label>
                            <select name="jobtype" id="jobtype" class="form-control">
                                @if ($jobtypes->isNotEmpty())
                                    @foreach ($jobtypes as $jobtype)
                                        <option value="{{ $jobtype->id }}">{{ $jobtype->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="" class="mb-1">Description<span class="req">*</span></label>
                            <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>
                            <p></p>
                        </div>
                        <div class="mb-3 col-md-3">
                            <label for="company_location" class="mb-1">Location<span class="req">*</span></label>
                            <input type="text" placeholder="Company Location" id="company_location" name="company_location" class="form-control">
                            <p></p>
                        </div>
                        
                        <div class="mb-3 col-md-3">
                            <label for="" class="mb-1">Keywords</label>
                            <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow mb-3 ">
                <div class="card-body card-form p-4">
                    <h3 class="fs-4 mb-1 ">Developer Details</h3>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="" class="mb-1">Name<span class="req">*</span></label>
                            <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="" class="mb-1">Location</label>
                            <input type="text" placeholder="Location" id="location" name="location" class="form-control">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="company_website" class="mb-1">Website</label>
                            <input type="text" placeholder="Website" id="company_website" name="company_website" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-footer  p-4">
                    <button type="submit" class="btn btn-primary">Create Property</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
@endsection


@section('customJs')
<script>
    $("#city").change(function(){
        var city_id = $(this).val();
        $.ajax({
            url: '{{ route("area.index") }}',
            type: 'get',
            data: {city_id:city_id},
            dataType: 'json',
            success: function(response) {
                $("#area").find("option").not(":first").remove();
                $.each(response["area"],function(key,item){
                    $("#area").append(`<option value='${item.id}' >${item.name}</option>`)
                })
            },
            error: function(){
                console.log("Something went wrong")
            }
        });
    })


    
    $("#createJobForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("account.saveProperty") }}',
            type: 'POST',
            dataType: 'json',
            data: $("#createJobForm").serializeArray(),
            success: function(response){
                $("button[type='submit']").prop('disabled', false);

                if(response.status == true){
                    $("#title").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#category").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#jobtype").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();                
                    $("#location").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#description").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#company_name").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    window.location.href='{{ route("account.property") }}'
                } else {
                    var errors = response.errors;
                    if(errors.title){
                        $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                    } else {
                        $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }

                    if(errors.category){
                        $("#category").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category);
                    } else {
                        $("#category").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }

                    if(errors.jobtype){
                        $("#jobtype").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.jobtype);
                    } else {
                        $("#jobtype").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }

                    if(errors.vacancy){
                        $("#vacancy").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.vacancy);
                    } else {
                        $("#vacancy").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }

                    if(errors.locattion){
                        $("#locattion").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.locattion);
                    } else {
                        $("#locattion").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }

                    if(errors.description){
                        $("#description").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                    } else {
                        $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }

                    if(errors.company_name){
                        $("#company_name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.company_name);
                    } else {
                        $("#company_name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
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
