
   @if ($properties->isNotEmpty())
       @foreach ($properties as $value)
       <div class="rh-ultra-half-layout-list">
         <div class="rh-ultra-property-card rh-half-map-card rh_popup_info_map" data-rh-id="RH-45">
            <div class="rh-ultra-list-card-thumb">
               
              <div class="rh-ultra-status-box">
                  @if ($value->category->name == 'Rent')
                     <span class="rh-ultra-featured">{{ $value->category->name }}</span>
                  @else
                     <span class="rh-ultra-hot">{{ $value->category->name }}</span>
                  @endif
               </div>

               @php
                  $propertyImage = $value->property_images->first();
               @endphp
               
               @if (!empty($propertyImage->image))
                  <a href="{{ route('propertyDetails', $value->id) }}" class="product-img">
                  <img loading="lazy" decoding="async" 
                  alt=""  src="{{ asset('uploads/property/small/'.$propertyImage->image) }}" >
               </a>
               @endif
               
               <div class="rh-ultra-bottom-box rh-ultra-flex-end">
                  <div class="rh-ultra-action-buttons rh-ultra-action-dark hover-dark">
                     <span class="favorite-btn-wrap favorite-btn-45">
                        <span class="favorite-placeholder highlight__red hide user_not_logged_in rh-ui-tooltip " data-propertyid="45" title="Added to favorites">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                              <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                           </svg>
                        </span>
                        <a href="#" class="favorite add-to-favorite user_not_logged_in rh-ui-tooltip " data-propertyid="45" title="Add to favorites">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path class="rh-ultra-light" d="M2.7 12.8C1.6 11.7 1 10.3 1 8.7s0.6-3 1.7-4.1C3.8 3.6 5.2 3 6.8 3c1.5 0 3 0.6 4.1 1.7 0.1 0.1 0.5 0.5 1.2 0.5 0.4 0 0.9-0.2 1.2-0.6 1.1-1.1 2.5-1.7 4-1.7s3 0.6 4.1 1.7C22.4 5.8 23 7.2 23 8.7s-0.6 3-1.7 4.1L12 21.6 2.7 12.8z"></path>
                              <path class="rh-ultra-dark" d="M17.3 4c1.3 0 2.5 0.5 3.4 1.4C21.5 6.3 22 7.5 22 8.7c0 1.3-0.5 2.4-1.4 3.3L12 20.2l-8.6-8.2C2.5 11.2 2 10 2 8.7c0-1.3 0.5-2.5 1.4-3.4C4.3 4.5 5.5 4 6.7 4 8 4 9.2 4.5 10.1 5.4 10.3 5.6 11 6.2 12 6.2c0.7 0 1.4-0.3 1.9-0.8C14.8 4.5 16 4 17.3 4M17.3 2c-1.7 0-3.5 0.7-4.8 2 -0.2 0.2-0.3 0.2-0.5 0.2 -0.3 0-0.5-0.2-0.5-0.2 -1.3-1.3-3-2-4.8-2S3.3 2.7 2 4c-2.6 2.6-2.6 6.9 0 9.5L12 23l10-9.5c2.6-2.6 2.6-6.9 0-9.5C20.7 2.7 19 2 17.3 2L17.3 2z"></path>
                           </svg>
                        </a>
                     </span>
                     <span class="add-to-compare-span compare-btn-45" data-property-id="45" data-property-title="Home in Merrick Way" data-property-url="https://ultra.realhomes.io/property/home-in-merrick-way/" data-property-image="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2022/06/architecture-home-merrick-way-488x326.jpg">
                        <span class="compare-placeholder highlight hide rh-ui-tooltip" title="Added to compare">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path class="rh-ultra-light" d="M11.1 23l-3.4-3.4v-1.2l3.4-3.4h1l2 4 9 0h-9l-2 4H11.1zM12 9l-2-4L1 5h9l2-4 1 0 3.4 3.4v1.2L12.9 9H12z"></path>
                              <path class="rh-ultra-dark" d="M12.5 2l2.8 2.8v0.3L12.5 8l-1.4-2.9L11.1 5l0.1-0.1L12.5 2M11.5 16l1.4 2.9 0.1 0.1 -0.1 0.1L11.5 22l-2.8-2.8v-0.3L11.5 16M13.3 0h-2v0l-2 4H0v2h9.3l2 4h2l4-4V4L13.3 0 13.3 0zM12.7 14h-2l-4 4v2l4 4h2v0l2-4H24v-2h-9.3L12.7 14 12.7 14z"></path>
                           </svg>
                        </span>
                        
                     </span>
                  </div>
               </div>
            </div>
            
            <div class="rh-ultra-card-detail-wrapper">
               <h3 class="rh-ultra-property-title"><a href="{{ route('propertyDetails', $value->id) }}">{{ $value->title }}</a></h3>
               <div class="rh-address-ultra">
                  <a class="rhea_trigger_map rhea_facnybox_trigger- " data-rhea-map-source="rhea-map-source-" data-rhea-map-location="25.749806376111,-80.25448590517,13" data-rhea-map-title="Home in Merrick Way" data-rhea-map-price=" $540,000 " data-rhea-map-thumb="https://ultra-realhomes.b-cdn.net/wp-content/uploads/2022/06/architecture-home-merrick-way-488x326.jpg" href="">
                     <span class="rh-ultra-address-pin">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="5 2 14 20">
                           <path d="M12 4C9.2 4 7 6.2 7 9c0 2.9 2.9 7.2 5 9.9 2.1-2.7 5-7 5-9.9C17 6.2 14.8 4 12 4zM12 11.5c-1.4 0-2.5-1.1-2.5-2.5s1.1-2.5 2.5-2.5 2.5 1.1 2.5 2.5S13.4 11.5 12 11.5z" fill="#1db2ff" class="rh-ultra-dark" style="opacity:0.24;"></path>
                           <path d="M12 2C8.1 2 5 5.1 5 9c0 5.3 7 13 7 13s7-7.8 7-13C19 5.1 15.9 2 12 2zM7 9c0-2.8 2.2-5 5-5s5 2.2 5 5c0 2.9-2.9 7.2-5 9.9C9.9 16.2 7 11.9 7 9z" fill="#1db2ff" class="rh-ultra-dark"></path>
                           <circle cx="12" cy="9" r="2.5" fill="#1db2ff" class="rh-ultra-dark"></circle>
                        </svg>
                     </span>
                     {{ $value->location }}, {{ $value->area->name }}, {{ $value->city->name }}.
                  </a>
               </div>
     
               <div class="rh-ultra-meta">
                  <div class="rh-properties-card-meta-ultra">
                     <div class="rh-ultra-prop-card-meta">
                        <div class="rh-ultra-meta-icon-wrapper">
                           <span class="rh-ultra-meta-icon" data-tooltip="Bedrooms">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                 <path class="ultra-meta rh-ultra-light" d="M2.6 23c-0.6 0-1-0.2-1.3-0.6C1 22.1 0.9 21.7 1 21.3L2.2 9.9C2.3 9.5 3.1 9 3.9 9h16.1c0.9 0 1.6 0.5 1.7 0.9L23 21.2c0.1 0.5 0 0.9-0.3 1.2 -0.3 0.4-0.8 0.6-1.3 0.6H2.6zM14.9 5c-0.5 0-0.8-0.1-0.9-0.3 0-0.1 0-0.2 0-0.2l0-3.3C14.2 1.1 14.6 1 15.6 1h3.9c0.7 0 1.2 0.4 1.2 0.5L21 4.6l0 0.1C20.9 4.9 20.5 5 20.1 5H14.9zM3.9 5C3.5 5 3.1 4.9 3 4.7c0 0 0-0.1 0-0.1l0.4-3.1C3.4 1.4 3.9 1 4.6 1h3.9c1 0 1.4 0.1 1.6 0.2l0 3.2C9.7 4.7 8.8 5 8.1 5H3.9z"></path>
                                 <path class="ultra-meta rh-ultra-dark" d="M19.4 2c0.1 0 0.2 0 0.3 0l0.2 2H15l0-2c0.2 0 0.3 0 0.6 0H19.4M8.4 2C8.7 2 8.9 2 9 2l0 1.8C8.7 3.9 8.4 4 8.1 4h-4l0.2-2c0.1 0 0.2 0 0.3 0H8.4M20.1 10c0.3 0 0.6 0.1 0.7 0.2L22 21.3c0 0 0 0.1 0 0.1 0 0.2 0 0.3-0.1 0.3 -0.1 0.1-0.3 0.2-0.6 0.2H2.6c-0.3 0-0.5-0.1-0.6-0.2C2 21.7 2 21.7 2 21.5c0 0 0-0.1 0-0.1l1.2-11.1C3.3 10.1 3.6 10 3.9 10H20.1M19.4 0h-3.9C14.5 0 13 0.1 13 1l0 3.5C12.8 5.3 13.7 6 14.9 6h5.2c1.2 0 2.1-0.7 1.9-1.5l-0.4-3.1C21.5 0.6 20.5 0 19.4 0L19.4 0zM8.4 0H4.6C3.5 0 2.5 0.6 2.4 1.3L2 4.5C1.9 5.3 2.7 6 3.9 6h4.2c1.2 0 3.1-0.7 2.9-1.5L11 1C11 0.1 9.5 0 8.4 0L8.4 0zM20.1 8H3.9C2.6 8 1.4 8.8 1.3 9.8L0 21.1C-0.2 22.7 0.9 24 2.6 24h18.7c1.7 0 2.9-1.3 2.6-2.9L22.7 9.8C22.6 8.8 21.4 8 20.1 8L20.1 8z"></path>
                              </svg>
                           </span>
                           <span class="rh-ultra-meta-box">
                           <span class="figure">{{ $value->room->title }}</span>
                           </span>
                        </div>
                     </div>

                     <div class="rh-ultra-prop-card-meta">
                        <div class="rh-ultra-meta-icon-wrapper">
                           <span class="rh-ultra-meta-icon" data-tooltip="Bathrooms">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                 <path class="ultra-meta rh-ultra-light" d="M9 22l0 1L9 22zM23 23L23 23zM1.3 22.2l0.3-0.9L1.3 22.2C1.3 22.2 1.3 22.2 1.3 22.2zM16.3 21.2l0.3 0.9L16.3 21.2zM9 17l0 1L9 17zM4.1 13c0.4-2 2-3.6 4.1-3.9L9 8.9l0.8 0.1c2.1 0.3 3.7 1.9 4.1 3.9H4.1zM23 8c0-3.9-3.1-7-7-7 -3.9 0-7 3.1-7 7 0-3.9 3.1-7 7-7C19.9 1 23 4.1 23 8z"></path>
                                 <path class="ultra-meta rh-ultra-dark" d="M9 10l0.7 0.1c1.2 0.2 2.2 0.9 2.8 1.9H5.5c0.6-1 1.6-1.7 2.8-1.9L9 10M16 0c-4.4 0-8 3.6-8 8 0 0 0 0.1 0 0.1C5.2 8.6 3 11 3 14h12c0-3-2.2-5.4-5-5.9V8c0-3.3 2.7-6 6-6 3.3 0 6 2.7 6 6v16h2V8C24 3.6 20.4 0 16 0L16 0zM14.3 15.6c-0.1 0-0.2 0-0.3 0.1 -0.5 0.2-0.8 0.8-0.6 1.3l0.7 0.9c0.1 0.4 0.5 0.7 0.9 0.7 0.1 0 0.2 0 0.3-0.1 0.5-0.2 0.8-0.8 0.6-1.3l-0.7-0.9C15.1 15.8 14.7 15.6 14.3 15.6L14.3 15.6zM3.7 15.6c-0.4 0-0.8 0.3-0.9 0.7l-0.7 0.9c-0.2 0.5 0.1 1.1 0.6 1.3 0.1 0 0.2 0.1 0.3 0.1 0.4 0 0.8-0.3 0.9-0.7l0.7-0.9c0.2-0.5-0.1-1.1-0.6-1.3C3.9 15.6 3.8 15.6 3.7 15.6L3.7 15.6zM9 16c-0.6 0-1 0.4-1 1v1c0 0.6 0.4 1 1 1 0.6 0 1-0.4 1-1v-1C10 16.5 9.6 16 9 16L9 16zM16.3 20.2c-0.1 0-0.2 0-0.3 0.1 -0.5 0.2-0.8 0.8-0.6 1.3l0.3 0.9c0.1 0.4 0.5 0.7 0.9 0.7 0.1 0 0.2 0 0.3-0.1 0.5-0.2 0.8-0.8 0.6-1.3l-0.3-0.9C17.1 20.5 16.7 20.2 16.3 20.2L16.3 20.2zM1.7 20.2c-0.4 0-0.8 0.3-0.9 0.7l-0.3 0.9c-0.2 0.5 0.1 1.1 0.6 1.3 0.1 0 0.2 0.1 0.3 0.1 0.4 0 0.8-0.3 0.9-0.7l0.3-0.9c0.2-0.5-0.1-1.1-0.6-1.3C1.9 20.3 1.8 20.2 1.7 20.2L1.7 20.2zM9 21c-0.6 0-1 0.4-1 1v1c0 0.6 0.4 1 1 1 0.6 0 1-0.4 1-1v-1C10 21.5 9.6 21 9 21L9 21z"></path>
                              </svg>
                           </span>
                           <span class="rh-ultra-meta-box">
                           <span class="figure">{{ $value->bathroom->title }}</span>
                           </span>
                        </div>
                     </div>

                     <div class="rh-ultra-prop-card-meta">
                        <div class="rh-ultra-meta-icon-wrapper">
                           <span class="rh-ultra-meta-icon" data-tooltip="Area">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                 <path class="ultra-meta rh-ultra-light" d="M4.4 23L1 19.6v-1l4-2 4 2v1L5.6 23H4.4zM18.6 9l-2-4H5h11.6l2-4h1L23 4.4v1.2L19.6 9H18.6z"></path>
                                 <path class="ultra-meta rh-ultra-dark" d="M19.2 2L22 4.8v0.3L19.2 8l-1.4-2.9L17.7 5l0.1-0.1L19.2 2M5 17.7l0.1 0.1L8 19.2 5.2 22H4.8L2 19.2l2.9-1.4L5 17.7M20 0h-2l-2 4H4v12l-4 2v2l4 4h2l4-4v-2l-4-2V6h10l2 4h2l4-4V4L20 0 20 0zM24 10h-2v2h2V10L24 10zM24 14h-2v2h2V14L24 14zM24 18h-2v2h2V18L24 18zM24 22h-2v2h2V22L24 22zM20 22h-2v2h2V22L20 22zM16 22h-2v2h2V22L16 22zM12 22h-2v2h2V22L12 22z"></path>
                              </svg>
                           </span>
                           <span class="rh-ultra-meta-box">
                           <span class="figure">{{ $value->size }}</span>
                           <span class="label">sq ft</span>
                           </span>

                           {{ $value->propertyType->name }}
                        </div>
                     </div>

                  </div>
               </div>
     
               <div class="rh-ultra-price-meta-box">
                  <div class="rh_prop_card__priceLabel_ultra">
                     <p class="rh_prop_card__price_ultra hide-ultra-price-postfix-separator">
                        <span class="ere-price-display">${{ $value->price }}/-</span>    
                     </p>
                  </div>
                  {{-- {{ Str::words(strip_tags($value->description), $words=10, '...') }} --}}
      
                  <div class="rh-ultra-year-built">Build: {{ $value->year_build }}</div>
               </div>
     
               <div class="rvr_card_info_wrap">
                  <p class="added-date"><span class="added-title">Added:</span> {{ \Carbon\Carbon::parse($value->created_at)->format('d M, Y') }}</p>

                  @if (!empty($relatedProperties))
                        @foreach ($relatedProperties as $relProperty)                                
                            <div class="col-md-3">
                                @php
                                    $propertyImage = $relProperty->property_images->first();
                                @endphp
                                {{ $relProperty->title }}
                            </div>
                        @endforeach
                    @endif
               </div>
            </div>
         </div>
      </div>

       @endforeach
         {{ $properties->withQueryString()->links() }}
   @else
       <div>Property not found</div>
   @endif

