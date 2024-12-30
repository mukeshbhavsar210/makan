<form class="rhea_search_form advance-search-form" action="{{ route('jobs') }}" method="GET">
    <div class="rhea-ultra-search-form-fields ">
        <div class="rhea-ultra-search-form-inner">
            <div class="rhea_top_search_fields">
                <div class="rhea_top_search_box rhea_top_fields_count_5" id="top-7aa80cab">

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
                                <svg class="rhea-icon-search"
                                    viewBox="0 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g data-name="32-Search">
                                        <circle class="icon-search" cx="12"
                                            cy="12" r="11" />
                                        <line class="icon-search" x1="20"
                                            x2="31" y1="20" y2="31" />
                                    </g>
                                </svg> </label>
                                <input type="text" class="rhea-keyword-live" name="keyword" id="keyword" placeholder="Keywords">
                        </span>
                        <div class="rhea-properties-data-list"></div>
                        <span class="rhea_sfoi_ajax_loader">
                            <svg width="57" height="57" viewBox="0 0 57 57" xmlns="http://www.w3.org/2000/svg" stroke="#1db2ff">
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="translate(1 1)"
                                        stroke-width="2">
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

        @include('front.home.search.extra')  
        
    </div>
</form>

<script type="application/javascript">
    jQuery(document).bind("ready", function () {
        rheaSearchFields("#rhea-7aa80cab", 5, "#top-7aa80cab", "#collapsed-7aa80cab");
        rheaSearchStatusChange("#rhea-7aa80cab .price-for-others", "#rhea-7aa80cab .price-for-rent", ".rhea-status-tabs-7aa80cab input", "");
        rheaPropertySlider(
            "#rhea_slider_7aa80cab .rhea_price_slider",
            2500,
            6950000,
            "before",
            ",",
            "$",
            "",
            "",
            100);
        rheaSearchAdvanceState(".advance_button_7aa80cab", "#collapsed_wrapper_7aa80cab");
        rheaSearchAdvanceState("#advance_bottom_button_7aa80cab", "#collapsed_wrapper_7aa80cab");
        rheaFeaturesState("#rhea_features_7aa80cab .rhea_open_more_features", "#rhea_features_7aa80cab .rhea-more-options-wrapper");
        rheaLocationsHandler([{ "term_id": 59, "name": "Coral Gables", "slug": "coral-gables", "parent": 0, "count": 2, "children": [] }, { "term_id": 51, "name": "Doral", "slug": "doral", "parent": 0, "count": 1, "children": [] }, { "term_id": 44, "name": "Little Havana", "slug": "little-havana", "parent": 0, "count": 2, "children": [] }, { "term_id": 41, "name": "Miami", "slug": "miami", "parent": 0, "count": 7, "children": [] }],
            ["All Main Locations", "All Child Location", "All Grand Child Location", "All Great Grand Child Location"],
            ["7aa80cablocation", "7aa80cabchild-location", "7aa80cabgrandchild-location", "7aa80cabgreat-grandchild-location"],
            [],
            1,
            "any",
            "");
        rheaSelectPicker("#rhea-7aa80cab select.rhea_multi_select_picker");
        rheaSelectPicker("#rhea-7aa80cab select.rhea_multi_select_picker_location");
        minMaxPriceValidation("#select-min-price-7aa80cab", "#select-max-price-7aa80cab");
        minMaxRentPriceValidation("#select-min-price-for-rent-7aa80cab", "#select-max-price-for-rent-7aa80cab");
        minMaxAreaValidation("#min-area-7aa80cab", "#max-area-7aa80cab");
        minMaxAreaValidation("#min-lot-size-7aa80cab", "#max-lot-size-7aa80cab");
        jQuery("#rhea-7aa80cab .rhea_multi_select_picker_location")
            .on('change', function () {
                setTimeout(function () {
                    jQuery("#rhea-7aa80cab .rhea_multi_select_picker_location")
                        .selectpicker('refresh');
                }, 500);
            });
        rheaAjaxSelect(".rhea_location_ajax_parent_7aa80cab",
            "#rhea_ajax_location_7aa80cab",
            'https://ultra.realhomes.io/wp-admin/admin-ajax.php',
            'no',
            'no'
        );
        searchFormAjaxKeywords("#keyword-search7aa80cab", "https://ultra.realhomes.io/wp-admin/admin-ajax.php");
        jQuery("#rhea-7aa80cab").fadeIn();
    });
</script>