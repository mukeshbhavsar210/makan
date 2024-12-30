@extends('front.layouts.app')

@section('main')

<div class="rh-ultra-property-wrapper rh-ultra-content-container">
   
   @include('front.propertyDetails.banner')

<section class="section-4 bg-2">
   @include('front.message')
   
   Added on: {{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}

   @if(Auth::check())
      <a href="#" onclick="saveProperty({{ $job->id }})" class="btn btn-secondary">Save Property</a>
   @else
      <a href="javascript:void()" class="btn btn-secondary disabled">Login to Save</a>
   @endif

   @if(Auth::check())
      <a href="#" onclick="applyProperty({{ $job->id }})" class="btn btn-primary">Apply</a>
   @else
      <a href="javascript:void()" class="btn btn-primary disabled">Login to Apply</a>
   @endif
           
       {{-- @if (Auth::user())
           @if (Auth::user()->id == $job->user_id)               
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
             <h4 class="rh_property__heading">
                Overview    
             </h4>
             <span class="rh-overview-separator">|</span>
             <div class="rh-property-id">
                <span>
                Property ID :        </span>
                <span>RH-2015-06</span>
             </div>
             <span class="rh-ultra-featured">
             Featured            </span>
          </div>

          @include('front.propertyDetails.moreDetails')
          
          <div class="rh-content-wrapper">
             <h4 class="rh_property__heading">Description</h4>
             <div class="rh_content margin-bottom-40px">
               {!! nl2br($job->description) !!}
             </div>
          </div>

          <div class="rh-property-additional-details-wrapper">
             <h4 class="rh_property__heading rh_property__additional_details">Additional Details</h4>
             <ul class="rh_property__additional margin-bottom-40px clearfix">
                <li>
                   <span class="title">BEDROOM FEATURES:</span>
                   <span class="value">Main Floor Master Bedroom, Walk-In Closet</span>
                </li>                
             </ul>
          </div>

          <div class="rh_property__features_wrap margin-bottom-40px">
             <h4 class="rh_property__heading">Features</h4>
             <ul class="rh_property__features arrow-bullet-list">
                <li class="rh_property__feature" id="rh_property__feature_32">
                   <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" xml:space="preserve">
                      <path d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" opacity=".3" fill-rule="evenodd" clip-rule="evenodd"></path>
                      <path class="rh-ultra-light rh-ultra-stroke-dark" d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" clip-rule="evenodd" fill="none" stroke="#000" stroke-width="1.5"></path>
                      <path class="rh-ultra-stroke-dark" d="m5.7 12 3 3 7-8" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                   </svg>
                   <a href="https://ultra.realhomes.io/property-feature/2-stories/">2 Stories</a>
                </li>
                <li class="rh_property__feature" id="rh_property__feature_48">
                   <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" xml:space="preserve">
                      <path d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" opacity=".3" fill-rule="evenodd" clip-rule="evenodd"></path>
                      <path class="rh-ultra-light rh-ultra-stroke-dark" d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" clip-rule="evenodd" fill="none" stroke="#000" stroke-width="1.5"></path>
                      <path class="rh-ultra-stroke-dark" d="m5.7 12 3 3 7-8" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                   </svg>
                   <a href="https://ultra.realhomes.io/property-feature/home-theater/">Home Theater</a>
                </li>
                <li class="rh_property__feature" id="rh_property__feature_39">
                   <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" xml:space="preserve">
                      <path d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" opacity=".3" fill-rule="evenodd" clip-rule="evenodd"></path>
                      <path class="rh-ultra-light rh-ultra-stroke-dark" d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" clip-rule="evenodd" fill="none" stroke="#000" stroke-width="1.5"></path>
                      <path class="rh-ultra-stroke-dark" d="m5.7 12 3 3 7-8" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                   </svg>
                   <a href="https://ultra.realhomes.io/property-feature/lawn/">Lawn</a>
                </li>
                <li class="rh_property__feature" id="rh_property__feature_40">
                   <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" xml:space="preserve">
                      <path d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" opacity=".3" fill-rule="evenodd" clip-rule="evenodd"></path>
                      <path class="rh-ultra-light rh-ultra-stroke-dark" d="M11 .8C16.7.8 21.3 5.4 21.3 11S16.7 21.2 11 21.2C5.3 21.2.8 16.7.8 11S5.3.8 11 .8z" clip-rule="evenodd" fill="none" stroke="#000" stroke-width="1.5"></path>
                      <path class="rh-ultra-stroke-dark" d="m5.7 12 3 3 7-8" fill="none" stroke="#000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                   </svg>
                   <a href="https://ultra.realhomes.io/property-feature/marble-floors/">Marble Floors</a>
                </li>
             </ul>
          </div>

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
