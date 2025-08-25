@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Create Property</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('properties.index') }}" class="btn btn-primary btn-sm pull-right">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->

        <form action="" method="post" id="createPropertyForm" name="createPropertyForm">
            @csrf
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
                                            <input type="text" placeholder="Title" id="title" name="title" class="form-control">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
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
                                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                                            @foreach ($categories as $key => $value)
                                                                <input type="radio" class="btn-check" 
                                                                    name="category" 
                                                                    id="category-{{ $value->id }}" 
                                                                    value="{{ $value->id }}" 
                                                                    autocomplete="off"
                                                                    {{ (isset($property) && $property->category_id == $value->id) ? 'checked' : ($key == 0 ? 'checked' : '') }}>
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
                                                    <div class="btn-group" role="group" aria-label="Sale Type Switch">
                                                        @if ($saleTypes->isNotEmpty())
                                                            @foreach ($saleTypes as $key => $value)
                                                                <input type="radio" class="btn-check" 
                                                                    name="saleType" 
                                                                    id="saleType-{{ $value->id }}" 
                                                                    value="{{ $value->id }}" 
                                                                    autocomplete="off"
                                                                    {{ (isset($property) && $property->sale_type_id == $value->id) ? 'checked' : ($key == 0 ? 'checked' : '') }}>
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
                                            {{-- <input type="text" id="txtPlaces" placeholder="Enter a location" /> --}}
                                            <label for="location" class="mb-1">Location<span class="req">*</span></label>
                                            <input type="text" placeholder="Location" id="location" name="location" class="form-control">                            
                                        </div>                        
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="mb-1">City<span class="req">*</span></label>
                                            <select name="city" id="city" class="form-select">
                                                <option value="">Select a City</option>
                                                @if ($cities->isNotEmpty())
                                                    @foreach ($cities as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                            </select>                        
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Description<span class="req">*</span></label>
                                            <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>                            
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="room" id="roomLabel" class="mb-1">BHK<span class="req">*</span></label>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="roomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Select BHK
                                                        </button>
                                                        <ul class="dropdown-menu w-100" aria-labelledby="roomDropdown">
                                                            @if ($rooms->isNotEmpty())
                                                                @foreach ($rooms as $value)
                                                                    <li>
                                                                        <label class="dropdown-item">
                                                                            <input type="checkbox" class="room-option" value="{{ $value->id }}"> {{ $value->title }}
                                                                        </label>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <!-- Hidden input to store selected values -->
                                                    <input type="hidden" name="room" id="room">
                                                </div>
                                            </div>     
                                            <div class="col-md-6">                                
                                                <div class="form-group">
                                                    <label for="bathroom" id="bathroomLabel" class="mb-1">Bathroom<span class="req">*</span></label>
                                                    <!-- Bathroom Multi-Select -->
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="bathroomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Select Bathroom
                                                        </button>
                                                        <ul class="dropdown-menu w-100" aria-labelledby="bathroomDropdown">
                                                            @if ($bathrooms->isNotEmpty())
                                                                @foreach ($bathrooms as $value)
                                                                    <li>
                                                                        <label class="dropdown-item">
                                                                            <input type="checkbox" class="bathroom-option" value="{{ $value->id }}"> {{ $value->title }}
                                                                        </label>
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>

                                                    <!-- Hidden input to store selected values -->
                                                    <input type="hidden" name="bathroom" id="bathroom">

                                                </div>    
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price" class="mb-1">Price<span class="req">*</span></label>
                                                    <input type="text" placeholder="Price" id="price" name="price" class="form-control">                            
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="compare_price" class="mb-1">Offer Price<span class="req">*</span></label>
                                                    <input type="text" placeholder="Offer price" id="compare_price" name="compare_price" class="form-control">                            
                                                </div>
                                            </div>  
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Search Keywords</label>
                                            <input type="text" placeholder="Search keywords" id="keywords" name="keywords" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="size" class="mb-1">Size<span class="req">*</span></label>
                                            <input type="text" placeholder="Size" id="size" name="size" class="form-control">                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="total_area" class="mb-1">Total Area<span class="req">*</span></label>
                                            <input type="text" placeholder="Total area" id="total_area" name="total_area" class="form-control">                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">       
                                        <div class="form-group">
                                            <label for="related_facings" class="mb-1">Facings<span class="req">*</span></label>
                                            <select multiple class="relatedFacings form-select" name="related_facings[]" id="related_facings" class="form-select">
                                                
                                            </select>
                                        </div>  
                                    </div>  
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="rera" class="mb-1">RERA<span class="req">*</span></label>
                                            <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control">                            
                                        </div>
                                    </div>  
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year_build" class="mb-1">Year Build<span class="req">*</span></label>
                                            <input type="text" placeholder="Year Build" id="year_build" name="year_build" class="form-control">                            
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Similar property</label>
                                            <select multiple class="relatedProperty" name="related_properties[]" >

                                            </select>
                                        </div>
                                    </div>                                                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="amenitiesLabel">Amenities <span class="req">*</span></label>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="amenitiesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select Amenities
                                                </button>
                                                <ul class="dropdown-menu w-100" aria-labelledby="amenitiesDropdown">
                                                    @if ($amenities->isNotEmpty())
                                                        @foreach ($amenities as $value)
                                                            <li>
                                                                <label class="dropdown-item">
                                                                    <input type="checkbox" class="amenities-option" value="{{ $value->id }}"> {{ $value->title }}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            <input type="hidden" name="amenities" id="amenities">  
                                        </div> 
                                    </div>

                                    <h4 class="mt-4 mb-2">Developer's details</h4>
                                    <div class="row">                                    
                                        <div class="col-md-6">
                                            <div class="form-group">   
                                                <label>Select Builder</label>   
                                                <select name="builder" id="builder" class="form-select">                                                                  
                                                    <option value="">Select a Builder</option>
                                                    @if ($builders->isNotEmpty())
                                                        @foreach ($builders as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>                            
                                            </div>   
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Show on page?</label><br />
                                               <div class="btn-group" role="group" aria-label="Is Featured Switch">
                                                    <input type="radio" class="btn-check" 
                                                        name="is_featured" 
                                                        id="is_featured_yes" 
                                                        value="Yes" 
                                                        autocomplete="off"
                                                        {{ (isset($property) && $property->is_featured == 'Yes') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                                    <label class="btn btn-outline-primary" for="is_featured_yes">Yes</label>

                                                    <input type="radio" class="btn-check" 
                                                        name="is_featured" 
                                                        id="is_featured_no" 
                                                        value="No" 
                                                        autocomplete="off"
                                                        {{ (isset($property) && $property->is_featured == 'No') ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="is_featured_no">No</label>
                                                </div>
                                                <p class="error"></p>
                                            </div>
                                        </div>   
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label><br />
                                                <div class="btn-group" role="group" aria-label="Status Switch">
                                                    <input type="radio" class="btn-check" 
                                                        name="status" 
                                                        id="status_active" 
                                                        value="1" 
                                                        autocomplete="off"
                                                        {{ (isset($property) && $property->status == 1) ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                                    <label class="btn btn-outline-primary" for="status_active">Active</label>

                                                    <input type="radio" class="btn-check" 
                                                        name="status" 
                                                        id="status_block" 
                                                        value="0" 
                                                        autocomplete="off"
                                                        {{ (isset($property) && $property->status == 0) ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-primary" for="status_block">Block</label>
                                                </div>
                                                <p class="error"></p>
                                            </div>
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
                               <div class="row">
                                    <div class="col-md-6">
                                        <h5>Photos</h5>
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">
                                                <br>Drop files here or click to upload.<br><br>
                                            </div>
                                        </div>
                                        <div class="row" id="product-gallery"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Documents (only PDF)</h5>
                                        <div id="document" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">
                                                <br>Drop files here or click to upload.<br><br>
                                            </div>
                                        </div>
                                        <div class="row" id="document-gallery"></div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>                   

                    <div class="card-footer">
                        <div class="pull-right mb-3">
                            <a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark btn-sm">Cancel</a>
                            <button type="submit" id="createBtn" class="btn btn-primary btn-sm m-1">Create</button>                         
                        </div>
                    </div>
                </div>
            </div>
        </form>    
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        $("form").on("submit", function(){
            let btn = $("#createBtn");
            btn.prop("disabled", true);              // disable button
            btn.text("Updating Data...");            // change label
        });


        $(".room-option").on("change", function() {
            let selected = [];
            $(".room-option:checked").each(function() {
                selected.push($(this).parent().text().trim());
            });

            // Update dropdown button text
            if (selected.length > 0) {
                $("#roomDropdown").text(selected.join(", "));
            } else {
                $("#roomDropdown").text("Select BHK");
            }

            // Update label with count
            if (selected.length > 0) {
                $("#roomLabel").text("Room (" + selected.length + ")");
            } else {
                $("#roomLabel").text("Room");
            }

            // Store IDs in hidden input
            let selectedIds = [];
            $(".room-option:checked").each(function() {
                selectedIds.push($(this).val());
            });
            $("#room").val(selectedIds.join(","));
        });


        $(".bathroom-option").on("change", function() {
            let selected = [];
            $(".bathroom-option:checked").each(function() {
                selected.push($(this).parent().text().trim());
            });

            // Update dropdown button text dynamically
            if (selected.length > 0) {
                $("#bathroomDropdown").text(selected.join(", "));
            } else {
                $("#bathroomDropdown").text("Select Bathroom");
            }

            // Update label with count
            if (selected.length > 0) {
                $("#bathroomLabel").text("Bathroom (" + selected.length + ")");
            } else {
                $("#bathroomLabel").text("Bathroom");
            }

            // Store selected IDs in hidden input
            let selectedIds = [];
            $(".bathroom-option:checked").each(function() {
                selectedIds.push($(this).val());
            });
            $("#bathroom").val(selectedIds.join(","));
        });


        
        //Amenities
        $(".amenities-option").on("change", function() {
            let selected = [];
            $(".amenities-option:checked").each(function() {
                selected.push($(this).parent().text().trim());
            });

            // Update dropdown button text
            if (selected.length > 0) {
                $("#amenitiesDropdown").text(selected.join(", "));
            } else {
                $("#amenitiesDropdown").text("Select Amenities");
            }

            // Update label with count
            if (selected.length > 0) {
                $("#amenitiesLabel").text("Amenities (" + selected.length + ")");
            } else {
                $("#amenitiesLabel").text("Amenities");
            }

            // Store selected IDs in hidden input
            let selectedIds = [];
            $(".amenities-option:checked").each(function() {
                selectedIds.push($(this).val());
            });
            $("#amenities").val(selectedIds.join(","));
        });

    });


    $("#city").change(function(){
        var city_id = $(this).val();
        $.ajax({
            url: '{{ route("areaSub.index") }}',            
            type: 'get',
            data: {city_id:city_id},
            dataType: 'json',
            success: function(response) {
                $("#area").find("option").not(":first").remove();
                $.each(response["subAreas"],function(key,item){
                    $("#area").append(`<option value='${item.id}' >${item.name}</option>`)
                })
            },
            error: function(){
                console.log("Something went wrong")
            }
        });
    })

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

    //Slug automatically add
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
    $("#createPropertyForm").submit(function(event){
        event.preventDefault();

        var formArray = $(this).serializeArray();
        $("button[type='submit']").prop('disabled',true);

        $.ajax({
            url: '{{ route("properties.store") }}',
            type: 'post',
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
            // error: function(){
            //     console.log("Something went wrong")
            // }
            error: function(xhr, status, error){
                console.log("AJAX Error:", status, error);
                console.log("Response:", xhr.responseText);
            }
        });
    });

    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url: "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                console.log(response);

                // Build HTML with label dropdown
                var html = `
                    <div class="col-md-3 mt-3" id="image-row-${response.image_id}">
                        <div class="card p-2">
                            <input type="hidden" name="image_array[${response.image_id}][id]" value="${response.image_id}">
                            
                            <img src="${response.ImagePath}" class="img-fluid" />

                            <!-- Label selection -->
                            <select name="image_array[${response.image_id}][label]" 
                                    class="form-control mt-2 image-label">
                                <option value="">Select Label</option>
                                <option value="Main">Main</option>
                                <option value="Video">Video</option>
                                <option value="Elevation">Elevation</option>
                                <option value="Bedroom">Bedroom</option>
                                <option value="Living">Living</option>
                                <option value="Balcony">Balcony</option>
                                <option value="Amenities">Amenities</option>
                                <option value="Floor">Floor</option>
                                <option value="Location">Location</option>
                                <option value="Cluster">Cluster</option>                        
                            </select>

                            <!-- Delete button -->
                            <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" 
                            class="deleteCardImg btn btn-sm btn-danger mt-2">Remove</a>
                        </div>
                    </div>`;

                $("#product-gallery").append(html);

                // Attach event after adding select
                $(".image-label").off("change").on("change", function() {
                    enforceUniqueLabels();
                });
            },
            complete: function(file) {
                this.removeFile(file);
            }
        });

        // Function to enforce unique labels
        function enforceUniqueLabels() {
            let selectedLabels = [];

            // Collect all selected labels
            $(".image-label").each(function() {
                let val = $(this).val();
                if (val) {
                    selectedLabels.push(val);
                }
            });

            // Reset all options first
            $(".image-label option").prop("disabled", false);

            // Disable already selected labels in other dropdowns
            $(".image-label").each(function() {
                let currentVal = $(this).val();
                selectedLabels.forEach(label => {
                    if (label !== currentVal) {
                        $(this).find("option[value='" + label + "']").prop("disabled", true);
                    }
                });
            });
        }



        //Delete image
        function deleteImage(id){
            $("#image-row-"+id).remove();
        }


    //Document image uplaod
    Dropzone.autoDiscover = false;
        const dropzone2 = $("#document").dropzone({
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 3,
            paramName: 'pdf',            
            addRemoveLinks: true,
            acceptedFiles: "application/pdf",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#document_id").val(response.document_id);
                console.log(response)
               var html = `<div class="col-md-3 mt-3" id="document-row-${response.document_id}">
                    <div class="card">
                        <input type="hidden" name="document_array[]" value="${response.document_id}" >
                        <img src="https://play-lh.googleusercontent.com/kXHLqzBASXjDuVVEVPRuFvdLRDU2GAiS7BBA9uOLB-uiKByzt4-YDhmBfuLaWIV_7xJ6=w240-h480-rw" />
                        <a href="javascript:void(0)" onclick="deleteDocument(${response.document_id})" class="deleteCardImg">X</a>
                    </div>
                </div>`;

                $("#document-gallery").append(html);
            },


            complete: function(file){
                this.removeFile(file);
            }
        });

        //Delete document
        function deleteDocument(id){
            $("#document-row-"+id).remove();
        }
</script>

@endsection