( function ( $ ) {
    "use strict";

    const $window = $( window );

    window.rheaIsRTL = function () {
        let isRTL = false;
        if ( document.querySelector( 'body' ).classList.contains( 'rtl' ) ) {
            isRTL = true;
        }
        return isRTL;
    }

    $( document ).ready( function () {

        /*-----------------------------------------------------------------------------------*/
        /* Sticky Header
        /*-----------------------------------------------------------------------------------*/
            const stickyHeader = $( '#rhea-sticky-header' );

            if ( stickyHeader.length ) {
                const headerHeight = stickyHeader.height();

                $window.on( 'scroll', function () {
                    let $this = $( this );

                    if ( $this.width() > 1024 ) {
                        if ( $this.scrollTop() > ( headerHeight + 100 ) ) {
                            stickyHeader.addClass( 'sticked' );
                        } else {
                            stickyHeader.removeClass( 'sticked' );
                        }
                    }
                } );
            }
        /*-----------------------------------------------------------------------------------*/
        /* Home page properties pagination
        /*-----------------------------------------------------------------------------------*/
        const $body = $( 'body' );
        $body.on( 'click', '.rhea_pagination_wrapper a', function ( e ) {
            e.preventDefault();

            var thisParent = $( this ).parents( '.rhea_ele_property_ajax_target' );
            var id         = $( thisParent ).attr( 'id' );
            var thisLoader = $( thisParent ).find( '.rhea_svg_loader' );
            var thisInner  = $( thisParent ).find( '.home-properties-section-inner-target' );
            var pageNav    = $( thisParent ).find( '.rhea_pagination_wrapper a' );
            var thisLink   = $( this );

            if ( ! ( thisLink ).hasClass( 'current' ) ) {
                var link = $( this ).attr( 'href' );
                thisInner.fadeTo( 'slow', 0.5 );

                thisLoader.slideDown( 'fast' );
                // thisContent.fadeOut('fast', function(){
                thisParent.load( link + ' #' + id + ' .home-properties-section-inner-target', function ( response, status, xhr ) {
                    if ( status == 'success' ) {
                        thisInner.fadeTo( 'fast', 1 );
                        pageNav.removeClass( 'current' );
                        thisLink.addClass( 'current' );
                        thisLoader.slideUp( 'fast' );
                        if ( typeof EREloadNewsSlider != 'undefined' && $.isFunction( EREloadNewsSlider ) ) {
                            EREloadNewsSlider();
                        }
                        if ( typeof setVideoHeightElementor != 'undefined' && $.isFunction( setVideoHeightElementor ) ) {
                            setVideoHeightElementor();
                        }
                        $( 'html, body' ).animate( {
                            scrollTop : $( '#' + id ).offset().top - 32
                        }, 1000 );

                    } else {
                        thisInner.fadeTo( 'fast', 1 );
                        thisLoader.slideUp( 'fast' );
                    }
                } );
            }
        } );

        $body.on( "click", ".rhea-ultra-properties-ajax-pagination a", function ( event ) {
            const $this                  = $( this ),
                  currentPageNum         = parseInt( $this.data( 'page' ) ),
                  propertiesContainer    = $this.closest( ".rhea-ultra-properties-container" ),
                  propertiesInner        = propertiesContainer.find( '.rhea-ultra-properties-inner-container' ),
                  propertiesStatsWrapper = propertiesContainer.find( '.rhea-ultra-properties-top-bar-stats-wrapper' ),
                  paginationContainer    = propertiesContainer.find( ".rhea-ultra-properties-ajax-pagination" ),
                  paginationItems        = propertiesContainer.find( ".pagination a" ),
                  loader                 = propertiesContainer.find( ".rhea_svg_loader" );

            if ( $this.hasClass( "current" ) ) {
                return false;
            }

            loader.slideDown();

            if ( typeof propertiesMapNewData !== "undefined" ) {
                $.ajax( {
                    url     : ajaxurl,
                    type    : 'post',
                    data    : {
                        action          : 'rhea_map_properties_data',
                        paged           : currentPageNum,
                        properties_args : JSON.parse( propertiesMapNewData.rheaPropertiesArgs )
                    },
                    success : function ( response ) {
                        if ( response.data ) {
                            const rheaUpdateMapData = $.Event( 'rheaUpdateMapData', {
                                mapProperties : JSON.stringify( response.data )
                            } );
                            $( document ).trigger( rheaUpdateMapData );
                        }
                    }
                } );
            }

            $.ajax( {
                url     : $this.attr( 'href' ),
                method  : 'GET',
                success : function ( response ) {
                    let $response = $( response );
                    propertiesStatsWrapper.html( $response.find( ".rhea-ultra-properties-top-bar-stats-wrapper > .rhea-ultra-properties-stats" ) );
                    paginationContainer.html( $response.find( ".rhea-ultra-properties-ajax-pagination > .pagination" ) );
                    propertiesInner.html( $response.find( ".rhea-ultra-properties-inner-container > div" ) );

                    paginationItems.removeClass( 'current' );
                    $this.addClass( 'current' );

                    loader.slideUp();

                    // Scroll to the top of the properties
                    $( 'html, body' ).animate( {
                        scrollTop : propertiesContainer.find( '.rhea-ultra-properties-inner-container' ).offset().top - 100
                    }, 1000 );
                }
            } );

            event.preventDefault();
        } );

        // Add class if div is empty
        let rheaStatusBox = $( '.rhea-ultra-property-card-three-wrapper .rhea-ultra-status-box' );
        if ( 0 < rheaStatusBox.length ) {
            rheaStatusBox.each( function () {
                if ( ! $.trim( $( this ).html() ).length ) {
                    $( this ).addClass( 'rhea-empty-wrapper' );
                }
            } );
        }

        // show lightbox info on button click
        $( 'body' ).on( 'click', '.rhea-ultra-property-card-five-popup', function () {

            let thisPopUp    = $( this ).data( 'src' );
            let galleryItems = $( thisPopUp ).find( '.rhea-gallery-item' );
            galleryItems.each( function () {
                let thisUlr = $( this ).data( 'bg-image' );
                $( this ).css( 'background-image', 'url("' + thisUlr + '")' );
            } );
        } );

        rheaEqualWidthButtons( '.rhea-equal-width-btn-1', '.rhea-equal-width-btn-2' );

    } );

    /*-----------------------------------------------------------------------------------*/
    /* Equal Width Buttons
    /*-----------------------------------------------------------------------------------*/
    window.rheaEqualWidthButtons = function ( btn1, btn2 ) {
        const rheaW1 = $( btn1 ).innerWidth();
        const rheaW2 = $( btn2 ).innerWidth();
        if ( rheaW1 > rheaW2 ) {
            $( btn2 ).css( 'width', rheaW1 + "px" );
        } else {
            $( btn1 ).css( 'width', rheaW2 + "px" );
        }
    }

    /*-----------------------------------------------------------------------------------*/
    /* Nav Menu Responsive Layout Management
    /*-----------------------------------------------------------------------------------*/
    window.rheaMenuDisplayScreen = function ( size, widgetID ) {
        const lgMenu         = $( ".rhea-lg-menu-" + widgetID );
        const responsiveMenu = $( ".rhea-responsive-men-" + widgetID );
        if ( innerWidth < size ) {
            lgMenu.hide();
            responsiveMenu.show();

        } else {
            lgMenu.show();
            responsiveMenu.hide();
        }
    }

    /*-----------------------------------------------------------------------------------*/
    /* SelectPicker Drop Down Initiation
    /*-----------------------------------------------------------------------------------*/
    window.rheaSelectPicker = function ( id ) {
        if ( $().selectpicker ) {
            $( id ).selectpicker( {
                iconBase        : 'fas',
                dropupAuto      : 'true',
                width           : "100%",
                tickIcon        : 'fa-check',
                selectAllText   : '<span class="rhea_select_bs_buttons rhea_bs_select"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><polygon points="22.1 9 20.4 7.3 14.1 13.9 15.8 15.6 "/><polygon points="27.3 7.3 16 19.3 9.6 12.8 7.9 14.5 16 22.7 29 9 "/><polygon points="1 14.5 9.2 22.7 10.9 21 2.7 12.8 "/></svg></span>',
                deselectAllText : '<span class="rhea_select_bs_buttons rhea_bs_deselect"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><style type="text/css">  \n' +
                                  '\t.rh-st0{fill:none;stroke:#000000;stroke-width:2;stroke-miterlimit:10;}\n' +
                                  '</style><path class="rhea_des rh-st0" d="M3.4 10.5H20c3.8 0 7 3.1 7 7v0c0 3.8-3.1 7-7 7h-6"/><polyline class="rhea_des rh-st0" points="8.4 15.5 3.4 10.5 8.4 5.5 "/></svg></span>'

            } );
        }
    };

    /*-----------------------------------------------------------------------------------*/
    /* Search Form Widget
    /*-----------------------------------------------------------------------------------*/
    window.rheaSearchFields = function ( id, fieldCount, topFields, collapsedFields ) {

        var divList = $( id ).find( '.rhea_prop_search__option' );
        divList.sort( function ( a, b ) {
            return $( a ).data( "key-position" ) - $( b ).data( "key-position" )
        } );

        $( topFields ).html( divList ).promise().done( function () {


            var getDataTopBar = fieldCount;


            var advanceSearch = $( topFields ).find( '.rhea_prop_search__option' );

            var prePendTo = $( collapsedFields );

            var i = 0;

            var j = 0;

            advanceSearch.each( function () {
                if ( i < getDataTopBar + 1 ) {
                    if ( $( this ).hasClass( 'hide-fields' ) ) {
                        j = 2;
                    }
                    if ( $( this ).hasClass( 'rvr-hide-fields' ) ) {
                        j++;
                    }
                }
                i++;
            } );
            var advanceElements = getDataTopBar + j + 1;

            if ( advanceElements > 0 ) {
                var advanceFieldsSmart = $( topFields )
                .find( '.rhea_prop_search__option:nth-of-type(n+' + advanceElements + ')' );

                advanceFieldsSmart.detach().prependTo( prePendTo );

            }

        } );


    };

    window.rheaOpenSearchPopup = function ( trigger, popup ) {
        $( trigger ).on( 'click', function () {
            $( popup ).addClass( 'active' );
            $( popup ).fadeIn( 'fast' );
        } );
        $( '.rhea-popup-close' ).on( 'click', function () {
            $( popup ).removeClass( 'active' );
            $( popup ).fadeOut( 'fast' );
            $( trigger ).removeClass( 'rhea_advance_open' );
        } )
    }

    window.rheaPropertySlider = function ( id, min, max, pos = 'before', separator = ',', currency = '$', min_searched = '', max_searched = '', step = 100 ) {

        function thousandSeparator( n ) {
            if ( typeof n === 'number' ) {
                n += '';
                var x   = n.split( '.' );
                var x1  = x[0];
                var x2  = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while ( rgx.test( x1 ) ) {
                    x1 = x1.replace( rgx, '$1' + separator + '$2' );
                }
                return x1 + x2;
            } else {
                return n;
            }
        }

        var getPosition = pos;

        var PosBefore = '';
        var PosAfter  = '';
        if ( getPosition === 'before' ) {
            PosBefore = currency;
        } else {
            PosAfter = currency;
        }

        var minVal = min;
        var maxVal = max;
        if ( min_searched !== '' ) {
            minVal = min_searched
        }
        if ( max_searched !== '' ) {
            maxVal = max_searched
        }

        $( id ).slider( {
            range  : true,
            min    : min,
            max    : max,
            step   : step,
            values : [minVal, maxVal],
            slide  : function ( event, ui ) {
                // Set interval difference between min and max price slider values
                if ( ui.values[0] >= ui.values[1] - Math.round( ui.values[1] / 10 ) ) {
                    return false;
                }

                for ( var i = 0; i < ui.values.length; ++i ) {
                    $( "input.rhea_slider_value[data-index=" + i + "]" ).val( ui.values[i] );
                    $( "span.rhea_price_display[data-index=" + i + "]" )
                    .text( PosBefore + thousandSeparator( ui.values[i] ) + PosAfter );

                }
            }
        } );
    };

    window.rheaSearchAdvanceState = function ( buttonID, wrapperID ) {
        $( buttonID ).on( 'click', function () {
            $( buttonID ).toggleClass( 'rhea_advance_open' );
            if ( $( buttonID ).hasClass( 'rhea_advance_open' ) ) {
                $( wrapperID ).slideDown( 'normal' );
            } else {
                $( wrapperID ).slideUp( 'normal' );
            }
        } );


    };

    window.rheaFeaturesState = function ( buttonID, wrapperID ) {
        $( buttonID ).on( 'click', function () {
            $( buttonID ).toggleClass( 'rhea_features_open' );
            if ( $( buttonID ).hasClass( 'rhea_features_open' ) ) {
                $( wrapperID ).slideDown( 'normal' );
            } else {
                $( wrapperID ).slideUp( 'normal' );
            }
        } );


    };

    /*-----------------------------------------------------------------------------------*/
    /* Search Form price change on status change
    /*-----------------------------------------------------------------------------------*/
    window.rheaSearchStatusChange = function ( priceOther, PriceRent, statusID, rent_status = 'for-rent' ) {

        if ( '' !== rent_status ) {

            var rhea_property_status_changed = function ( new_status ) {
                var price_for_others = $( priceOther );
                var price_for_rent   = $( PriceRent );

                if ( price_for_others.length > 0 && price_for_rent.length > 0 ) {

                    if ( new_status === rent_status ) {
                        price_for_others.addClass( 'hide-fields' ).find( 'select' ).prop( 'disabled', true );
                        price_for_rent.removeClass( 'hide-fields' ).find( 'select' ).prop( 'disabled', false );


                    } else {
                        price_for_rent.addClass( 'hide-fields' ).find( 'select' ).prop( 'disabled', true );
                        price_for_others.removeClass( 'hide-fields' ).find( 'select' ).prop( 'disabled', false );
                    }
                }
            };
            $( statusID ).change( function ( e ) {
                var selected_status = $( this ).val();
                rhea_property_status_changed( selected_status );
                $( '.rhea_multi_select_picker' ).selectpicker( 'refresh' );
            } );

            /* On page load ( as on search page ) */
            var selected_status = $( statusID ).val();
            if ( selected_status === rent_status ) {
                rhea_property_status_changed( selected_status );
            }
        }
    };

    window.minMaxPriceValidation     = function ( minID, maxID ) {

        /**
         * Max and Min Price
         * Shows red outline if min price is bigger than max price
         */

        /* for normal prices */
        $( minID ).add( maxID ).on( 'change', function () {
            var min_text_val = $( minID ).val();
            var min_int_val  = ( isNaN( min_text_val ) ) ? 0 : parseInt( min_text_val );

            var max_text_val = $( maxID ).val();
            var max_int_val  = ( isNaN( max_text_val ) ) ? 0 : parseInt( max_text_val );

            if ( ( min_int_val >= max_int_val ) && ( min_int_val != 0 ) && ( max_int_val != 0 ) ) {
                $( minID ).add( maxID ).siblings( '.dropdown-toggle' ).addClass( 'rhea-error' );
            } else {
                $( minID ).add( maxID ).siblings( '.dropdown-toggle' ).removeClass( 'rhea-error' );
            }
        } );
    };
    window.minMaxRentPriceValidation = function ( minID, maxID ) {

        /* for rent prices */
        $( minID ).add( maxID ).on( 'change', function () {

            var min_text_val = $( minID ).val();

            var min_int_val = ( isNaN( min_text_val ) ) ? 0 : parseInt( min_text_val );

            var max_text_val = $( maxID ).val();
            var max_int_val  = ( isNaN( max_text_val ) ) ? 0 : parseInt( max_text_val );

            if ( ( min_int_val >= max_int_val ) && ( min_int_val != 0 ) && ( max_int_val != 0 ) ) {
                $( minID ).add( maxID ).siblings( '.dropdown-toggle' ).addClass( 'rhea-error' );
            } else {
                $( minID ).add( maxID ).siblings( '.dropdown-toggle' ).removeClass( 'rhea-error' );
            }
        } );
    };

    window.minMaxAreaValidation = function ( minID, maxID ) {
        /**
         * Max and Min Area
         * To show red outline if min is bigger than max
         */
        $( minID ).add( maxID ).on( 'change', function ( obj, e ) {
            var min_text_val = $( minID ).val();
            var min_int_val  = ( isNaN( min_text_val ) ) ? 0 : parseInt( min_text_val );

            var max_text_val = $( maxID ).val();
            var max_int_val  = ( isNaN( max_text_val ) ) ? 0 : parseInt( max_text_val );

            if ( ( min_int_val >= max_int_val ) && ( min_int_val != 0 ) && ( max_int_val != 0 ) ) {
                $( minID ).add( maxID ).addClass( 'rhea-error' );
            } else {
                $( minID ).add( maxID ).removeClass( 'rhea-error' );
            }
        } );
    };


    /**
     * MapBox map widget map generation
     *
     * @since 0.9.10
     *
     * */
    window.rheaLoadMapBoxMap = function ( id, settingObj ) {

        let ThisMapID       = id,
            mapBoxContainer = document.getElementById( id );

        mapBoxContainer.className = mapBoxContainer.className + ' mapbox-dl-map-wrap rhea-mapbox-wrap';

        if ( typeof settingObj !== "undefined" ) {

            if ( 0 < settingObj.properties.length && typeof settingObj.settings.api_key !== 'undefined' ) {

                const eleMapBoxAPI         = settingObj.settings.api_key,
                      mapBoxPropertiesData = settingObj.properties,
                      widgetSettings       = settingObj.settings,
                      mapBoxStyle          = widgetSettings.style,
                      mapBoxMarkerType     = 'pin'; //widgetSettings.marker_type;

                // TODO find out the proper way to implement it
                let tileLayer = L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution : '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                } );

                // get map bounds
                let mapBounds = [];
                for ( let i = 0; i < mapBoxPropertiesData.length; i++ ) {
                    if ( mapBoxPropertiesData[i].lat && mapBoxPropertiesData[i].lng ) {
                        mapBounds.push( [mapBoxPropertiesData[i].lat, mapBoxPropertiesData[i].lng] );
                    }
                }

                // Basic map
                let mapBoxCenter = L.latLng( 27.664827, -81.515755 );	// given coordinates not going to matter 99.9% of the time but still added just in case.
                if ( 1 === mapBounds.length ) {
                    mapBoxCenter = L.latLng( mapBounds[0] );	// this is also not going to effect 99% of the time but just in case of one property.
                }

                L.mapbox.accessToken   = eleMapBoxAPI;
                const mapBoxProperties = L.mapbox.map( mapBoxContainer )
                .setView( mapBoxCenter, 12 )
                .addLayer( L.mapbox.styleLayer( mapBoxStyle ) );

                if ( 1 < mapBounds.length ) {
                    mapBoxProperties.fitBounds( mapBounds );	// fit bounds should work only for more than one properties
                }

                let markers = new L.MarkerClusterGroup();

                for ( let i = 0; i < mapBoxPropertiesData.length; i++ ) {
                    if ( mapBoxPropertiesData[i].lat && mapBoxPropertiesData[i].lng ) {
                        let propertyMapData = mapBoxPropertiesData[i],
                            markerLatLng    = L.latLng( propertyMapData.lat, propertyMapData.lng ),
                            propertyMarker,
                            markerOptions   = {
                                id          : propertyMapData.id,
                                riseOnHover : true
                            };

                        // Marker icon
                        if ( propertyMapData.title ) {
                            markerOptions.title = propertyMapData.title;
                        }

                        // Map marker.
                        if ( 'pin' === mapBoxMarkerType ) {
                            let iconOptions = {
                                iconUrl     : propertyMapData.icon,
                                iconSize    : [42, 57],
                                iconAnchor  : [20, 57],
                                popupAnchor : [1, -54]
                            };
                            if ( propertyMapData.retinaIcon ) {
                                iconOptions.iconRetinaUrl = propertyMapData.retinaIcon;
                            }
                            markerOptions.icon = L.icon( iconOptions );
                            propertyMarker     = L.marker( markerLatLng, markerOptions );
                        } else {
                            propertyMarker = new L.CircleMarker( markerLatLng, {
                                fillColor   : '#1cb2ff', //widgetSettings.marker_color,
                                color       : '#1cb2ff', //widgetSettings.marker_color,
                                weight      : 2,
                                fillOpacity : 0.6,
                                opacity     : 0.6,
                                radius      : 25
                            } ).addTo( mapBoxProperties );
                        }

                        // Marker popup
                        let popupContentWrapper       = document.createElement( "div" );
                        popupContentWrapper.className = 'mapboxgl-popup-content';
                        let popupContent              = "";

                        if ( propertyMapData.thumb ) {
                            popupContent += '<a class="mapbox-popup-thumb-link" href="' + propertyMapData.url + '"><img class="mapbox-popup-thumb" src="' + propertyMapData.thumb + '" alt="' + propertyMapData.title + '"/></a>';
                        }

                        if ( propertyMapData.title ) {
                            popupContent += '<h5 class="mapbox-popup-title"><a class="mapbox-popup-link" href="' + propertyMapData.url + '">' + propertyMapData.title + '</a></h5>';
                        }

                        if ( propertyMapData.price ) {
                            popupContent += '<p><span class="mapbox-popup-price">' + propertyMapData.price + '</span></p>';
                        }

                        popupContentWrapper.innerHTML = popupContent;

                        propertyMarker.popupContents = popupContentWrapper;
                        propertyMarker.id            = propertyMapData.id;
                        propertyMarker.className     = 'mapboxgl-wrapper';
                        propertyMarker.bindPopup( popupContentWrapper );

                        markers.addLayer( propertyMarker );

                    }
                }
                mapBoxProperties.addLayer( markers );
                mapBoxProperties.scrollWheelZoom.disable();

                /*
                * Panning the marker to center of the visible map on "popupopen" event
                */
                mapBoxProperties.on( 'popupopen', function ( e ) {
                    // find the pixel location on the map where the popup anchor is
                    var px = mapBoxProperties.project( e.target._popup._latlng );
                    // find the height of the popup container, divide by 2, subtract from the Y axis of marker location
                    px.y -= e.target._popup._container.clientHeight / 2;
                    // pan to new center
                    mapBoxProperties.panTo( mapBoxProperties.unproject( px ), { animate : true } );

                } );

                /**
                 * Function to find the marker in a cluster
                 * @param {int} marker
                 * @param {int} cluster
                 * @returns
                 */
                function is_marker_in_cluster( marker, cluster ) {

                    let length = cluster.length;

                    for ( let i = 0; i < length; i++ ) {

                        if ( cluster[i].id == marker ) {

                            return true;

                        }

                    }

                    return false;

                }

                /**
                 * Open Popup function
                 * @param {int} markerid
                 */
                function mapbox_open_popup( markerid ) {

                    mapBoxProperties.eachLayer( function ( layer ) {

                        // Checking if this layer is a cluster
                        if ( typeof layer._childCount !== "undefined" ) {

                            // Getting all markers in this cluster
                            let markersincluster = layer.getAllChildMarkers();

                            if ( is_marker_in_cluster( markerid, markersincluster ) ) {

                                layer.spiderfy();

                                markersincluster.forEach(
                                    function ( property_marker ) {
                                        if ( property_marker.id === parseInt( markerid ) ) {

                                            property_marker.openPopup();

                                        }
                                    } );

                            }

                        } else {

                            if ( layer.id === parseInt( markerid ) ) {

                                layer.openPopup();

                            }

                        }

                    } );

                }

                /**
                 * Close Popup function
                 * @param {int} markerid
                 */
                function mapbox_close_popup( markerid ) {

                    mapBoxProperties.eachLayer( function ( layer ) {

                        // Checking if this layer is a cluster
                        if ( typeof layer._childCount !== "undefined" ) {

                            // Getting all markers in this cluster
                            var markersincluster = layer.getAllChildMarkers();

                            if ( is_marker_in_cluster( markerid, markersincluster ) ) {

                                layer.unspiderfy();

                                markersincluster.forEach(
                                    function ( property_marker ) {

                                        if ( property_marker.id == parseInt( markerid ) ) {

                                            layer.closePopup();

                                        }

                                    } );
                            }

                        } else {

                            if ( layer.id == parseInt( markerid ) ) {

                                layer.closePopup();

                                mapBoxProperties.closePopup();

                            }

                        }

                    } );

                }

                let realhomesInfoboxPopupTrigger = function () {

                    $( '.rh_popup_info_map' ).each( function ( i ) {

                        // Getting the Property ID for mouse events
                        let property_ID = $( this ).attr( 'data-rh-id' ).replace( /[^\d.]/g, '' );

                        $( this )
                        .on( 'mouseenter', function () {
                            mapbox_open_popup( property_ID );
                        } )
                        .on( 'mouseleave', function () {
                            mapbox_close_popup( property_ID );
                        } );

                    } );

                    return false;
                };

                let RHisMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test( navigator.userAgent ) ? true : false;

                if ( ! RHisMobile ) {
                    realhomesInfoboxPopupTrigger();
                }

            } else {

                // Fallback Map
                var fallbackLayer = L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution : '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                } );

                // todo: provide an option for fallback map coordinates
                var fallbackMapOptions = {
                    center : [27.664827, -81.515755],
                    zoom   : 12
                };

                var fallbackMap = L.map( ThisMapID, fallbackMapOptions );
                fallbackMap.addLayer( fallbackLayer );

            }

        }

    };


    window.rheaLocationsHandler = function ( hierarchicalLocations,
                                             locationPlaceholders,
                                             selectBoxesIDs,
                                             slugsInQueryParams,
                                             selectBoxesCount,
                                             anyValue,
                                             multiSelect ) {

        /**
         * Following function automatically runs to initialize locations boxes
         */
        ( function () {
            /* prepare select boxes */
            prepareSelectBoxes();

            let parentLocations = [];
            for ( let selectIndex = 0; selectIndex < selectBoxesCount; selectIndex++ ) {
                const currentSelect = $( '#' + selectBoxesIDs[selectIndex] ); /* loop's current select box */
                const currentIsLast = ( selectBoxesCount === ( selectIndex + 1 ) ); /* check if current select box is last */

                if ( selectIndex === 0 ) { /* First iteration */
                    parentLocations = addParentLocations( currentSelect, currentIsLast );
                } else { /* later iterations */
                    /* If parents locations array is not empty then there could be children to add in current select box */
                    if ( parentLocations.length > 0 ) {
                        let currentLocations = [];
                        const previousSelect = $( '#' + selectBoxesIDs[selectIndex - 1] );

                        /* loop through all if value is "any" */
                        if ( previousSelect.val() === anyValue ) {
                            for ( let i = 0; i < parentLocations.length; i++ ) {
                                let tempLocations = addChildrenLocations( currentSelect, parentLocations[i].children, '', currentIsLast );
                                if ( tempLocations.length > 0 ) {
                                    currentLocations = $.merge( currentLocations, tempLocations );
                                }
                            }
                        } else {
                            /* Otherwise add only children of previous selected location, It there are any. */
                            let previousLocation = searchLocation( previousSelect.val(), hierarchicalLocations );
                            if ( previousLocation && previousLocation.children.length > 0 ) {
                                currentLocations = addChildrenLocations( currentSelect, previousLocation.children, '', currentIsLast );
                            }
                        }

                        /* hook up updateChildSelect function with previous select change event */
                        previousSelect.change( updateChildSelect );
                        /* currentLocations variable is passed to parentLocations for code below and for next iteration */
                        parentLocations = currentLocations;
                    }
                }

                /* If parentLocations is empty */
                if ( parentLocations.length === 0 ) {
                    /* disable current select and children selects if any */
                    disableSelect( currentSelect );
                    /* No need for further iterations */
                    break;
                } else {
                    /* Select the right option within current select based on query parameters */
                    selectParamOption( currentSelect );
                }
            }   /* end of loop */
        } )(); /* Run the function immediately after declaration */

        /**
         * Adds top level locations to given select box, If addAllChildren is true then it adds all children locations as well
         * @param targetSelect
         * @param addAllChildren
         * @returns {*[]}
         */
        function addParentLocations( targetSelect, addAllChildren ) {
            let addedLocations   = [];
            let insertionCounter = 0;

            /* loop through top level locations */
            hierarchicalLocations.forEach( function ( currentLocation, index, locationsArray ) {
                targetSelect.append( '<option value="' + currentLocation.slug + '">' + currentLocation.name + '</option>' );
                addedLocations[insertionCounter++] = currentLocation;
                if ( addAllChildren && currentLocation.children.length ) {
                    addChildrenLocations( targetSelect, currentLocation.children, '- ', addAllChildren );
                }
            } );

            return addedLocations;
        }

        /**
         * Adds top level locations form given childrenLocations array to targetSelect box, If addAllChildren is true then it adds all children locations as well
         * @param targetSelect
         * @param childrenLocations
         * @param prefix
         * @param addAllChildren
         * @returns {*[]}
         */
        function addChildrenLocations( targetSelect, childrenLocations, prefix, addAllChildren ) {
            let addedChildrenLocations = [];
            let insertionCounter       = 0;

            /* loop through all children locations */
            childrenLocations.forEach( function ( currentLocation, index, locationsArray ) {
                targetSelect.append( '<option value="' + currentLocation.slug + '">' + prefix + currentLocation.name + '</option>' );
                addedChildrenLocations[insertionCounter++] = currentLocation;
                /* If a current location has children then add those as well */
                if ( addAllChildren && currentLocation.children.length ) {
                    let tempLocations = addChildrenLocations( targetSelect, currentLocation.children, prefix + '- ', addAllChildren );
                    if ( tempLocations.length > 0 ) {
                        /* merge newly added children locations with existing children locations array */
                        addedChildrenLocations = $.merge( addedChildrenLocations, tempLocations );
                    }
                }
            } );

            return addedChildrenLocations;
        }

        /**
         * Search a location from given locations array for given slug
         * @param slug
         * @param locations
         * @returns {boolean}   location OR false if no location is found
         */
        function searchLocation( slug, locations ) {
            let targetLocation = false;

            for ( let index = 0; index < locations.length; index++ ) {
                let currentLocation = locations[index];
                if ( currentLocation.slug === slug ) {
                    targetLocation = currentLocation;
                    break;
                }
                if ( currentLocation.children.length > 0 ) {
                    targetLocation = searchLocation( slug, currentLocation.children );
                    if ( targetLocation ) {
                        break;
                    }
                }
            }

            return targetLocation;
        }

        /**
         * Update child select box based on change in selected value of parent select box
         * @param event
         */
        function updateChildSelect( event ) {
            let selectedSlug       = $( this ).val();
            let currentSelectIndex = selectBoxesIDs.indexOf( $( this ).attr( 'id' ) );

            /*  When "any" is selected, Also no need to run this on last select box */
            if ( selectedSlug === anyValue && ( currentSelectIndex > -1 ) && ( currentSelectIndex < ( selectBoxesCount - 1 ) ) ) {
                for ( let s = currentSelectIndex; s < ( selectBoxesCount - 1 ); s++ ) {
                    /* check if child select is Last */
                    let childSelectIsLast = ( selectBoxesCount === ( s + 2 ) );

                    /* find child select box, empty it and add any options to it */
                    let childSelect = $( '#' + selectBoxesIDs[s + 1] );
                    childSelect.empty();
                    addAnyOption( childSelect );

                    /* loop through select options to find and add children locations into next select */
                    let anyChildLocations = [];
                    $( '#' + selectBoxesIDs[s] + ' > option' ).each( function () {
                        if ( this.value !== anyValue ) {
                            let relatedLocation = searchLocation( this.value, hierarchicalLocations );
                            if ( relatedLocation && relatedLocation.children.length > 0 ) {
                                let tempChildrenLocations = addChildrenLocations( childSelect, relatedLocation.children, '', childSelectIsLast );
                                if ( tempChildrenLocations.length > 0 ) {
                                    anyChildLocations = $.merge( anyChildLocations, tempChildrenLocations );
                                }
                            }
                        }
                    } );

                    /* enable next select if options are added otherwise disable it */
                    if ( anyChildLocations.length > 0 ) {
                        enableSelect( childSelect );
                    } else {
                        disableSelect( childSelect );
                        break;
                    }

                }   /* end of for loop */

            } else {
                /* In case of valid location selection */
                let selectedParentLocation = searchLocation( selectedSlug, hierarchicalLocations );
                if ( selectedParentLocation ) {
                    let childLocations = [];
                    for ( let childSelectIndex = currentSelectIndex + 1; childSelectIndex < selectBoxesCount; childSelectIndex++ ) {
                        /* check if child select is Last */
                        let childSelectIsLast = ( selectBoxesCount === ( childSelectIndex + 1 ) );

                        /* find and empty child select box */
                        let childSelect = $( '#' + selectBoxesIDs[childSelectIndex] );
                        childSelect.empty();

                        /* First iteration */
                        if ( childLocations.length === 0 ) {
                            if ( selectedParentLocation.children.length > 0 ) {
                                addAnyOption( childSelect );
                                let tempLocations = addChildrenLocations( childSelect, selectedParentLocation.children, '', childSelectIsLast );
                                if ( tempLocations.length > 0 ) {
                                    childLocations = tempLocations;
                                }
                            }
                        } else if ( childLocations.length > 0 ) { /* 2nd and later iterations */
                            let currentLocations = [];
                            for ( let i = 0; i < childLocations.length; i++ ) {
                                let tempChildLocation = childLocations[i];
                                if ( tempChildLocation.children.length > 0 ) {
                                    addAnyOption( childSelect );
                                    let tempLocations = addChildrenLocations( childSelect, tempChildLocation.children, '', childSelectIsLast );
                                    if ( tempLocations.length > 0 ) {
                                        currentLocations = $.merge( currentLocations, tempLocations );
                                    }
                                }
                            }
                            /* If there are current locations OR none, assign current locations array to child locations*/
                            childLocations = currentLocations;
                        }

                        if ( childLocations.length > 0 ) {
                            enableSelect( childSelect );
                        } else {
                            disableSelect( childSelect );
                            break;
                        }
                    } /* end of for loop */
                }
            }
        }

        /**
         * Adds Any value and select index based place holder text to given select box.
         * @param targetSelect
         */
        function addAnyOption( targetSelect ) {
            if ( targetSelect.has( 'option' ).length > 0 ) {
                return;
            }

            /* current select box index */
            let targetSelectIndex = selectBoxesIDs.indexOf( targetSelect.attr( 'id' ) );

            /* For location fields in search form */
            if ( targetSelect.parents( '.rhea_prop_search__select' )
            .hasClass( 'rhea_location_prop_search_' + targetSelectIndex ) ) {
                targetSelect.append( '<option value="' + anyValue + '" selected="selected">' + locationPlaceholders[targetSelectIndex] + '</option>' );
            }
        }

        /**
         * Disable a select box and next select boxes if exists
         * @param targetSelect
         */
        function disableSelect( targetSelect ) {
            let targetSelectID = targetSelect.attr( 'id' );
            targetSelect.empty();

            targetSelect.closest( '.option-bar' ).addClass( 'disabled' );
            if ( targetSelect.is( ':enabled' ) ) {
                targetSelect.prop( 'disabled', true );
                targetSelect.parents( '.rhea_prop_search__select' ).addClass( 'rhea_disable_parent' );
            }

            let targetSelectIndex    = selectBoxesIDs.indexOf( targetSelectID );      // target select box index
            let nextSelectBoxesCount = selectBoxesCount - ( targetSelectIndex + 1 );

            /* Disable next select box as well */
            if ( nextSelectBoxesCount > 0 ) {
                let nextSelect = $( '#' + selectBoxesIDs[targetSelectIndex + 1] );
                disableSelect( nextSelect );
            }
        }

        /**
         * Enable a select box
         * @param targetSelect
         */
        function enableSelect( targetSelect ) {
            let targetSelectID = targetSelect.attr( 'id' );

            if ( targetSelect.is( ':disabled' ) ) {
                targetSelect.prop( 'disabled', false );
            }

            // remove class from parents
            targetSelect.parents( '.rhea_prop_search__select' ).map( function () {
                if ( $( this ).hasClass( 'rhea_disable_parent' ) ) {
                    $( this ).removeClass( 'rhea_disable_parent' );
                }
            } );

            /* Remove .option-bar's disabled class */
            let optionWrapper = targetSelect.closest( '.option-bar' );
            if ( optionWrapper.hasClass( 'disabled' ) ) {
                optionWrapper.removeClass( 'disabled' );
            }
        }

        /**
         * Mark the current value in query params as selected in related select box
         * @param currentSelect
         */
        function selectParamOption( currentSelect ) {
            if ( Object.keys( slugsInQueryParams ).length > 0 ) {
                let selectName = currentSelect.attr( 'name' );
                if ( typeof selectName !== "undefined" ) {
                    selectName = selectName.replace( /[\[\]]+/g, '' ); /* remove box brackets as for multi select location brackets comes with name */
                }
                if ( typeof slugsInQueryParams[selectName] !== 'undefined' ) {
                    let tempValue = slugsInQueryParams[selectName];
                    if ( Array.isArray( tempValue ) ) {
                        for ( let i = 0; i < tempValue.length; i++ ) {
                            currentSelect.find( 'option[value="' + tempValue[i] + '"]' ).prop( 'selected', true );
                        }
                    } else {
                        currentSelect.find( 'option[value="' + tempValue + '"]' ).prop( 'selected', true );
                    }
                }
            }
        }

        /**
         * Append options with Any value or None value depending on conditions
         */
        function prepareSelectBoxes() {
            /* Loop through select boxes and prepare them with basic option */
            for ( let selectIndex = 0; selectIndex < selectBoxesCount; selectIndex++ ) {
                let currentSelectId = selectBoxesIDs[selectIndex];
                let currentSelect   = $( '#' + currentSelectId );

                /* For location fields in search form */
                if ( ( multiSelect !== 'multiple' ) &&
                     ( currentSelect.has( 'option' ).length === 0 ) &&
                     ( currentSelect.parents( '.rhea_prop_search__select' )
                     .hasClass( 'rhea_location_prop_search_' + selectIndex ) ) ) {
                    addAnyOption( currentSelect );
                }
            }
        }
    };

    var rheaLocationSuccessList = function ( data, thisParent, refreshList = false ) {

        if ( true === refreshList ) {
            thisParent.find( 'option' ).not( ':selected, .none' ).remove().end();
        }
        var getSelected = $( thisParent ).val();


        jQuery.each( data, function ( index, text ) {

            if ( getSelected ) {
                if ( getSelected.indexOf( text[0] ) < 0 ) {
                    thisParent.append(
                        $( '<option value="' + text[0] + '">' + text[1] + '</option>' )
                    );
                }
            } else {
                thisParent.append(
                    $( '<option value="' + text[0] + '">' + text[1] + '</option>' )
                );
            }
        } );
        thisParent.selectpicker( 'refresh' );
        $( parent ).find( 'ul.dropdown-menu li:first-of-type a' ).focus();

        $( parent ).find( 'input' ).focus();

    };

    var rheaLoaderFadeIn = function ( parent ) {
        $( parent ).find( '.rhea-location-ajax-loader' ).fadeIn( 'fast' );
    };

    var rheaLoaderFadeOut = function ( parent ) {
        $( parent ).find( '.rhea-location-ajax-loader' ).fadeOut( 'fast' );
    };

    var rheaTriggerAjaxOnLoad = function ( parent, thisParent, ajaxurl, hideEmpty, SortAlpha, fieldValue = '' ) {

        $.ajax( {
            url        : ajaxurl,
            dataType   : 'json',
            delay      : 250, // delay in ms while typing when to perform a AJAX search
            data       : {
                action          : 'rhea_get_location_options', // AJAX action for admin-ajax.php
                query           : fieldValue,
                hideemptyfields : hideEmpty,
                sortplpha       : SortAlpha

            },
            beforeSend : rheaLoaderFadeIn( parent ),
            success    : function ( data ) {
                rheaLoaderFadeOut( parent );
                rheaLocationSuccessList( data, thisParent, true );
            }
        } );

    };

    var rheaTriggerAjaxOnScroll = function ( parent, thisParent, farmControl, ajaxurl, hideEmpty, SortAlpha, fieldValue = '' ) {

        var paged = 2;

        farmControl.on( 'keyup', function ( e ) {
            paged = 2;

            fieldValue = $( this ).val();
        } );

        var targetInner = $( parent ).find( 'div.inner' );

        targetInner.on( 'scroll', function () {
            var thisInner = $( this );

            var thisInnerHeight = thisInner.innerHeight();
            var getScrollIndex  = thisInner.scrollTop() + thisInnerHeight;
            if ( getScrollIndex >= $( this )[0].scrollHeight ) {


                $.ajax( {
                    url      : ajaxurl,
                    dataType : 'json',
                    delay    : 250, // delay in ms while typing when to perform a AJAX search
                    data     : {
                        action          : 'rhea_get_location_options', // AJAX action for admin-ajax.php
                        query           : fieldValue,
                        page            : paged,
                        hideemptyfields : hideEmpty,
                        sortplpha       : SortAlpha
                    },
                    // beforeSend: loaderFadeIn(),
                    beforeSend : rheaLoaderFadeIn( parent ),
                    success    : function ( data ) {
                        rheaLoaderFadeOut( parent );
                        paged++;
                        rheaLocationSuccessList( data, thisParent, false );

                        if ( ! $.trim( data ) ) {
                            $( parent ).find( '.rhea-location-ajax-loader' ).fadeTo( "fast", 0 );
                        }
                    }
                } );
            }
        } );
    };

    window.rheaAjaxSelect = function ( parent, id, ajaxurl, hideEmpty, SortAlpha ) {
        var farmControl = $( parent ).find( '.form-control' );
        var thisParent  = $( id );
        rheaTriggerAjaxOnScroll( parent, thisParent, farmControl, ajaxurl, hideEmpty, SortAlpha );
        rheaTriggerAjaxOnLoad( parent, thisParent, ajaxurl, hideEmpty, SortAlpha );
        farmControl.on( 'keyup', function ( e ) {
            var fieldValue = $( this ).val();
            fieldValue     = fieldValue.trim();
            var wordcounts = jQuery.trim( fieldValue ).length;
            $( parent ).find( '.rhea-location-ajax-loader' ).fadeTo( "fast", 1 );
            if ( wordcounts > 0 ) {
                $.ajax( {
                    url        : ajaxurl,
                    dataType   : 'json',
                    delay      : 250, // delay in ms while typing when to perform a AJAX search
                    data       : {
                        action          : 'rhea_get_location_options', // AJAX action for admin-ajax.php
                        query           : fieldValue,
                        hideemptyfields : hideEmpty,
                        sortplpha       : SortAlpha
                    },
                    beforeSend : rheaLoaderFadeIn( parent ),
                    success    : function ( data ) {
                        rheaLoaderFadeOut( parent );
                        thisParent.find( 'option' ).not( ':selected' ).remove().end();
                        // var options = [];
                        if ( fieldValue && data ) {
                            rheaLocationSuccessList( data, thisParent );
                        } else {
                            thisParent.find( 'option' ).not( ':selected' ).remove().end();
                            thisParent.selectpicker( 'refresh' );
                            $( parent ).find( 'ul.dropdown-menu li:first-of-type a' ).focus();
                            $( parent ).find( 'input' ).focus();
                        }
                    }
                } );
            } else {
                rheaTriggerAjaxOnLoad( parent, thisParent, ajaxurl, hideEmpty, SortAlpha )
            }
        } );
    };

    window.searchFormAjaxKeywords = function ( id, url ) {
        var inputField = $( id ).find( 'input' );
        inputField.keyup( function () {
            var charCount = inputField.val().length;
            if ( charCount > 1 ) {
                $( id ).find( '.rhea-properties-data-list' ).slideDown();
                $( id ).find( '.rhea_sfoi_ajax_loader' ).show();
                $( id ).find( '.rhea-field-icon-wrapper' ).addClass( 'rhea-search-fade' )
                $.ajax( {
                    url     : url,
                    type    : 'POST',
                    data    : {
                        action  : 'rh_sfoi_data_fetch',
                        keyword : $( this ).val()
                    },
                    success : function ( data ) {
                        $( id ).find( '.rhea-properties-data-list' ).html( data );
                        $( id ).find( '.rhea_sfoi_ajax_loader' ).hide();
                        $( id ).find( '.rhea-field-icon-wrapper' ).removeClass( 'rhea-search-fade' )

                    }
                } );
            } else {
                $( id ).find( '.rhea-properties-data-list' ).slideUp();
            }
        } );
    }

    window.rheaTestimonialsTwoCarousel = function ( id, itemsFluid = 4, items = 3, itemsTab = 2, itemsMob = 1, gap = 30, dots = true, rtl = false ) {
        if ( $().owlCarousel ) {
            $( id ).owlCarousel( {
                loop       : false,
                dots       : dots,
                nav        : false,
                margin     : gap,
                rtl        : rtl,
                responsive : {
                    0    : {
                        items : itemsMob
                    },
                    767  : {
                        items : itemsTab
                    },
                    1024 : {
                        items : items
                    },
                    1440 : {
                        items : itemsFluid
                    }
                }

            } );
        }
    };

    window.rheaTestimonialsThreeCarousel = function ( slide1, slide2, navSelectors, animationspeed = '600', slideshowspeed = '5000', slideShow1 = true, direction1 = 'horizontal', animation1 = 'fade', reverse1 = false, animation2 = 'fade', reverse2 = false ) {
        if ( $().flexslider ) {
            $( slide1 ).flexslider( {
                controlNav     : false,
                directionNav   : false,
                animationLoop  : true,
                slideshow      : slideShow1,
                direction      : direction1,
                animation      : animation1,
                reverse        : reverse1,
                animationSpeed : animationspeed,
                slideshowSpeed : slideshowspeed
            } );

            $( slide2 ).flexslider( {
                controlNav         : false,
                animation          : animation2,
                animationLoop      : true,
                slideshow          : slideShow1,
                reverse            : reverse2,
                customDirectionNav : $( navSelectors ),
                sync               : $( slide1 ),
                animationSpeed     : animationspeed,
                slideshowSpeed     : slideshowspeed
            } );
        }
    };

    window.rheaTestimonialsFourCarousel = function ( slider, navSelectors, animation = 'fade', animationSpeed = '600', reverse = false, slideshow = false, slideshowSpeed = '5000' ) {
        if ( $().flexslider ) {
            $( slider ).flexslider( {
                controlNav     : false,
                directionNav   : false,
                animation      : animation,
                animationSpeed : animationSpeed,
                reverse        : reverse,
                slideshow      : slideshow,
                slideshowSpeed : slideshowSpeed
            } );

            $( navSelectors ).on( 'click', function ( event ) {
                $( slider ).flexslider( $( this ).attr( 'href' ) );
                event.preventDefault();
            } );
        }
    };

    window.EREloadNewsSlider = function () {
        if ( $().flexslider ) {
            $( '.rhea-listing-news-slider' ).each( function () {
                $( this ).flexslider( {
                    animation  : "slide",
                    slideshow  : false,
                    controlNav : false,

                    customDirectionNav : $( this ).next( '.rhea-news-directional-nav' ).find( 'a' )
                } );
            } );
        }
    }

    window.ultraFeaturedSlider = function ( s1, s2 ) {
        var s1       = $( s1 );
        var s2       = $( s2 );
        var maxItems = 3;

        var $sliderItemTotal = $( ".rhea-slider-item-total" );

        s2.flexslider( {
            move          : 1,
            directionNav  : false,
            animation     : "slide",
            controlNav    : false,
            animationLoop : false,
            slideshow     : false,
            itemWidth     : 10,
            itemMargin    : 12,
            asNavFor      : s1,
            maxItems      : maxItems,
            minItems      : 1,
            start         : function ( item ) {
                slideCounter( item );
            },
            after         : function ( item ) {
                slideCounter( item );
            }
        } );

        function slideCounter( item ) {
            $sliderItemTotal.text( item.count - maxItems - item.currentSlide );
        }

        s1.flexslider( {
            smoothHeight  : true,
            animation     : "fade",
            controlNav    : false,
            animationLoop : false,
            slideshow     : false,
            sync          : s2
        } );


    }

    window.rheaSubmitContactForm = function ( formID, btnSelector ) {
        if ( jQuery().validate && jQuery().ajaxSubmit ) {

            var submitButton     = $( btnSelector ),
                ajaxLoader       = $( formID ).find( '.rhea-ajax-loader' ),
                messageContainer = $( formID ).find( '.rhea-message-container' ),
                errorContainer   = $( formID ).find( ".rhea-error-container" );

            var formOptions = {
                beforeSubmit : function () {
                    submitButton.attr( 'disabled', 'disabled' );
                    ajaxLoader.fadeIn( 'fast' );
                    messageContainer.fadeOut( 'fast' );
                    errorContainer.fadeOut( 'fast' );
                },
                success      : function ( ajax_response, statusText, xhr, $form ) {
                    var response = $.parseJSON( ajax_response );
                    ajaxLoader.fadeOut( 'fast' );
                    submitButton.removeAttr( 'disabled' );
                    if ( response.success ) {
                        $form.resetForm();
                        messageContainer.html( response.message ).fadeIn( 'fast' );

                        setTimeout( function () {
                            messageContainer.fadeOut( 'slow' )
                        }, 5000 );

                        // call reset function if it exists
                        if ( typeof inspiryResetReCAPTCHA == 'function' ) {
                            inspiryResetReCAPTCHA();
                        }

                        if ( typeof CFOSData !== 'undefined' ) {
                            setTimeout( function () {
                                window.location.replace( CFOSData.redirectPageUrl );
                            }, 1000 );
                        }

                        if ( typeof contactFromData !== 'undefined' ) {
                            setTimeout( function () {
                                window.location.replace( contactFromData.redirectPageUrl );
                            }, 1000 );
                        }
                    } else {
                        errorContainer.html( response.message ).fadeIn( 'fast' );
                    }
                }
            };


            // Agent single page form
            $( formID ).validate( {
                errorLabelContainer : errorContainer,
                submitHandler       : function ( form ) {
                    $( form ).ajaxSubmit( formOptions );
                }
            } );
        }
    };

    function isInViewport( node ) {
        var rect = node.getBoundingClientRect();
        return (
            ( rect.height > 0 || rect.width > 0 ) &&
            rect.bottom >= 0 &&
            rect.right >= 0 &&
            rect.top <= ( window.innerHeight || document.documentElement.clientHeight ) &&
            rect.left <= ( window.innerWidth || document.documentElement.clientWidth )
        )
    }

    function scrollParallax( selector ) {
        var scrolled = jQuery( window ).scrollTop();
        jQuery( selector ).each( function ( index, element ) {
            var initY  = jQuery( this ).offset().top;
            var height = jQuery( this ).height();
            var endY   = initY + jQuery( this ).height();

            // Check if the element is in the viewport.
            var visible = isInViewport( this );
            if ( visible ) {
                var diff  = scrolled - initY;
                var ratio = Math.round( ( diff / height ) * 100 );
                jQuery( this ).css( 'background-position', 'center ' + parseInt( ( ratio * 1 ) ) + 'px' )
            }

        } )
    }

    jQuery( '.ere_cta_parallax' ).each( function () {
        scrollParallax( this );
    } );

    jQuery( window ).scroll( function () {
        jQuery( '.ere_cta_parallax' ).each( function () {
            scrollParallax( this );
        } );

    } );

    // Testimonials Five Carousel
    window.rheaTestimonialsFiveCarousel = function ( settings ) {
        if ( $().owlCarousel ) {

            let carouselOptions = {
                items              : 1,
                margin             : 0,
                nav                : false,
                autoHeight         : true,
                loop               : settings.loop,
                autoplay           : settings.autoplay,
                autoplayTimeout    : settings.autoplaySpeed,
                autoplayHoverPause : true,
                smartSpeed         : settings.animationSpeed,
                dotsContainer      : settings.dots,
                rtl                : $( 'body' ).hasClass( 'rtl' )
            };

            if ( 'fade' === settings.slideAnimation ) {
                carouselOptions.animateOut = 'fadeOut';
                carouselOptions.animateIn  = 'fadeIn';
            }

            $( settings.id ).owlCarousel( carouselOptions );
        }
    };

    // Image Carousel Widget Script.
    window.rheaImageCarousel = function ( settings ) {
        if ( $().slick ) {
            const imageCarouselWrap = $( settings.wrapper ),
                  imageCarousel     = $( settings.id );

            imageCarousel.on( 'init', function ( event, slick, direction ) {
                $( event.currentTarget ).show();
            } );

            imageCarousel.slick( {
                fade               : settings.fade,
                speed              : settings.speed,
                infinite           : settings.infinite,
                autoplay           : settings.autoplay,
                autoplaySpeed      : settings.autoplaySpeed,
                pauseOnHover       : settings.pauseOnHover,
                pauseOnInteraction : settings.pauseOnInteraction,
                slidesToShow       : settings.slidesToShow,
                slidesToScroll     : settings.slidesToScroll,
                rows               : 1,
                slidesPerRow       : 1,
                dots               : settings.dots,
                arrows             : settings.arrows,
                prevArrow          : imageCarouselWrap.find( '.rhea-image-carousel-button-prev' ),
                nextArrow          : imageCarouselWrap.find( '.rhea-image-carousel-button-next' ),
                vertical           : false,
                mobileFirst        : true,
                adaptiveHeight     : false,
                rtl                : $( 'body' ).hasClass( 'rtl' ),
                responsive         : [
                    {
                        breakpoint : 1025,
                        settings   : {
                            slidesToShow   : settings.slidesToShow,
                            slidesToScroll : settings.slidesToScroll
                        }
                    },
                    {
                        breakpoint : 768,
                        settings   : {
                            slidesToShow   : settings.slidesToShowTablet,
                            slidesToScroll : settings.slidesToScrollTablet
                        }
                    },
                    {
                        breakpoint : 380,
                        settings   : {
                            slidesToShow   : settings.slidesToShowMobile,
                            slidesToScroll : settings.slidesToScrollMobile
                        }
                    },
                    {
                        breakpoint : 0,
                        settings   : {
                            slidesToShow   : 1,
                            slidesToScroll : 1
                        }
                    }
                ]
            } );
        }
    };

    // Accordion Widget Script.
    window.rheaAccordion = function ( id ) {
        $( '#' + id + ' > .rhea-accordion-title' ).on( 'click', function ( event ) {
            var $this = $( this );

            if ( $this.hasClass( 'rhea-accordion-active' ) ) {
                $this.next( '.rhea-accordion-content' ).slideUp( 500, function () {
                    $this.removeClass( 'rhea-accordion-active' )
                } );
            } else {
                $this.siblings( '.rhea-accordion-title' ).removeClass( 'rhea-accordion-active' );
                $this.addClass( 'rhea-accordion-active' )
                .next( '.rhea-accordion-content' )
                .slideDown( 500 )
                .siblings( '.rhea-accordion-content' )
                .slideUp( 500 );
            }
        } );
    };

    // Tabs Widget Script.
    window.rheaTabs = function ( id ) {
        const tabsContainer      = $( '#' + id );
        const tabsList           = tabsContainer.find( '.rhea-tabs-list li' );
        const tabsContentWrapper = tabsContainer.find( '.rhea-tabs-content-wrapper' );
        const tabsContent        = tabsContainer.find( '.rhea-tabs-content-wrapper .rhea-tabs-content' );

        if ( tabsContent.length ) {
            let minHeight      = 0;
            let contentHeights = [];

            tabsContent.each( function ( index ) {
                // Gather all content wrapper heights.
                contentHeights.push( $( this ).outerHeight() );
            } );

            if ( contentHeights ) {
                // Find max value in the array and add with wrapper's space.
                minHeight = Math.max.apply( Math, contentHeights ) + ( tabsContentWrapper.outerHeight() - tabsContentWrapper.height() );

                // Set container minimum height
                tabsContainer.css( 'min-height', minHeight );
            }
        }

        tabsList.on( 'click', function ( event ) {
            const $this = $( this );

            tabsList.removeClass( 'rhea-tabs-active' );
            $this.addClass( 'rhea-tabs-active' );

            // Hide all content and show current one.
            tabsContent.hide().removeClass( 'rhea-tabs-active' );
            tabsContent.eq( $this.index() ).show().addClass( 'rhea-tabs-active' );
        } );
    };

    // Image Gallery Widget Script.
    window.rheaImageGallery = function ( settings ) {
        if ( jQuery().isotope ) {
            const container      = $( settings.containerId ),
                  filterLinks    = $( settings.filters ),
                  galleryOptions = {
                      filter          : "*",
                      animationEngine : 'best-available',
                      itemSelector    : settings.itemSelector
                  };

            if ( 'grid' === settings.layout ) {
                galleryOptions.layoutMode = 'fitRows';
            }

            const gallery = container.isotope( galleryOptions );

            // Re-layout
            gallery.isotope( 'layout' );

            filterLinks.on( 'click', function ( event ) {
                filterLinks.removeClass( 'current' );
                $( this ).addClass( 'current' );

                gallery.isotope( { filter : '.' + $( this ).attr( 'data-filter' ) } );
                event.preventDefault();
            } );
        }
    };

    // Get width and height and set the width/position of Featured Properties slider nav
    window.rheaFeaturedNavPosition = function ( id1, id2 ) {
        var sliderWidth = $( id1 ).outerWidth();
        var slideHeight = $( id1 ).outerHeight();

        $( id2 ).width( sliderWidth );
        $( id2 ).css( 'top', slideHeight );
    }

    // Schedule Tour Form Widget Script.
    window.rheaScheduleTourForm = function ( id ) {
        if ( jQuery().validate && jQuery().ajaxSubmit ) {

            const formId           = $( id ),
                  submitButton     = formId.find( '.rhea-stf-submit' ),
                  ajaxLoader       = formId.find( '.rhea-stf-ajax-loader' ),
                  messageContainer = formId.find( '.rhea-stf-message-container' ),
                  errorContainer   = formId.find( ".rhea-stf-error-container" );

            const formOptions = {
                beforeSubmit : function () {
                    submitButton.attr( 'disabled', 'disabled' );
                    ajaxLoader.fadeIn( 'fast' );
                    messageContainer.fadeOut( 'fast' );
                    errorContainer.fadeOut( 'fast' );
                },
                success      : function ( ajax_response, statusText, xhr, $form ) {
                    var response = $.parseJSON( ajax_response );
                    ajaxLoader.fadeOut( 'fast' );
                    submitButton.removeAttr( 'disabled' );
                    if ( response.success ) {
                        $form.resetForm();
                        messageContainer.html( response.message ).fadeIn( 'fast' );

                        setTimeout( function () {
                            messageContainer.fadeOut( 'slow' )
                        }, 5000 );

                        // Call reset function if it exists.
                        // if (typeof inspiryResetReCAPTCHA == 'function') {
                        //     inspiryResetReCAPTCHA();
                        // }
                    } else {
                        errorContainer.html( response.message ).fadeIn( 'fast' );
                    }
                }
            };

            $( id ).validate( {
                errorLabelContainer : errorContainer,
                submitHandler       : function ( form ) {
                    $( form ).ajaxSubmit( formOptions );
                }
            } );
        }
    };

    if ( jQuery().isotope ) {
        $( '.rhea_properties_cities_wrapper.masonry' ).isotope( {
            itemSelector : '.rhea_property_city',
            //percentPosition: true,
            masonry : {
                //columnWidth: 300,
                horizontalOrder : true
            }
        } )
    }

    /**
     * Enable empty values dropdown fields again on clicking the browser back button
     */
    window.onload = function ( event ) {
        setTimeout( function () {
            $( '.rhea_multi_select_picker' ).selectpicker( 'refresh' );
            $( '.rhea_multi_select_picker_location ' ).selectpicker( 'refresh' );
        }, 500 );

    }


    /**
     * Hotel Services Slider
     */

    window.rheaServicesSlider = function ( id ) {

        const carousel = $( id ).find( '.rhea-service-carousel-tabs' );
        const slider   = $( id ).find( '.rhea-service-carousel-images' );
        const navPrev  = $( id ).find( '.rhea-prev-service' );
        const navNext  = $( id ).find( '.rhea-next-service' );

        carousel.slick( {
            slidesToShow   : 4,
            slidesToScroll : 1,
            asNavFor       : slider,
            dots           : false,
            centerMode     : false,
            focusOnSelect  : true,
            prevArrow      : navPrev,
            nextArrow      : navNext,
            responsive     : [
                {
                    breakpoint : 1200,
                    settings   : {
                        slidesToShow : 3
                    }
                },
                {
                    breakpoint : 800,
                    settings   : {
                        slidesToShow : 2
                    }
                }
            ]
        } );

        slider.slick( {
            slidesToShow   : 1,
            slidesToScroll : 1,
            arrows         : false,
            fade           : true,
            draggable      : false
        } );

    }

    /**
     * RVR guests fields counter
     */
    window.rvrGuestsFieldsCounter = function ( field, wrapper ) {
        $( '.rhea-guests-number' ).each( function () {

            let decrement      = $( this ).find( '.minus' );
            let increment      = $( this ).find( '.plus' );
            let $input         = $( this ).find( 'input' );
            let currentCounter = '';
            let adultsRequired = false;
            if ( $( this ).hasClass( 'adults-field' ) ) {
                currentCounter = $( this ).closest( '.rhea-guests-field-dropdown-box' ).find( '.adults i' );
                adultsRequired = true;
            }
            if ( $( this ).hasClass( 'children-field' ) ) {
                currentCounter = $( this ).closest( '.rhea-guests-field-dropdown-box' ).find( '.children i' );
            }
            if ( $( this ).hasClass( 'infants-field' ) ) {
                currentCounter = $( this ).closest( '.rhea-guests-field-dropdown-box' ).find( '.infants i' );
            }

            decrement.on( 'click', function () {

                let count = parseInt( $input.val() ) - 1;
                if ( true === adultsRequired ) {
                    count = count < 1 ? 1 : count;
                } else {
                    count = count < 0 ? 0 : count;
                }
                $input.val( count );
                $input.change();
                currentCounter.html( count );
                return false;
            } );

            increment.on( 'click', function () {
                let count = parseInt( $input.val() ) + 1;
                $input.val( count );
                $input.change();
                currentCounter.html( count );
                return false;
            } );


        } );

        $( field ).on( 'click', function () {
            if ( ! $( wrapper ).hasClass( 'active' ) ) {
                $( wrapper ).addClass( 'active' );
            } else {
                $( wrapper ).removeClass( 'active' );
            }
        } );

        //Close guests field dropdown if click outside the wrapper
        $( 'body' ).on( "click", function ( e ) {
            const target     = $( '.rhea-guests-field-dropdown-box, .rhea-guests-field-dropdown-box *' );
            const targetDrop = $( '.rhea-rvr-guests-fields-wrapper' );
            if ( targetDrop.hasClass( 'active' ) ) {
                if ( $( e.target ).is( target ) === false && $( e.target ).is( targetDrop ) === false ) {
                    targetDrop.removeClass( "active" );
                }
            }
        } );

    }

} )( jQuery );