@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit Property</h1>
            </div>            
            <div class="col-sm-6 text-right">
                <a href="{{ route('property.index' )}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<section class="section-5 bg-2">
    <div class="container-fluid">
        @include('front.message')
      
        <form action="" method="post" id="updateJobForm" name="updateJobForm">
            <div class="card border-0 shadow mb-3 ">
                <div class="card-body card-form p-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="" class="mb-1">Title<span class="req">*</span></label>
                            <input value={{ $property->title}} type="text" placeholder="Job Title" id="title" name="title" class="form-control">
                            <p></p>
                        </div>
                        <div class="col-md-4  mb-3">
                            <label for="" class="mb-1">Category<span class="req">*</span></label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select a Category</option>
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $category)
                                        <option {{ ($property->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="propertyType" class="mb-1">Property Type<span class="req">*</span></label>
                            <select name="propertyType" id="propertyType" class="form-control">
                                @if ($propertytypes->isNotEmpty())
                                    @foreach ($propertytypes as $propertytype)
                                        <option {{ ($property->job_type_id == $propertytype->id) ? 'selected' : ''}} value="{{ $propertytype->id }}">{{ $propertytype->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>                                               
                        <div class="mb-3 col-md-4">
                            <label for="company_location" class="mb-1">Location<span class="req">*</span></label>
                            <input value={{ $property->location}} type="text" placeholder="Company Location" id="company_location" name="company_location" class="form-control">
                            <p></p>
                        </div>                        
                        <div class="mb-3 col-md-12">
                            <label for="" class="mb-1">Description<span class="req">*</span></label>
                            <textarea class="textarea" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $property->description}}</textarea>
                            <p></p>
                        </div>                        
                        <div class="mb-3 col-md-4">
                            <label for="" class="mb-1">Keywords</label>
                            <input value={{ $property->keywords}} type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>           
        </form>           
    </div>
</section>
@endsection

@section('customJs')
<script>
    $("#updateJobForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled', true);

        $.ajax({
            url: '{{ route("property.update", $property->id) }}',
            type: 'POST',
            dataType: 'json',
            data: $("#updateJobForm").serializeArray(),
            success: function(response){
                $("button[type='submit']").prop('disabled', false);

                if(response.status == true){

                    $("#title").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#category").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#location").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();
                    $("#description").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();

                    window.location.href='{{ route("property.index") }}'

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
                 
                    if(errors.description){
                        $("#description").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                    } else {
                        $("#description").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
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
