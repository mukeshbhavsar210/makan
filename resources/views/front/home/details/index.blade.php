@extends('front.layouts.app')

@section('hideHeader') @endsection

@include('front.layouts.header')

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
        @include('admin.layouts.message')  

        <div class="row">
            <div class="col-md-8 col-12">
                <div class="first">
                    <h2>{{ $property->title }}</h2>
                    <p>By <a href="#" class="link">{{ $property->builder->developer_name }}</a></p>

                    
                    <p class="address">{{ $property->location }},  {{ $property->area->name }}, {{ $property->city->name }}.</p>
                    
                     @if(Auth::check())
                        @if($saveCount)
                            <i class="fa-solid fa-heart saved"></i>
                        @else
                            <a href="javascript:void(0)" onclick="saveProperty({{ $property->id }})" class="favorite add-to-favorite user_not_logged_in rh-ui-tooltip"  title="Add to favorites">
                                <i class="fa-regular fa-heart save-icon"></i>
                            </a>      
                            <div id="notification" class="notification">Saved</div>                                         
                        @endif
                    @else
                        <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" >
                            <i class="bi bi-heart" style="color: black; font-size: 20px;"></i>
                        </a>
                    @endif
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
                                                <img alt="" src="{{ asset('uploads/builder/'.$property->builder->logo) }}" >
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
                <div class="col-md-7 col-12">

                </div>
                <div class="col-md-5 col-12">
                    <div class="propertyMedia">
                        {{-- @if ($properties->property_images)
                            @foreach ($properties->property_images as $key => $propertyImage)
                                <img src="{{ asset('uploads/property/large/'.$propertyImage->image) }}" alt="Image">    
                            @endforeach
                        @endif   --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="figures">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="center">
                        {{-- <p>
                            @if(!empty($property->room->title))
                                {{ $property->room->title }}
                            @endif 
                            @if(!empty($property->category->type))
                                {{ $property->category->type }}
                            @endif 
                            <br />Configuration
                        </p> --}}
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
                        Price on request <br />Avg. Price
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="center">
                        <p>
                            @if(!empty($property->size))
                                {{ $property->size }} sq.yd.
                            @endif
                            @if(!empty($property->total_area))
                                {{ $property->total_area }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
     </div>

     <div>Details</div>
        
    @if (!empty($relatedAmenities))
        <h4>Amenities Details</h4>
        <ul>
            @foreach ($relatedAmenities as $value)  
                <li>{{ $value->title }}</li>    
            @endforeach
        </ul>            
    @endif        
        <span>Added on:</span>
        <span> {{ \Carbon\Carbon::parse($property->created_at)->format('d M, Y') }}</span>
             
        {!! nl2br($property->description) !!}  
            
        @if (!empty($relatedProperties))
            <h4>Similar Properties</h4>
            <div class="row">
                @foreach ($relatedProperties as $value)                                
                    <div class="col-md-3">
                        @php
                            $propertyImage = $value->property_images->first();
                        @endphp
                    
                        <a href="{{ $value->id }}">
                            @if (!empty($propertyImage->image))
                                <img class="card-img-top" src="{{ asset('uploads/property/small/'.$propertyImage->image) }}" >
                            @else
                                <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" />
                            @endif
                        </a>                            
                        {{ $value->title }}
                    </div>
                @endforeach
            </div>
        @endif   
       </div>
    </div>
    {{-- @include('front.propertyDetails.similarProperty')       --}}
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