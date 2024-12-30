@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Add Property</h1>
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
                                        <label for="title">Project's name</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="slug">Slug</label>
                                        <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                        <p class="error"></p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="listed_by">Posted By</label>
                                        <select name="listed_by" id="listed_by" class="form-control">
                                            <option value="Agent">Agent</option>
                                            <option value="Owner">Owner</option>
                                            <option value="Developer">Developer</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="category">Select City</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select City</option>
                                            @if ($categories->isNotEmpty())
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Select Area</label>
                                        <select name="sub_category" id="sub_category" class="form-control">
                                            <option value="">Select Area</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="property_location">Property Location</label>
                                            <input name="property_location" id="property_location" class="form-control"  type="text" placeholder="Property location">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="google_map">Google Map</label>
                                            <input name="google_map" id="google_map" class="form-control"  type="text" placeholder="Google map">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="rera">RERA</label>
                                            <input name="rera" id="rera" class="form-control"  type="text" placeholder="rera">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="buildup_areas">Buildup Areas</label>
                                            <input name="buildup_areas" id="buildup_areas" class="form-control"  type="text" placeholder="Buildup areas">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="property_types">Property Types</label>
                                            <select name="property_types" id="property_types" class="form-control">
                                                <option value="Apartment">Apartment</option>
                                                <option value="Independent House">Independent House</option>
                                                <option value="Independent Floor">Independent Floor</option>
                                                <option value="Plot">Plot</option>
                                                <option value="Studio">Studio</option>
                                                <option value="Duplex">Duplex</option>
                                                <option value="Penthouse">Penthouse</option>
                                                <option value="Villa">Villa</option>
                                                <option value="Agricultural Land">Agricultural Land</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sale_type">Sale Type</label>
                                            <select name="sale_type" id="sale_type" class="form-control">
                                                <option value="New Project">New Project</option>
                                                <option value="Resale Properties">Resale Properties</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="possession">Possession</label>
                                            <select name="possession" id="possession" class="form-control">
                                                <option value="Ready to move">Ready to move</option>
                                                <option value="In 1 year">In 1 year</option>
                                                <option value="In 3 years">In 3 years</option>
                                                <option value="Beyond 3 years">Beyond 3 years</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="bhk_types">BHK Types</label>
                                            <select name="bhk_types" id="bhk_types" class="form-control">
                                                <option value="1 RK">1 RK</option>
                                                <option value="1 BHK">1 BHK</option>
                                                <option value="2 BHK">2 BHK</option>
                                                <option value="3 BHK">3 BHK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="bathrooms">Bathrooms</label>
                                            <select name="bathrooms" id="bathrooms" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="balconies">Balconies</label>
                                            <select name="balconies" id="balconies" class="form-control">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-3">
                                            <label for="sell_rent">Sell Rent</label>
                                            <select name="sell_rent" id="sell_rent" class="form-control">
                                                <option value="Sell">Sell</option>
                                                <option value="Rent">Rent</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Property's Photos</h2>
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="product-gallery"></div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-1">Similar property</h2>
                                <select multiple class="relatedProperty" name="related_properties[]" id="related_properties">

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
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
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
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="developer_address">Address</label>
                                    <input name="developer_address" id="developer_address" class="form-control"  type="text" placeholder="Address">
                                </div>

                                <div class="mb-3">
                                    <label for="developer_phone">Phone</label>
                                    <input name="developer_phone" id="developer_phone" class="form-control"  type="text" placeholder="Phone">
                                </div>

                                <div class="mb-3">
                                    <label for="developer_website">Website</label>
                                    <input name="developer_website" id="developer_website" class="form-control"  type="text" placeholder="Website">
                                </div>

                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
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

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('properties.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
@endsection

@section('customJs')
<script>

    $('.relatedProperty').select2({
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
        //$("button[type='submit']").prop('disabled',true);

        $.ajax({
            url: '{{ route("properties.store") }}',
            type: 'post',
            data: formArray,
            dataType: 'json',
            success: function(response){

                //$("button[type='submit']").prop('disabled',false);

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
