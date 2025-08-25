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

        @include('front.home.search') 
        @include('front.home.login')
        @include('front.home.search_slide')
                    
        <div class="overlay"></div>
    </div>
</header>

@section('main')

@include('front.home.filters')

<div class="body-details">
    <div class="row">
        <div class="col-md-8 col-12">
            @include('front.home.breadcrumb')

            @if ($properties->isNotEmpty())
                @foreach ($properties as $value)      
                    <div class="propery-listings">                        
                        <div class="picture">
                            <div class="media-overlay" data-bs-toggle="modal" data-bs-target="#big-modal_{{ $value->id }}"></div>
                            <div class="listing-gallery" >                                
                                @if ($value->property_images && $value->property_images->count())
                                    @foreach ($value->property_images->take(4) as $propertyImage)
                                        <img src="{{ asset('uploads/property/large/'.$propertyImage->image) }}" alt="Image">
                                    @endforeach
                                @endif                               
                            </div>
                        </div>

                        @include('front.home.modal')
                        
                        <div class="details">
                            <a href="{{ route('propertyDetails', $value->id) }}" class="product-link">
                                <div class="first-group">
                                    <div class="left">                                        
                                        <h3 class="title">{{ $value->title }}
                                            <div class="rera" style="{{ empty($value->rera) ? 'display:none;' : '' }}">
                                                <img class="icon" src="{{ asset('front-assets/images/tick.svg') }}" /> RERA
                                            </div>
                                        </h3>                                                                            
                                        <p>
                                            @php
                                                $roomsArray = json_decode($value->rooms, true) ?? [];
                                                $titles = array_column($roomsArray, 'title');
                                            @endphp

                                            {{ implode(', ', $titles) }}

                                            BHK  in {{ $value->area->name }}.</p>
                                    </div>
                                    <div class="right">
                                        @if ($value->category == 'Rent')
                                            <span class="rh-ultra-featured">{{ $value->category }}</span>
                                        @else
                                            <span class="rh-ultra-hot">{{ $value->category }}</span>
                                        @endif
                                    </div>                                                                                                 
                                </div>  

                                <div class="second-group">
                                    @php                                       
                                        $roomsArray = json_decode($value->rooms, true) ?? [];
                                        $propertyTypes = json_decode($value->property_types, true) ?? [];
                                    @endphp

                                    @if(!empty($roomsArray))
                                        @foreach($roomsArray as $room)
                                            <div class="room-item">
                                                <p>
                                                    {{ $room['title'] ?? '' }} BHK
                                                </p>

                                                @if(!empty($room['price']))
                                                    <p class="price">₹{{ number_format($room['price']) }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="third-group">
                                    <p>Sizes: {{ $value->size }} sq.yd. {{ $value->handover_status }} Possession: {{ \Carbon\Carbon::parse($value->possession_date)->format('M, Y') }}</p>
                                </div>                        
                            </a>

                            <div class="developer">
                                <div class="branding">
                                    <img alt="" class="logo" src="{{ asset('uploads/builder/'.$value->builder->logo) }}" >
                                    <div class="name">
                                        <p class="builder_name">{{ $value->builder->name }}</p>
                                        <p>{{ $value->user->role }}</p>  
                                    </div>                                  
                                </div>

                               @if(Auth::check())
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#longModal_{{ $value->id }}">Contact</a>  
                                @else
                                    <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">Contact</a>
                                @endif                                                                

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

<script type="text/javascript">
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

    function saveProperty(id){
        $.ajax({
            url: '{{ route("saveProperty") }}',
            type: 'post',
            data: {id:id},
            dataType: 'json',
            success: function(response){
                window.location.href = "{{ url()->current() }}";
            }
        });
    }
</script>

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

    updateDropdownLabel('#propertyTypeDropdown', 'input[name="property_type[]"]', 'Property Type');
    updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
    updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
    updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');    
    updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
    updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
});

// Initialize all dropdown labels on page load
updateDropdownLabel('#propertyTypeDropdown', 'input[name="property_type[]"]', 'Property Type');
updateDropdownLabel('#roomDropdown', 'input[name="room[]"]', 'BHK Type');
updateDropdownLabel('#bathroomDropdown', 'input[name="bathroom[]"]', 'Bathrooms');
updateDropdownLabel('#listedTypeDropdown', 'input[name="listed_type[]"]', 'Listed By');
updateDropdownLabel('#facingDropdown', 'input[name="facing[]"]', 'Facings');
updateDropdownLabel('#areasDropdown', 'input[name="areas[]"]', 'Areas');
updateDropdownLabel('#saletypeDropdown', 'input[name="saletype"]', 'Sale Type');
updateDropdownLabel('#constructionDropdown', 'input[name="construction_type"]', 'Construction Type');

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