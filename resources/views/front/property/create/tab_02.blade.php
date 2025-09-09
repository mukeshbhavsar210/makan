<div class="form-section" data-step="2">
<h5>Add Price & Property Details</h5>
<div class="row">
    <div class="col-md-9">
        <div class="form-group form-section">
            <label for="title" class="light-label">Property Name<span class="req">*</span></label>
            <input type="text" placeholder="Building/Project/Society" id="title" name="title" class="form-control required-field">
            <input type="text" readonly name="slug" id="slug" class="form-control d-none required-field" placeholder="Slug">
            <p></p>
        </div> 

        <div class="form-group form-section">
            <label for="location" class="light-label">Property Location<span class="req">*</span></label>
            <input type="text" placeholder="Location" id="location" name="location" class="form-control required-field">                            
        </div>

        <div class="form-group room-wrapper form-section">
            @php
                $selectedRooms = isset($property) ? json_decode($property->rooms, true) ?? [] : [];
                if (empty($selectedRooms)) {
                    $selectedRooms = [
                        ['title' => '3_bhk', 'price' => '5000000', 'size' => '1500']
                    ];
                }

                $selectedRoomTitles = array_column($selectedRooms, 'title');
                $roomPrices = collect($selectedRooms)->mapWithKeys(fn($item) => [
                    $item['title'] => $item['price'] ?? ''
                ])->toArray();
                $roomSizes = collect($selectedRooms)->mapWithKeys(fn($item) => [
                    $item['title'] => $item['size'] ?? ''
                ])->toArray();
            @endphp

            <label for="room" id="roomCounts" class="light-label">BHK, Price and Sq ft <span class="req">*</span></label><br />
            <div class="title required-group">
                @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHK','3_bhk'=>'3 BHK','4_bhk'=>'4 BHK','5_bhk'=>'5 BHK'] as $key => $label)                    
                    <div class="custom-checkbox-group" id="heading_{{ $key }}">
                        <label class="custom-checkbox">
                            <input type="checkbox" 
                                class="form-check-input room-option" 
                                id="room_{{ $key }}" 
                                name="rooms[]" 
                                value="{{ $key }}"
                                {{ in_array($key, $selectedRoomTitles) ? 'checked' : '' }}
                                data-target="#collapse_{{ $key }}">
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
                                <span class="input-group-text">₹</span>
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

        <div class="form-group residenceProperty form-section">
            <label for="bathroom" id="bathroomCounts" class="light-label">Bathroom <span class="req">*</span></label>
            @php
                $selectedBathrooms = old('bathrooms_json') ? json_decode(old('bathrooms_json'), true) : [];
                 if (empty($selectedBathrooms)) {
                    $selectedBathrooms = ['2_baths'];
                }
            @endphp

            <div class="custom-checkbox-group required-group">
                @foreach (['1_bath' => '1 Bath', '2_baths' => '2 Baths', '3_baths' => '3 Baths', '4_baths' => '4 Baths', '5_baths' => '5 Baths'] as $value => $label)
                    <label class="custom-checkbox">
                        <input type="checkbox" class="bathroom-option" value="{{ $value }}"
                            {{ in_array($value, $selectedBathrooms) ? 'checked' : '' }}>
                        <span class="btn-checkbox">{{ $label }}</span>
                    </label>
                @endforeach
            </div>           

            <input type="hidden" name="bathrooms_json" id="bathrooms_json" value="{{ old('bathrooms_json') }}">
        </div>

        <div class="form-group form-section">
             @php
                $constructionOptions = [
                    'under' => 'Under Construction',
                    'ready' => 'Ready to Move',
                ];
            @endphp

            <label class="light-label">Construction Type?</label><br />
            <div class="custom-radio required-group">
                @foreach ($constructionOptions as $value => $label)
                    @php
                        $id = 'construction_' . $loop->index;
                        $isChecked = isset($property) && $property->construction_types == $value;
                        // If no property set, make "under" the default
                        if (!isset($property) && $value === 'under') {
                            $isChecked = true;
                        }
                    @endphp

                    <input type="radio"
                        class="btn-check required-field"
                        name="construction_types"
                        id="{{ $id }}"
                        value="{{ $value }}"
                        autocomplete="off"
                        {{ $isChecked ? 'checked' : '' }}>

                    <label class="btn-radio" for="{{ $id }}">{{ $label }}</label>
                @endforeach
            </div>
            <p class="error"></p>
        </div>

        <div class="form-group form-section some-div">
            @php
                $furnishOptions = [
                    'fully_furnished' => 'Fully Furnished',
                    'semi_furnished'  => 'Semi Furnished',
                    'unfurnished'     => 'Unfurnished',
                ];
            @endphp

            <label for="category" class="light-label">Furnish Type<span class="req">*</span></label><br />
            <div class="custom-radio required-group">
                @foreach ($furnishOptions as $value => $label)
                    @php
                        $id = 'is_furnish_' . $loop->index;
                    @endphp
                    <input type="radio" 
                        class="btn-check required-field"
                        name="furnish_types" 
                        id="{{ $id }}" 
                        value="{{ $value }}"
                        autocomplete="off"
                        {{ (isset($property) && $property->furnish_types == $value) || (!isset($property) && $value == 'unfurnished') ? 'checked' : '' }}>
                    <label class="btn-radio" for="{{ $id }}">{{ $label }}</label>                        
                @endforeach
            </div>
        </div>        

        <div class="form-group some-div form-section">
            <label class="light-label">Facings <span class="req">*</span> - <span id="facingsCounts"></span></label>
            <div class="custom-checkbox-group">
                @php
                    $facings = ['east' => 'East', 'west' => 'West', 'north' => 'North', 'south' => 'South'];
                    $selectedFacings = old('facings_json') ? json_decode(old('facings_json'), true) : [];
                    
                    // Default first checkbox if nothing selected
                    if (empty($selectedFacings)) {
                        $selectedFacings[] = array_key_first($facings);
                    }
                @endphp

                <div class="custom-checkbox-group required-group">
                    @foreach ($facings as $value => $label)
                        <label class="custom-checkbox">
                            <input type="checkbox" class="facings" value="{{ $value }}" {{ in_array($value, $selectedFacings) ? 'checked' : '' }}>
                            <span class="btn-checkbox">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <input type="hidden" name="facings_json" id="facings_json">
        </div>


        <a class="basic-link some-div" href="#" data-bs-toggle="modal" data-bs-target="#amenitiesModal">+ Add Furnishing / Amenities</a>

        <div class="modal fade bd-example-modal-lg" id="amenitiesModal" tabindex="-1" aria-labelledby="amenitiesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content login-modal">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header">Add property furnishings and amenities</div>
                    <div class="modal-body">
                        <div class="form-group">
                            <h6>Furnishing <span id="furnishingCounts"></span></h6>                            

                            @php
                                $furnishing = [
                                    'dining_table' => 'Dining Table',
                                    'washing_machine' => 'Washing Machine',                                    
                                ];
                                $selectedFurnishing = old('furnishing_json') ? json_decode(old('furnishing_json'), true) : [];
                            @endphp

                            <div class="custom-checkbox-group">
                                @foreach($furnishing as $value => $label)
                                    <label class="custom-checkbox">
                                        <input type="checkbox" 
                                            class="form-check-input furnishing" 
                                            value="{{ $value }}" 
                                            {{ in_array($value, $selectedFurnishing) || (empty($selectedFurnishing) && $loop->first) ? 'checked' : '' }}>
                                        <span class="btn-checkbox">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <input type="hidden" name="furnishing_json" id="furnishing_json">
                        </div>

                        <div class="form-group">
                            <h6>Amenities - <span id="amenitiesCounts"></span></h6>
                            @php
                                $amenities = [
                                    'gated_community' => 'Gated Community',
                                    'lift' => 'Lift',
                                    'swimming_pool' => 'Swimming Pool',
                                    'gym' => 'Gym',
                                    'security' => 'Security',
                                    'parking' => 'Parking',
                                    'gas_pipeline' => 'Gas Pipeline',
                                    'play_area' => "Children's Play Area",
                                    'waste_management' => 'Solid Waste Management',
                                    'surveillance' => '24x7 CCTV Surveillance',
                                    'fire' => 'Fire Fighting System',
                                    'electrification' => 'Electrification',
                                    'water' => '24X7 Water Supply',
                                    'jogging' => 'Jogging Track',
                                ];

                                $selectedAmenities = old('amenities_json') ? json_decode(old('amenities_json'), true) : [];
                            @endphp

                            <div class="custom-checkbox-group">
                                @foreach($amenities as $value => $label)
                                    <label class="custom-checkbox">
                                        <input type="checkbox" 
                                            class="form-check-input amenities" 
                                            value="{{ $value }}" 
                                            {{ in_array($value, $selectedAmenities) || (empty($selectedAmenities) && $loop->first) ? 'checked' : '' }}>
                                        <span class="btn-checkbox">{{ $label }}</span>
                                    </label>
                                @endforeach
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
        <div class="form-group form-section">
            <label for="property_age" class="light-label">Property Age<span class="req">*</span></label>
            <select name="property_age" id="property_age" class="form-select required-field">
                <option value="">Property Age</option>
                <option value="1_year">Less than 1 year</option>
                <option value="3_years">Less than 3 years</option>
                <option value="5_years">Less than 5 years</option>
                <option value="6_years">More than 5 years</option>
            </select>
        </div> 
         <div class="form-group form-section">
            <label for="property_age" class="light-label">Tower</label>
            <input type="property_age" placeholder="Tower" id="towers" name="towers" class="form-control required-field">
        </div>
        <div class="form-group form-section">
            <label for="property_age" class="light-label">Units</label>
            <input type="property_age" placeholder="Units" id="units" name="units" class="form-control required-field">
        </div>
        <div class="form-group form-section">
            <label for="total_area" class="light-label">Total Area (in Sq.ft.)</label>
            <input type="text" placeholder="Total area" id="total_area" name="total_area" class="form-control required-field">                            
        </div>         
    </div>
</div>
</div>

<p><a href="#" class="btn btn-primary">Next, add price details</a></p>