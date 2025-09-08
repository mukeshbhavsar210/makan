<h5>Add Basic Details</h5>
<p class="light-label">Property Type</p>

<ul class="nav nav-pills property-types custom" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-tab_011" data-bs-toggle="pill" data-value="residential"
           data-bs-target="#pills-basic_2" role="tab" aria-controls="pills-basic_2" aria-selected="true">
           Residential
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-tab_022" data-bs-toggle="pill" data-value="commercial"
           data-bs-target="#pills-properties_2" role="tab" aria-controls="pills-properties_2" aria-selected="false">
           Commercial
        </a>
    </li>
</ul>

<!-- Hidden field that stores value -->
<input type="hidden" name="residence_types" id="residence_types" value="residential">

<div class="tab-content" id="pills-tabContent_2">
    <div class="tab-pane fade show active" id="pills-basic_2" role="tabpanel" aria-labelledby="pills-tab_01">        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category" class="light-label">Looking to<span class="req">*</span></label><br />
                    <div class="custom-radio">
                        <input type="radio" class="btn-check" name="category" id="is_category_buy" value="buy" autocomplete="off"
                            {{ (isset($property) && $property->category == 'buy') ? 'checked' : (!isset($property) ? 'checked' : '') }}>
                        <label class="btn-radio" for="is_category_buy">Buy</label>

                        <input type="radio" class="btn-check" name="category" id="is_category_rent" value="rent" autocomplete="off"
                            {{ (isset($property) && $property->category == 'rent') ? 'checked' : '' }}>
                        <label class="btn-radio" for="is_category_rent">Rent</label>
                    </div> 
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="saletype" class="light-label">Sale Type<span class="req">*</span></label>
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

            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="light-label">City<span class="req">*</span></label>
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
                    <label for="" class="light-label">Area<span class="req">*</span></label>
                    <select name="area" id="area" class="form-select">
                        <option value="">Select Area</option>
                    </select>                        
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="pills-properties_2" role="tabpanel" aria-labelledby="pills-tab_02">
        <div class="form-group">
            <label for="property_types" id="propertyTypesCounts" class="light-label">Property Type<span class="req">*</span></label>
            @php
                $selectedType = isset($property) ? $property->property_types : '';
            @endphp

            <div class="custom-radio-square">
                <input type="radio" class="btn-check" name="property_types" id="type_office" value="office" {{ $selectedType == 'office' ? 'checked' : '' }}>
                <label class="btn-radio" for="type_office">Office</label>

                <input type="radio" class="btn-check" name="property_types" id="type_retain_shop" value="retain_shop" {{ $selectedType == 'retain_shop' ? 'checked' : '' }}>
                <label class="btn-radio" for="type_retain_shop">Retain<br /> Shop</label>

                <input type="radio" class="btn-check" name="property_types" id="type_showroom" value="independent_floor" {{ $selectedType == 'showroom' ? 'checked' : '' }}>
                <label class="btn-radio" for="type_showroom">Showroom</label>

                <input type="radio" class="btn-check" name="property_types" id="type_warehouse" value="warehouse" {{ $selectedType == 'warehouse' ? 'checked' : '' }}>
                <label class="btn-radio" for="type_warehouse">Warehouse</label>

                <input type="radio" class="btn-check" name="property_types" id="type_plot" value="plot" {{ $selectedType == 'plot' ? 'checked' : '' }}>
                <label class="btn-radio" for="type_plot">Plot</label>

                <input type="radio" class="btn-check" name="property_types" id="type_others" value="others" {{ $selectedType == 'others' ? 'checked' : '' }}>
                <label class="btn-radio" for="type_others">Others</label>
            </div>
        </div>
    </div>
</div>


<a href="#" class="btn btn-primary big-btn">Next, add property details</a>
