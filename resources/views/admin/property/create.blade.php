@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="title-icon">
            <a href="{{ route('properties.index') }}" class="icon-arrow"><i class="las la-arrow-circle-left"></i></a>
            <h1>Create Property</h1>                
        </div>        
    </section>
    <!-- Main content -->

        <form action="" method="post" id="createPropertyForm" name="createPropertyForm">
            @csrf
            <div class="card">                
                <div class="card-body">
                    <h4>Property</h4>
                    <div class="row">
                        <div class="col-md-9 col-12">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="title" class="mb-1">Property name<span class="req">*</span></label>
                                        <input type="text" placeholder="Title" id="title" name="title" class="form-control">
                                        <input type="text" readonly name="slug" id="slug" class="form-control d-none" placeholder="Slug">
                                        <p></p>
                                    </div>                                    
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="category" class="mb-1">Category<span class="req">*</span></label>
                                        <div class="btn-group" role="group" aria-label="Is Category Switch">
                                            <input type="radio" class="btn-check" name="category" id="is_category_buy" value="buy" autocomplete="off"
                                                {{ (isset($property) && $property->category == 'buy') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="is_category_buy">Buy</label>

                                            <input type="radio" class="btn-check" name="category" id="is_category_rent" value="rent" autocomplete="off"
                                                {{ (isset($property) && $property->category == 'rent') ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_category_rent">Rent</label>
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="saletype" class="mb-1">Sale Type<span class="req">*</span></label>
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
                                        <input type="text" placeholder="Location" id="location" name="location" class="form-control">                            
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="" class="mb-1">City<span class="req">*</span></label>
                                                <select name="city" id="city" class="form-select">
                                                    <option value="">Select a City</option>
                                                    @if ($cities->isNotEmpty())
                                                        @foreach ($cities as $value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                                </select>                        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="mb-1">Description<span class="req">*</span></label>
                                        <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description"></textarea>                            
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Constructions Type?</label><br />
                                        <div class="btn-group" role="group" aria-label="Is Construction Switch">
                                            <input type="radio" class="btn-check" name="construction_types" id="is_construction_under" value="under" autocomplete="off"
                                                {{ (isset($property) && $property->construction_types == 'under') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="is_construction_under">Under Construction</label>

                                            <input type="radio" class="btn-check" name="construction_types" id="is_construction_ready" value="ready" autocomplete="off"
                                                {{ (isset($property) && $property->construction_types == 'ready') ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_construction_ready">Ready to Move</label>
                                        </div>
                                        <p class="error"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="size" class="mb-1">Size (in Sq.ft.)<span class="req">*</span></label>
                                        <input type="text" placeholder="Size" id="size" name="size" class="form-control">                            
                                    </div>
                                    <div class="form-group">
                                        <label for="total_area" class="mb-1">Total Area (in Sq.ft.)<span class="req">*</span></label>
                                        <input type="text" placeholder="Total area" id="total_area" name="total_area" class="form-control">                            
                                    </div>
                                    <div class="form-group">
                                        <label for="property_age" class="mb-1">Property Age<span class="req">*</span></label>
                                        <select name="property_age" id="property_age" class="form-select">
                                            <option value="">Select Property Age</option>
                                            <option value="1_year">Less than 1 year</option>
                                            <option value="3_years">Less than 3 years</option>
                                            <option value="5_years">Less than 5 years</option>
                                            <option value="6_years">More than 5 years</option>
                                        </select>
                                    </div> 
                                </div>

                                <h4 class="mt-3">Builder details</h4>
                                <div class="col-md-8">
                                    <div class="form-group">   
                                        <label>Select Builder</label>   
                                        <select name="builder" id="builder" class="form-select">                                                                  
                                            <option value="">Select a Builder</option>
                                            @if ($builders->isNotEmpty())
                                                @foreach ($builders as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>                            
                                    </div>   
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="year_build" class="mb-1">Year Build<span class="req">*</span></label>
                                        <div class="input-group date" id="year_build">
                                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="year_build" value="">
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
                                                $selectedRelated = [];
                                            @endphp

                                            <ul class="dropdown-menu overflow-y w-100" aria-labelledby="similar-label">
                                                @if (!empty($relatedProperties))
                                                    @foreach ($relatedProperties as $value)
                                                        <li>
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" class="related_properties" value="{{ $value->id }}">
                                                                {{ $value->title }}
                                                            </label>
                                                        </li>
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
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="" class="mb-1">Search Keywords</label>
                                        <input type="text" placeholder="Search keywords" id="keywords" name="keywords" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rera" class="mb-1">RERA<span class="req">*</span></label>
                                        <input type="text" placeholder="RERA" id="rera" name="rera" class="form-control">                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label for="room" id="roomCounts" class="mb-1">BHK <span class="req">*</span></label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="roomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select BHK
                                    </button>

                                    @php
                                        $selectedRooms = isset($property) ? json_decode($property->rooms, true) ?? [] : [];
                                        $selectedRoomTitles = array_column($selectedRooms, 'title');
                                        $roomPrices = collect($selectedRooms)->mapWithKeys(fn($item) => [$item['title'] => $item['price']])->toArray();
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="roomDropdown">
                                        @foreach (['1_rk'=>'1 RK','1_bhk'=>'1 BHK','2_bhk'=>'2 BHK','3_bhk'=>'3 BHK','4_bhk'=>'4 BHK','5_bhk'=>'5 BHK'] as $key => $label)
                                            <li>
                                                <label class="dropdown-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <input type="checkbox" class="room-option" name="rooms[]" value="{{ $key }}"
                                                            {{ in_array($key, $selectedRoomTitles) ? 'checked' : '' }}> 
                                                        {{ $label }}
                                                    </div>
                                                    <input type="text" class="form-control showCheck" placeholder="Price" data-title="{{ $key }}" value="{{ $roomPrices[$key] ?? '' }}">
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <input type="hidden" name="rooms_json" id="rooms_json">                            
                            </div>
                                                               
                            <div class="form-group">
                                <label for="bathroom" id="bathroomCounts" class="mb-1">
                                    Bathroom <span class="req">*</span>
                                </label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="bathroomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Bathroom
                                    </button>

                                    @php
                                        // Handle old form values or default empty
                                        $selectedBathrooms = old('bathrooms_json') ? json_decode(old('bathrooms_json'), true) : [];
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="bathroomDropdown">
                                        @foreach (['1_bath' => '1 Bath', '2_baths' => '2 Baths', '3_baths' => '3 Baths', '4_baths' => '4 Baths', '5_baths' => '5 Baths'] as $value => $label)
                                            <li>
                                                <label class="dropdown-item">
                                                    <input type="checkbox" class="bathroom-option" value="{{ $value }}"
                                                        {{ in_array($value, $selectedBathrooms) ? 'checked' : '' }}>
                                                    {{ $label }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                {{-- Hidden field to hold JSON values --}}
                                <input type="hidden" name="bathrooms_json" id="bathrooms_json" value="{{ old('bathrooms_json') }}">
                            </div>
  
                            <div class="form-group">
                                <label for="property_types" id="propertyTypesCounts" class="mb-1">
                                    Property Type<span class="req">*</span>
                                </label>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="propertyTypes-label" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Property Type
                                    </button>

                                    @php
                                        $selectedTypes = isset($property) 
                                            ? json_decode($property->property_types, true) ?? [] 
                                            : [];
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
                                        // For create page, no amenities selected
                                        $selectedAmenities = old('amenities_json') ? json_decode(old('amenities_json'), true) : [];
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
                                        $selectedFacings = old('facings_json') ? json_decode(old('facings_json'), true) : [];
                                    @endphp

                                    <ul class="dropdown-menu overflow-y w-100" aria-labelledby="facings-label">
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="east" {{ in_array('east', $selectedFacings) ? 'checked' : '' }}> East
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="west" {{ in_array('west', $selectedFacings) ? 'checked' : '' }}> West
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="north" {{ in_array('north', $selectedFacings) ? 'checked' : '' }}> North
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item">
                                                <input type="checkbox" class="facings" value="south" {{ in_array('south', $selectedFacings) ? 'checked' : '' }}> South
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <input type="hidden" name="facings_json" id="facings_json">
                            </div>

                            

                            <div class="row">                                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Show on page?</label><br />
                                        <div class="btn-group" role="group" aria-label="Is Featured Switch">
                                            <input type="radio" class="btn-check" name="is_featured" id="is_featured_yes" value="Yes" autocomplete="off"
                                                {{ (isset($property) && $property->is_featured == 'Yes') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="is_featured_yes">Yes</label>

                                            <input type="radio" class="btn-check" name="is_featured" id="is_featured_no" value="No" autocomplete="off"
                                                {{ (isset($property) && $property->is_featured == 'No') ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="is_featured_no">No</label>
                                        </div>
                                        <p class="error"></p>
                                    </div>
                                </div>   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label><br />
                                        <div class="btn-group" role="group" aria-label="Status Switch">
                                            <input type="radio" class="btn-check" name="status" id="status_active" value="1" autocomplete="off"
                                                {{ (isset($property) && $property->status == 1) ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                                            <label class="btn btn-outline-primary" for="status_active">Active</label>

                                            <input type="radio" class="btn-check" name="status" id="status_block" value="0" autocomplete="off"
                                                {{ (isset($property) && $property->status == 0) ? 'checked' : '' }}>
                                            <label class="btn btn-outline-primary" for="status_block">Block</label>
                                        </div>
                                        <p class="error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <h5>Photos</h5>
                            <div id="image" class="dropzone dz-clickable">
                                <div class="dz-message needsclick">
                                    <br>Drop files here or click to upload.<br><br>
                                </div>
                            </div>
                            <div class="row" id="product-gallery"></div>
                        </div>
                        <div class="col-md-3">
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
        </div>
                        
            <div class="card-footer">
                <div class="pull-right mb-3">
                    <a href="{{ route('properties.index') }}" class="btn m-1 btn-outline-dark">Cancel</a>
                    <button type="submit" id="createBtn" class="btn btn-primary m-1">Create</button>                         
                </div>
            </div>
        </div>
    </div>
</form>    
@endsection

@section('customJs')
<script>
    $(document).ready(function(){
        $("form").on("submit", function(){
            let btn = $("#createBtn");
            btn.prop("disabled", true);              // disable button
            btn.text("Updating Data...");            // change label
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
                var price = $('.showCheck[data-title="' + title + '"]').val() || '';

                data.push({
                    id: idCounter,
                    title: title,
                    price: price
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
            // error: function(){
            //     console.log("Something went wrong")
            // }
            error: function(xhr, status, error){
                console.log("AJAX Error:", status, error);
                console.log("Response:", xhr.responseText);
            }
        });
    });

    //File image uplaod
    Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url: "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                console.log(response);

                // Build HTML with label dropdown
                var html = `
                    <div class="col-md-3 mt-3" id="image-row-${response.image_id}">
                        <div class="card p-2">
                            <input type="hidden" name="image_array[${response.image_id}][id]" value="${response.image_id}">
                            
                            <img src="${response.ImagePath}" class="img-fluid" />

                            <!-- Label selection -->
                            <select name="image_array[${response.image_id}][label]" 
                                    class="form-control mt-2 image-label">
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

                            <!-- Delete button -->
                            <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" 
                            class="deleteCardImg btn btn-sm btn-danger mt-2">Remove</a>
                        </div>
                    </div>`;

                $("#product-gallery").append(html);

                // Attach event after adding select
                $(".image-label").off("change").on("change", function() {
                    enforceUniqueLabels();
                });
            },
            complete: function(file) {
                this.removeFile(file);
            }
        });

        // Function to enforce unique labels
        function enforceUniqueLabels() {
            let selectedLabels = [];

            // Collect all selected labels
            $(".image-label").each(function() {
                let val = $(this).val();
                if (val) {
                    selectedLabels.push(val);
                }
            });

            // Reset all options first
            $(".image-label option").prop("disabled", false);

            // Disable already selected labels in other dropdowns
            $(".image-label").each(function() {
                let currentVal = $(this).val();
                selectedLabels.forEach(label => {
                    if (label !== currentVal) {
                        $(this).find("option[value='" + label + "']").prop("disabled", true);
                    }
                });
            });
        }



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