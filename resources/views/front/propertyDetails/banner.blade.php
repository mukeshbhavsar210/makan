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
                      {{-- <a href="" class="rh-ultra-status rh-ultra-property-tag">{{ $property->saleType->name }}</a>                       --}}
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
                   @if($count > 1 || $count == 1)
                   <span class=" add-to-favorite" >
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
   