@extends('front.layouts.app')

@section('content')
    
    <section class="content-header">
        <div class="row">
            <div class="col-md-9 col-6">
                <h1>Edit Property</h1>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('properties.index') }}" class="btn btn-primary pull-right">Back</a>            
            </div>
        </div>
    </section>
    
    <section>
        <form action="" method="post" id="updateJobForm" name="updateJobForm">
            <div class="card">
                <div class="card-body">
                    <h4>Property Details</h4>
                    <div class="row">
                        <div class="col-md-9 col-12">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="title" class="mb-1">Property details<span class="req">*</span></label>
                                        <input type="text" value="{{ $property->title}}" id="title" name="title" class="form-control">
                                        <input type="text" value="{{ $property->slug}}" name="slug" id="slug" class="form-control d-none" >
                                        <p></p>
                                    </div>                                    
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="category" class="mb-1">Category<span class="req">*</span></label><br />
                                        <div class="btn-group" role="group" aria-label="Is Category Switch">
                                            <input type="radio" class="btn-check" name="category" id="is_category_buy" value="buy" autocomplete="off"
                                                {{ old('category', $property->category ?? 'buy') == 'buy' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_category_buy">Buy</label>

                                            <input type="radio" class="btn-check" name="category" id="is_category_rent" value="rent" autocomplete="off"
                                                {{ old('category', $property->category ?? '') == 'rent' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_category_rent">Rent</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="saletype" class="mb-1">Sale Type<span class="req">*</span></label><br />
                                        <div class="btn-group" role="group" aria-label="Is SaleType Switch">
                                            <input type="radio" class="btn-check" name="sale_types" id="is_sale_new" value="new" autocomplete="off"
                                                {{ (isset($property) && $property->sale_types == 'new') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="is_sale_new">New</label>

                                            <input type="radio" class="btn-check" name="sale_types" id="is_sale_resale" value="resale" autocomplete="off"
                                                {{ (isset($property) && $property->sale_types == 'resale') ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_sale_resale">Resale</label>
                                        </div>
                                    </div>
                                </div>                                                                                                           
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="location" class="mb-1">Property Location<span class="req">*</span></label>
                                        <input type="text" value="{{ $property->location}}" id="location" name="location" class="form-control">                            
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
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
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-1">Description<span class="req">*</span></label>
                                        <textarea class="form-control"  name="description" id="description" cols="5" rows="5" placeholder="Description">{{ $property->description}}</textarea>                            
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="property_age" class="mb-1">Property Age<span class="req">*</span></label>
                                        <select name="property_age" id="property_age" class="form-select">
                                            <option value="">Select Property Age</option>
                                            <option value="1_year" {{ (isset($property) && $property->property_age == '1_year') ? 'selected' : '' }}>Less than 1 year</option>
                                            <option value="3_years" {{ (isset($property) && $property->property_age == '3_years') ? 'selected' : '' }}>Less than 3 years</option>
                                            <option value="5_years" {{ (isset($property) && $property->property_age == '5_years') ? 'selected' : '' }}>Less than 5 years</option>
                                            <option value="6_years" {{ (isset($property) && $property->property_age == '6_years') ? 'selected' : '' }}>More than 5 years</option>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="size" class="mb-1">Size (in Sq.ft.)<span class="req">*</span></label>
                                        <input type="text" value="{{ $property->size}}" id="size" name="size" class="form-control">                            
                                    </div>
                                    <div class="form-group">
                                        <label for="total_area" class="mb-1">Total Area (in Sq.ft.)<span class="req">*</span></label>
                                        <input type="text" value="{{ $property->total_area}}" id="total_area" name="total_area" class="form-control">                            
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <label for="towers" class="mb-1">Tower</label>
                                                <input type="text" value="{{ $property->towers}}" id="towers" name="towers" class="form-control">                                        
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="form-group">
                                                <label for="units" class="mb-1">Units</label>
                                                <input type="text" value="{{ $property->units}}" id="units" name="units" class="form-control">                                        
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>                                                                        
                                </div>
                            </div>
                                
                            <h4 class="mt-3">Builder details</h4>
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group">   
                                        <label>Select Builder</label>   
                                        <select name="builder" id="builder" class="form-select">                                                                  
                                            <option value="">Select a Builder</option>
                                            @if ($builders->isNotEmpty())
                                                @foreach ($builders as $value)
                                                    <option {{ ($property->builder_id == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->developer_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>                            
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="year_build" class="mb-1">Year Build<span class="req">*</span></label>
                                        <div class="input-group date" id="year_build">
                                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build" value="{{ $property->year_build}}">
                                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label id="similarCounts">Similar Properties <span class="req">*</span></label>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="similar-label" data-bs-toggle="dropdown" aria-expanded="false">
                                                Similar Properties
                                            </button>

                                            @php
                                                $selectedRelated = json_decode($property->related_properties, true) ?? [];
                                            @endphp

                                            <ul class="dropdown-menu overflow-y w-100" aria-labelledby="similar-label">
                                                @if (!empty($relatedProperties))
                                                    @foreach ($relatedProperties as $value)
                                                        <li><label class="dropdown-item">
                                                                <input type="checkbox" class="related_properties" value="{{ $value->id }}"
                                                                    {{ in_array($value->id, $selectedRelated) ? 'checked' : '' }}>
                                                                {{ $value->title }}
                                                            </label></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                        <input type="hidden" name="related_properties_json" id="related_properties_json">
                                    </div> 
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="datepicker" class="mb-1">Handover Date<span class="req">*</span></label>
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build">
                                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="" class="mb-1">Search Keywords</label>
                                        <input type="text" value="{{ $property->keywords }}" id="keywords" name="keywords" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">                                    
                                    <div class="form-group">
                                        <label for="rera" class="mb-1">RERA<span class="req">*</span></label>
                                        <input type="text" value="{{ $property->rera}}" id="rera" name="rera" class="form-control">                            
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label>Construction Type <span class="req">*</span></label> <br />                                  
                                <div class="btn-group" role="group" aria-label="Construction Type Switch">
                                    <input type="radio" class="btn-check" name="construction_types" id="construction_under" value="under" autocomplete="off"
                                        {{ isset($property) && $property->construction_types == 'under' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="construction_under">Under Construction</label>
                                    <input type="radio" class="btn-check" name="construction_types" id="construction_ready" value="ready" autocomplete="off"
                                        {{ isset($property) && $property->construction_types == 'ready' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="construction_ready">Ready to Move</label>
                                </div>
                                <p class="error"></p>
                            </div>

                            <div class="form-group">
                                <label for="room" id="roomCounts" class="mb-1">BHK, Price and Sq ft<span class="req">*</span></label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="roomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select BHK
                                    </button>

                                    @php
                                        $selectedRooms = json_decode($property->rooms, true) ?? [];
                                        $selectedRoomTitles = array_column($selectedRooms, 'title');
                                        $roomPrices = collect($selectedRooms)->mapWithKeys(fn($item) => [
                                            $item['title'] => $item['price'] ?? ''
                                        ])->toArray();

                                        $roomSizes = collect($selectedRooms)->mapWithKeys(fn($item) => [
                                            $item['title'] => $item['size'] ?? ''
                                        ])->toArray();
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="roomDropdown">
                                        @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHK','3_bhk'=>'3 BHK','4_bhk'=>'4 BHK','5_bhk'=>'5 BHK'] as $key => $label)
                                            <li>
                                                <label class="dropdown-item addingCheckbox ">
                                                    <div>
                                                        <input type="checkbox" class="room-option" name="rooms[]" value="{{ $key }}"
                                                            {{ in_array($key, $selectedRoomTitles) ? 'checked' : '' }}>
                                                        {{ $label }}
                                                    </div>
                                                    <div><input type="text" class="form-control price showCheck" placeholder="Price" data-title="{{ $key }}" data-field="price" value="{{ $roomPrices[$key] ?? '' }}"></div>
                                                    <div><input type="text" class="form-control size showCheck" placeholder="Sq Ft" data-title="{{ $key }}" data-field="size" value="{{ $roomSizes[$key] ?? '' }}"></div>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <input type="hidden" name="rooms_json" id="rooms_json">                            
                            </div>                                                                
                            <div class="form-group">
                                <label for="bathroom" id="bathroomCounts" class="mb-1">Bathroom<span class="req">*</span></label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="bathroomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Bathroom
                                    </button>

                                    @php
                                        $selectedBathroom = json_decode($property->bathrooms, true) ?? [];
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="bathroomDropdown">
                                        <li><label class="dropdown-item"><input type="checkbox" class="bathroom-option" value="1_bath" {{ in_array('1_bath', $selectedBathroom) ? 'checked' : '' }}> 1 Bath </label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="bathroom-option" value="2_baths" {{ in_array('2_baths', $selectedBathroom) ? 'checked' : '' }}> 2 Baths</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="bathroom-option" value="3_baths" {{ in_array('3_baths', $selectedBathroom) ? 'checked' : '' }}> 3 Baths</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="bathroom-option" value="4_baths" {{ in_array('4_baths', $selectedBathroom) ? 'checked' : '' }}> 4 Baths</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="bathroom-option" value="5_baths" {{ in_array('5_baths', $selectedBathroom) ? 'checked' : '' }}> 5 Baths</label></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="bathrooms_json" id="bathrooms_json">
                            </div>    
                            <div class="form-group">
                                <label for="property_types" id="propertyTypesCounts" class="mb-1">Property Type<span class="req">*</span></label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="propertyTypes-label" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Property Type
                                    </button>

                                    @php
                                        $selectedTypes = json_decode($property->property_types, true) ?? [];
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="propertyTypes-label">
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="apartment" {{ in_array('apartment', $selectedTypes) ? 'checked' : '' }}> Apartment</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="independent_house" {{ in_array('independent_house', $selectedTypes) ? 'checked' : '' }}> Independent House</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="independent_floor" {{ in_array('independent_floor', $selectedTypes) ? 'checked' : '' }}> Independent Floor</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="plot" {{ in_array('plot', $selectedTypes) ? 'checked' : '' }}> Plot</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="studio" {{ in_array('studio', $selectedTypes) ? 'checked' : '' }}> Studio</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="duplex" {{ in_array('duplex', $selectedTypes) ? 'checked' : '' }}> Duplex</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="pent_house" {{ in_array('pent_house', $selectedTypes) ? 'checked' : '' }}> Pent House</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="villa" {{ in_array('villa', $selectedTypes) ? 'checked' : '' }}> Villa</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="property-types" value="agricultural_land" {{ in_array('agricultural_land', $selectedTypes) ? 'checked' : '' }}> Agricultural Land</label></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="property_types_json" id="property_types_json">                                                            
                            </div>                                
                           
                            <div class="form-group">
                                <label id="amenitiesCounts">Amenities <span class="req">*</span></label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="amenities-label" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Amenities
                                    </button>
                                    @php
                                        $selectedAmenities = json_decode($property->amenities, true) ?? [];
                                    @endphp
                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="amenities-label">
                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="1" {{ in_array("1",$selectedAmenities) ? 'checked' : '' }}> Gated Community</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="2" {{ in_array("2",$selectedAmenities) ? 'checked' : '' }}> Lift</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="3" {{ in_array("3",$selectedAmenities) ? 'checked' : '' }}> Swimming Pool</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="4" {{ in_array("4",$selectedAmenities) ? 'checked' : '' }}> Gym</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="5" {{ in_array("5",$selectedAmenities) ? 'checked' : '' }}> Security</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="6" {{ in_array("6",$selectedAmenities) ? 'checked' : '' }}> Parking</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="amenities" value="7" {{ in_array("7",$selectedAmenities) ? 'checked' : '' }}> Gas Pipeline</label></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="amenities_json" id="amenities_json">
                            </div>
                            <div class="form-group">
                                <label id="facingsCounts">Facings <span class="req">*</span></label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="facings-label" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Facings
                                    </button>

                                    @php
                                        $selectedFacings = json_decode($property->facings, true) ?? [];
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="facings-label">
                                        <li><label class="dropdown-item"><input type="checkbox" class="facings" value="east" {{ in_array('east', $selectedFacings) ? 'checked' : '' }}> East</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="facings" value="west" {{ in_array('west', $selectedFacings) ? 'checked' : '' }}> West</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="facings" value="north" {{ in_array('north', $selectedFacings) ? 'checked' : '' }}> North</label></li>
                                        <li><label class="dropdown-item"><input type="checkbox" class="facings" value="south" {{ in_array('south', $selectedFacings) ? 'checked' : '' }}> South</label></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="facings_json" id="facings_json">
                            </div>    
                                         
                            <div class="row">
                                <div class="col-md-6 col-12">
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
                                <div class="col-md-6 col-12">
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

                    <h4 class="mt-3">Media</h4>

                    <div id="image" class="dropzone dz-clickable mb-4">
                        <div class="dz-message needsclick">
                            <br>Drop files here or click to upload.<br><br>
                        </div>
                    </div>
                    <div id="product-gallery">
                        @php
                            $imageCount = $propertyImage->count();
                        @endphp

                        @if ($imageCount > 0)
                            <h4>Uploaded images <span class="badge rounded text-blue bg-blue-subtle">{{ $imageCount }}</span> </h4>
                        @endif

                        @if ($propertyImage->isNotEmpty())
                            @php
                                $usedLabels = $propertyImage->pluck('label')->filter()->toArray(); 
                                $labelOptions = [
                                    'Main'      => 1,
                                    'Video'     => 2,
                                    'Elevation' => 3,
                                    'Bedroom'   => 4,
                                    'Living'    => 5,
                                    'Balcony'   => 6,
                                    'Amenities' => 7,
                                    'Floor'     => 8,
                                    'Location'  => 9,
                                    'Cluster'   => 10,
                                ];

                                // Sort images by label mapping (default large number if no label)
                                $sortedImages = $propertyImage->sortBy(function ($img) use ($labelOptions) {
                                    return $labelOptions[$img->label] ?? 999; // unlabeled go to end
                                });
                            @endphp

                            @foreach ($sortedImages as $image)
                                <div class="media" id="image-row-{{ $image->id }}">
                                    <input type="hidden" name="image_array[]" value="{{ $image->id }}">

                                    <img src="{{ asset('uploads/property/thumb/'.$image->image) }}" class="thumb" />
                                    
                                    <div class="overlay">
                                        <div class="field">
                                            @if ($image->label && isset($labelOptions[$image->label]))
                                                <span class="order">{{ $labelOptions[$image->label] }}</span>
                                            @endif
                                            <select name="image_array[{{ $image->id }}][label]" class="form-select">
                                            <option value="">Select Label</option>
                                                @foreach ($labelOptions as $option => $order)
                                                    <option value="{{ $option }}"
                                                        {{ $image->label == $option ? 'selected' : '' }}
                                                        {{ in_array($option, $usedLabels) && $image->label !== $option ? 'disabled' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <a href="javascript:void(0)" onclick="deleteImage({{ $image->id }})" class="deleteCardImg">X</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="card-footer">
                    <div class="pull-right">
                        <a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark">Cancel</a>
                        <button type="submit" id="updateBtn" class="btn btn-primary m-1">Update</button>                         
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
            btn.prop("disabled", true); 
            btn.text("Updating Data..."); 
        });
    
        //Multiselect Checkbox
        function handleMultiSelect(optionsClass, dropdownId, labelId, hiddenInputId, defaultText) {
            $(optionsClass).on("change", function() {
                let selectedLabels = [];
                let selectedIds = [];

                $(optionsClass + ":checked").each(function() {
                    selectedLabels.push($(this).parent().text().trim());
                    selectedIds.push($(this).val());
                });

                // Update dropdown button text (first 2 labels + '...' if more)
                let displayText = "";
                if (selectedLabels.length > 2) {
                    displayText = selectedLabels.slice(0, 2).join(", ") + ", ...";
                } else if (selectedLabels.length > 0) {
                    displayText = selectedLabels.join(", ");
                } else {
                    displayText = defaultText;
                }
                $(dropdownId).text(displayText);

                // Update label with count
                $(labelId).text(selectedLabels.length ? defaultText.split(' ')[0] + " (" + selectedLabels.length + ")" : defaultText.split(' ')[0]);

                // Store selected IDs in hidden input
                $(hiddenInputId).val(selectedIds.join(","));
            });
        }

        // Apply to your selects
        handleMultiSelect(".room", "#room-label", "#roomCounts", "#room", "Select BHK");
        handleMultiSelect(".bathroom", "#bathroom-label", "#bathroomCounts", "#bathroom", "Select Bathroom");
        handleMultiSelect(".property-types", "#propertyTypes-label", "#propertyTypesCounts", "#property_types", "Select Property Types");
        handleMultiSelect(".amenities", "#amenities-label", "#amenitiesCounts", "#amenities", "Select Amenities");
        handleMultiSelect(".facings", "#facings-label", "#facingsCounts", "#facings", "Select Facings");
        handleMultiSelect(".similar", "#similar-label", "#similarCounts", "#similar", "Similar Properties");


        //Room json data
        function updateRoomsJson() {
            var data = [];
            var idCounter = 1;

            $('.room-option:checked').each(function() {
                var title = $(this).val();

                var price = $('.showCheck[data-title="' + title + '"][data-field="price"]').val() || '';
                var size  = $('.showCheck[data-title="' + title + '"][data-field="size"]').val() || '';

                data.push({
                    id: idCounter,
                    title: title,
                    price: price,
                    size: size
                });
                idCounter++;
            });

            $('#rooms_json').val(JSON.stringify(data));
        }


        $('.room-option').change(function() {
            var title = $(this).val();
            var input = $('.showCheck[data-title="' + title + '"]');
            if ($(this).is(':checked')) {
                input.show();
            } else {
                input.hide().val('');
            }
            updateRoomsJson();
        });
        $('.showCheck').on('input', updateRoomsJson);
        // Initialize
        $('.room-option').each(function() {
            var input = $('.showCheck[data-title="' + $(this).val() + '"]');
            $(this).is(':checked') ? input.show() : input.hide();
        });
        updateRoomsJson();


        function bindJsonUpdater(checkboxClass, hiddenInputId) {
            function updateJson() {
                const data = $(`.${checkboxClass}:checked`).map(function () {
                    return $(this).val();
                }).get();
                $(`#${hiddenInputId}`).val(JSON.stringify(data));
            }

            $(document).on("change", `.${checkboxClass}`, updateJson);
            updateJson(); // initialize on page load
        }

        // Bind all
        bindJsonUpdater("bathroom-option", "bathrooms_json");
        bindJsonUpdater("property-types", "property_types_json");
        bindJsonUpdater("amenities", "amenities_json");
        bindJsonUpdater("facings", "facings_json");
        bindJsonUpdater("related_properties", "related_properties_json");
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
            acceptedFiles: "image/jpeg,image/png,image/gif,image/avif",

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                $("#image_id").val(response.image_id);
                console.log(response)

               var html = `<div class="media" id="image-row-${response.image_id}">
                                <input type="hidden" name="image_array[]" value="${response.image_id}" >
                                <img src="${response.ImagePath}" class="thumb" />

                                <div class="overlay">
                                    <div class="field">
                                        <select name="image_array[${response.image_id}][label]" class="form-control mt-2 image-label">
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
                                        <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="deleteCardImg">X</a>
                                    </div>
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
                                //alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        }
                })
            }
        }
</script>
@endsection