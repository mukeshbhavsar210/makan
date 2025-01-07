<div class="rh-ultra-property-slider-wrapper">
    <div class="rh-ultra-property-slider-container">      
      <div class="slider-for"> 
            @if ($properties->property_images)
               @foreach ($properties->property_images as $key => $propertyImage)
                  <div class="rh-ultra-property-slider" >
                     <img class="w-100 h-100" src="{{ asset('uploads/property/large/'.$propertyImage->image) }}" alt="Image">
                  </div>
               @endforeach
            @endif                   
      </div>
       
       <div class="rh-ultra-property-thumb-box">
          <div class="rh-ultra-property-thumb-container">
             <div class="rh-ultra-thumb-info-box">
                <div class="page-head-inner">
                   <div class="rh-ultra-property-tags rh-property-title">
                      <a href="" class="rh-ultra-status rh-ultra-property-tag">{{ $property->saleType->name }}</a>                      
                      <span class="rh_ultra_featured rh-ultra-property-tag">{{ $property->category->name }}</span>                      
                   </div>
                   <div class="rh-ultra-property-title-price">
                      <h1 class="property-title">{{ $property->title }}</h1>
                      <div class="rh-ultra-property-tag-wrapper">
                         <span class="rh-ultra-price "> {{ $property->price }} </span>
                      </div>
                   </div>

                   <p class="rh-ultra-property-address">
                      <span class="rh-ultra-address-pin">
                         <svg xmlns="http://www.w3.org/2000/svg" viewBox="5 2 14 20">
                            <path d="M12 4C9.2 4 7 6.2 7 9c0 2.9 2.9 7.2 5 9.9 2.1-2.7 5-7 5-9.9C17 6.2 14.8 4 12 4zM12 11.5c-1.4 0-2.5-1.1-2.5-2.5s1.1-2.5 2.5-2.5 2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" fill="#1db2ff" class="rh-ultra-dark" style="opacity:0.24;"></path>
                            <path d="M12 2C8.1 2 5 5.1 5 9c0 5.3 7 13 7 13s7-7.8 7-13C19 5.1 15.9 2 12 2zM7 9c0-2.8 2.2-5 5-5s5 2.2 5 5c0 2.9-2.9 7.2-5 9.9C9.9 16.2 7 11.9 7 9z" fill="#1db2ff" class="rh-ultra-dark"></path>
                            <circle cx="12" cy="9" r="2.5" fill="#1db2ff" class="rh-ultra-dark"></circle>
                         </svg>
                      </span>
                      {{ $property->location }}          
                   </p>
                </div>
             </div>

             <div class="rh-ultra-thumb-action-box rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
                <span class="favorite-btn-wrap favorite-btn-45">
                   <span class="favorite-placeholder highlight__red hide user_not_logged_in rh-ui-tooltip " data-propertyid="45" title="Added to favorites">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                         <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                      </svg>
                   </span>
                   <a href="javascript:void(0)" onclick="saveProperty({{ $property->id }})" class="favorite add-to-favorite user_not_logged_in rh-ui-tooltip {{ ($count == 1) ? 'saved-job' : '' }}" data-propertyid="45" title="Add to favorites">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                         <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                         <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                      </svg>
                   </a>
                </span>

                <div class="rh-ultra-share-wrapper">
                   <a href="#" class="rh-ultra-share share rh-ui-tooltip" title="Share">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2">
                         <circle cx="18" cy="5" r="3"></circle>
                         <circle cx="6" cy="12" r="3"></circle>
                         <circle cx="18" cy="19" r="3"></circle>
                         <path d="m8.59 13.51 6.83 3.98M15.41 6.51l-6.82 3.98"></path>
                      </svg>
                   </a>                   
                </div>
             </div>
          </div>
       </div>
    </div>

    <div class="rh-ultra-property-carousel-wrapper"> 
      <div class="slider-nav">
         @if ($properties->property_images)
            @foreach ($properties->property_images as $key => $propertyImage)
               <div><img style="width: 200px" src="{{ asset('uploads/property/small/'.$propertyImage->image) }}" alt="Image"></div>
            @endforeach
         @endif         
      </div>
       
       <div class="rh-ultra-thumb-count">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
             <style type="text/css">
                .rh-photo-st0{fill-rule:evenodd;clip-rule:evenodd;}
             </style>
             <path class="rh-ultra-black rh-photo-st0" d="M3 5h12c1.1 0 2 0.9 2 2v8c0 1.1-0.9 2-2 2H3c-1.1 0-2-0.9-2-2V7C1 5.9 1.9 5 3 5zM7.7 1h2.8c0.8-0.2 1.7 0.4 1.8 1.2 0 0 0 0.1 0 0.1L13 5H5l0.7-2.7C5.9 1.4 6.8 0.8 7.7 1zM9 7.4c2.2 0 4 1.8 4 4s-1.8 4-4 4 -4-1.8-4-4S6.8 7.4 9 7.4zM9 9c1.3 0 2.4 1.1 2.4 2.4s-1.1 2.4-2.4 2.4 -2.4-1.1-2.4-2.4S7.7 9 9 9L9 9zM8.2 2.6h1.6c0.4 0 0.8 0.4 0.7 0.9 0 0.4-0.3 0.7-0.7 0.7H8.2c-0.4 0-0.8-0.3-0.9-0.7 0-0.4 0.3-0.8 0.7-0.9C8.1 2.6 8.2 2.6 8.2 2.6z"></path>
          </svg>
          <span class="rh-slider-item-total">6</span>
          <span class="rh-more-slides">Photos</span>
       </div>
    </div>
 </div>
   