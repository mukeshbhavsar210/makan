<div class="form-section" data-step="2">
<h5>Update Price &amp; Property Details</h5>
<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            <label for="title" class="light-label">Property details<span class="req">*</span></label>
            <input type="text" value="{{ $property->title}}" id="title" name="title" class="form-control">
            <input type="text" value="{{ $property->slug}}" name="slug" id="slug" class="form-control d-none" >
            <p></p>
        </div> 

        <div class="form-group">
            <label for="location" class="light-label">Property Location<span class="req">*</span></label>
            <input type="text" value="{{ $property->location}}" id="location" name="location" class="form-control">                            
        </div> 

        <div class="form-group room-wrapper ">
            <label for="room" id="roomCounts" class="light-label">BHK, Price and Sq ft<span class="req">*</span></label>
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
                
                <div class="title">
                    @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHK','3_bhk'=>'3 BHK','4_bhk'=>'4 BHK','5_bhk'=>'5 BHK'] as $key => $label)
                        <div class="custom-checkbox-group" id="heading_{{ $key }}">
                            <label class="custom-checkbox">
                                <input type="checkbox" class="form-check-input room-option" name="rooms[]" value="{{ $key }}"
                                    {{ in_array($key, $selectedRoomTitles) ? 'checked' : '' }}>
                                <span class="btn-checkbox">{{ $label }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="child-wrapper">
                    @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHK','3_bhk'=>'3 BHK','4_bhk'=>'4 BHK','5_bhk'=>'5 BHK'] as $key => $label)
                        <div id="collapse_{{ $key }}" class="child-div {{ in_array($key, $selectedRoomTitles) ? 'active' : '' }}">
                            <div class="flex-details">
                                <div class="room-title">{{ $label }}</div> 
                                <div class="input-group price-details">
                                    <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16">
                                        <path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4z"></path>
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control price showCheck" placeholder="Price" data-title="{{ $key }}" data-field="price" value="{{ $roomPrices[$key] ?? '' }}">
                                </div>
                                <div class="input-group price-details">
                                    <span class="input-group-text">Size</span>
                                    <input type="text" class="form-control size showCheck" placeholder="Sq Ft" data-title="{{ $key }}" data-field="size" value="{{ $roomSizes[$key] ?? '' }}">
                                </div>                                                                                     
                            </div>
                        </div>
                    @endforeach
                </div>                        
            <input type="hidden" name="rooms_json" id="rooms_json">                            
        </div>   

        <div class="form-group">
            <label for="bathroom" class="light-label">Bathroom <span id="bathroomCounts"></span><span class="req">*</span></label>            
            @php
                $selectedBathroom = json_decode($property->bathrooms, true) ?? [];
            @endphp

            <div class="custom-checkbox-group">
                <label class="custom-checkbox">
                    <input type="checkbox" class="bathroom-option" value="1_bath" {{ in_array('1_bath', $selectedBathroom) ? 'checked' : '' }}> 
                    <span class="btn-checkbox">1 Bath</span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" class="bathroom-option" value="2_baths" {{ in_array('2_baths', $selectedBathroom) ? 'checked' : '' }}>
                    <span class="btn-checkbox">2 Baths</span>                
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" class="bathroom-option" value="3_baths" {{ in_array('3_baths', $selectedBathroom) ? 'checked' : '' }}>
                    <span class="btn-checkbox">3 Baths</span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" class="bathroom-option" value="4_baths" {{ in_array('4_baths', $selectedBathroom) ? 'checked' : '' }}>
                    <span class="btn-checkbox">4 Baths</span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" class="bathroom-option" value="5_baths" {{ in_array('5_baths', $selectedBathroom) ? 'checked' : '' }}>
                    <span class="btn-checkbox">5 Baths</span>
                </label>
            </div>

            <input type="hidden" name="bathrooms_json" id="bathrooms_json">
        </div>
        
        <div class="form-group">
            <label class="light-label">Construction Type <span class="req">*</span></label> <br />                                  
            <div class="custom-radio">
                <input type="radio" class="btn-check" name="construction_types" id="construction_under" value="under" autocomplete="off"
                    {{ isset($property) && $property->construction_types == 'under' ? 'checked' : '' }}>
                <label class="btn-radio" for="construction_under">Under Construction</label>
                <input type="radio" class="btn-check" name="construction_types" id="construction_ready" value="ready" autocomplete="off"
                    {{ isset($property) && $property->construction_types == 'ready' ? 'checked' : '' }}>
                <label class="btn-radio" for="construction_ready">Ready to Move</label>
            </div>
            <p class="error"></p>
        </div>

        <div class="form-group">
            <label class="light-label">Furnish Type <span class="req">*</span></label> <br />                                  
            <div class="custom-radio">
                <input type="radio" class="btn-check" name="furnish_types" id="is_furnish_1" value="fully_furnished" autocomplete="off"
                    {{ isset($property) && $property->furnish_types == 'fully_furnished' ? 'checked' : '' }}>
                <label class="btn-radio" for="is_furnish_1">Fully Furnished</label>

                <input type="radio" class="btn-check" name="furnish_types" id="is_furnish_2" value="semi_furnished" autocomplete="off"
                    {{ isset($property) && $property->furnish_types == 'semi_furnished' ? 'checked' : '' }}>
                <label class="btn-radio" for="is_furnish_2">Semi Furnished</label>

                <input type="radio" class="btn-check" name="furnish_types" id="is_furnish_3" value="unfurnished" autocomplete="off"
                    {{ isset($property) && $property->furnish_types == 'unfurnished' ? 'checked' : '' }}>
                <label class="btn-radio" for="is_furnish_3">Unfurnished</label>
            </div>
            <p class="error"></p>
        </div>

        <div class="form-group">
            <label class="light-label">Facings <span id="facingsCounts"></span></label>            
            @php
                $selectedFacings = json_decode($property->facings, true) ?? [];
            @endphp

            <div class="custom-checkbox-group">
                <label class="custom-checkbox">
                    <input type="checkbox" class="facings" value="east" {{ in_array('east', $selectedFacings) ? 'checked' : '' }}>
                    <span class="btn-checkbox">East</span>                    
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" class="facings" value="west" {{ in_array('west', $selectedFacings) ? 'checked' : '' }}>
                    <span class="btn-checkbox">West</span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" class="facings" value="north" {{ in_array('north', $selectedFacings) ? 'checked' : '' }}>
                    <span class="btn-checkbox">North</span>
                </label>
                <label class="custom-checkbox">
                    <input type="checkbox" class="facings" value="south" {{ in_array('south', $selectedFacings) ? 'checked' : '' }}>
                    <span class="btn-checkbox">South</span>
                </label>
            </div>
                
            <input type="hidden" name="facings_json" id="facings_json">
        </div> 

        <a class="basic-link some-div" href="#" data-bs-toggle="modal" data-bs-target="#amenitiesModal">+ Add 
            Furnishing 
            @php
                $selectedFurnishing = json_decode($property->furnishing, true) ?? [];
                $furnishingCount = count($selectedFurnishing);
            @endphp

            @if($furnishingCount > 0)
                ({{ $furnishingCount }})
            @endif

            / Amenities
            @php
                $selectedAmenities = json_decode($property->amenities, true) ?? [];
                $amenitiesCount = count($selectedAmenities);
            @endphp

            @if($amenitiesCount > 0)
                ({{ $amenitiesCount }})
            @endif
        </a>

        <div class="modal fade bd-example-modal-lg" id="amenitiesModal" tabindex="-1" aria-labelledby="amenitiesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content login-modal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header">Add property furnishings and amenities</div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Furnishing <span class="req">*</span></label>
                            <p id="furnishingCounts"></p>
                            @php
                                $selectedFurnishing = json_decode($property->furnishing, true) ?? [];
                            @endphp

                            <div class="custom-checkbox-group">
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="furnishing" value="dining_table" {{ in_array("dining_table",$selectedFurnishing) ? 'checked' : '' }}> 
                                    <span class="btn-checkbox">Dining Table</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="furnishing" value="washing_machine" {{ in_array("washing_machine",$selectedFurnishing) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Washing Machine</span>
                                </label>                                
                            </div>
                            
                            <input type="hidden" name="furnishing_json" id="furnishing_json">
                        </div>

                        <div class="form-group">
                            <label>Amenities <span class="req">*</span></label>                            
                            <p id="amenitiesCounts"></p>

                            @php
                                $selectedAmenities = json_decode($property->amenities, true) ?? [];                                
                            @endphp

                            <div class="custom-checkbox-group">
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="gated_community" {{ in_array("gated_community",$selectedAmenities) ? 'checked' : '' }}> 
                                    <span class="btn-checkbox">Gated Community</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="lift" {{ in_array("lift",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Lift</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="swimming_pool" {{ in_array("swimming_pool",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Swimming Pool</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="gym" {{ in_array("gym",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Gym</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="security" {{ in_array("security",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Security</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="parking" {{ in_array("parking",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Parking</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="gas_pipeline" {{ in_array("gas_pipeline",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Gas Pipeline</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="play_area" {{ in_array("play_area",$selectedAmenities) ? 'checked' : '' }}> 
                                    <span class="btn-checkbox">Children's Play Area</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="waste_management" {{ in_array("waste_management",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Solid Waste Management</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="surveillance" {{ in_array("surveillance",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">24x7 CCTV Surveillance</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="fire" {{ in_array("fire",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Fire Fighting System</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="electrification" {{ in_array("electrification",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Electrification</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="water" {{ in_array("water",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">24X7 Water Supply</span>
                                </label>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="amenities" value="jogging" {{ in_array("jogging",$selectedAmenities) ? 'checked' : '' }}>
                                    <span class="btn-checkbox">Jogging Track</span>
                                </label>
                            </div>
                            
                            <input type="hidden" name="amenities_json" id="amenities_json">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="property_age" class="light-label">Property Age<span class="req">*</span></label>
            <select name="property_age" id="property_age" class="form-select">
                <option value="">Select Property Age</option>
                <option value="1_year" {{ (isset($property) && $property->property_age == '1_year') ? 'selected' : '' }}>Less than 1 year</option>
                <option value="3_years" {{ (isset($property) && $property->property_age == '3_years') ? 'selected' : '' }}>Less than 3 years</option>
                <option value="5_years" {{ (isset($property) && $property->property_age == '5_years') ? 'selected' : '' }}>Less than 5 years</option>
                <option value="6_years" {{ (isset($property) && $property->property_age == '6_years') ? 'selected' : '' }}>More than 5 years</option>
            </select>
        </div> 
        <div class="form-group">
            <label for="towers" class="light-label">Tower</label>
            <input type="text" value="{{ $property->towers}}" id="towers" name="towers" class="form-control">                                        
            <p></p>
        </div>
        <div class="form-group">
            <label for="units" class="light-label">Units</label>
            <input type="text" value="{{ $property->units}}" id="units" name="units" class="form-control">                                        
            <p></p>
        </div>
         <div class="form-group">
            <label for="total_area" class="light-label">Total Area (in Sq.ft.)<span class="req">*</span></label>
            <input type="text" value="{{ $property->total_area}}" id="total_area" name="total_area" class="form-control">                            
        </div>
    </div>
</div>
</div>