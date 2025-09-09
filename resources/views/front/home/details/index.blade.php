@extends('front.layouts.app')

@section('hideHeader') @endsection

<header class="control-header">
    <div id="pageLoader" class="page-loader">
        <img src="{{ asset('front-assets/images/loader.gif') }}" />    
    </div>

    <div class="strip">
        <a class="navbar-brand" href="{{ route('front.home') }}"><img src="{{ asset('front-assets/images/logo.png') }}" /></a>
        <a class="toggleHeader toggleControl">
            @if($categoryWord)
                {{ $categoryWord }} 
            @endif
            @if($citySelected)
                in {{ $citySelected->name }}
            @endif
            
            <i class="fa-solid fa-angle-down down-arrow"></i>
            <i class="fa-solid fa-angle-up up-arrow"></i>            
        </a>  

        @include('front.home.results.search') 
        @include('front.home.results.search_slide')

        @include('front.layouts.login')
                    
        <div class="overlay"></div>
    </div>
</header>

@section('main')

<div class="wrapper">
<div class="container mt-5">
    <ul class="breadcrumb">
        <li><a href="{{ route('front.home') }}">Home</a></li>
        <li><a href="http://127.0.0.1:8000/properties?city=1">{{ $property->city->name }}</a></li>
        <li><a href="http://127.0.0.1:8000/properties?city=1&area=1">{{ $property->area->name }}</a></li>
        <li>{{ $property->title }}</li>
    </ul>

    <div class="property-individuals">
        @include('front.layouts.message')  

        <div class="row">
            <div class="col-md-8 col-12">
                <div class="first">
                    <h2>{{ $property->title }}</h2>
                    <p>By
                        @if ($property->user)
                            @php
                                $displayName = $property->user->role === 'Builder'
                                    ? ($property->user->developer_name ?? $property->user->name)
                                    : $property->user->name;

                                $slug = Str::slug($displayName) ?: 'user';
                            @endphp

                            <a class="link" target="_blank" href="{{ route('properties.user', ['category' => $property->category, 'name' => $slug, 'id' => $property->user->id]) }}">
                                {{ $displayName }}
                            </a>
                        @endif
                    </p>
                    <p class="address">{{ $property->location }},  {{ $property->area->name }}, {{ $property->city->name }}.</p>
                </div>
            </div>             

            <div class="col-md-4 col-12">
                <div class="price">
                    <div class="right">
                         @php                                       
                            $roomsArray = json_decode($property->rooms, true) ?? [];
                            $propertyTypes = json_decode($property->property_types, true) ?? [];

                            $formatPrice = function ($price) {
                                if ($price >= 10000000) {
                                    return number_format($price / 10000000, 1) . ' Cr';
                                } elseif ($price >= 100000) {
                                    return number_format($price / 100000, 1) . ' Lacs';
                                } else {
                                    return number_format($price);
                                }
                            };
                        @endphp

                        @if(!empty($roomsArray))
                            @foreach($roomsArray as $room)
                                @if(!empty($room['price']))
                                    ₹{{ $formatPrice($room['price']) }} -
                                @endif
                            @endforeach
                        @endif

                        @php
                            $roomsArray = json_decode($property->rooms, true) ?? [];
                            $totalPrice = 0;
                            $totalSize  = 0;

                            foreach ($roomsArray as $room) {
                                $price = isset($room['price']) ? (float) $room['price'] : 0;
                                $size  = isset($room['size']) ? (float) $room['size'] : 0;

                                $totalPrice += $price;
                                $totalSize  += $size;
                            }

                            $overallPricePerSqft = ($totalPrice > 0 && $totalSize > 0)
                                ? round($totalPrice / $totalSize, 2)
                                : 0;
                        @endphp

                        @if($overallPricePerSqft > 0)
                            ₹{{ number_format($overallPricePerSqft) }}/sq.ft.
                        @endif

                        <h3>{{ $property->price }}</h3>
                        <p>EMI starts at 61.56 k</p>
                        <p class="small-text">All Inclusive Price</p> 
                        
                        @if(Auth::check())
                            @if($interestedCount > 1 || $interestedCount == 1)
                                <a href="#" class="btn btn-secondary disabled">You contacted</a>
                            @else
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#longModal_{{ $property->id }}">Contact Seller</a>  
                            @endif                    
                        @else
                            <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Contact Seller</a>
                        @endif
                    </div>

                    <div class="modal fade" id="longModal_{{ $property->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <img alt="" src="{{ asset('uploads/developer/thumb/'.$property->builder->logo) }}" >
                                            </div>
                                            <div class="details-modal">
                                                <h4>{{ $property->builder->name }}</h4>
                                                <p>Developer</p>
                                                <p>+91-{{ $property->builder->mobile }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    Please share your contact
                                </div>
                                <div class="modal-footer">
                                    <a href="javascript:void(0)" onclick="applyProperty({{ $property->id }})" class="btn btn-primary" title="Add to favorites">I'm Interested</a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   

        <div class="media">
            <div class="row">
                @if ($property->property_details_images->count())
                    @php
                        $displayed = $property->property_details_images->count();
                        $total = (int) $property->total_property_images;
                        $remaining = max($total - $displayed, 0);
                    @endphp
                    
                    <div class="col-md-8 col-12">
                        <div class="cover-img">
                            <div class="label">
                                @if ($property->mainImage)
                                    {{ $property->mainImage->label }}
                                @endif
                            </div>
                            <div class="right">
                                <div class="saved"><a href="#">Share</a></div>
                                @if(Auth::check())
                                    @if($saveCount)                                        
                                        <div class="saved"><i class="fa-solid fa-heart saved-icon"></i> Saved</div>
                                    @else
                                        <a href="javascript:void(0)" onclick="saveProperty({{ $property->id }})" class="favorite add-to-favorite user_not_logged_in rh-ui-tooltip"  title="Add to favorites">
                                            <div class="stage">
                                                <div class="heart"></div>
                                            </div>
                                        </a>      
                                        <div id="notification" class="notification">Saved</div>                                         
                                    @endif
                                @else
                                    <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                        <div class="stage">
                                            <div class="heart"></div>
                                        </div>
                                    </a>
                                @endif
                            </div>
                            
                            @if ($property->mainImage)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $property->id }}">
                                    <img src="{{ asset('uploads/property/'.$property->mainImage->image) }}" alt="Main Image" width="100%">
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4 col-12 d-flex flex-column gap-2">
                        @foreach ($property->property_details_images->slice(1, 2) as $propertyImage)
                            <div class="image-wrapper position-relative">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $property->id }}">
                                    <img src="{{ asset('uploads/property/'.$propertyImage->image) }}" alt="Image" width="100%">
                                </a>
                                
                                @if ($loop->last && $remaining > 0)
                                    <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 text-white fw-bold fs-5">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $property->id }}">
                                            +{{ $remaining }} more
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>                   
                @endif
            </div>
        </div>

        <div class="figures">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="center">
                        @php                                       
                            $roomsArray = json_decode($property->rooms, true) ?? [];
                        @endphp

                        @if(!empty($roomsArray))
                            @foreach($roomsArray as $room)
                                {{ isset($room['title']) ? preg_replace('/[^0-9]/', '', $room['title']) : '' }},
                            @endforeach
                        @endif
                        BHK 
                        @php
                            $types = json_decode($property->property_types, true) ?? [];
                        @endphp
                        {{ implode(', ', array_map('ucwords', $types)) }}, 
                        Configurations
                    </div>                    
                </div>
                <div class="col-md-3 col-6">
                    <div class="center">
                        {{ \Carbon\Carbon::parse($property->possession_date)->format('M, Y') }}<br />
                        Possession Starts
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="center">
                        @php
                            $roomsArray = json_decode($property->rooms, true) ?? [];
                            $totalPrice = 0;
                            $totalSize  = 0;

                            foreach ($roomsArray as $room) {
                                $price = isset($room['price']) ? (float) $room['price'] : 0;
                                $size  = isset($room['size']) ? (float) $room['size'] : 0;

                                $totalPrice += $price;
                                $totalSize  += $size;
                            }

                            $overallPricePerSqft = ($totalPrice > 0 && $totalSize > 0)
                                ? round($totalPrice / $totalSize, 2)
                                : 0;
                        @endphp

                        @if($overallPricePerSqft > 0)
                            ₹{{ number_format($overallPricePerSqft) }}/sq.ft.
                        @endif
                        <br />Avg. Price
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="center">
                        @php                                       
                            $roomsArray = json_decode($property->rooms, true) ?? [];
                        @endphp

                        @if(!empty($roomsArray))
                            @foreach($roomsArray as $room)
                                {{ isset($room['size']) ? strtoupper(str_replace('_', ' ', $room['size'])) : '' }} -
                            @endforeach
                            sq.ft.
                        @endif  
                        <p class="m-0">(Super Builtup Area) <br />Sizes</p>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </div>

    <div class="grey-body">
        <div class="overview-tabs">
            <div class="container">
                <ul class="overview-details">
                    <li><a href="#overview" class="nav-link active">Overview</a></li>
                    <li><a href="#highlights" class="nav-link">Highlights</a></li>
                    <li><a href="#aroud-project" class="nav-link">Around This Project</a></li>
                    <li><a href="#floor-plan" class="nav-link">About Project</a></li>                    
                    <li><a href="#amenities" class="nav-link">Amenities</a></li>
                    <li><a href="#more-about" class="nav-link">More About Project</a></li>
                    <li><a href="#about-project" class="nav-link"></a></li>
                    <li><a href="#contact-seller" class="nav-link">Contact Seller</a></li>
                    <li><a href="#about-developer" class="nav-link">About Developer</a></li>
                </ul>
            </div>
        </div>

        <div class="anchor-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-12">
                        <div class="card mb-4" id="overview" >
                            <div class="card-body">
                                <h3>Overview</h3>                            
                                coming
                            </div>                
                        </div>

                        <div class="card mb-4" id="highlights">
                            <div class="card-body">
                                <p>Property Location</p>
                                {{ $property->location }}, {{ $areaSelected->name }}, {{ $citySelected->name }}.
                            </div>                
                        </div>

                        <div class="card mb-4" id="aroud-project">
                            <h5 class="title">{{ $property->title }} Overview</h5>
                            <div class="card-body">                            
                                <div class="row">      
                                    <div class="col-md-4 col-12">
                                        <div class="details">
                                            <div class="icon"></div>
                                            <div class="text">
                                                <p class="small-text">Sizes</p>
                                                @php                                       
                                                    $roomsArray = json_decode($property->rooms, true) ?? [];
                                                @endphp

                                                @if(!empty($roomsArray))
                                                    @foreach($roomsArray as $room)
                                                        {{ isset($room['size']) ? strtoupper(str_replace('_', ' ', $room['size'])) : '' }} -
                                                    @endforeach
                                                    sq.ft.
                                                @endif     
                                            </div>
                                        </div>                                                                             
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="details">
                                            <div class="icon"></div>
                                            <div class="text">
                                                <p class="small-text">Project Size</p>                                        
                                                5 Buildings - 699 units                                        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">  
                                        <div class="details">
                                            <div class="icon"></div>
                                            <div class="text">
                                                <p class="small-text">Launch Date</p>                                 
                                                @php
                                                    $date = \Carbon\Carbon::parse($property->possession_date);
                                                @endphp
                                                {{ $date->year == now()->year ? $date->format('M, Y') : $date->format('M, Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">
                                        <div class="details">
                                            <div class="icon"></div>
                                            <div class="text">
                                                <p class="small-text">Avg. Price</p>
                                                @php
                                                    $roomsArray = json_decode($property->rooms, true) ?? [];
                                                    $totalPrice = 0;
                                                    $totalSize  = 0;

                                                    foreach ($roomsArray as $room) {
                                                        $price = isset($room['price']) ? (float) $room['price'] : 0;
                                                        $size  = isset($room['size']) ? (float) $room['size'] : 0;

                                                        $totalPrice += $price;
                                                        $totalSize  += $size;
                                                    }

                                                    $overallPricePerSqft = ($totalPrice > 0 && $totalSize > 0)
                                                        ? round($totalPrice / $totalSize, 2)
                                                        : 0;
                                                @endphp

                                                @if($overallPricePerSqft > 0)
                                                    ₹{{ number_format($overallPricePerSqft) }}/sq.ft.
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-12">  
                                        <div class="details">
                                            <div class="icon"></div>
                                            <div class="text">
                                                <p class="small-text">Possession Starts</p>                                 
                                                @php
                                                    $date = \Carbon\Carbon::parse($property->possession_date);
                                                @endphp
                                                {{ $date->year == now()->year ? $date->format('M, Y') : $date->format('M, Y') }}
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-4 col-12">
                                        <div class="details">
                                            <div class="icon"></div>
                                            <div class="text">
                                                <p class="small-text">Configurations</p>
                                                @php                                       
                                                    $roomsArray = json_decode($property->rooms, true) ?? [];
                                                @endphp

                                                @if(!empty($roomsArray))
                                                    @foreach($roomsArray as $room)
                                                        {{ isset($room['title']) ? preg_replace('/[^0-9]/', '', $room['title']) : '' }},
                                                    @endforeach
                                                @endif
                                                BHK 
                                                @php
                                                    $types = json_decode($property->property_types, true) ?? [];
                                                @endphp
                                                {{ implode(', ', array_map('ucwords', $types)) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                
                        </div>

                        <div class="card mb-4" id="floor-plan">
                            <h5 class="title">Price & Floor Plan</h5>

                            <div class="card-body"> 
                                 @php                                       
                                    $roomsArray = json_decode($property->rooms, true) ?? [];
                                    $propertyTypes = json_decode($property->property_types, true) ?? [];

                                    $formatPrice = function ($price) {
                                        if ($price >= 10000000) {
                                            return number_format($price / 10000000, 1) . ' Cr';
                                        } elseif ($price >= 100000) {
                                            return number_format($price / 100000, 1) . ' Lacs';
                                        } else {
                                            return number_format($price);
                                        }
                                    };
                                @endphp

                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    @if(!empty($roomsArray))
                                        @foreach($roomsArray as $index => $room)
                                            @php
                                                $tabId = 'room-tab-'.$index;
                                                $paneId = 'room-pane-'.$index;
                                            @endphp

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $tabId }}" data-bs-toggle="pill" 
                                                    data-bs-target="#{{ $paneId }}" type="button" role="tab" aria-controls="{{ $paneId }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                                    {{ isset($room['title']) ? strtoupper(str_replace('_', ' ', $room['title'])) : '' }}
                                                    @if(!empty($room['price']))
                                                        <br>₹{{ $formatPrice($room['price']) }}
                                                    @endif
                                                </button>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>

                                <div class="tab-content" id="roomTabContent">
                                    @foreach($roomsArray as $index => $room)
                                        @php $paneId = 'room-pane-'.$index; @endphp
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $paneId }}" role="tabpanel" aria-labelledby="room-tab-{{ $index }}">
                                            <div class="room-item">
                                                @if(!empty($room['size']))
                                                    <p>{{ strtoupper(str_replace('_', ' ', $room['size'])) }} sq.ft.</p>
                                                @endif

                                                @if(!empty($room['price']))
                                                    <p class="price">₹{{ $formatPrice($room['price']) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4" id="floor-plan">
                            <h5 class="title">Photos & Videos: Tour this project virtually</h5>

                            <div class="card-body"> 
                                <h6 class="mb-3">Project Tour & Photos</h6>
                                <div class="row">
                                    <div class="col-md-3">
                                        @if ($property->mainImage)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $property->id }}">
                                                <img src="{{ asset('uploads/property/'.$property->mainImage->image) }}" alt="Main Image" width="100%" class="rounded" >
                                            </a>                                            
                                        @endif 

                                        @include('front.home.results.modal')
                                    </div>

                                    @foreach ($property->property_details_images->take(4) as $propertyImage)
                                        <div class="col-md-3 position-relative">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $property->id }}">
                                                <img src="{{ asset('uploads/property/'.$propertyImage->image) }}" alt="Image" width="100%" class="rounded">
                                            </a>
                                            
                                            @if ($loop->last && $remaining > 0)
                                                <div class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 text-white fw-bold fs-5">
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $property->id }}">
                                                        +{{ $remaining }} more
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4" id="amenities">
                            <h5 class="title">Project Amenities</h5>
                            <div class="card-body"> 
                                @php
                                    $amenitiesArray = json_decode($property->amenities, true) ?? [];
                                @endphp

                                @if(!empty($amenitiesArray))
                                    <div class="row" id="amenities-wrapper">
                                        @foreach($amenitiesArray as $index => $amenity)
                                            <div class="col-md-2 mb-2 amenity-item {{ $index > 10 ? 'd-none extra-amenity' : '' }}">
                                                <div class="amenities-data">
                                                    <div class="icon"></div>
                                                    {{ \Illuminate\Support\Str::limit(ucwords(str_replace('_', ' ', $amenity)), 15, '...') }}
                                                </div>
                                            </div>
                                        @endforeach

                                        @if(count($amenitiesArray) > 11)
                                            <div class="col-md-2 mb-2" id="show-more-box">
                                                <div class="more-less">
                                                    <a href="#" id="toggle-link">
                                                        +{{ count($amenitiesArray) - 11 }}<br />More
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card mb-4" id="amenities">
                            <h5 class="title">Contact Sellers</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10 col-9">
                                        <div class="developer-details">
                                            @if ($property->builder && $property->builder->image)
                                                <img src="{{ asset('uploads/developer/' . $property->builder->image) }}" class="logo" >
                                                <div class="name">
                                                    <p class="builder_name">{{ $property->builder->developer_name }}</p>
                                                    <p class="mb-1">{{ $property->user->role }}</p>  

                                                     @php                                       
                                                        $roomsArray = json_decode($property->rooms, true) ?? [];                                                        

                                                        $formatPrice = function ($price) {
                                                            if ($price >= 10000000) {
                                                                return number_format($price / 10000000, 1) . ' Cr';
                                                            } elseif ($price >= 100000) {
                                                                return number_format($price / 100000, 1) . ' Lacs';
                                                            } else {
                                                                return number_format($price);
                                                            }
                                                        };
                                                    @endphp

                                                    @if(!empty($roomsArray))
                                                        @foreach($roomsArray as $room)                                                            
                                                            @if(!empty($room['price']))
                                                                <b>₹ {{ $formatPrice($room['price']) }} -</b>
                                                            @endif                                                            
                                                        @endforeach
                                                    @endif
                                                </div>                                  
                                            @else
                                                <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="logo" />
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-3">
                                        @if(Auth::check())
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#longModal_{{ $property->id }}">Contact</a>  
                                        @else
                                            <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-sm">Contact</a>
                                        @endif                                          
                                    </div>
                                </div>                                
                            </div>
                        </div>

                        <div class="property-modal-developer">
                            <div class="card">
                                <div class="card-body">
                                    <p>Contact Sellers in</p>
                                    <div class="developer">
                                        @if ($property->builder && $property->builder->image)
                                            <img src="{{ asset('uploads/builder/' . $property->builder->image) }}" class="logo" >
                                            <p class="builder_name">{{ $property->builder->developer_name }}</p>
                                        @else
                                            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" height="80" class="logo" />
                                        @endif
                                    </div>
                                    <div class="form">
                                        <p class="small-font">Please share your contact</p>
                                    </div>
                                </div>
                            </div>
                            <div class="btm-text">
                                <span>I agree to be contacted by Housing and agents via</span>, WhatsApp, SMS, phone, email etc</span>
                                <button class="btn btn-primary">Get Contact Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-12">1</div>
                </div>
                </div>
            </div>
        </div>

        <a href="#header" class="btn btn-primary">Top</a>
        
        {!! nl2br($property->description) !!}  
    </div>    
