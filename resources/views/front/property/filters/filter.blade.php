<div class="rh-custom-search-form-wrapper" >
    <div data-elementor-type="page" data-elementor-id="4763" class="elementor elementor-4763">
       <section class="elementor-section elementor-top-section elementor-element elementor-element-8200375 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="8200375" data-element_type="section">
          <div class="elementor-container elementor-column-gap-no">
             <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-4ab2802" data-id="4ab2802" data-element_type="column">
                <div class="elementor-widget-wrap elementor-element-populated">
                   <div class="elementor-element elementor-element-27a00c8 elementor-widget elementor-widget-rhea-ultra-search-form-widget" data-id="27a00c8" data-element_type="widget" data-settings="{&quot;rhea_top_field_count&quot;:&quot;4&quot;}" data-widget_type="rhea-ultra-search-form-widget.default">
                      <div class="elementor-widget-container">
                         <div class="rhea_ultra_search_form_wrapper rhea-search-form-1" id="rhea-27a00c8" style="display: block;">
                            <form class="rhea_search_form advance-search-form" action="https://ultra.realhomes.io/search-properties/" method="get">
                               <div class="rhea-ultra-search-form-fields">
                                  <div class="rhea-ultra-search-form-inner">
                                     <div class="rhea_top_search_fields">
                                        <div class="rhea_top_search_box rhea_top_fields_count_4">
                                            @include('front.property.filters.all_filters.filter1')
                                            @include('front.property.filters.all_filters.filter2')
                                            @include('front.property.filters.all_filters.filter3')
                                        </div>
                                     </div>

                                     <div class="rhea_collapsed_search_fields rhea_advance_fields_collapsed">
                                        <div class="rhea_collapsed_search_fields_inner">
                                            @include('front.property.filters.all_filters.filter4')
                                            @include('front.property.filters.all_filters.filter5')
                                            @include('front.property.filters.all_filters.filter6')
                                            @include('front.property.filters.all_filters.filter7')

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
                                        <div class="rhea_advanced_expander advance_button_27a00c8">
                                           <span class="search-ultra-plus">
                                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 330" xml:space="preserve">
                                                 <path d="M325.606 304.394 223.328 202.117c16.707-21.256 26.683-48.041 26.683-77.111C250.011 56.077 193.934 0 125.005 0 56.077 0 0 56.077 0 125.006 0 193.933 56.077 250.01 125.005 250.01c29.07 0 55.855-9.975 77.11-26.681l102.278 102.277c2.929 2.93 6.768 4.394 10.607 4.394s7.678-1.464 10.606-4.394c5.859-5.857 5.859-15.355 0-21.212zM30 125.006C30 72.619 72.619 30 125.005 30c52.387 0 95.006 42.619 95.006 95.005 0 52.386-42.619 95.004-95.006 95.004C72.619 220.01 30 177.391 30 125.006z"></path>
                                              </svg>
                                           </span>
                                           <span>
                                           Advance Search                </span>
                                        </div>
                                        <button class="rhea_search_form_button" type="submit">
                                        <span>
                                        Search                    </span>
                                        </button>
                                     </div>
                                  </div>

                                  <div class="rhea-more-options-mode-container rhea-features-styles-2" id="rhea_features_27a00c8">
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
                                  </div>
                               </div>
                            </form>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </section>
    </div>
 </div>