@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container-fluid">
       
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')

                <form action="" method="post" id="updateJobForm" name="updateJobForm">
                    <div class="card border-0 shadow mb-3 ">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Edit Job Details</h3>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="mb-1">Title<span class="req">*</span></label>
                                    <input value={{ $job->title}} type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-3">
                                    <label for="" class="mb-1">Category<span class="req">*</span></label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select a Category</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option {{ ($job->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="jobtype" class="mb-1">Job Type<span class="req">*</span></label>
                                    <select name="jobtype" id="jobtype" class="form-select">
                                        @if ($jobtypes->isNotEmpty())
                                            @foreach ($jobtypes as $jobtype)
                                                <option {{ ($job->job_type_id == $jobtype->id) ? 'selected' : ''}} value="{{ $jobtype->id }}">{{ $jobtype->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-3">
                                    <label for="" class="mb-1">Vacancy<span class="req">*</span></label>
                                    <input value={{ $job->vacancy}} type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="" class="mb-1">Salary</label>
                                    <input value={{ $job->salary}} type="text" placeholder="Salary" id="salary" name="salary" class="form-control">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="company_location" class="mb-1">Location<span class="req">*</span></label>
                                    <input value={{ $job->location}} type="text" placeholder="Company Location" id="company_location" name="company_location" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="" class="mb-1">Description<span class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $job->description}}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="" class="mb-1">Responsibility</label>
                                    <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ $job->responsibility}}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="" class="mb-1">Benefits</label>
                                    <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits}}</textarea>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="" class="mb-1">Qualifications</label>
                                    <textarea class="textarea" name="qualification" id="qualification" cols="5" rows="5" placeholder="Qualifications">{{ $job->qualification}}</textarea>
                                </div>
                                <div class="mb-3 col-md-9">
                                    <label for="" class="mb-1">Keywords</label>
                                    <input value={{ $job->keywords}} type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="experience" class="mb-1">Experience<span class="req">*</span></label>
                                    <select name="experience" id="experience" class="form-control">
                                        <option value="1" {{ ($job->experience == 1) ? 'selected' : '' }}>1 Year</option>
                                        <option value="2" {{ ($job->experience == 2) ? 'selected' : '' }}>2 Years</option>
                                        <option value="3" {{ ($job->experience == 3) ? 'selected' : '' }}>3 Years</option>
                                        <option value="4" {{ ($job->experience == 4) ? 'selected' : '' }}>4 Years</option>
                                        <option value="5" {{ ($job->experience == 5) ? 'selected' : '' }}>5 Years</option>
                                        <option value="6" {{ ($job->experience == 6) ? 'selected' : '' }}>6 Years</option>
                                        <option value="7" {{ ($job->experience == 7) ? 'selected' : '' }}>7 Years</option>
                                        <option value="8" {{ ($job->experience == 8) ? 'selected' : '' }}>8 Years</option>
                                        <option value="9" {{ ($job->experience == 9) ? 'selected' : '' }}>9 Years</option>
                                        <option value="10" {{ ($job->experience == 10) ? 'selected' : '' }}>10 Years</option>
                                        <option value="10_plus" {{ ($job->experience == '10_plus') ? 'selected' : '' }} >10+ Years</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                            <h3 class="fs-4 mb-1 ">Company Details</h3>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="" class="mb-1">Name<span class="req">*</span></label>
                                    <input value={{ $job->company_name}} type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="" class="mb-1">Location</label>
                                    <input value={{ $job->location}} type="text" placeholder="Location" id="location" name="location" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="company_website" class="mb-1">Website</label>
                                <input value={{ $job->company_website}} type="text" placeholder="Website" id="company_website" name="company_website" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="submit" class="btn btn-primary">Update Job</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $("#updateJobForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("account.updateProperty", $job->id) }}',
            type: 'POST',
            dataType: 'json',
            data: $("#updateJobForm").serializeArray(),
            success: function(response){
                $("button[type='submit']").prop('disabled', false);

                if(response.status == true){

                    $("#title").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#category").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#jobtype").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#vacancy").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
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
