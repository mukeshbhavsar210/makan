<form action="" name="searchForm" id="searchForm" class="rhea_search_form advance-search-form">
<div class="rh-custom-search-form-wrapper" >
    <div data-elementor-type="page" data-elementor-id="4763" class="elementor elementor-4763">
       <section class="elementor-section elementor-top-section elementor-element elementor-element-8200375 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8200375" data-element_type="section">
          <div class="elementor-container elementor-column-gap-no">
             <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4ab2802" data-id="4ab2802" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                   <div class="elementor-element elementor-element-27a00c8 elementor-widget elementor-widget-rhea-ultra-search-form-widget" data-id="27a00c8" data-element_type="widget" data-settings="{&quot;rhea_top_field_count&quot;:&quot;4&quot;}" data-widget_type="rhea-ultra-search-form-widget.default">
                      <div class="elementor-widget-container">
                         <div class="rhea_ultra_search_form_wrapper rhea-search-form-1" id="rhea-27a00c8" style="display: block;">
                               <div class="rhea-ultra-search-form-fields">
                                  <div class="rhea-ultra-search-form-inner">
                                     <div class="rhea_top_search_fields">

                                       <div class="rhea_top_search_box rhea_top_fields_count_4">
                                          <div>
                                             <input value="{{ Request::get('keyword') }}" type="text" name="keyword" id="keyword" placeholder="Keywords" class="form-control">
                                          </div>
                                          <div>
                                             <select name="category" id="category" >
                                                <option value="">Category</option>
                                                @if ($categories)
                                                   @foreach ($categories as $value)
                                                      <option {{ (Request::get('category') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                   @endforeach
                                                @endif
                                             </select>
                                          </div>
                                          <div>
                                             <select name="city" id="city" >
                                                <option value="">City</option>
                                                @if ($cities)
                                                   @foreach ($cities as $value)
                                                      <option {{ (Request::get('city') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                   @endforeach
                                                @endif
                                             </select>

                                             <select name="area" id="area">
                                                <option value="">Area</option>
                                             </select>
                                          </div>
                                          <div>
                                             <select name="bathroom" id="bathroom" >
                                                <option value="">bathroom</option>
                                                @if ($bathrooms)
                                                   @foreach ($bathrooms as $value)
                                                      <option {{ (Request::get('bathroom') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title }}</option>
                                                   @endforeach
                                                @endif
                                             </select>
                                          </div>
                                          <div>
                                             <select name="room" id="room" >
                                                <option value="">Room</option>
                                                @if ($rooms)
                                                   @foreach ($rooms as $value)
                                                      <option {{ (Request::get('room') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->title }}</option>
                                                   @endforeach
                                                @endif
                                             </select>
                                          </div>
                                          <div>
                                             <select name="type" id="type" >
                                                <option value="">All Types</option>
                                                @if ($types)
                                                   @foreach ($types as $value)
                                                      <option {{ (Request::get('type') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                                   @endforeach
                                                @endif
                                             </select>
                                          </div>

                                          {{-- <div>                                             
                                             @if ($jobTypes->isNotEmpty())
                                                 @foreach ($jobTypes as $jobType)
                                                     <div class="form-check mb-2">
                                                         <input {{ (in_array($jobType->id, $jobTypeArray)) ? 'checked' : ''}} class="form-check-input " name="job_type" type="checkbox" value=" {{ $jobType->id }}" id="job-type-{{ $jobType->id }}">
                                                         <label class="form-check-label " for="job-type-{{ $jobType->id }}">{{ $jobType->name }}</label>
                                                     </div>
                                                 @endforeach
                                             @endif
                                         </div> --}}
                                          {{-- <div>
                                             <input type="text" class="js-range-slider" name="my_range" value="" />
                                          </div> --}}
                                          
                                        
                                            {{-- @include('front.propertyMap.filters.all_filters.filter1')
                                            @include('front.propertyMap.filters.all_filters.filter2')
                                            @include('front.propertyMap.filters.all_filters.filter3') --}}
                                        </div>
                                     </div>

                                     <div class="rhea_collapsed_search_fields rhea_advance_fields_collapsed">
                                        <div class="rhea_collapsed_search_fields_inner">
                                            {{-- @include('front.propertyMap.filters.all_filters.filter4')
                                            @include('front.propertyMap.filters.all_filters.filter5')
                                            @include('front.propertyMap.filters.all_filters.filter6')
                                            @include('front.propertyMap.filters.all_filters.filter7') --}}

                                           <div class="rhea_prop_search__option rhea_mod_text_field rhea_keyword_field rhea-ultra-field-separator" data-key-position="8" id="keyword-search27a00c8" style="order: 8">
                                              <span class="rhea-text-field-wrapper">
                                              <input class="rhea-keyword-live" type="text" name="keyword"  autocomplete="off" value="" placeholder="Keyword">
                                              </span>
                                           </div>
                                           <div class="rhea_prop_search__option rhea_mod_text_field rhea_property_id_field rhea-ultra-field-separator" style="order: 9" data-key-position="9" id="property-id-27a00c8">
                                              <span class="rhea-text-field-wrapper">
                                              <input type="text" name="property-id" autocomplete="off" id="property-id-txt-27a00c8" value="" placeholder="Property ID">
                                              </span>
                                           </div>
                                           <div class="rhea_prop_search__option rhea_mod_text_field rhea_min_area_field rhea-ultra-field-separator" data-key-position="10" style="order: 10">
                                              <span class="rhea-text-field-wrapper ">
                                              <input type="text" autocomplete="off" name="min-area" id="min-area-27a00c8" pattern="[0-9]+" value="" placeholder="Min Area" title="Only provide digits!">
                                              </span>
                                           </div>
                                           <div class="rhea_prop_search__option rhea_mod_text_field rhea_max_area_field rhea-ultra-field-separator" data-key-position="10.1" style="order: 10">
                                              <span class="rhea-text-field-wrapper ">
                                              <input type="text" autocomplete="off" name="max-area" id="max-area-27a00c8" pattern="[0-9]+" value="" placeholder="Max Area" title="Only provide digits!">
                                              </span>
                                           </div>
                                           <div class="rhea_prop_search__option rhea_mod_text_field rhea_min_lot_size_field rhea-ultra-field-separator" data-key-position="11" style="order: 11">
                                              <span class="rhea-text-field-wrapper ">
                                              <input type="text" autocomplete="off" name="min-lot-size" id="min-lot-size-27a00c8" pattern="[0-9]+" value="" placeholder="Min Lot Size" title="Only provide digits!">
                                              </span>
                                           </div>
                                           <div class="rhea_prop_search__option rhea_mod_text_field rhea_max_lot_size_field rhea-ultra-field-separator" data-key-position="11.1" style="order: 11">
                                              <span class="rhea-text-field-wrapper ">
                                              <input type="text" autocomplete="off" name="max-lot-size" id="max-lot-size-27a00c8" pattern="[0-9]+" value="" placeholder="Max Lot Size" title="Only provide digits!">
                                              </span>
                                           </div>
                                        </div>
                                     </div>

                                     <div class="rhea_search_button_wrapper rhea_buttons_top">
                                        {{-- <div class="rhea_advanced_expander advance_button_27a00c8">
                                           <span class="search-ultra-plus">
                                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 330" xml:space="preserve">
                                                 <path d="M325.606 304.394 223.328 202.117c16.707-21.256 26.683-48.041 26.683-77.111C250.011 56.077 193.934 0 125.005 0 56.077 0 0 56.077 0 125.006 0 193.933 56.077 250.01 125.005 250.01c29.07 0 55.855-9.975 77.11-26.681l102.278 102.277c2.929 2.93 6.768 4.394 10.607 4.394s7.678-1.464 10.606-4.394c5.859-5.857 5.859-15.355 0-21.212zM30 125.006C30 72.619 72.619 30 125.005 30c52.387 0 95.006 42.619 95.006 95.005 0 52.386-42.619 95.004-95.006 95.004C72.619 220.01 30 177.391 30 125.006z"></path>
                                              </svg>
                                           </span>
                                           <span>Advance Search</span>
                                        </div> --}}

                                        <button class="rhea_search_form_button" type="submit"><span>Search</span></button>

                                        <div class="rhea_advanced_expander advance_button_27a00c8">                                          
                                          <a href="{{ route('properties') }}"  type="submit"><span>Reset</span></a>
                                       </div>
                                     </div>
                                  </div>
                                  
                                  {{-- <div class="rhea-more-options-mode-container rhea-features-styles-2" id="rhea_features_27a00c8">
                                     <div class="rhea-more-options-wrapper rhea-more-options-wrapper-mode clearfix collapsed">
                                        <div class="rhea-option-bar">
                                           <input type="checkbox" id="feature-27a00c8-2-stories" name="features[]" value="2-stories">
                                           <label for="feature-27a00c8-2-stories">2 Stories <small>(6)</small></label>
                                        </div>
                                     </div>
                                     <span class="rhea_open_more_features_outer">
                                        <span class="rhea_open_more_features">
                                            <span></span>
                                            Looking for certain features</span>
                                     </span>
                                  </div> --}}
                                  

                               </div>
                            
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </section>
    </div>
 </div>

 <div class="rh-custom-search-form-gutter clearfix"></div>
<div class="rh-ultra-half-map-sorting">
   <p class="rh_pagination__stats"><span>1</span> to <span>4</span> out of <span>10</span> properties</p>
               
   <div class="rh-ultra-sorting-side">
      <div class="rh_sort_controls">

         <select name="sort" id="sort" class="form-control">
            <option value="1" {{ (Request::get('sort') == '1') ? 'selected' : '' }}>Latest</option>
            <option value="0" {{ (Request::get('sort') == '0') ? 'selected' : '' }}>Oldest</option>
         </select>

         <label for="sort-properties">Sort By:</label>
         <div class="dropdown bootstrap-select show-tick inspiry_select_picker_trigger rh-ultra-select-dropdown rh-ultra-select-light bs3" style="width: 100%;">
            <select name="sort-properties" id="sort-properties" class="inspiry_select_picker_trigger rh-ultra-select-dropdown rh-ultra-select-light show-tick" tabindex="-98">
               <option value="default">Default Order</option>
               <option value="title-asc">Property Title A to Z</option>
               <option value="title-desc">Property Title Z to A</option>
               <option value="price-asc">Price Low to High</option>
               <option value="price-desc">Price High to Low</option>
               <option value="date-asc">Date Old to New</option>
               <option value="date-desc" selected="">Date New to Old</option>
            </select>
            <button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="combobox" aria-owns="bs-select-7" aria-haspopup="listbox" aria-expanded="false" data-id="sort-properties" title="Date New to Old">
               <div class="filter-option">
                  <div class="filter-option-inner">
                     <div class="filter-option-inner-inner">Date New to Old</div>
                  </div>
               </div>
               <span class="bs-caret"><span class="caret"></span></span>
            </button>
            <div class="dropdown-menu open">
               <div class="inner open" role="listbox" id="bs-select-7" tabindex="-1">
                  <ul class="dropdown-menu inner " role="presentation"></ul>
               </div>
            </div>
         </div>
      </div>
      
      <div class="rh-ultra-view-type">
         <a class="grid " href="#"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
               <path d="M1497,1029h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1497,1029Zm0,10h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1497,1039Zm10-10h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1507,1029Zm0,10h4a2.006,2.006,0,0,1,2,2v4a2.006,2.006,0,0,1-2,2h-4a2.006,2.006,0,0,1-2-2v-4A2.006,2.006,0,0,1,1507,1039Z" transform="translate(-1495 -1029)"></path>
            </svg>
         </a>
         <a class="list active" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
               <path id="menu" d="M1539.01,1029a1.958,1.958,0,0,1,1.99,1.99,2.067,2.067,0,0,1-1.99,2.01A2,2,0,1,1,1539.01,1029Zm5.99,0h8a2,2,0,0,1,0,4h-8A2,2,0,0,1,1545,1029Zm-5.99,7a1.958,1.958,0,0,1,1.99,1.99,2.067,2.067,0,0,1-1.99,2.01A2,2,0,1,1,1539.01,1036Zm5.99,0h8a2.006,2.006,0,0,1,2,2h0a2.006,2.006,0,0,1-2,2h-8a2.006,2.006,0,0,1-2-2h0A2.006,2.006,0,0,1,1545,1036Zm-5.99,7a1.958,1.958,0,0,1,1.99,1.99,2.067,2.067,0,0,1-1.99,2.01A2,2,0,1,1,1539.01,1043Zm5.99,0h8a2.006,2.006,0,0,1,2,2h0a2.006,2.006,0,0,1-2,2h-8a2.006,2.006,0,0,1-2-2h0A2.006,2.006,0,0,1,1545,1043Z" transform="translate(-1537 -1029)"></path>
            </svg>
         </a>
      </div>

   </div>
</div>
</form>