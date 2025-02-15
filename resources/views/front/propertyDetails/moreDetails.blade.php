<div class="rh_ultra_prop_card_meta_wrap margin-bottom-40px">
    <div class="rh_ultra_prop_card__meta">
       <div class="rh_ultra_meta_icon_wrapper">
          <span class="rh-ultra-meta-label">Bedrooms</span>
          <div class="rh-ultra-meta-icon-wrapper">
             <span class="rh_ultra_meta_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                   <path class="ultra-meta rh-ultra-light" d="M2.6 23c-0.6 0-1-0.2-1.3-0.6C1 22.1 0.9 21.7 1 21.3L2.2 9.9C2.3 9.5 3.1 9 3.9 9h16.1c0.9 0 1.6 0.5 1.7 0.9L23 21.2c0.1 0.5 0 0.9-0.3 1.2 -0.3 0.4-0.8 0.6-1.3 0.6H2.6zM14.9 5c-0.5 0-0.8-0.1-0.9-0.3 0-0.1 0-0.2 0-0.2l0-3.3C14.2 1.1 14.6 1 15.6 1h3.9c0.7 0 1.2 0.4 1.2 0.5L21 4.6l0 0.1C20.9 4.9 20.5 5 20.1 5H14.9zM3.9 5C3.5 5 3.1 4.9 3 4.7c0 0 0-0.1 0-0.1l0.4-3.1C3.4 1.4 3.9 1 4.6 1h3.9c1 0 1.4 0.1 1.6 0.2l0 3.2C9.7 4.7 8.8 5 8.1 5H3.9z"></path>
                   <path class="ultra-meta rh-ultra-dark" d="M19.4 2c0.1 0 0.2 0 0.3 0l0.2 2H15l0-2c0.2 0 0.3 0 0.6 0H19.4M8.4 2C8.7 2 8.9 2 9 2l0 1.8C8.7 3.9 8.4 4 8.1 4h-4l0.2-2c0.1 0 0.2 0 0.3 0H8.4M20.1 10c0.3 0 0.6 0.1 0.7 0.2L22 21.3c0 0 0 0.1 0 0.1 0 0.2 0 0.3-0.1 0.3 -0.1 0.1-0.3 0.2-0.6 0.2H2.6c-0.3 0-0.5-0.1-0.6-0.2C2 21.7 2 21.7 2 21.5c0 0 0-0.1 0-0.1l1.2-11.1C3.3 10.1 3.6 10 3.9 10H20.1M19.4 0h-3.9C14.5 0 13 0.1 13 1l0 3.5C12.8 5.3 13.7 6 14.9 6h5.2c1.2 0 2.1-0.7 1.9-1.5l-0.4-3.1C21.5 0.6 20.5 0 19.4 0L19.4 0zM8.4 0H4.6C3.5 0 2.5 0.6 2.4 1.3L2 4.5C1.9 5.3 2.7 6 3.9 6h4.2c1.2 0 3.1-0.7 2.9-1.5L11 1C11 0.1 9.5 0 8.4 0L8.4 0zM20.1 8H3.9C2.6 8 1.4 8.8 1.3 9.8L0 21.1C-0.2 22.7 0.9 24 2.6 24h18.7c1.7 0 2.9-1.3 2.6-2.9L22.7 9.8C22.6 8.8 21.4 8 20.1 8L20.1 8z"></path>
                </svg>
             </span>
             <span class="rh_ultra_meta_box">
             <span class="figure"> 
                  @if (!empty($relatedRooms))
                        @foreach ($relatedRooms as $value)  
                           {{ $value->title }},
                        @endforeach
                  @endif
               </span>
             </span>
          </div>
       </div>
    </div>

    <div class="rh_ultra_prop_card__meta">
       <div class="rh_ultra_meta_icon_wrapper">
          <span class="rh-ultra-meta-label">Bathrooms</span>
          <div class="rh-ultra-meta-icon-wrapper">
             <span class="rh_ultra_meta_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                   <path class="ultra-meta rh-ultra-light" d="M9 22l0 1L9 22zM23 23L23 23zM1.3 22.2l0.3-0.9L1.3 22.2C1.3 22.2 1.3 22.2 1.3 22.2zM16.3 21.2l0.3 0.9L16.3 21.2zM9 17l0 1L9 17zM4.1 13c0.4-2 2-3.6 4.1-3.9L9 8.9l0.8 0.1c2.1 0.3 3.7 1.9 4.1 3.9H4.1zM23 8c0-3.9-3.1-7-7-7 -3.9 0-7 3.1-7 7 0-3.9 3.1-7 7-7C19.9 1 23 4.1 23 8z"></path>
                   <path class="ultra-meta rh-ultra-dark" d="M9 10l0.7 0.1c1.2 0.2 2.2 0.9 2.8 1.9H5.5c0.6-1 1.6-1.7 2.8-1.9L9 10M16 0c-4.4 0-8 3.6-8 8 0 0 0 0.1 0 0.1C5.2 8.6 3 11 3 14h12c0-3-2.2-5.4-5-5.9V8c0-3.3 2.7-6 6-6 3.3 0 6 2.7 6 6v16h2V8C24 3.6 20.4 0 16 0L16 0zM14.3 15.6c-0.1 0-0.2 0-0.3 0.1 -0.5 0.2-0.8 0.8-0.6 1.3l0.7 0.9c0.1 0.4 0.5 0.7 0.9 0.7 0.1 0 0.2 0 0.3-0.1 0.5-0.2 0.8-0.8 0.6-1.3l-0.7-0.9C15.1 15.8 14.7 15.6 14.3 15.6L14.3 15.6zM3.7 15.6c-0.4 0-0.8 0.3-0.9 0.7l-0.7 0.9c-0.2 0.5 0.1 1.1 0.6 1.3 0.1 0 0.2 0.1 0.3 0.1 0.4 0 0.8-0.3 0.9-0.7l0.7-0.9c0.2-0.5-0.1-1.1-0.6-1.3C3.9 15.6 3.8 15.6 3.7 15.6L3.7 15.6zM9 16c-0.6 0-1 0.4-1 1v1c0 0.6 0.4 1 1 1 0.6 0 1-0.4 1-1v-1C10 16.5 9.6 16 9 16L9 16zM16.3 20.2c-0.1 0-0.2 0-0.3 0.1 -0.5 0.2-0.8 0.8-0.6 1.3l0.3 0.9c0.1 0.4 0.5 0.7 0.9 0.7 0.1 0 0.2 0 0.3-0.1 0.5-0.2 0.8-0.8 0.6-1.3l-0.3-0.9C17.1 20.5 16.7 20.2 16.3 20.2L16.3 20.2zM1.7 20.2c-0.4 0-0.8 0.3-0.9 0.7l-0.3 0.9c-0.2 0.5 0.1 1.1 0.6 1.3 0.1 0 0.2 0.1 0.3 0.1 0.4 0 0.8-0.3 0.9-0.7l0.3-0.9c0.2-0.5-0.1-1.1-0.6-1.3C1.9 20.3 1.8 20.2 1.7 20.2L1.7 20.2zM9 21c-0.6 0-1 0.4-1 1v1c0 0.6 0.4 1 1 1 0.6 0 1-0.4 1-1v-1C10 21.5 9.6 21 9 21L9 21z"></path>
                </svg>
             </span>
             <span class="rh_ultra_meta_box">
             <span class="figure">
               @if (!empty($relatedBathrooms))
                     @foreach ($relatedBathrooms as $value)  
                        {{ $value->title }},
                     @endforeach
               @endif
             </span>
             </span>
          </div>
       </div>
    </div>
    
    <div class="rh_ultra_prop_card__meta">
       <div class="rh_ultra_meta_icon_wrapper">
          <span class="rh-ultra-meta-label">Year Built</span>
          <div class="rh-ultra-meta-icon-wrapper">
             <span class="rh_ultra_meta_icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar rh-ultra-stroke-dark" viewBox="2 1 20 22">
                   <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                   <path d="M16 2v4M8 2v4M3 10h18"></path>
                </svg>
             </span>
             <span class="rh_ultra_meta_box">
             <span class="figure">
               @if(!empty($property->year_build))
                  {{ $property->year_build }}
               @endif 
             </span>
             </span>
          </div>
       </div>
    </div>

    <div class="rh_ultra_prop_card__meta">
       <div class="rh_ultra_meta_icon_wrapper">
          <span class="rh-ultra-meta-label">Area</span>
          <div class="rh-ultra-meta-icon-wrapper">
             <span class="rh_ultra_meta_icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                   <path class="ultra-meta rh-ultra-light" d="M4.4 23L1 19.6v-1l4-2 4 2v1L5.6 23H4.4zM18.6 9l-2-4H5h11.6l2-4h1L23 4.4v1.2L19.6 9H18.6z"></path>
                   <path class="ultra-meta rh-ultra-dark" d="M19.2 2L22 4.8v0.3L19.2 8l-1.4-2.9L17.7 5l0.1-0.1L19.2 2M5 17.7l0.1 0.1L8 19.2 5.2 22H4.8L2 19.2l2.9-1.4L5 17.7M20 0h-2l-2 4H4v12l-4 2v2l4 4h2l4-4v-2l-4-2V6h10l2 4h2l4-4V4L20 0 20 0zM24 10h-2v2h2V10L24 10zM24 14h-2v2h2V14L24 14zM24 18h-2v2h2V18L24 18zM24 22h-2v2h2V22L24 22zM20 22h-2v2h2V22L20 22zM16 22h-2v2h2V22L16 22zM12 22h-2v2h2V22L12 22z"></path>
                </svg>
             </span>
             <span class="rh_ultra_meta_box">
             <span class="figure">
               @if(!empty($property->size))
                  {{ $property->size }}
               @endif 
             </span>
             <span class="label">sq ft</span>
             </span>
          </div>
       </div>
    </div>

    <div class="rh_ultra_prop_card__meta">
       <div class="rh_ultra_meta_icon_wrapper">
          <span class="rh-ultra-meta-label">Size</span>
          <div class="rh-ultra-meta-icon-wrapper">
             <span class="rh_ultra_meta_icon">
                <svg class="rh-ultra-dark" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="24" height="24" xml:space="preserve">
                   <style>
                      .lot-st0{opacity:.3}
                   </style>
                   <g class="lot-st0">
                      <path d="M5.4 5.6L1.6 6.9v-5l.3-.3L7 1.5 5.6 5.4v.2h-.2z"></path>
                   </g>
                   <g class="lot-st0">
                      <path d="M18.6 18.4l3.8-1.3v5l-.2.3h-5.1l1.3-3.8v-.2z"></path>
                   </g>
                   <g>
                      <path d="M22.6 15.5l-4.2 1.4L7.1 5.7l1.4-4.2L7.1 0H1.4L0 1.4v5.7l1.4 1.4 4.2-1.4 11.3 11.3-1.4 4.2 1.4 1.4h5.7l1.4-1.4v-5.7l-1.4-1.4zM5.2 5v.1l-.2.1-3 1v-4l.2-.2 4-.1-1 3.1zM22 21.7l-.2.2-4 .1 1.1-3v-.1h.1l3-1.1v3.9z"></path>
                   </g>
                   <path d="M10 0h2v2h-2zM14 0h2v2h-2zM18 0h2v2h-2zM22 0h2v2h-2zM22 4h2v2h-2zM22 8h2v2h-2zM22 12h2v2h-2zM12 22h2v2h-2zM8 22h2v2H8zM4 22h2v2H4zM0 22h2v2H0zM0 18h2v2H0zM0 14h2v2H0zM0 10h2v2H0z"></path>
                </svg>
             </span>
             <span class="rh_ultra_meta_box">
             <span class="figure">
               @if(!empty($property->total_area))
                  {{ $property->total_area }}
               @endif 
             </span>
             <span class="label">sq ft</span>
             </span>
          </div>
       </div>
    </div>
 </div>