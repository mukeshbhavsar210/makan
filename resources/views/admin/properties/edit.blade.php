@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Edit Property</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('properties.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->

    <section class="content">
        <form action="" method="post" name="productForm" id="productForm">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title">Property's name</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ $property->title }}">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug">Slug</label>
                                        <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $property->slug }}">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Price" value="{{ $property->price }}">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="listed_by">Posted By</label>
                                        <select name="listed_by" id="listed_by" class="form-control">
                                            <option {{ ($property->listed_by == 'Agent' ? 'selected' : '' )}} value="Agent">Agent</option>
                                            <option {{ ($property->listed_by == 'Owner' ? 'selected' : '' )}} value="Owner">Owner</option>
                                            <option {{ ($property->listed_by == 'Developer' ? 'selected' : '' )}} value="Developer">Developer</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote" >{{ $property->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="property_location">Property Location</label>
                                            <input name="property_location" id="property_location" class="form-control"  type="text" placeholder="property_location" value="{{ $property->property_location }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city">City</label>
                                        <select name="city" id="city" class="form-control">
                                            <option value="">Select City</option>
                                            @if ($cities->isNotEmpty())
                                                @foreach ($cities as $city)
                                                    <option {{ ($property->city_id == $city->id) ? 'selected' : '' }} value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city">Area</label>
                                        <select name="area" id="area" class="form-control">
                                            <option value="">Select Area</option>
                                            @if ($areas->isNotEmpty())
                                                @foreach ($areas as $area)
                                                    <option {{ ($property->area_id == $area->id) ? 'selected' : '' }} value="{{ $area->id }}">{{ $area->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="google_map">Google Map</label>
                                            <input name="google_map" id="google_map" class="form-control"  type="text" placeholder="google_map" value="{{ $property->google_map }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="rera">RERA</label>
                                            <input name="rera" id="rera" class="form-control"  type="text" placeholder="rera" value="{{ $property->rera }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buildup_areas">Buildup Areas</label>
                                            <input name="buildup_areas" id="buildup_areas" class="form-control"  type="text" placeholder="buildup_areas" value="{{ $property->buildup_areas }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="possession">possession</label>
                                            <select name="possession" id="possession" class="form-control">
                                                <option {{ ($property->possession == 'Ready to move' ? 'selected' : '' )}} value="Ready to move">Ready to move</option>
                                                <option {{ ($property->possession == 'In 1 year' ? 'selected' : '' )}} value="In 1 year">In 1 year</option>
                                                <option {{ ($property->possession == 'In 3 years' ? 'selected' : '' )}} value="In 3 years">In 3 years</option>
                                                <option {{ ($property->possession == 'Beyond 3 years' ? 'selected' : '' )}} value="Beyond 3 years">Beyond 3 years</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="bhk_types">BHK Types</label>
                                            <select name="bhk_types" id="bhk_types" class="form-control">
                                                <option {{ ($property->bhk_types == '1 RK' ? 'selected' : '' )}} value="1 RK">1 RK</option>
                                                <option {{ ($property->bhk_types == '1 BHK' ? 'selected' : '' )}} value="1 BHK">1 BHK</option>
                                                <option {{ ($property->bhk_types == '2 BHK' ? 'selected' : '' )}} value="2 BHK">2 BHK</option>
                                                <option {{ ($property->bhk_types == '3 BHK' ? 'selected' : '' )}} value="3 BHK">3 BHK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="bathrooms">Bathrooms</label>
                                            <select name="bathrooms" id="bathrooms" class="form-control">
                                                <option {{ ($property->bathrooms == '1' ? 'selected' : '' )}} value="1">1</option>
                                                <option {{ ($property->bathrooms == '2' ? 'selected' : '' )}} value="2">2</option>
                                                <option {{ ($property->bathrooms == '3' ? 'selected' : '' )}} value="3">3</option>
                                                <option {{ ($property->bathrooms == '4' ? 'selected' : '' )}} value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="balconies">Balconies</label>
                                            <select name="balconies" id="balconies" class="form-control">
                                                <option {{ ($property->balconies == '1' ? 'selected' : '' )}} value="1">1</option>
                                                <option {{ ($property->balconies == '2' ? 'selected' : '' )}} value="2">2</option>
                                                <option {{ ($property->balconies == '3' ? 'selected' : '' )}} value="3">3</option>
                                                <option {{ ($property->balconies == '4' ? 'selected' : '' )}} value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="sell_rent">Sell/Rent</label>
                                            <select name="sell_rent" id="sell_rent" class="form-control">
                                                <option {{ ($property->sell_rent == 'Sell' ? 'selected' : '' )}} value="Sell">Sell</option>
                                                <option {{ ($property->sell_rent == 'Rent' ? 'selected' : '' )}} value="Rent">Rent</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="property_types">property_types</label>
                                            <select name="property_types" id="property_types" class="form-control">
                                                <option {{ ($property->property_types == 'Apartment' ? 'selected' : '' )}} value="Apartment">Apartment</option>
                                                <option {{ ($property->property_types == 'Independent House' ? 'selected' : '' )}} value="Independent House">Independent House</option>
                                                <option {{ ($property->property_types == 'Independent Floor' ? 'selected' : '' )}} value="Independent Floor">Independent Floor</option>
                                                <option {{ ($property->property_types == 'Plot' ? 'selected' : '' )}} value="Plot">Plot</option>
                                                <option {{ ($property->property_types == 'Studio' ? 'selected' : '' )}} value="Studio">Studio</option>
                                                <option {{ ($property->property_types == 'Duplex' ? 'selected' : '' )}} value="Duplex">Duplex</option>
                                                <option {{ ($property->property_types == 'Penthouse' ? 'selected' : '' )}} value="Penthouse">Penthouse</option>
                                                <option {{ ($property->property_types == 'Villa' ? 'selected' : '' )}} value="Villa">Villa</option>
                                                <option {{ ($property->property_types == 'Agricultural Land' ? 'selected' : '' )}} value="Agricultural Land">Agricultural Land</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="sale_type">Sale Type</label>
                                            <select name="sale_type" id="sale_type" class="form-control">
                                                <option {{ ($property->sale_type == 'New Project' ? 'selected' : '' )}} value="New Project">New Project</option>
                                                <option {{ ($property->sale_type == 'Resale Properties' ? 'selected' : '' )}} value="Resale Properties">Resale Properties</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-2">Property photos</h2>
                                <div id="image" class="dropzone dz-clickable mb-4">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>

                                <div id="product-gallery">
                                    @if ($propertyImages->isNotEmpty())
                                    <h6>Uploaded images</h6>
                                    <div class="row">
                                        @foreach ( $propertyImages as $image)
                                            <div class="col-md-2" id="image-row-{{ $image->id }}">
                                                <div class="card">
                                                    <input type="hidden" name="image_array[]" value="{{ $image->id }}" >
                                                    <img src="{{ asset('uploads/property/small/'.$image->image ) }}" />
                                                    <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="deleteCardImg">X</a>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-1">Related Properties</h2>
                                <select multiple class="related-product " name="related_products[]" id="related_products">
                                    @if (!empty($relatedProducts))
                                        @foreach ($relatedProducts as $relProduct)
                                            <option selected value="{{ $relProduct->id }}">{{ $relProduct->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option {{ ($property->status == 1 ? 'selected' : '' )}} value="1">Active</option>
                                        <option  {{ ($property->status == 0 ? 'selected' : '' )}} value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Developer's Details</h2>
                                <div class="mb-3">
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select a Developer</option>
                                        @if ($brands->isNotEmpty())
                                            @foreach ($brands as $brand)
                                                <option {{ ($property->brand_id == $brand->id) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="developer_address">Address</label>
                                    <input name="developer_address" id="developer_address" class="form-control"  type="text" placeholder="Address" value="{{ $property->developer_address }}">
                                </div>

                                <div class="mb-3">
                                    <label for="developer_phone">Phone</label>
                                    <input name="developer_phone" id="developer_phone" class="form-control"  type="text" placeholder="Phone" value="{{ $property->developer_phone }}">
                                </div>

                                <div class="mb-3">
                                    <label for="developer_website">Website</label>
                                    <input name="developer_website" id="developer_website" class="form-control"  type="text" placeholder="Website" value="{{ $property->developer_website }}">
                                </div>

                                <div class="mb-3">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select City</option>
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option {{ ($property->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p class="error"></p>
                                </div>
                                <div class="mb-3">
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Select Area</option>
                                        @if ($subCategories->isNotEmpty())
                                            @foreach ($subCategories as $subCategory)
                                                <option {{ ($property->sub_category_id == $subCategory->id) ? 'selected' : '' }} value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>


                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured" class="form-control">
                                        <option {{ ($property->is_featured == 'No' ? 'selected' : '')}} value="No" >No</option>
                                        <option  {{ ($property->is_featured == 'Yes' ? 'selected' : '')}} value="Yes" >Yes</option>
                                    </select>
                                    <p class="error"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('properties.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
@endsection

@section('customJs')
<script>
    $('.related-product').select2({
        ajax: {
            url: '{{ route('properties.getProperties') }}',
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
    $("#productForm").submit(function(event){
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



    $("#city").change(function(){
        var city_id = $(this).val();
        $.ajax({
            url: '{{ route("areas.index") }}',
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

    $("#category").change(function(){
        var category_id = $(this).val();
        $.ajax({
            url: '{{ route("product-subcategories.index") }}',
            type: 'get',
            data: {category_id:category_id},
            dataType: 'json',
            success: function(response) {
                $("#sub_category").find("option").not(":first").remove();
                $.each(response["subCategories"],function(key,item){
                    $("#sub_category").append(`<option value='${item.id}' >${item.name}</option>`)
                })
            },
            error: function(){
                console.log("Something went wrong")
            }
        });
    })

    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url:  "{{ route('product-images.update') }}",
            maxFiles: 10,
            paramName: 'image',
            params: {'product_id' : '{{ $property->id }}'},
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

            if (confirm("Are you sure you want to delete image?")) {
                $.ajax({
                    url: '{{ route("product-images.destroy") }}',
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
