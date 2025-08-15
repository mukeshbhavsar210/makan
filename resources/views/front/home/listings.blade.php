@extends('front.layouts.app')

@section('main')

<div class="listing-page">
    <form action="{{ route('properties') }}" > 
        {{-- <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="areasDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Areas
            </button>
            <ul class="dropdown-menu p-2" aria-labelledby="areasDropdown" style="min-width: 200px;">
                @foreach ($areas as $value)
                    <li>
                        <label class="dropdown-item custom-checkbox-label {{ is_array(request('areas')) && in_array($value->id, request('areas')) ? 'active' : '' }}">
                            <input type="checkbox" name="areas[]" value="{{ $value->id }}"
                                data-label="{{ $value->name }}"
                                {{ is_array(request('areas')) && in_array($value->id, request('areas')) ? 'checked' : '' }}>
                            <span class="checkmark"></span>
                            {{ $value->name }}
                        </label>
                    </li>
                @endforeach
            </ul>
        </div> --}}

        <div class="container-fluid">
            <div class="filters">
                <div class="dropdown">
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
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn control-btn btnFilter dropdown-toggle" type="button" id="bathroomDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        Bathrooms
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="bathroomDropdown" >
                        @foreach ($bathrooms as $value)
                            <li>
                                <label class="dropdown-item custom-checkbox-label {{ is_array(request('bathroom')) && in_array($value->id, request('bathroom')) ? 'active' : '' }}">
                                    <input type="checkbox" name="bathroom[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                        {{ is_array(request('bathroom')) && in_array($value->id, request('bathroom')) ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                    {{ $value->title }}
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
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Facing -->
                                <div class="tab-pane fade" id="facing-content" role="tabpanel">
                                    Facings
                                    <div class="more-filter-checkbox">
                                        @foreach ($facings as $value)                                            
                                            <label class="custom-checkbox-label {{ is_array(request('facing')) && in_array($value->id, request('facing')) ? 'active' : '' }}">
                                                <input type="checkbox" name="facing[]" value="{{ $value->id }}" data-label="{{ $value->title }}"
                                                    {{ is_array(request('facing')) && in_array($value->id, request('facing')) ? 'checked' : '' }}>
                                                <span class="checkmark"></span>
                                                {{ $value->title }}
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
                                            </label>
                                        @endforeach

                                        {{-- @foreach ($bathrooms as $bathroom)
                                            <label class="custom-checkbox-label">
                                                <input class="form-check-input" type="checkbox" name="bathroom[]" value="{{ $bathroom->id }}">
                                                <span class="checkmark"></span>
                                                {{ $bathroom->title }}
                                            </label>
                                        @endforeach --}}
                                    </div>
                                </div>

                                <div class="mt-3 text-end">
                                    <button class="btn btn-primary" id="applyFilters">Apply</button>
                                    <button class="btn btn-secondary" id="resetFilters">Reset</button>
                                </div>
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

