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
            <div class="container-fluid">                              
                <div id="accordionExample" class="accordion ">
                    <div class="card">
                        <div id="headingOne" class="card-header bg-white shadow-sm border-0">
                            <h4 data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne" >Property details</h4>
                        </div>
                        <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse show">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title" class="mb-1">Property name<span class="req">*</span></label>
                                            <input type="text" placeholder="Title" id="title" name="title" class="form-control">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug">Slug</label>
                                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                            <p class="error"></p>
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
                                            <label for="saletype" class="mb-1">Sale Type<span class="req">*</span></label>
                                            <select name="saleType" id="saleType" class="form-control">
                                                @if ($saleTypes->isNotEmpty())
                                                    @foreach ($saleTypes as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category" class="mb-1">Category<span class="req">*</span></label>
                                            <select name="category" id="category" class="form-control">
                                                @if ($categories->isNotEmpty())
                                                    @foreach ($categories as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                            
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
                                            <select name="city" id="city" class="form-control">
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
                                            <select name="area" id="area" class="form-control">
                                                <option value="">Select Area</option>
                                            </select>                        
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
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
                                                    <label for="" class="mb-1">Property Type<span class="req">*</span></label>
                                                    <select name="propertyType" id="propertyType" class="form-control">
                                                        <option value="">Select a type</option>
                                                        @if ($propertyTypes->isNotEmpty())
                                                            @foreach ($propertyTypes as $value)
                                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="year_build" class="mb-1">Year Build<span class="req">*</span></label>
                                                    <input type="text" placeholder="Year Build" id="year_build" name="year_build" class="form-control">                            
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
                                </div>
                            </div>
                        </div>
                        <!-- Accordion item 1 -->

                        <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
                            <h4 data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo" >Details</h4>
                        </div>
                        <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Similar property</label>
                                            <select multiple class="relatedProperty" name="related_properties[]" >

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">  
                                        <div class="form-group">
                                            <label for="rera" class="mb-1">RERA<span class="req">*</span></label>
                                            <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control">                            
                                        </div>
                                    </div>     
                                    <div class="col-md-6">       
                                        <div class="form-group">
                                            <label for="related_facings" class="mb-1">Facings<span class="req">*</span></label>
                                            <select multiple class="relatedFacings" name="related_facings[]" id="related_facings">
                                                
                                            </select>
                                        </div>  
                                    </div>                                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="room" class="mb-1">Rooms<span class="req">*</span></label>
                                            <select name="room" id="room" class="form-control">
                                                <option value="">Select a Room</option>
                                                @if ($rooms->isNotEmpty())
                                                    @foreach ($rooms as $value)
                                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select> 
                                        </div>
                                    </div>     
                                    <div class="col-md-3">                                
                                        <div class="form-group">
                                            <label for="bathroom" class="mb-1">Bathroom<span class="req">*</span></label>
                                            <select name="bathroom" id="bathroom" class="form-control">
                                                <option value="">Select a Bathroom</option>
                                                @if ($bathrooms->isNotEmpty())
                                                    @foreach ($bathrooms as $value)
                                                        <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select> 
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="size" class="mb-1">Amenities<span class="req">*</span></label>
                                            <select multiple class="relatedAmenity" name="related_amenities[]" id="related_amenities">
                                                
                                            </select>
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
                                </div>                                                    
                            </div>
                        </div>
                        <!-- Accordion item 2 -->
                        
                        <div id="headingThree" class="card-header bg-white shadow-sm border-0">
                            <h4 data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree" >Photos/Documents</h4>
                        </div>
                        <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample" class="collapse">
                            <div class="card-body">
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
                        <!-- Accordion item 3 -->                        
                    
                        <div id="headingFour" class="card-header bg-white shadow-sm border-0">
                            <h4 type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                aria-controls="collapseFour" >Builder</h4>
                        </div>
                        <div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample" class="collapse">
                            <div class="card-body">
                                <div class="row">                                    
                                    <div class="col-md-8">
                                        <div class="form-group">   
                                            <label>Select Builder</label>   
                                            <select name="builder" id="builder" class="form-control">                                                                  
                                                <option value="">Select a Builder</option>
                                                @if ($builders->isNotEmpty())
                                                    @foreach ($builders as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                            
                                        </div>   
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Show on page?</label>
                                            <select name="is_featured" id="is_featured" class="form-control">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>   
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Block</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <!-- Accordion item 4 -->
                    </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create Property</button>
                <a href="{{ route('properties.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>
    
@endsection

@section('customJs')
<script>

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
            error: function(){
                console.log("Something went wrong")
            }
        });
    });

    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                console.log(response)

               var html = `<div class="col-md-3 mt-3" id="image-row-${response.image_id}">
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