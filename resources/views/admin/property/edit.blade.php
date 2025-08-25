@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('properties.index') }}" class="btn btn-primary btn-sm pull-right">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->

    <section>
        <form action="" method="post" id="updateJobForm" name="updateJobForm">                         
            <div class="card">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h5 class="accordion-header m-0" id="headingOne">
                            <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Property Details
                            </button>
                        </h5>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-1">Property name<span class="req">*</span></label>
                                            <input type="text" value="{{ $property->title}}" id="title" name="title" class="form-control">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" value="{{ $property->slug}}"  readonly name="slug" id="slug" class="form-control" >
                                            <p class="error"></p>
                                        </div>
                                    </div>                                            
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" class="mb-1">Property Type<span class="req">*</span></label>
                                                    <select name="propertyType" id="propertyType" class="form-select">
                                                        <option value="">Select a type</option>
                                                        @if ($propertyTypes->isNotEmpty())
                                                            @foreach ($propertyTypes as $value)
                                                                <option {{ ($property->property_type_id == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        @endif                                               
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="category" class="mb-1">Category<span class="req">*</span></label>
                                                    <div class="btn-group" role="group" aria-label="Category Switch">
                                                        @if ($categories->isNotEmpty())
                                                            @foreach ($categories as $value)
                                                                <input type="radio" class="btn-check" name="category" id="category-{{ $value->id }}" 
                                                                    value="{{ $value->id }}" 
                                                                    autocomplete="off"
                                                                    {{ (isset($property) && $property->category_id == $value->id) ? 'checked' : '' }}>
                                                                <label class="btn btn-outline-primary" for="category-{{ $value->id }}">
                                                                    {{ $value->name }}
                                                                </label>
                                                            @endforeach
                                                        @endif
                                                    </div>                           
                                                </div>
                                            </div>           
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="saletype" class="mb-1">Sale Type<span class="req">*</span></label>
                                                    <div class="btn-group" role="group" aria-label="Category Switch">
                                                        @if ($saleTypes->isNotEmpty())
                                                            @foreach ($saleTypes as $value)
                                                                <input type="radio" class="btn-check" 
                                                                    name="saleType" 
                                                                    id="saleType-{{ $value->id }}" 
                                                                    value="{{ $value->id }}" 
                                                                    autocomplete="off"
                                                                    {{ (isset($property) && $property->sale_type_id == $value->id) ? 'checked' : '' }}>
                                                                <label class="btn btn-outline-primary" for="saleType-{{ $value->id }}">
                                                                    {{ $value->title }}
                                                                </label>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>                                                                                                                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location" class="mb-1">Location<span class="req">*</span></label>
                                            <input type="text" value="{{ $property->location}}" id="location" name="location" class="form-control">                            
                                        </div>                        
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="mb-1">City<span class="req">*</span></label>
                                            <select name="city" id="city" class="form-select">
                                                <option value="">Select a City</option>
                                                @if ($cities->isNotEmpty())
                                                    @foreach ($cities as $value)
                                                        <option {{ ($property->city_id == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                            
                                        </div>
                                    </div>                                             
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Area<span class="req">*</span></label>
                                            <select name="area" id="area" class="form-select">
                                                <option value="">Select Area</option>
                                                @if ($areas->isNotEmpty())
                                                @foreach ($areas as $value)
                                                    <option {{ ($property->area_id == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            @endif
                                            </select>                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Description<span class="req">*</span></label>
                                            <textarea class="form-control"  name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $property->description}}</textarea>                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">   
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="room" class="mb-1">BHK<span class="req">*</span></label>
                                                    <select name="room" id="room" class="form-select">
                                                        <option value="">Select a BHK</option>
                                                        @if ($rooms->isNotEmpty())
                                                            @foreach ($rooms as $value)
                                                                <option {{ ($property->room_id == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->title }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="bathroom" class="mb-1">Bathroom<span class="req">*</span></label>
                                                    <select name="bathroom" id="bathroom" class="form-select">
                                                        <option value="">Select a Bathroom</option>
                                                        @if ($bathrooms->isNotEmpty())
                                                            @foreach ($bathrooms as $value)
                                                                <option {{ ($property->bathroom_id == $value->id) ? 'selected' : ''}} value="{{ $value->id }}">{{ $value->title }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>  
                                                </div>
                                            </div>                                                    
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price" class="mb-1">Price<span class="req">*</span></label>
                                                    <input type="text" value="{{ $property->price}}"  id="price" name="price" class="form-control">                            
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="compare_price" class="mb-1">Compare Price<span class="req">*</span></label>
                                                    <input type="text" value="{{ $property->compare_price}}" id="compare_price" name="compare_price" class="form-control">                            
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Search Keywords</label>
                                            <input type="text" value="{{ $property->keywords }}" id="keywords" name="keywords" class="form-control">
                                        </div>
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="size" class="mb-1">Size<span class="req">*</span></label>
                                            <input type="text" value="{{ $property->size}}" id="size" name="size" class="form-control">                            
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total_area" class="mb-1">Total Area<span class="req">*</span></label>
                                            <input type="text" value="{{ $property->total_area}}" id="total_area" name="total_area" class="form-control">                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="size" class="mb-1">Facings<span class="req">*</span></label>
                                            <select multiple class="relatedFacings" name="related_facings[]" id="related_facings">
                                                @if (!empty($relatedFacings))
                                                    @foreach ($relatedFacings as $value)
                                                        <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rera" class="mb-1">RERA<span class="req">*</span></label>
                                            <input type="text" value="{{ $property->rera}}" id="rera" name="rera" class="form-control">                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year_build" class="mb-1">Year Build<span class="req">*</span></label>
                                            <input type="text" value="{{ $property->year_build}}" id="year_build" name="year_build" class="form-control">                            
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Similar property</label>
                                            <select multiple class="relatedProperty" name="related_properties[]" id="related_properties">
                                                @if (!empty($relatedProperties))
                                                    @foreach ($relatedProperties as $value)
                                                        <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="size" class="mb-1">Amenities<span class="req">*</span></label>
                                            <select multiple class="relatedAmenity" name="related_amenities[]" id="related_amenities">
                                                @if (!empty($relatedAmenities))
                                                    @foreach ($relatedAmenities as $value)
                                                        <option selected value="{{ $value->id }}">{{ $value->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mt-4 mb-2">Developer's details</h4>
                                <div class="row">                                    
                                    <div class="col-md-8">
                                        <div class="form-group">   
                                            <label>Select Builder</label>   
                                            <select name="builder" id="builder" class="form-select">                                                                  
                                                <option value="">Select a Builder</option>
                                                @if ($builders->isNotEmpty())
                                                    @foreach ($builders as $value)
                                                        <option {{ ($property->builder_id == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                            
                                        </div>   
                                    </div>   
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Show on page?</label> <br />                                  
                                            <div class="btn-group" role="group" aria-label="Is Featured Switch">
                                                <input type="radio" class="btn-check" name="is_featured" id="is_featured_yes" value="Yes" autocomplete="off"
                                                    {{ isset($property) && $property->is_featured == 'Yes' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="is_featured_yes">Yes</label>

                                                <input type="radio" class="btn-check" name="is_featured" id="is_featured_no" value="No" autocomplete="off"
                                                    {{ isset($property) && $property->is_featured == 'No' ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="is_featured_no">No</label>
                                            </div>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label><br />
                                            <div class="btn-group" role="group" aria-label="Status Switch">
                                                <input type="radio" class="btn-check" name="status" id="status_active" value="1" autocomplete="off"
                                                    {{ isset($property) && $property->status == 1 ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="status_active">Active</label>

                                                <input type="radio" class="btn-check" name="status" id="status_block" value="0" autocomplete="off"
                                                    {{ isset($property) && $property->status == 0 ? 'checked' : '' }}>
                                                <label class="btn btn-outline-primary" for="status_block">Block</label>
                                            </div>
                                            <p class="error"></p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h5 class="accordion-header m-0" id="headingThree">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Media
                            </button>
                        </h5>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div id="image" class="dropzone dz-clickable mb-3">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                                <div id="product-gallery">
                                    @if ($propertyImage->isNotEmpty())
                                        <div class="row">
                                            @foreach ($propertyImage->unique('label') as $image)
                                                <div class="col-md-2" id="image-row-{{ $image->id }}">
                                                    <div class="media-gallery">
                                                        <input type="hidden" name="image_array[]" value="{{ $image->id }}">
                                                        <img src="{{ asset('uploads/property/small/'.$image->image ) }}" />
                                                        <div class="label">
                                                            <span class="title">{{ $image->label }}</span>
                                                            <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="deleteCardImg">X</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="card-footer">
                <div class="pull-right mb-3">
                    <a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark btn-sm">Cancel</a>
                    <button type="submit" id="updateBtn" class="btn btn-primary btn-sm m-1">Update</button>                         
                </div>
            </div>
        </div>
    </form> 
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        $("form").on("submit", function(){
            let btn = $("#updateBtn");
            btn.prop("disabled", true);              // disable button
            btn.text("Updating Data...");            // change label
        });
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


    //Similar property
    $('.relatedAmenity').select2({
        ajax: {
            url: '{{ route('property.amenities') }}',
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

    //Similar property
    $('.relatedFacings').select2({
        ajax: {
            url: '{{ route('property.facings') }}',
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

    $('#title').change(function(){
        element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success: function(response){
                $("button[type=submit]").prop('disabled', false);
                if(response["status"] == true){
                    $("#slug").val(response["slug"]);
                }
            }
        });
    })



    //Product form add details in database
    $("#updateJobForm").submit(function(event){
        event.preventDefault();

        var formArray = $(this).serializeArray();
        $("button[type='submit']").prop('disabled',true);

        $.ajax({
            url: '{{ route("properties.update",$property->id) }}',
            type: 'put',
            data: formArray,
            dataType: 'json',
            success: function(response){

                $("button[type='submit']").prop('disabled',false);

                if (response['status'] == true) {

                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                    window.location.href="{{ route('properties.index') }}";

                } else {
                    var errors = response['errors'];

                    $(".error").removeClass('invalid-feedback').html('');
                    $("input[type='text'], select, input[type='number']").removeClass('is-invalid');

                    $.each(errors, function(key,value){
                        $(`#${key}`).addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(value);
                    });
                }
            },

            error: function(){
                console.log("Something went wrong")
            }
        });
    });




    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url:  "{{ route('property-images.update') }}",
            maxFiles: 10,
            paramName: 'image',
            params: {'property_id' : '{{ $property->id }}'},
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                console.log(response)

               var html = `<div class="col-md-2" id="image-row-${response.image_id}">
                    <div class="card">
                        <input type="hidden" name="image_array[]" value="${response.image_id}" >
                        <img src="${response.ImagePath}" />
                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="deleteCardImg">X</a>
                    </div>
                </div>`;

                $("#product-gallery").append(html);
            },
            complete: function(file){
                this.removeFile(file);
            }
        });


        //Delete Images
        function deleteImage(id){
            $("#image-row-"+id).remove();

            if (confirm("Are you sure you want to delete image?")) {
                $.ajax({
                    url: '{{ route("property-images.destroy") }}',
                    type: 'delete',
                    data: {id:id},
                        success: function(response) {
                            if(response.status == true){
                                alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        }
                })
            }
        }
</script>
@endsection