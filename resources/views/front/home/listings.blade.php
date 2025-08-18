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
                                    {{-- @if(Auth::check())
                                        @if(in_array($value->id, $savedPropertyIds))
                                            <span class="add-to-favorite">
                                                <span class="add-to-favorite" >
                                                    <svg width="24" height="24" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet">
                                                    <path d="M93.99 8.97c-21.91 0-29.96 22.39-29.96 22.39s-7.94-22.39-30-22.39c-16.58 0-35.48 13.14-28.5 43.01c6.98 29.87 58.56 67.08 58.56 67.08s51.39-37.21 58.38-67.08c6.98-29.87-10.56-43.01-28.48-43.01z" fill="#f44336"></path>
                                                    <g fill="#c33">
                                                        <path d="M30.65 11.2c17.2 0 25.74 18.49 28.5 25.98c.39 1.07 1.88 1.1 2.33.06L64 31.35C60.45 20.01 50.69 8.97 34.03 8.97c-6.9 0-14.19 2.28-19.86 7.09c5.01-3.29 10.88-4.86 16.48-4.86z"></path>
                                                        <path d="M93.99 8.97c-5.29 0-10.11 1.15-13.87 3.47c2.64-1.02 5.91-1.24 9.15-1.24c16.21 0 30.72 12.29 24.17 40.7c-5.62 24.39-38.46 53.98-48.49 65.27c-.64.72-.86 1.88-.86 1.88s51.39-37.21 58.38-67.08c6.98-29.86-10.53-43-28.48-43z"></path>
                                                    </g>
                                                        <path d="M17.04 24.82c3.75-4.68 10.45-8.55 16.13-4.09c3.07 2.41 1.73 7.35-1.02 9.43c-4 3.04-7.48 4.87-9.92 9.63c-1.46 2.86-2.34 5.99-2.79 9.18c-.18 1.26-1.83 1.57-2.45.46c-4.22-7.48-5.42-17.78.05-24.61z" fill="#ff8a80"></path>
                                                        <path d="M77.16 34.66c-1.76 0-3-1.7-2.36-3.34c1.19-3.02 2.73-5.94 4.58-8.54c2.74-3.84 7.95-6.08 11.25-3.75c3.38 2.38 2.94 7.14.57 9.44c-5.09 4.93-11.51 6.19-14.04 6.19z" fill="#ff8a80"></path>
                                                    </svg>
                                                </span>
                                            </span>
                                        @else
                                            <a href="javascript:void(0)" onclick="saveProperty({{ $value->id }})" class="favorite add-to-favorite user_not_logged_in" data-propertyid="{{ $value->id }}"  title="Add to favorites">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                    <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                                                    <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    @else
                                        <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                                                <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                                            </svg>
                                        </a>
                                    @endif --}}

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