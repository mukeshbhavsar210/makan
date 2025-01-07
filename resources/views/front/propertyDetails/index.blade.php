@extends('front.layouts.app')

@section('main')

<div class="rh-ultra-property-wrapper rh-ultra-content-container">
   
   @include('front.propertyDetails.banner')

<section class="section-4 bg-2">
   @include('admin.layouts.message')
   
           
       {{-- @if (Auth::user())
           @if (Auth::user()->id == $property->user_id)               
               @if ($applications->isNotEmpty())
                   @foreach ($applications as $application)
                           <p>{{ $application->user->name }}</p>
                           <p>{{ $application->user->email }}</p>
                           <p>{{ $application->user->mobile }}</p>
                           <p>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}</p>
                   @endforeach
                   @else
                     <div>People not found</div>
               @endif
           @endif
       @endif --}}

    <div class="rh-ultra-property-content">
       <div class="rh-ultra-property-content-box">
          <div class="rh-ultra-overview-box">
             <h4 class="rh_property__heading">Overview</h4>
             <a href="javascript:void(0)" onclick="saveProperty({{ $property->id }})" class=" {{ ($count == 1) ? 'saved-job' : '' }}" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                   <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                   <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                </svg>
             </a>
             <span class="rh-overview-separator">|</span>
             <div class="rh-property-id">
                <span>Added on:</span>
                <span> {{ \Carbon\Carbon::parse($property->created_at)->format('d M, Y') }}</span>
             </div>
            
          </div>

          @include('front.propertyDetails.moreDetails')
          
          <div class="rh-content-wrapper">
             <h4 class="rh_property__heading">Description</h4>

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
