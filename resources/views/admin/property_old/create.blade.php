@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Add Property</h1>
            </div>  
            <div class="col-sm-6 text-right">
                <a href="{{ route('property.index' )}}" class="btn btn-primary">Back</a>
            </div>          
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('admin.message')

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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Facing<span class="req">*</span></label>
                                            <select name="view" id="view" class="form-control">
                                                <option value="">Facing</option>
                                                @if ($facings->isNotEmpty())
                                                    @foreach ($facings as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                            
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="year_build" class="mb-1">Year Build<span class="req">*</span></label>
                                            <input type="text" placeholder="Year Build" id="year_build" name="year_build" class="form-control">                            
                                        </div>
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="total_area" class="mb-1">Total Area<span class="req">*</span></label>
                                            <input type="text" placeholder="Total area" id="total_area" name="total_area" class="form-control">                            
                                        </div>
                                    </div> 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="price" class="mb-1">Price<span class="req">*</span></label>
                                            <input type="text" placeholder="Price" id="price" name="price" class="form-control">                            
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="compare_price" class="mb-1">Compare Price<span class="req">*</span></label>
                                            <input type="text" placeholder="Compare price" id="compare_price" name="compare_price" class="form-control">                            
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
                                            <label for="rera" class="mb-1">RERA<span class="req">*</span></label>
                                            <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control">                            
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="mb-1">BHK<span class="req">*</span></label>
                                            <select name="room" id="room" class="form-control">  
                                                <option value="">Room</option>                              
                                                @if ($bhk->isNotEmpty())
                                                    @foreach ($bhk as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                            
                                        </div>
                                    </div>    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Bathroom<span class="req">*</span></label>
                                            <select name="bathroom" id="bathroom" class="form-control">   
                                                <option value="">Bath</option>                             
                                                @if ($bath->isNotEmpty())
                                                    @foreach ($bath as $value)
                                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>                        
                                        </div>
                                    </div>  
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="mb-1">Description<span class="req">*</span></label>
                                            <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Similar property</label>
                                            <select multiple class="relatedProperty" name="related_properties[]" id="related_properties">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="size" class="mb-1">Amenities<span class="req">*</span></label>
                                            <select multiple class="related_amenities" name="related_amenities[]" id="related_amenities">
                                                
                                            </select>
                                        </div>                                        
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Accordion item 1 -->

                <div class="card">
                    <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
                        <h4 data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo" >Property Photos</h4>
                    </div>
                    <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <h2 class="h4 mb-3">Cover Picture</h2>
                                    <input type="hidden" id="image_id" name="image_id" value=" ">
                                    <div id="cover_photo" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>                                    
                                </div> --}}
                                <div class="col-md-12">
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                    <div class="row" id="product-gallery"></div>
                                </div>
                            </div>                                                    
                        </div>
                    </div>
                </div>
                <!-- Accordion item 2 -->
                    
                <div class="card">
                    <div id="headingThree" class="card-header bg-white shadow-sm border-0">
                        <h4 type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree" >Developer's Details</h4>
                    </div>
                    <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample" class="collapse">
                        <div class="card-body">
                            <div class="row">                                    
                                <div class="col-md-6">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Block</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Show on page?</label>
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Accordion item 3 -->
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Create Property</button>
                <a href="{{ route('property.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </div>
    </form>
</div>
</section>
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
            url: '{{ route('property.similarProperty') }}',
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
    $('.related_amenities').select2({
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

    //Submit Post Form
    $("#createPropertyForm").submit(function(event){
        event.preventDefault();
        $("button[type='submit']").prop('disabled', true);
        $.ajax({
            url: '{{ route("property.store") }}',
            type: 'POST',
            dataType: 'json',
            data: $("#createPropertyForm").serializeArray(),
            success: function(response){
                $("button[type='submit']").prop('disabled', false);

                if(response.status == true){
                    $("#title").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html();                    
                    window.location.href='{{ route("property.index") }}'
                } else {
                    var errors = response.errors;
                    if(errors.title){
                        $("#title").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.title);
                    } else {
                        $("#title").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html();
                    }
                    //window.location.href='{{ route("account.login") }}'
                }
            },
            error: function(JQXHR, exception){
                console.log("Something went wrong");
            }
        })
    });


    //File image uplaod
    // Dropzone.autoDiscover = false;
    //     const dropzone = $("#cover_photo").dropzone({
    //         init: function() {
    //             this.on('addedfile', function(file) {
    //                 if (this.files.length > 1) {
    //                     this.removeFile(this.files[0]);
    //                 }
    //             });
    //         },
    //         url:  "{{ route('temp-images.create') }}",
    //         maxFiles: 1,
    //         paramName: 'image',
    //         addRemoveLinks: true,
    //         acceptedFiles: "image/jpeg,image/png,image/gif",
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }, success: function(file, response){
    //             $("#image_id").val(response.image_id);                
    //         }
    //     });




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

        function deleteImage(id){
            $("#image-row-"+id).remove();
        }
</script>
@endsection