@endsection

@section('customJs')
<script type="text/javascript">

    $(document).ready(function() {
        let expanded = false;
        const hiddenCount = $(".extra-amenity").length;

        $("#toggle-link").on("click", function(e) {
            e.preventDefault();

            if (!expanded) {
                // Expand
                $(".extra-amenity").removeClass("d-none");
                $(this).text("Less");
                $("#show-more-box div").contents().first()[0].textContent = ""; // remove +X
            } else {
                // Collapse
                $(".extra-amenity").addClass("d-none");
                $(this).text("More");
                $("#show-more-box div").contents().first()[0].textContent = "+" + hiddenCount + " ";
            }
            
            expanded = !expanded;
        });
    });



    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

         $(".nav-link.active").removeClass("active"); // remove from old
        $(this).addClass("active"); // add to clicked

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 1500);
    });



    function applyProperty(id){
        $.ajax({
            url: '{{ route("applyProperty") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                window.location.href = "{{ url()->current() }}";
            }
        });
    }

   

    function saveProperty(propertyId) {
        $.ajax({
            url: '/save-property',
            type: 'POST',
            data: {
                property_id: propertyId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'saved') {
                    showNotification('Saved', 'success');
                } else if (response.status === 'removed') {
                    alert('Property Removed');
                }
                location.reload();
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
    }

    function showNotification(message, type = 'success') {
        let notification = $('#notification');
        notification.removeClass('success info error').addClass(type).text(message).fadeIn();

        setTimeout(() => {
            notification.fadeOut();
        }, 1000); 
    }
</script>

@endsection