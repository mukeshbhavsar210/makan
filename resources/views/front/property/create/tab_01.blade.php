<div data-step="1">
    <h5>Add Basic Details</h5>

    <div class="form-group form-section">    
        <div class="custom-radio required-group">
            <input type="radio" class="btn-check" name="residence_types" id="is_residential" value="residential" autocomplete="off"
                {{ (isset($property) && $property->residence_types == 'residential') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
            <label class="btn-radio" for="is_residential">Residential</label>

            <input type="radio" class="btn-check" name="residence_types" id="is_commercial" value="commercial" autocomplete="off"
                {{ (isset($property) && $property->residence_types == 'commercial') ? 'checked' : '' }}>
            <label class="btn-radio" for="is_commercial">Commercial</label>
        </div> 
    </div>

    <div class="form-group">
        @php
            $residenceTypes = [
                'apartment' => 'Apartment',
                'independent_house' => 'Independent House',
                'independent_floor' => 'Independent Floor',
                'plot' => 'Plot',
                'studio' => 'Studio',
                'duplex' => 'Duplex',
                'pent_house' => 'Pent House',
                'villa' => 'Villa',
                'agricultural_land' => 'Agricultural Land',
            ];

            $commercialTypes = [
                'office' => 'Office',
                'retain_shop' => 'Retain Shop',
                'showroom' => 'Showroom',
                'warehouse' => 'Warehouse',
                'plot' => 'Plot',
                'others' => 'Others',
            ];

            // Selected type: property value or default "apartment"
            $selectedType = isset($property) ? $property->property_types : 'apartment';
        @endphp

        <label for="property_types" id="propertyTypesCounts" class="light-label">Property Type<span class="req">*</span></label>
        <div class="form-section required-group">
            <div class="custom-radio-square residenceProperty ">
                @foreach($residenceTypes as $value => $label)
                    <input type="radio" class="btn-check" name="property_types" id="type_{{ $value }}" value="{{ $value }}" {{ $selectedType == $value ? 'checked' : '' }}>
                    <label class="btn-radio" for="type_{{ $value }}">{{ $label }}</label>
                @endforeach
            </div>

            <div class="custom-radio-square commercialProperty d-none">
                @foreach($commercialTypes as $value => $label)
                    <input type="radio" class="btn-check" name="property_types" id="type_{{ $value }}" value="{{ $value }}" {{ $selectedType == $value ? 'checked' : '' }}>
                    <label class="btn-radio" for="type_{{ $value }}">{{ $label }}</label>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">                
        <select name="city" id="city" class="form-select" hidden >
            <option value="">Select a City</option>
            @if ($cities->isNotEmpty())
                @foreach ($cities as $value)
                    <option value="{{ $value->id }}" 
                        {{ $value->name === 'Ahmedabad' ? 'selected' : '' }}>
                        {{ $value->name }}
                    </option>
                @endforeach
            @endif
        </select>
            
        <div class="col-md-6">
            <div class="form-group form-section">
                <label for="" class="light-label">Area<span class="req">*</span></label>
                <select name="area" id="area" class="form-select required-field">
                    <option value="">Select Area</option>
                </select>                        
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-section">
                <label for="category" class="light-label">Looking to<span class="req">*</span></label><br />
                <div class="custom-radio required-group">
                    <input type="radio" class="btn-check" name="category" id="is_category_buy" value="buy" autocomplete="off"
                        {{ (isset($property) && $property->category == 'buy') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                    <label class="btn-radio" for="is_category_buy">Buy</label>

                    <input type="radio" class="btn-check" name="category" id="is_category_rent" value="rent" autocomplete="off"
                        {{ (isset($property) && $property->category == 'rent') ? 'checked' : '' }}>
                    <label class="btn-radio" for="is_category_rent">Rent</label>
                </div> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group form-section">
                <label for="saletype" class="light-label">Sale Type<span class="req">*</span></label>
                <div class="custom-radio required-group">
                    <input type="radio" class="btn-check" name="sale_types" id="is_sale_new" value="new" autocomplete="off"
                        {{ (isset($property) && $property->sale_types == 'new') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                    <label class="btn-radio" for="is_sale_new">New</label>

                    <input type="radio" class="btn-check" name="sale_types" id="is_sale_resale" value="resale" autocomplete="off"
                        {{ (isset($property) && $property->sale_types == 'resale') ? 'checked' : '' }}>
                    <label class="btn-radio" for="is_sale_resale">Resale</label>
                </div>                           
            </div>
        </div>
    </div>
</div>

<p><a href="#" class="btn btn-primary btn-next-tab">Next, add price details</a></p>