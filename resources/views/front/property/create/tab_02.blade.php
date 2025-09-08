<h5>Add Property Details</h5>

    <div class="form-group some-div">
        <label for="property_types" id="propertyTypesCounts" class="light-label">Property Type<span class="req">*</span></label>
        @php
            $selectedType = isset($property) ? $property->property_types : '';
        @endphp

        <div class="custom-radio-square">
            <input type="radio" class="btn-check" name="property_types" id="type_apartment" value="apartment" {{ $selectedType == 'apartment' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_apartment">Apartment</label>

            <input type="radio" class="btn-check" name="property_types" id="type_independent_house" value="independent_house" {{ $selectedType == 'independent_house' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_independent_house">Independent<br /> House</label>

            <input type="radio" class="btn-check" name="property_types" id="type_independent_floor" value="independent_floor" {{ $selectedType == 'independent_floor' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_independent_floor">Independent<br /> Floor</label>

            <input type="radio" class="btn-check" name="property_types" id="type_plot" value="plot" {{ $selectedType == 'plot' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_plot">Plot</label>

            <input type="radio" class="btn-check" name="property_types" id="type_studio" value="studio" {{ $selectedType == 'studio' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_studio">Studio</label>

            <input type="radio" class="btn-check" name="property_types" id="type_duplex" value="duplex" {{ $selectedType == 'duplex' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_duplex">Duplex</label>

            <input type="radio" class="btn-check" name="property_types" id="type_pent_house" value="pent_house" {{ $selectedType == 'pent_house' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_pent_house">Pent<br /> House</label>

            <input type="radio" class="btn-check" name="property_types" id="type_villa" value="villa" {{ $selectedType == 'villa' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_villa">Villa</label>

            <input type="radio" class="btn-check" name="property_types" id="type_agricultural_land" value="agricultural_land" {{ $selectedType == 'agricultural_land' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_agricultural_land">Agricultural<br /> Land</label>
        </div>
    </div>

    <div class="form-group">
        <label for="title" class="light-label">Property name<span class="req">*</span></label>
        <input type="text" placeholder="Building/Project/Society" id="title" name="title" class="form-control">
        <input type="text" readonly name="slug" id="slug" class="form-control d-none" placeholder="Slug">
        <p></p>
    </div> 

    <div class="form-group">
        <label for="location" class="light-label">Property Location<span class="req">*</span></label>
        <input type="text" placeholder="Location" id="location" name="location" class="form-control">                            
    </div>

    <div class="form-group">
        <label for="room" id="roomCounts" class="light-label">BHK, Price and Sq ft <span class="req">*</span></label>

        @php
            $selectedRooms = isset($property) ? json_decode($property->rooms, true) ?? [] : [];
            $selectedRoomTitles = array_column($selectedRooms, 'title');
            $roomPrices = collect($selectedRooms)->mapWithKeys(fn($item) => [
                $item['title'] => $item['price'] ?? ''
            ])->toArray();
            $roomSizes = collect($selectedRooms)->mapWithKeys(fn($item) => [
                $item['title'] => $item['size'] ?? ''
            ])->toArray();
        @endphp

        <div class="row">
            @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHK','3_bhk'=>'3 BHK','4_bhk'=>'4 BHK','5_bhk'=>'5 BHK'] as $key => $label)
                <div class="col-md-3">
                    <div class="card-bhk">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input room-option" id="room_{{ $key }}" name="rooms[]" value="{{ $key }}"
                                {{ in_array($key, $selectedRoomTitles) ? 'checked' : '' }}>
                            <label class="form-check-label" for="room_{{ $key }}">{{ $label }}</label>
                        </div>

                        <!-- Price input -->
                        <div class="flex-grow-1">
                            <input type="text" class="form-control price showCheck"
                                placeholder="Price"
                                data-title="{{ $key }}"
                                data-field="price"
                                value="{{ $roomPrices[$key] ?? '' }}"
                                {{ in_array($key, $selectedRoomTitles) ? '' : 'disabled' }}>
                        </div>

                        <!-- Size input -->
                        <div class="flex-grow-1">
                            <input type="text" class="form-control size showCheck"
                                placeholder="Sq Ft"
                                data-title="{{ $key }}"
                                data-field="size"
                                value="{{ $roomSizes[$key] ?? '' }}"
                                {{ in_array($key, $selectedRoomTitles) ? '' : 'disabled' }}>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <input type="hidden" name="rooms_json" id="rooms_json">
    </div>

    <div class="form-group">
        <label for="category" class="light-label">Furnish Type<span class="req">*</span></label><br />
        <div class="custom-radio">
            <input type="radio" class="btn-check" name="furnish_types" id="is_furnish_1" value="fully" autocomplete="off"
                {{ (isset($property) && $property->furnish == 'fully_furnished') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
            <label class="btn-radio" for="is_furnish_1">Fully Furnished</label>

            <input type="radio" class="btn-check" name="furnish_types" id="is_furnish_2" value="rent" autocomplete="off"
                {{ (isset($property) && $property->furnish == 'semi_furnished') ? 'checked' : '' }}>
            <label class="btn-radio" for="is_furnish_2">Semi Furnished</label>

            <input type="radio" class="btn-check" name="furnish_types" id="is_furnish_3" value="unfurnished" autocomplete="off"
                {{ (isset($property) && $property->furnish == 'unfurnished') ? 'checked' : '' }}>
            <label class="btn-radio" for="is_furnish_3">Unfurnished</label>
        </div> 
    </div>

                                    
    <div class="form-group">
        <label for="bathroom" id="bathroomCounts" class="light-label">Bathroom <span class="req">*</span></label>
        @php
            $selectedBathrooms = old('bathrooms_json') ? json_decode(old('bathrooms_json'), true) : [];
        @endphp

        <div class="custom-checkbox-group">
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

    <div class="form-group">
        <label id="amenitiesCounts" class="light-label">Society Amenities <span class="req">*</span></label>
        @php
            $selectedAmenities = old('amenities_json') ? json_decode(old('amenities_json'), true) : [];
        @endphp

        <div class="custom-checkbox-group">
            <label class="custom-checkbox">
                <input type="checkbox" class="form-check-input amenities" value="1" {{ in_array("1",$selectedAmenities) ? 'checked' : '' }}>
                <span class="btn-checkbox">Gated Community</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" class="form-check-input amenities" value="2" {{ in_array("2",$selectedAmenities) ? 'checked' : '' }}>
                <span class="btn-checkbox">Lift</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" class="form-check-input amenities" value="3" {{ in_array("3",$selectedAmenities) ? 'checked' : '' }}>
                <span class="btn-checkbox">Swimming Pool</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" class="form-check-input amenities" value="4" {{ in_array("4",$selectedAmenities) ? 'checked' : '' }}>
                <span class="btn-checkbox">Gym</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" class="form-check-input amenities" value="5" {{ in_array("5",$selectedAmenities) ? 'checked' : '' }}>
                <span class="btn-checkbox">Security</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" class="form-check-input amenities" value="6" {{ in_array("6",$selectedAmenities) ? 'checked' : '' }}>
                <span class="btn-checkbox">Parking</span>
            </label>

            <label class="custom-checkbox">
                <input type="checkbox" class="form-check-input amenities" value="7" {{ in_array("7",$selectedAmenities) ? 'checked' : '' }}>
                <span class="btn-checkbox">Gas Pipeline</span>
            </label>
        </div>

        <input type="hidden" name="amenities_json" id="amenities_json">
    </div>

    <a href="#" class="btn btn-primary">Next, add price details</a>   