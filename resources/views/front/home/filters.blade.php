<div class="listing-page">
    <form action="{{ route('properties') }}" > 
        <div class="container-fluid">
            <div class="filters">
                <div class="dropdown {{ request('category') == 27 ? 'hidden-property-type' : '' }}">
                    <button class="btn control-btn btnFilter dropdown-toggle" type="button" id="typeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Property Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="typeDropdown" >
                        @foreach ($propertyTypes as $value)
                            <li>
                                <label class="dropdown-item custom-checkbox-label {{ is_array(request('type')) && in_array($value->id, request('type')) ? 'active' : '' }}">
                                    <input type="checkbox" name="type[]" value="{{ $value->id }}" data-label="{{ $value->name }}"
                                        {{ is_array(request('type')) && in_array($value->id, request('type')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    {{ $value->name }}
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
                        @foreach ($rooms as $value)
                            <li>
                                <label class="dropdown-item custom-checkbox-label {{ is_array(request('room')) && in_array($value->id, request('room')) ? 'active' : '' }}">
                                    <input type="checkbox" name="room[]" value="{{ $value->id }}"
                                        data-label="{{ $value->title }}"
                                        {{ is_array(request('room')) && in_array($value->id, request('room')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    {{ $value->title }}
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
                                <input type="hidden" name="price_min" id="price_min" value="{{ request('price_min') }}">
                                <input type="hidden" name="price_max" id="price_max" value="{{ request('price_max') }}">
                                <input type="text" id="priceRange" />
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" id="resetPriceRange" class="btn btn-secondary">Reset</button>
                            </form>
                        </ul>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btnFilter dropdown-toggle" type="button" id="saletypeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Sale Type
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="saletypeDropdown">
                        @foreach ($saletypes as $value)
                            <li>
                                <label class="dropdown-item custom-radio-label {{ request('saletype') == $value->id ? 'active' : '' }}">
                                    <input type="radio" name="saletype" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                        {{ request('saletype') == $value->id ? 'checked' : '' }}>
                                    <span class="radiomark"></span>
                                    {{ $value->title }}                                    
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btnFilter dropdown-toggle" type="button" id="constructionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Construction
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="constructionDropdown">
                        @foreach ($constructions as $value)
                            <li>
                                <label class="dropdown-item custom-radio-label {{ request('construction') == $value->id ? 'active' : '' }}">
                                    <input type="radio" name="construction" value="{{ $value->id }}" data-label="{{ $value->name }}"
                                        {{ request('construction') == $value->id ? 'checked' : '' }}>
                                    <span class="radiomark"></span>
                                    {{ $value->title }}
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
                                        @foreach ($listedTypes as $value)
                                            <label class="custom-checkbox-label {{ is_array(request('listed_type')) && in_array($value->id, request('listed_type')) ? 'active' : '' }}">
                                                <input type="checkbox" name="listed_type[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                    {{ is_array(request('listed_type')) && in_array($value->id, request('listed_type')) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                {{ $value->title }}
                                                <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                                </svg>  
                                            </label>
                                        @endforeach
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
                                        
                                        {{-- @foreach ($amenities as $amenity)
                                            <label class="custom-checkbox-label {{ is_array(request('amenities')) && in_array($amenity->id, request('amenities')) ? 'active' : '' }}">
                                                <input class="hidden" type="checkbox" 
                                                    name="amenities[]" 
                                                    value="{{ $amenity->id }}" 
                                                    data-label="{{ $amenity->title }}"
                                                    {{ is_array(request('amenities')) && in_array($amenity->id, request('amenities')) ? 'checked' : '' }}>
                                                <span class="radiomark"></span>
                                                {{ $amenity->title }}
                                                <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                    <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                                </svg>
                                            </label>
                                        @endforeach --}}

                                        @foreach ($properties as $property)
                                            @foreach ($property->amenities as $amenity)
                                                <label class="custom-checkbox-label {{ is_array(request('amenities')) && in_array($amenity->id, request('amenities')) ? 'active' : '' }}">
                                                    <input class="hidden" type="checkbox" name="amenities[]" value="{{ $amenity->id }}" data-label="{{ $amenity->title }}"
                                                        {{ is_array(request('amenities')) && in_array($amenity->id, request('amenities')) ? 'checked' : '' }}>
                                                    <span class="radiomark"></span>
                                                    {{ $amenity->title }}
                                                    <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                        <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                                    </svg>
                                                </label>                                                    
                                            @endforeach
                                        @endforeach                                        
                                    </div>
                                </div>

                                <!-- Property Age -->
                                <div class="tab-pane fade" id="age-content" role="tabpanel">
                                    <div class="age-checkbox">
                                        <h6>Property Age</h6>
                                        <div class="loop-radio">
                                            @foreach ($ages as $value)
                                                <div class="individual">
                                                    <label class="custom-radio-label {{ request('age') == $value->id ? 'active' : '' }}">
                                                        <input class="hidden" type="radio" name="age" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                            {{ request('age') == $value->id ? 'checked' : '' }}>
                                                        <span class="radiomark"></span>
                                                        {{ $value->title }}
                                                        <svg fill="#ffffff" width="14px" height="14px" viewBox="-3.5 0 19 19" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                                                            <path d="M11.383 13.644A1.03 1.03 0 0 1 9.928 15.1L6 11.172 2.072 15.1a1.03 1.03 0 1 1-1.455-1.456l3.928-3.928L.617 5.79a1.03 1.03 0 1 1 1.455-1.456L6 8.261l3.928-3.928a1.03 1.03 0 0 1 1.455 1.456L7.455 9.716z"></path>
                                                        </svg>
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
                                        @foreach ($facings as $value)                                            
                                            <label class="custom-checkbox-label {{ is_array(request('facing')) && in_array($value->id, request('facing')) ? 'active' : '' }}">
                                                <input type="checkbox" name="facing[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                    {{ is_array(request('facing')) && in_array($value->id, request('facing')) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                {{ $value->title }}
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
                                        @foreach ($bathrooms as $value)
                                            <label class="custom-checkbox-label {{ is_array(request('bathroom')) && in_array($value->id, request('bathroom')) ? 'active' : '' }}">
                                                <input type="checkbox" name="bathroom[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                    {{ is_array(request('bathroom')) && in_array($value->id, request('bathroom')) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                {{ $value->title }}
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

                <select name="sort" id="sort" class="form-control">
                    <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : '' }}>Latest</option>
                    <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : '' }}>Oldest</option>
                </select>

                <div class="col">
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
                </div>
            </div>
        </div>    
    </form>     
</div>
