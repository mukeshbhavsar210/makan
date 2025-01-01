@extends('admin.layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Add Property</h1>
            </div>  
            <div class="col-sm-6 text-right">
                <a href="{{ route('account.property' )}}" class="btn btn-primary">Back</a>
            </div>          
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        @include('admin.message')

        <form action="" method="post" id="createJobForm" name="createJobForm">
            <div class="card">
                <div class="card-body card-form p-4">                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="from-group">
                                <label for="title" class="mb-1">Property name<span class="req">*</span></label>
                                <input type="text" placeholder="Title" id="title" name="title" class="form-control">
                                <p></p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="from-group">
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
                            <div class="from-group">
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
                            <div class="from-group">
                                <label for="" class="mb-1">Keywords</label>
                                <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="from-group">
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
                            <div class="from-group">
                                <label for="" class="mb-1">Area<span class="req">*</span></label>
                                <select name="area" id="area" class="form-control">
                                    <option value="">Select a Area</option>
                                    @if ($areas->isNotEmpty())
                                        @foreach ($areas as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="from-group">
                                <label for="location" class="mb-1">Location<span class="req">*</span></label>
                                <input type="text" placeholder="Company Location" id="location" name="location" class="form-control">                            
                            </div>                        
                        </div>

                        <div class="col-md-2">
                            <div class="from-group">
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

                        <div class="col-md-2">
                            <div class="from-group">
                                <label for="" class="mb-1">BHK<span class="req">*</span></label>
                                <select name="room" id="room" class="form-control">  
                                    <option value="">Select a Room</option>                              
                                    @if ($bhk->isNotEmpty())
                                        @foreach ($bhk as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="from-group">
                                <label for="" class="mb-1">Bathroom<span class="req">*</span></label>
                                <select name="bathroom" id="bathroom" class="form-control">   
                                    <option value="">Select a Bath</option>                             
                                    @if ($bath->isNotEmpty())
                                        @foreach ($bath as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>                        
                            </div>
                        </div>                                        

                        {{-- <div class="col-md-4 mb-3">
                            <label for="amenities" class="mb-1">amenities<span class="req">*</span></label>
                            @if ($amenities->isNotEmpty())
                            @foreach ($amenities as $value)
                            <input {{ (in_array($value->id, $amenityTypeArray)) ? 'checked' : ''}} name="job_type" type="checkbox" value="{{ $value->id }}" id="amenities-{{ $value->id }}">
                            <label for="job-type-{{ $value->id }}">{{ $value->name }}</label>               
                            @endforeach
                        @endif   
                        </div> --}}

                        <div class="col-md-6">
                            <div class="from-group">
                                <label for="size" class="mb-1">Amenities<span class="req">*</span></label>
                                <select name="amenities"  id="amenities" class="form-control">
                                    @if ($amenities->isNotEmpty())
                                        @foreach ($amenities as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>                            
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="price" class="mb-1">Price<span class="req">*</span></label>
                                <input type="text" placeholder="Price" id="price" name="price" class="form-control">                            
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="compare_price" class="mb-1">Compare Price<span class="req">*</span></label>
                                <input type="text" placeholder="compare_price" id="compare_price" name="compare_price" class="form-control">                            
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="from-group">
                                <label for="developer" class="mb-1">Developer<span class="req">*</span></label>
                                <select name="developer" id="developer" class="form-control">
                                    @if ($developers->isNotEmpty())
                                        @foreach ($developers as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="size" class="mb-1">Size<span class="req">*</span></label>
                                <input type="text" placeholder="Size" id="size" name="size" class="form-control">                            
                            </div>
                        </div>

                        
                        <div class="col-md-3">
                            <div class="from-group">
                                <label for="" class="mb-1">Facing<span class="req">*</span></label>
                                <select name="view" id="view" class="form-control">
                                    <option value="">Select a Facing</option>
                                    @if ($facings->isNotEmpty())
                                        @foreach ($facings as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>                            
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="from-group">
                                <label for="" class="mb-1">Description<span class="req">*</span></label>
                                <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>                            
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="from-group">     
                                <label for="" class="mb-1">Media<span class="req">*</span></label>                           
                                <div id="image" class="dropzone dz-clickable">
                                    <div class="dz-message needsclick">
                                        <br>Drop files here or click to upload.<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save Property</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
@endsection


@section('customJs')
<script>
    // $("#city").change(function(){
    //     var city_id = $(this).val();
    //     $.ajax({
    //         url: '{{ route("area.index") }}',
    //         type: 'get',
    //         data: {city_id:city_id},
    //         dataType: 'json',
    //         success: function(response) {
    //             $("#area").find("option").not(":first").remove();
    //             $.each(response["area"],function(key,item){
    //                 $("#area").append(`<option value='${item.id}' >${item.name}</option>`)
    //             })
    //         },
    //         error: function(){
    //             console.log("Something went wrong")
    //         }
    //     });
    // })

    
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
                    window.location.href='{{ route("account.property") }}'
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
</script>
@endsection
