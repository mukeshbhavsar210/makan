<div class="form-section" data-step="1">
    <h4>Section 1</h4>
    <input type="text" class="required-field" placeholder="Name">
    <input type="email" class="required-field" placeholder="Email">
    <textarea class="required-field" placeholder="About yourself"></textarea>
</div>

<div class="form-section" data-step="2">
    <h4>Section 2</h4>
    <label><input type="radio" name="gender" class="required-field"> Male</label>
    <label><input type="radio" name="gender" class="required-field"> Female</label>
    <label><input type="radio" name="gender" class="required-field"> Other</label>
</div>

<div class="form-section" data-step="3">
    <h4>Section 3</h4>
    <label><input type="checkbox" name="hobbies" class="required-field"> Reading</label>
    <label><input type="checkbox" name="hobbies" class="required-field"> Sports</label>
    <label><input type="checkbox" name="hobbies" class="required-field"> Music</label>
</div>

<div class="form-section" data-step="1">
    <h5>Add Basic Details</h5>
    <div class="form-group">    
        <div class="custom-radio">
            <input type="radio" class="btn-check" name="residence_types" id="is_residential" value="residential" autocomplete="off"
                {{ (isset($property) && $property->residence_types == 'residential') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
            <label class="btn-radio" for="is_residential">Residential</label>

            <input type="radio" class="btn-check" name="residence_types" id="is_commercial" value="commercial" autocomplete="off"
                {{ (isset($property) && $property->residence_types == 'commercial') ? 'checked' : '' }}>
            <label class="btn-radio" for="is_commercial">Commercial</label>
        </div> 
    </div>

    <div class="form-group">
        <label for="property_types" id="propertyTypesCounts" class="light-label">
            Property Type <span class="req">*</span>
        </label>

        @php
            $selectedTypes = json_decode($property->property_types, true) ?? [];
        @endphp

        <div class="custom-radio-square residenceProperty">
            <input type="radio" class="btn-check" name="property_types" id="type_apartment" value="apartment" {{ (isset($property) && $property->property_types == 'apartment') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_apartment">Apartment</label>
            <input type="radio" class="btn-check" name="property_types" id="type_independent_house" value="independent_house" {{ (isset($property) && $property->property_types == 'independent_house') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_independent_house">Independent<br />House</label>
            <input type="radio" class="btn-check" name="property_types" id="type_floor" value="independent_floor" {{ (isset($property) && $property->property_types == 'independent_house') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_floor">Independent<br />Floor</label>
            <input type="radio" class="btn-check" name="property_types" id="type_plot" value="plot" {{ (isset($property) && $property->property_types == 'plot') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_plot">Plot</label>
            <input type="radio" class="btn-check" name="property_types" id="type_studio" value="studio" {{ (isset($property) && $property->property_types == 'studio') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_studio">Studio</label>
            <input type="radio" class="btn-check" name="property_types" id="type_duplex" value="duplex" {{ (isset($property) && $property->property_types == 'duplex') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_duplex">Duplex</label>
            <input type="radio" class="btn-check" name="property_types" id="type_pent" value="pent_house" {{ (isset($property) && $property->property_types == 'pent_house') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_pent">Pent<br />House</label>
            <input type="radio" class="btn-check" name="property_types" id="type_villa" value="villa" {{ (isset($property) && $property->property_types == 'villa') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_villa">Villa</label>
            <input type="radio" class="btn-check" name="property_types" id="type_land" value="agricultural_land" {{ (isset($property) && $property->property_types == 'agricultural_land') ? 'checked' : (!isset($property) ? 'checked' : '') }} > 
            <label class="btn-radio" for="type_land">Agricultural<br />Land</label>
        </div>

        <div class="custom-radio-square commercialProperty d-none">
            <input type="radio" class="btn-check" name="property_types" id="type_office" value="office" {{ $selectedTypes == 'office' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_office">Office</label>

            <input type="radio" class="btn-check" name="property_types" id="type_retail_shop" value="retail_shop" {{ $selectedTypes == 'retail_shop' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_retail_shop">Retail<br />Shop</label>

            <input type="radio" class="btn-check" name="property_types" id="type_showroom" value="showroom" {{ $selectedTypes == 'showroom' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_showroom">Showroom</label>

            <input type="radio" class="btn-check" name="property_types" id="type_warehouse" value="warehouse" {{ $selectedTypes == 'warehouse' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_warehouse">Warehouse</label>

            <input type="radio" class="btn-check" name="property_types" id="type_plot" value="plot" {{ $selectedTypes == 'plot' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_plot">Plot</label>

            <input type="radio" class="btn-check" name="property_types" id="type_others" value="others" {{ $selectedTypes == 'others' ? 'checked' : '' }}>
            <label class="btn-radio" for="type_others">Others</label>
        </div>

        <input type="hidden" name="property_types_json" id="property_types_json">
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="" class="light-label">City<span class="req">*</span></label>
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
                <label for="" class="light-label">Area<span class="req">*</span></label>
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="category" class="light-label">Looing to<span class="req">*</span></label><br />
                <div class="custom-radio">
                    <input type="radio" class="btn-check" name="category" id="is_category_buy" value="buy" autocomplete="off"
                        {{ old('category', $property->category ?? 'buy') == 'buy' ? 'checked' : '' }}>
                    <label class="btn-radio" for="is_category_buy">Buy</label>

                    <input type="radio" class="btn-check" name="category" id="is_category_rent" value="rent" autocomplete="off"
                        {{ old('category', $property->category ?? '') == 'rent' ? 'checked' : '' }}>
                    <label class="btn-radio" for="is_category_rent">Rent</label>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="saletype" class="light-label">Sale Type<span class="req">*</span></label><br />
                <div class="custom-radio">
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
<a href="#" class="btn btn-primary big-btn">Next, add property details</a>