@extends('front.layouts.app')

@section('main')

<div class="container">
    <ul class="breadcrumb">
        <li><a href="{{ route('front.home') }}">Home</a></li>
        <li><a href="http://127.0.0.1:8000/properties?city=1">{{ $property->city->name }}</a></li>
        <li><a href="http://127.0.0.1:8000/properties?city=1&area=1">{{ $property->area->name }}</a></li>
        <li>{{ $property->title }}</li>
    </ul>

    <div class="property-individuals">

        @include('admin.layouts.message')  

        <div class="row">
            <div class="col-md-9 col-12">
                <div class="first">
                    <h2>{{ $property->title }}</h2>
                    <p>By <a href="#" class="link">{{ $property->builder->name }}</a></p>
                    {{-- <p class="address">{{ $property->location }}, {{ $property->category->name }}, {{ $property->area->name }}, {{ $property->city->name }}.</p> --}}

                    @if(Auth::check())
                        @if($saveCount > 1 || $saveCount == 1)
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
                        @else
                            <a href="javascript:void(0)" onclick="saveProperty({{ $property->id }})" class="favorite add-to-favorite user_not_logged_in rh-ui-tooltip" data-propertyid="45" title="Add to favorites">
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
                    @endif
                </div>
            </div>             

            <div class="col-md-3 col-12">
                <div class="price">
                    <div class="right">
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
                            <a href="http://127.0.0.1:8000/account/login" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-secondary">Login to Apply</a>                            
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
                        @if ($properties->property_images)
                            @foreach ($properties->property_images as $key => $propertyImage)
                                <img src="{{ asset('uploads/property/large/'.$propertyImage->image) }}" alt="Image">    
                            @endforeach
                        @endif  
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
    {{-- <p>
    @if(!empty($property->bathroom->title))
        {{ $property->bathroom->title }}
    @endif 
    </p>

    <p>
        @if(!empty($property->year_build))
            {{ $property->year_build }}
        @endif
    </p> --}}
</div>
             
        
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

       @include('front.home.details.form')
    
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
@endsection
