<div data-step="2">
    <h5>Update Price &amp; Property Details</h5>

    <div class="form-group form-section">
        <label for="title" class="light-label">Property details<span class="req">*</span></label>
        <input type="text" value="{{ $property->title}}" id="title" name="title" class="form-control required-field">
        <input type="text" value="{{ $property->slug}}" name="slug" id="slug" class="form-control d-none required-field" >
        <p></p>
    </div> 

    <div class="form-group form-section">
        <label for="location" class="light-label">Property Location<span class="req">*</span></label>
        <input type="text" value="{{ $property->location}}" id="location" name="location" class="form-control required-field">
    </div> 

    <div class="form-group form-section">
        <label for="" class="light-label">Search Keywords</label>
        <input type="text" value="{{ $property->keywords }}" id="keywords" name="keywords" class="form-control required-field">
    </div>

    <div class="form-group room-wrapper form-section">
        <label for="room" id="roomCounts" class="light-label">BHK, Price and Sq ft<span class="req">*</span></label>
            @php
                $selectedRooms = json_decode($property->rooms, true) ?? [];

                // Get only the titles from JSON (e.g. ["2_bhk", "3_bhks"])
                $selectedRoomTitles = array_column($selectedRooms, 'title');

                // Prices mapped by title
                $roomPrices = collect($selectedRooms)->mapWithKeys(fn($item) => [
                    $item['title'] => $item['price'] ?? ''
                ])->toArray();

                // Sizes mapped by title
                $roomSizes = collect($selectedRooms)->mapWithKeys(fn($item) => [
                    $item['title'] => $item['size'] ?? ''
                ])->toArray();
            @endphp

            <div class="title required-group">
                @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHKs','3_bhk'=>'3 BHKs','4_bhk'=>'4 BHK','5_bhk'=>'5 BHKs'] as $key => $label)
                    <div class="custom-checkbox-group" id="heading_{{ $key }}">
                        <label class="custom-checkbox ">
                            <input type="checkbox" 
                                class="form-check-input room-option" 
                                id="room_{{ $key }}" 
                                name="rooms[]" 
                                value="{{ $key }}"
                                {{ in_array($key, $selectedRoomTitles, true) ? 'checked' : '' }}
                                data-target="#collapse_{{ $key }}">
                            <span class="btn-checkbox">{{ $label }}</span>
                        </label>                        
                    </div>
                @endforeach
            </div>

            <div class="child-wrapper">
                @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHKs','3_bhk'=>'3 BHKs','4_bhk'=>'4 BHKs','5_bhk'=>'5 BHKs'] as $key => $label)
                    <div id="collapse_{{ $key }}" class="child-div {{ in_array($key, $selectedRoomTitles) ? 'active' : '' }} {{ $loop->iteration % 2 == 1 ? 'odd' : 'even' }}">
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
        <input type="hidden" name="rooms_json" id="rooms_json" value="{{ old('rooms_json') }}">                            
    </div>   

    <div class="form-group residenceProperty form-section">
        <label for="bathroom" id="bathroomCounts" class="light-label">Bathroom <span class="req">*</span></label>
        @php
            $bathrooms = json_decode($property->bathrooms, true) ?? [];           
            $selectedBathrooms = old('bathrooms_json') ? json_decode(old('bathrooms_json'), true) : [];                
        @endphp

        <div class="custom-checkbox-group required-group">
            @foreach (['1_bath' => '1 Bath', '2_baths' => '2 Baths', '3_baths' => '3 Baths', '4_baths' => '4 Baths', '5_baths' => '5 Baths'] as $value => $label)
                <label class="custom-checkbox">
                    <input type="checkbox" class="bathroom-option" value="{{ $value }}"
                        {{ in_array($value, $bathrooms) ? 'checked' : '' }}>
                    <span class="btn-checkbox">{{ $label }}</span>
                </label>
            @endforeach
        </div>           

        <input type="hidden" name="bathrooms_json" id="bathrooms_json" value="{{ old('bathrooms_json') }}">
    </div>
    
    <div class="form-group form-section">
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