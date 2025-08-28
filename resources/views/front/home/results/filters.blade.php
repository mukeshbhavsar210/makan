<div class="listing-page">
    <form action="{{ route('properties') }}" > 
        <div class="container-fluid">
            <div class="filters">
                <div class="dropdown">
                    <button class="btn control-btn btnFilter dropdown-toggle" type="button" id="propertyTypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Property Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="propertyTypeDropdown">
                        @php
                            $propertyTypes = [
                                ['id' => 1, 'title' => 'Apartment'],
                                ['id' => 2, 'title' => 'Independent House'],
                                ['id' => 3, 'title' => 'Independent Floor'],
                                ['id' => 4, 'title' => 'Plot'],
                                ['id' => 6, 'title' => 'Studio'],
                                ['id' => 7, 'title' => 'Duplex'],
                                ['id' => 8, 'title' => 'Pent House'],
                                ['id' => 9, 'title' => 'Villa'],
                                ['id' => 10, 'title' => 'Agricultural Land'],
                            ];
                        @endphp

                         @foreach ($propertyTypes as $value)
                            <li>
                                @php
                                    $slug = strtolower(str_replace(' ', '_', $value['title']));
                                @endphp

                                <label class="dropdown-item custom-checkbox-label {{ is_array(request('property_type')) && in_array($slug, request('property_type')) ? 'active' : '' }}">
                                    <input type="checkbox" name="property_type[]" value="{{ $slug }}" data-label="{{ $value['title'] }}"
                                        {{ is_array(request('property_type')) && in_array($slug, request('property_type')) ? 'checked' : '' }}>
                                    
                                    <span class="checkmark"></span>
                                    {{ $value['title'] }}
                                    <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                        <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                    </svg>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn control-btn btnFilter dropdown-toggle" type="button" id="roomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        BHK Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="roomDropdown" >
                        @php
                            $rooms = [
                                ['id' => 1, 'title' => '1 RK', 'price' => ''],
                                ['id' => 2, 'title' => '1 BHK', 'price' => ''],
                                ['id' => 3, 'title' => '2 BHK', 'price' => '7500000'],
                                ['id' => 4, 'title' => '3 BHK', 'price' => '9500000'],
                                ['id' => 5, 'title' => '4 BHK', 'price' => ''],
                                ['id' => 6, 'title' => '5 BHK', 'price' => '']
                            ];
                        @endphp

                        @foreach ($rooms as $value)
                            @php
                                $roomValue = strtolower(str_replace(' ', '_', $value['title']));
                            @endphp

                            <li>
                                <label class="dropdown-item custom-checkbox-label {{ is_array(request('room')) && in_array($roomValue, request('room')) ? 'active' : '' }}">
                                    <input type="checkbox" name="room[]" value="{{ $roomValue }}" data-label="{{ $value['title'] }}" {{ is_array(request('room')) && in_array($roomValue, request('room')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    {{ strtoupper(str_replace('_', ' ', $roomValue)) }}
                                    
                                    <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                        <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                    </svg>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col">
                    <div class="dropdown">
                        <button class="btn btnFilter btn-secondary dropdown-toggle" type="button" id="priceDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Price Range
                        </button>
                        <ul class="dropdown-menu custom-price" aria-labelledby="priceDropdown">

                            <form id="filterForm" method="GET" action="{{ route('properties.index') }}">
                                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min', 1000) }}">
                                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max', 50000) }}">
                                
                                <p>
                                    <label for="priceRange">Price range:</label>
                                    <input type="text" id="priceRange" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                </p>
                                <div id="priceSlider"></div>

                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>

                            {{-- <form id="filterForm" method="GET" action="{{ route('properties.index') }}">
                                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min') }}">
                                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max') }}">
                                <input type="text" id="priceRange" />
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" id="resetPriceRange" class="btn btn-secondary">Reset</button>
                            </form> --}}
                        </ul>
                    </div>
                </div>
               
                <div class="dropdown">
                    <button class="btn btnFilter dropdown-toggle" type="button" id="saletypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Sale Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="saletypeDropdown">
                        @php
                            $saletypes = [
                                ['id' => 'new', 'title' => 'New'],
                                ['id' => 'resale', 'title' => 'Resale'],
                            ];
                        @endphp

                        @foreach ($saletypes as $value)
                            <li>
                                <label class="dropdown-item custom-radio-label {{ request('saletype') == $value['id'] ? 'active' : '' }}">
                                    <input type="radio" 
                                        name="saletype" 
                                        value="{{ $value['id'] }}" 
                                        data-label="{{ $value['title'] }}"
                                        {{ request('saletype') == $value['id'] ? 'checked' : '' }}>
                                    <span class="radiomark"></span>
                                    {{ $value['title'] }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btnFilter dropdown-toggle" type="button" id="constructionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Construction
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="constructionTypeDropdown">
                        @php
                            $constructionTypes = [
                                ['id' => 'under', 'title' => 'Under Construction'],
                                ['id' => 'ready', 'title' => 'Ready to Move'],
                            ];
                        @endphp

                        @foreach ($constructionTypes as $value)
                            <li>
                                <label class="dropdown-item custom-radio-label {{ request('construction') == $value['id'] ? 'active' : '' }}">
                                    <input type="radio" 
                                        name="construction" 
                                        value="{{ $value['id'] }}" 
                                        data-label="{{ $value['title'] }}"
                                        {{ request('construction') == $value['id'] ? 'checked' : '' }}>
                                    <span class="radiomark"></span>
                                    {{ $value['title'] }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btnFilter btn-secondary dropdown-toggle" type="button" id="moreFiltersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        More Filters
                    </button>
                    <div class="dropdown-menu moreFilters" aria-labelledby="moreFiltersDropdown" style="min-width: 500px;">
                        <div class="wrapper-filters">
                            <ul class="nav flex-column nav-pills" id="more-filters-tab" role="tablist" aria-orientation="vertical">
                                <li><a href="#" class="nav-link active" id="tab-listedby" data-bs-toggle="pill" data-bs-target="#listedby-content" role="tab">Listed By</a></li>
                                <li><a href="#" class="nav-link" id="tab-size" data-bs-toggle="pill" data-bs-target="#size-content" type="button" role="tab">Built-up Area</a></li>
                                <li><a href="#" class="nav-link" id="tab-amenities" data-bs-toggle="pill" data-bs-target="#amenities-content" type="button" role="tab">Amenities</a></li>
                                <li><a href="#" class="nav-link" id="tab-age" data-bs-toggle="pill" data-bs-target="#age-content" type="button" role="tab">Age of Property</a></li>                                
                                <li><a href="#" class="nav-link" id="tab-facing" data-bs-toggle="pill" data-bs-target="#facing-content" type="button" role="tab">Facing</a></li>                                
                                <li><a href="#" class="nav-link" id="tab-bathrooms" data-bs-toggle="pill" data-bs-target="#bathroom-content" type="button" role="tab">Bathrooms</a></li>                                    
                            </ul>
                        
                            <div class="tab-content" id="more-filters-tabContent">
                                <!-- Listed By -->
                                <div class="tab-pane fade show active" id="listedby-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Listed By</h6>
                                        <ul class="flex-wrapper">
                                            @php
                                                $uniqueRoles = $users->pluck('role')->unique();
                                            @endphp

                                            @foreach ($uniqueRoles as $role)
                                                <li>
                                                    <label class="dropdown-item custom-radio-label {{ request('posted_by') == $role ? 'active' : '' }}">
                                                        <input type="radio" name="posted_by" value="{{ $role }}" {{ request('posted_by') == $role ? 'checked' : '' }}>
                                                        <span class="radiomark"></span>
                                                        {{ $role }}
                                                    </label>
                                                </li>
                                            @endforeach  
                                        </ul>                                  
                                    </div>
                                </div>

                                <!-- Size -->
                                <div class="tab-pane fade" id="size-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Built-up Area in sq.ft.</h6>
                                        <form id="sizeFilterForm" method="GET" action="{{ route('properties.index') }}">
                                            <input type="hidden" name="size_min" id="size_min" value="{{ request('size_min') }}">
                                            <input type="hidden" name="size_max" id="size_max" value="{{ request('size_max') }}">
                                            <input type="text" id="sizeRange" />
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <button type="button" id="resetSizeRange" class="btn btn-secondary">Reset</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Sale type -->
                                <div class="tab-pane fade" id="amenities-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Amenities</h6> 
                                        @php
                                            $amenities = [
                                                ['id' => 1, 'title' => 'Gated Community'],
                                                ['id' => 2, 'title' => 'Lift'],
                                                ['id' => 3, 'title' => 'Swimming Pool'],
                                                ['id' => 4, 'title' => 'Gym'],
                                                ['id' => 5, 'title' => 'Security'],
                                                ['id' => 6, 'title' => 'Parking'],
                                                ['id' => 7, 'title' => 'Gas Pipeline'],
                                            ];
                                        @endphp

                                        @foreach ($amenities as $value)
                                            @php
                                                $slug = strtolower(str_replace(' ', '_', $value['title'])); // "Gym" => "gym"
                                            @endphp

                                            <label class="custom-checkbox-label {{ is_array(request('amenities')) && in_array($slug, request('amenities')) ? 'active' : '' }}">
                                                <input class="hidden" type="checkbox" name="amenities[]" value="{{ $slug }}" data-label="{{ $value['title'] }}"
                                                    {{ is_array(request('amenities')) && in_array($slug, request('amenities')) ? 'checked' : '' }}>
                                                
                                                <span class="radiomark"></span>
                                                {{ $value['title'] }} {{-- UI label --}}
                                                
                                                <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                                </svg>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Property Age -->
                                <div class="tab-pane fade" id="age-content" role="tabpanel">
                                    <div class="age-checkbox">
                                        <h6>Property Age</h6>
                                        <div class="loop-radio">
                                             @php
                                                $ages = [
                                                    ['id' => '1_year', 'title' => 'Less than 1 year'],
                                                    ['id' => '3_years', 'title' => 'Less than 3 year'],
                                                    ['id' => '5_years', 'title' => 'Less than 5 year'],
                                                    ['id' => '6_years', 'title' => 'More than 5 year'],
                                                ];
                                            @endphp

                                            @foreach ($ages as $value)
                                                <div class="individual">
                                                    <label class="custom-radio-label {{ request('age') == $value['id'] ? 'active' : '' }}">
                                                        <input type="radio" 
                                                            name="age" 
                                                            value="{{ $value['id'] }}" 
                                                            data-label="{{ $value['title'] }}"
                                                            {{ request('age') == $value['id'] ? 'checked' : '' }}>
                                                        <span class="radiomark"></span>
                                                        {{ $value['title'] }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Facing -->
                                <div class="tab-pane fade" id="facing-content" role="tabpanel">
                                    <h6>Facings</h6>
                                    <div class="more-filter-checkbox">
                                        @php
                                            $facings = [
                                                ['id' => 1, 'title' => 'North'],
                                                ['id' => 2, 'title' => 'East'],
                                                ['id' => 3, 'title' => 'West'],
                                                ['id' => 4, 'title' => 'South'],
                                                ['id' => 5, 'title' => 'North-East'],
                                                ['id' => 6, 'title' => 'North-West'],
                                                ['id' => 7, 'title' => 'South-East'],
                                                ['id' => 8, 'title' => 'South-West']
                                            ];
                                        @endphp

                                        @foreach ($facings as $value)
                                            @php
                                                $slug = strtolower(str_replace(' ', '_', $value['title']));
                                            @endphp

                                            <label class="custom-checkbox-label 
                                                {{ is_array(request('facing')) && in_array($slug, request('facing')) ? 'active' : '' }}">

                                                <input type="checkbox" name="facing[]" value="{{ $slug }}" data-label="{{ $value['title'] }}"
                                                    {{ is_array(request('facing')) && in_array($slug, request('facing')) ? 'checked' : '' }}>

                                                <span class="checkmark"></span>
                                                {{ $value['title'] }}

                                                <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                                </svg>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <!-- Bathrooms -->
                                <div class="tab-pane fade" id="bathroom-content" role="tabpanel">
                                    <div class="more-filter-checkbox">
                                        <h6>Bathrooms</h6>
                                        @php
                                            $bathrooms = [
                                                ['id' => 1, 'title' => '1 Bath'],
                                                ['id' => 2, 'title' => '2 Baths'],
                                                ['id' => 3, 'title' => '3 Baths'],
                                                ['id' => 4, 'title' => '4 Baths'],
                                                ['id' => 5, 'title' => '5 Baths'],
                                            ];
                                        @endphp

                                        @foreach ($bathrooms as $value)
                                            @php
                                                $slug = strtolower(str_replace(' ', '_', $value['title']));
                                            @endphp

                                            <label class="custom-checkbox-label 
                                                {{ is_array(request('bathroom')) && in_array($slug, request('bathroom')) ? 'active' : '' }}">

                                                <input type="checkbox" 
                                                    name="bathroom[]" 
                                                    value="{{ $slug }}" {{-- lowercase slug for DB --}}
                                                    data-label="{{ $value['title'] }}"
                                                    {{ is_array(request('bathroom')) && in_array($slug, request('bathroom')) ? 'checked' : '' }}>

                                                <span class="checkmark"></span>
                                                {{ $value['title'] }}

                                                <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                                </svg>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- <div class="mt-3 text-end">
                                    <button class="btn btn-primary" id="applyFilters">Apply</button>
                                    <button class="btn btn-secondary" id="resetFilters">Reset</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>    

                @php
                    $resetUrl = url()->current() . '?' . http_build_query([
                        'category' => request('category'),
                        'city' => request('city'),
                        'area' => request('area'),
                    ]);
                @endphp

                <button type="button" id="resetPriceRange" class="btn btn-primary btn-sm">Reset</button>

                <script>
                    let resetUrl = @json($resetUrl);

                    $("#resetPriceRange").on("click", function () {
                        $("#price_min").val("");
                        $("#price_max").val("");

                        slider.update({
                            from: 0,
                            to: priceLabels.length - 1
                        });

                        // Redirect instead of just submitting
                        window.location.href = resetUrl;
                    });
                </script>


                <select name="sort" id="sort" class="form-control">
                    <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : '' }}>Latest</option>
                    <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : '' }}>Oldest</option>
                </select>

                {{-- <div class="col">
                    <div style="display: none">
                        <select name="city" id="city" >
                            <option value="">City</option>
                            @if ($cities)
                                @foreach ($cities as $value)
                                    <option {{ (Request::get('city') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>    
    </form>     
</div>
