@extends('front.layouts.app')

@section('hideHeader') @endsection

<div id="pageLoader" class="page-loader">
    <img src="{{ asset('front-assets/images/loader.gif') }}" />    
</div>

<header class="control-header">
    <div class="strip">
        <a class="navbar-brand" href="{{ route('front.home') }}"><img src="{{ asset('front-assets/images/logo.png') }}" /></a>
        <a class="toggleHeader toggleControl">
            @if($categoryWord)
                {{ $categoryWord }} 
            @endif
            in {{ $citySelected->name }}
            <span class="down-arrow">
                <?xml version="1.0" encoding="utf-8"?>
                <svg width="15px" height="15px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M903.232 256l56.768 50.432L512 768 64 306.432 120.768 256 512 659.072z" fill="#ffffff" /></svg>
            </span>

            <span class="up-arrow">
                <?xml version="1.0" encoding="iso-8859-1"?>
                <svg fill="#ffffff" height="15px" width="15px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    viewBox="0 0 512.01 512.01" xml:space="preserve"><g>
                    <g><path d="M505.755,358.256L271.088,123.589c-8.341-8.341-21.824-8.341-30.165,0L6.256,358.256c-8.341,8.341-8.341,21.824,0,30.165
                            s21.824,8.341,30.165,0l219.584-219.584l219.584,219.584c4.16,4.16,9.621,6.251,15.083,6.251c5.462,0,10.923-2.091,15.083-6.251
                            C514.096,380.08,514.096,366.597,505.755,358.256z"/></g>
                    </g>
                </svg>
            </span>                
        </a>  

        <form action="{{ route('properties') }}" >                            
            <div class="search-strip">
                <ul id="areas_top" >
                    @if(Request::get('city'))
                        @php
                            $areas = \App\Models\Area::where('city_id', Request::get('city'))->get();
                            $selectedAreas = (array) Request::get('area'); // multiple areas allowed
                        @endphp

                        @php
                            // First area to display (either first selected or default first area)
                            $firstAreaId = $selectedAreas ? $selectedAreas[0] : ($areas[0]->id ?? null);
                        @endphp

                        {{-- Show only the first area --}}
                        @if($firstAreaId)
                            @php $firstArea = $areas->firstWhere('id', $firstAreaId); @endphp
                            @if($firstArea)
                                <li class="active">
                                    <label class="custom-checkbox-label">
                                        <input type="checkbox" name="area[]" value="{{ $firstArea->id }}" checked>
                                        {{ $firstArea->name }}
                                        <a href="javascript:void(0);" class="remove-area" data-id="{{ $firstArea->id }}">
                                            <svg width="22px" height="22px" viewBox="0 0 1024 1024" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M512 897.6c-108 0-209.6-42.4-285.6-118.4-76-76-118.4-177.6-118.4-285.6 0-108 42.4-209.6 118.4-285.6 76-76 177.6-118.4 285.6-118.4 108 0 209.6 42.4 285.6 118.4 157.6 157.6 157.6 413.6 0 571.2-76 76-177.6 118.4-285.6 118.4z m0-760c-95.2 0-184.8 36.8-252 104-67.2 67.2-104 156.8-104 252s36.8 184.8 104 252c67.2 67.2 156.8 104 252 104 95.2 0 184.8-36.8 252-104 139.2-139.2 139.2-364.8 0-504-67.2-67.2-156.8-104-252-104z"/>
                                                <path d="M707.872 329.392L348.096 689.16l-31.68-31.68 359.776-359.768z"/>
                                                <path d="M328 340.8l32-31.2 348 348-32 32z"/>
                                            </svg>
                                        </a>
                                    </label>
                                </li>
                            @endif
                        @endif

                    {{-- Add More Areas button if multiple selected --}}
                        @if($areas->count() > 1)
                        <li>
                            <a href="javascript:void(0);" id="showAllAreas" class="show-all">
                                Add +
                            </a>
                        </li>
                    @endif
                        
                    
                @endif
            </ul>

            {{-- Hidden Areas (only extra selected areas beyond the first) --}}
                @if(count($selectedAreas) > 1)
                    <div class="hidden-areas-added">
                        <ul class="added">
                            @foreach($selectedAreas as $index => $areaId)
                                @if($index > 0) {{-- Skip first area --}}
                                    @php $area = $areas->firstWhere('id', $areaId); @endphp
                                    @if($area)
                                        <li class="active">
                                            <label class="custom-checkbox-label">
                                                <input type="checkbox" name="area[]" value="{{ $area->id }}" checked>
                                                {{ $area->name }}
                                                <a href="javascript:void(0);" class="remove-area" data-id="{{ $area->id }}">
                                                    <svg width="22px" height="22px" viewBox="0 0 1024 1024" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M512 897.6c-108 0-209.6-42.4-285.6-118.4-76-76-118.4-177.6-118.4-285.6 0-108 42.4-209.6 118.4-285.6 76-76 177.6-118.4 285.6-118.4 108 0 209.6 42.4 285.6 118.4 157.6 157.6 157.6 413.6 0 571.2-76 76-177.6 118.4-285.6 118.4z m0-760c-95.2 0-184.8-36.8-252 104-67.2 67.2-104 156.8-104 252s36.8 184.8 104 252c67.2 67.2 156.8 104 252 104 95.2 0 184.8-36.8 252-104 139.2-139.2 139.2-364.8 0-504-67.2-67.2-156.8-104-252-104z"/>
                                                        <path d="M707.872 329.392L348.096 689.16l-31.68-31.68 359.776-359.768z"/>
                                                        <path d="M328 340.8l32-31.2 348 348-32 32z"/>
                                                    </svg>
                                                </a>
                                            </label>
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>  
                        
                        
                    </div>                     
                @endif

                {{-- Hidden Areas --}}                                
                <ul class="hidden-areas" style="display: none" >
                    @foreach($areas as $index => $area)
                        @if(!in_array($area->id, $selectedAreas) && !(!$selectedAreas && $index == 0))
                            <li>
                                <label class="custom-checkbox-label">
                                    <input type="checkbox" name="area[]" value="{{ $area->id }}">
                                    {{ $area->name }}
                                </label>
                            </li>
                        @endif
                    @endforeach  
                </ul>
            </div>
        </form>               
    </div>

    <div class="inner-header">
        <div class="search-engine">
            <form action="{{ route('properties') }}" >            
                <ul class="rentBuy">
                    <li>I'm looking to</li>
                    @if ($categories)                               
                        @foreach ($categories as $value)                            
                            <li>
                                <label class="{{ request('category') == $value->id || (!request('category') && $loop->first) ? 'activeTab' : '' }}">
                                    <input type="radio" name="category" value="{{ $value->id }}"
                                        {{ request('category') == $value->id || (!request('category') && $loop->first) ? 'checked' : '' }}>
                                    {{ $value->name }}
                                </label>
                            </li>
                        @endforeach                            
                    @endif
                </ul>

                <div class="search-controls">
                    <div class="flex-search">
                        <div class="left">
                            <select name="city" id="city" class="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $c)
                                    <option value="{{ $c->id }}" {{ Request::get('city') == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>    

                            
                            
                            
                        </div>
                        <div class="right">
                            <div class="areas-list">
                                <ul id="areas" >
                                    @if(Request::get('city'))
                                        @php
                                            $areas = \App\Models\Area::where('city_id', Request::get('city'))->get();
                                            $selectedAreas = (array) Request::get('area'); // multiple areas allowed
                                        @endphp

                                        {{-- Show selected areas with remove (X) --}}
                                        @foreach($areas as $index => $area)
                                            @if(in_array($area->id, $selectedAreas) || (!$selectedAreas && $index == 0))
                                                <li class="active">
                                                    <label class="custom-checkbox-label">
                                                        <input type="checkbox" name="area[]" value="{{ $area->id }}" checked>
                                                        {{ $area->name }}
                                                        <a href="javascript:void(0);" class="remove-area" data-id="{{ $area->id }}">
                                                            <?xml version="1.0" encoding="utf-8"?>
                                                            <svg width="22px" height="22px" viewBox="0 0 1024 1024" fill="#ffffff" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 897.6c-108 0-209.6-42.4-285.6-118.4-76-76-118.4-177.6-118.4-285.6 0-108 42.4-209.6 118.4-285.6 76-76 177.6-118.4 285.6-118.4 108 0 209.6 42.4 285.6 118.4 157.6 157.6 157.6 413.6 0 571.2-76 76-177.6 118.4-285.6 118.4z m0-760c-95.2 0-184.8 36.8-252 104-67.2 67.2-104 156.8-104 252s36.8 184.8 104 252c67.2 67.2 156.8 104 252 104 95.2 0 184.8-36.8 252-104 139.2-139.2 139.2-364.8 0-504-67.2-67.2-156.8-104-252-104z" fill="" /><path d="M707.872 329.392L348.096 689.16l-31.68-31.68 359.776-359.768z" fill="" /><path d="M328 340.8l32-31.2 348 348-32 32z" fill="" /></svg>
                                                        </a>
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Add More Button --}}
                                        @if($areas->count() > 1)
                                            <li>
                                                <a href="javascript:void(0);" id="showAllAreas" class="show-all">
                                                    Add 
                                                    <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 12H18M12 6V18" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                                {{-- Hidden Areas --}}                                
                                <ul class="hidden-areas" style="display:none;">
                                    @foreach($areas as $index => $area)
                                        @if(!in_array($area->id, $selectedAreas) && !(!$selectedAreas && $index == 0))
                                            <li>
                                                <label class="custom-checkbox-label">
                                                    <input type="checkbox" name="area[]" value="{{ $area->id }}">
                                                    {{ $area->name }}
                                                </label>
                                            </li>
                                        @endif
                                    @endforeach  
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="right-btn">
                        <button class="btn btn-primary" type="submit">Search</button>      
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="overlay"></div>
</header>

@section('main')

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
    <div class="container-fluid">        
        <ul class="breadcrumb">
            <li><a href="{{ route('front.home') }}">Home</a></li>                
            @if($citySelected)
                <li><a href="{{ url('/properties?city='.$citySelected->id) }}">{{ $citySelected->name }}</a></li>
            @endif

            @if($area)
                <li class="active" aria-current="page"> 
                    @if($room)
                        {{ $room->title }} 
                    @endif
                    Flat 
                    @if($categoryWord)
                        {{ $categoryWord }} 
                    @endif
                    in 
                    @if($area)
                        {{ $area->name }}
                    @endif
                </li>
            @endif            
        </ul>
    </div>

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
    updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
    updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
    updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');    
    updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
    updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
});

// Initialize all dropdown labels on page load
updateDropdownLabel('#typeDropdown', 'input[name="type[]"]', 'Property Type');
updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
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