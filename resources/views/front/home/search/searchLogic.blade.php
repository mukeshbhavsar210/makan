<form class="rhea_search_form advance-search-form"  action="{{ route('properties') }}" >
    <div class="rhea-ultra-search-form-fields ">
        <div class="rhea-ultra-search-form-inner">
            <div class="rhea_top_search_fields">
                <div class="rhea_top_search_box rhea_top_fields_count_5" >

                    @include('front.home.search.location')
                    @include('front.home.search.rentSale')
                    @include('front.home.search.propertyType')                
                    @include('front.home.search.priceRange')   
                    @include('front.home.search.amenity')
                    @include('front.home.search.bed')   
                    @include('front.home.search.bath')   
                    @include('front.home.search.minArea')  
                    @include('front.home.search.maxArea')  
                    
                    <div class="rhea_prop_search__option rhea_mod_text_field rhea_keyword_field   rhea-ultra-field-separator  "
                        data-key-position="1" id="keyword-search7aa80cab"
                        style="order: 1">
                        <span class="rhea-text-field-wrapper">
                            <label for="keyword-txt-7aa80cab"
                                class="rhea-field-icon-wrapper ">
                                <svg class="rhea-icon-search" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <g data-name="32-Search"><circle class="icon-search" cx="12" cy="12" r="11" />
                                        <line class="icon-search" x1="20" x2="31" y1="20" y2="31" /> </g>
                                </svg>
                            </label>
                            <input type="text" class="rhea-keyword-live" name="keyword" id="keyword" placeholder="Keywords">
                        </span>
                        <div class="rhea-properties-data-list"></div>
                        <span class="rhea_sfoi_ajax_loader">
                            <svg width="57" height="57" viewBox="0 0 57 57" xmlns="http://www.w3.org/2000/svg" stroke="#1db2ff">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(1 1)" stroke-width="2">
                                        <circle cx="5" cy="50" r="5">
                                            <animate attributeName="cy"
                                                begin="0s" dur="2.2s"
                                                values="50;5;50;50"
                                                calcMode="linear"
                                                repeatCount="indefinite" />
                                            <animate attributeName="cx"
                                                begin="0s" dur="2.2s"
                                                values="5;27;49;5"
                                                calcMode="linear"
                                                repeatCount="indefinite" />
                                        </circle>
                                        <circle cx="27" cy="5" r="5">
                                            <animate attributeName="cy"
                                                begin="0s" dur="2.2s"
                                                from="5" to="5"
                                                values="5;50;50;5"
                                                calcMode="linear"
                                                repeatCount="indefinite" />
                                            <animate attributeName="cx"
                                                begin="0s" dur="2.2s"
                                                from="27" to="27"
                                                values="27;49;5;27"
                                                calcMode="linear"
                                                repeatCount="indefinite" />
                                        </circle>
                                        <circle cx="49" cy="50" r="5">
                                            <animate attributeName="cy"
                                                begin="0s" dur="2.2s"
                                                values="50;50;5;50"
                                                calcMode="linear"
                                                repeatCount="indefinite" />
                                            <animate attributeName="cx"
                                                from="49" to="49" begin="0s"
                                                dur="2.2s"
                                                values="49;5;27;49"
                                                calcMode="linear"
                                                repeatCount="indefinite" />
                                        </circle>
                                    </g>
                                </g>
                            </svg> 
                        </span>
                    </div>
                </div>
            </div>

            <div class="rhea_collapsed_search_fields  rhea_advance_fields_collapsed" id="collapsed_wrapper_7aa80cab">
                <div class="rhea_collapsed_search_fields_inner" id="collapsed-7aa80cab"></div>
            </div>

            <div class="rhea_search_button_wrapper rhea_buttons_top">
                <div class="rhea_advanced_expander advance_button_7aa80cab">
                    <span class="search-ultra-plus"><svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 330 330" xml:space="preserve">
                            <path
                                d="M325.606 304.394 223.328 202.117c16.707-21.256 26.683-48.041 26.683-77.111C250.011 56.077 193.934 0 125.005 0 56.077 0 0 56.077 0 125.006 0 193.933 56.077 250.01 125.005 250.01c29.07 0 55.855-9.975 77.11-26.681l102.278 102.277c2.929 2.93 6.768 4.394 10.607 4.394s7.678-1.464 10.606-4.394c5.859-5.857 5.859-15.355 0-21.212zM30 125.006C30 72.619 72.619 30 125.005 30c52.387 0 95.006 42.619 95.006 95.005 0 52.386-42.619 95.004-95.006 95.004C72.619 220.01 30 177.391 30 125.006z" />
                        </svg></span>
                    <span>Advance Search </span>
                </div>
                <button class="rhea_search_form_button" type="submit"><span>Search </span></button>
            </div>
        </div>

        <div class="rhea-more-options-mode-container rhea-features-styles-2" id="rhea_features_7aa80cab">
            <div class="rhea-more-options-wrapper rhea-more-options-wrapper-mode clearfix collapsed">
                <div class="rhea-option-bar">
                    <input type="checkbox" id="feature-7aa80cab-marble-floors" value="marble-floors" />
                    <label for="feature-7aa80cab-marble-floors">Marble Floors <small>(5)</small></label>
                </div>
            </div>
            <span class="rhea_open_more_features_outer">
                <span class="rhea_open_more_features"><span></span> Looking for certain features </span>
            </span>
        </div>        
    </div>
</form>
