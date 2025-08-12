@extends('front.layouts.app')

@section('main')

<div class="rh-ultra-property-wrapper rh-ultra-content-container">
    @include('admin.layouts.message')
    @include('front.propertyDetails.banner')

<section class="section-4 bg-2">
    <div class="rh-ultra-property-content">
       <div class="rh-ultra-property-content-box">
          <div class="rh-ultra-overview-box">
            <h4 class="rh_property__heading">Overview</h4>
          </div>

          @include('front.propertyDetails.moreDetails')
          
          <div class="rh-content-wrapper">
             <h4 class="rh_property__heading">Description</h4>
             <div class="rh-property-id">
                <span>Added on:</span>
                <span> {{ \Carbon\Carbon::parse($property->created_at)->format('d M, Y') }}</span>
             </div>

             <div class="rh_content margin-bottom-40px">
             {!! nl2br($property->description) !!}  
            
            @if (!empty($relatedProperties))
                <h4 class="rh_property__heading">Similar Properties</h4>
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
          
        @if (!empty($relatedAmenities))
            <div class="rh_property__features_wrap margin-bottom-40px">
                <h4 class="rh_property__heading">Amenities Details</h4>
                <ul class="rh_property__features arrow-bullet-list">
                    @foreach ($relatedAmenities as $value)  
                    <li class="rh_property__feature">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" xml:space="preserve">
                            <path d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" opacity=".3" fill-rule="evenodd" clip-rule="evenodd"></path>
                            <path class="rh-ultra-light rh-ultra-stroke-dark" d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" clip-rule="evenodd" fill="none" stroke="#000" stroke-width="1.5"></path>
                            <path class="rh-ultra-stroke-dark" d="m5.7 12 3 3 7-8" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>                              
                        {{ $value->title }}
                    </li>    
                    @endforeach
                </ul>
            </div>
        @endif
            
          @include('front.propertyDetails.attachments')

          {{-- @include('front.propertyDetails.floorPlan')
          @include('front.propertyDetails.video')
          @include('front.propertyDetails.virtualTour')
          @include('front.propertyDetails.visit')
          @include('front.propertyDetails.comments') --}}

       </div>
       @include('front.propertyDetails.form')
    </div>
    {{-- @include('front.propertyDetails.similarProperty')       --}}
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
@endsection