<div class="body-details">
    <div class="row">
        <div class="col-md-8 col-12">
            @if ($properties->isNotEmpty())
                @foreach ($properties as $value)                                     
                    <div class="propery-listings">                        
                        <div class="picture">
                            @php
                                $propertyImage = $value->property_images->first();
                            @endphp
                                                        
                            <a href="{{ route('propertyDetails', $value->id) }}" >
                                @if (!empty($propertyImage->image))
                                    <img alt="" class="thumb" src="{{ asset('uploads/property/small/'.$propertyImage->image) }}" >
                                @else
                                    <img class="thumb" src="{{ asset('front-assets/images/building.svg') }}" />
                                @endif
                            </a>
                        </div>
                        
                        <div class="details">
                            <div class="first-group">
                                <div class="left">
                                    <h3 class="title">{{ $value->title }}</h3>
                                    <p>{{ $value->room->title }} {{ $value->propertyType->name }} in {{ $value->area->name }}.</p>
                                </div>
                                <div class="right">
                                    @if ($value->category->name == 'Rent')
                                        <span class="rh-ultra-featured">{{ $value->category->name }}</span>
                                    @else
                                        <span class="rh-ultra-hot">{{ $value->category->name }}</span>
                                    @endif
                                </div>                                                                                                 
                            </div>

                            <div class="second-group">
                                <p class="small-text">{{ $value->room->title }} {{ $value->propertyType->name }}</p>
                                <p>Rs.{{ $value->price }}/-</p>
                            </div>

                            <div class="third-group">
                                <p>Sizes: {{ $value->size }} sq.yd. {{ $value->handover_status }} Possession: {{ \Carbon\Carbon::parse($value->possession_date)->format('M, Y') }}</p>
                            </div>
                            
                            <div class="developer">
                                <div class="branding">
                                    <img alt="" class="logo" src="{{ asset('uploads/builder/'.$value->builder->logo) }}" >
                                    <div class="name">
                                        <p class="builder_name">{{ $value->builder->name }} </p>
                                        <p>Developer</p>  
                                    </div>                                  
                                </div>
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#longModal_{{ $value->id }}" >Contact</a>  

                                <div class="modal fade" id="longModal_{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="longModalLabel">Contact Seller</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">                                            
                                                <div class="modal-builder">
                                                <h3>Contact Seller</h3>
                                                    <div class="logo-details">
                                                        <div class="logo">
                                                            <img alt="" src="{{ asset('uploads/builder/'.$value->builder->logo) }}" >
                                                        </div>
                                                        <div class="details-modal">
                                                            <h4>{{ $value->builder->name }}</h4>
                                                            <p>Developer</p>
                                                            <p>+91-{{ $value->builder->mobile }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                Please share your contact
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">Get Contact Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>      
                @endforeach
                    {{ $properties->withQueryString()->links() }}
                @else
                    <div class="container">
                        <img src="{{ asset('front-assets/images/nodata.webp') }}" />
                    </div>
                @endif                                                                          
            </div>
            <div class="col-md-4 col-12">Right</div>
        </div>
    </div>
@endsection

@section('customJs')
<script>
function updateDropdownLabel(dropdownId, inputSelector, defaultText) {
    var checked = $(inputSelector + ':checked');
    var button = $(dropdownId);

    if (checked.length === 0) {
        button.text(defaultText);
    } else {
        var names = checked.map(function () {
            return $(this).data('label');
        }).get();
        button.text(names.join(', '));
    }
}

$('.custom-checkbox-label input').on('change', function () {
    if ($(this).is(':checked')) {
        $(this).closest('.custom-checkbox-label').addClass('active');
    } else {
        $(this).closest('.custom-checkbox-label').removeClass('active');
    }

    updateDropdownLabel('#typeDropdown', 'input[name="type[]"]', 'Property Type');
    updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'Rooms');
    updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
    updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');    
    updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
    updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
});

// Initialize all dropdown labels on page load
updateDropdownLabel('#typeDropdown', 'input[name="type[]"]', 'Property Type');
updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'Rooms');
updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');
updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
updateDropdownLabel('#saletypeDropdown', 'input[name="saletype"]', 'Sale Type');

function updateDropdownLabel(dropdownId, checkboxSelector, defaultLabel) {
    let selectedLabels = [];
    $(checkboxSelector + ':checked').each(function () {
        selectedLabels.push($(this).data('label'));
    });

    if (selectedLabels.length > 0) {
        $(dropdownId).text(selectedLabels.join(', '));
    } else {
        $(dropdownId).text(defaultLabel);
    }
}



$('.custom-radio-label input[name="saletype"]').on('change', function () {
    var name = $(this).attr('name');

    // Remove active from all radios in the group
    $('input[name="' + name + '"]').closest('.custom-radio-label').removeClass('active');

    // Add active to the selected one
    if ($(this).is(':checked')) {
        $(this).closest('.custom-radio-label').addClass('active');
    }

    // Update only the Sale Type dropdown label
    updateDropdownLabel('#saletypeDropdown', 'input[name="saletype"]', 'Sale Type');
});
</script>
@endsection