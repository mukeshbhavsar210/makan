
//From home page
let selectedCategory = $('input[name="category"]:checked').val(); // set default if checked
// Handle category selection
$('input[name="category"]').on('change', function () {
    selectedCategory = $(this).val();
    $('#city').prop('disabled', false); // enable city dropdown after category selection
});

// Handle city change
$('#city').on('change', function () { 
    let cityID = $(this).val();
    let citySlug = $('#city option:selected').data('slug'); // ✅ use slug instead of name
    let areasContainer = $('#areas');
    let areasTopContainer = $('#areas_top');
    let areasBtmContainer = $('#areas_btm');

    // Add or remove .active class on city select
    if (cityID) {
        $('.flex-search').addClass('active');
    } else {
        $('.flex-search').removeClass('active');
    }

    // Clear old list
    areasContainer.empty().hide();
    areasTopContainer.empty().hide();
    areasBtmContainer.empty().hide();

    if (cityID && selectedCategory) {
        $.ajax({
            url: '/get-areas/' + cityID,
            type: 'GET',
            success: function (data) {
                let html = '';
                data.forEach(function (area) {
                    html += `<li>
                                <a href="#" class="area-item" data-id="${area.id}" data-slug="${area.slug}">
                                    <div class="icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_1_3059" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                                            <rect width="24" height="24" rx="12" fill="#D8D8D8"/>
                                            </mask>
                                            <g mask="url(#mask0_1_3059)">
                                            <path d="M19.3 19.7482H4.5C4.4 19.7482 4.2 19.6482 4.1 19.5482C4 19.4482 4 19.2482 4 19.1482L6 11.7482C6.1 11.5482 6.2 11.4482 6.4 11.4482H8.7C9 11.4482 9.2 11.6482 9.2 11.9482C9.2 12.2482 9 12.4482 8.7 12.4482H6.8L5 18.9482H18.6L16.8 12.4482H15.1C14.8 12.4482 14.6 12.2482 14.6 11.9482C14.6 11.6482 14.8 11.4482 15.1 11.4482H17.1C17.3 11.4482 17.5 11.5482 17.5 11.7482L19.6 19.1482C19.6 19.2482 19.6 19.4482 19.5 19.5482C19.4 19.6482 19.5 19.7482 19.3 19.7482Z" fill="#434343"/>
                                            <path d="M13.5 16.1483H10.3C10 16.1483 9.80005 15.9483 9.80005 15.6483C9.80005 15.3483 10 15.1483 10.3 15.1483H13.5C13.8 15.1483 14 15.3483 14 15.6483C14 15.9483 13.8 16.1483 13.5 16.1483Z" fill="#434343"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4 13.6482C11.5 13.7482 11.7 13.8482 11.9 13.8482C12.1 13.8482 12.3 13.7482 12.5 13.5482C12.6 13.4482 12.7 13.3232 12.8 13.1982C12.9 13.0732 13 12.9482 13.1 12.8482C13.2 12.6482 13.4 12.4482 13.6 12.2482C14.2 11.5482 14.8 10.7482 15.3 9.94824C15.7 9.34824 15.9 8.64824 15.9 7.94824C15.9 6.94824 15.5 5.94824 14.7 5.14824C13.6 4.04824 11.8 3.64824 10.3 4.34824C8.60004 5.14824 7.60004 7.04824 8.10004 8.84824C8.20004 9.44824 8.40004 9.84824 8.80004 10.3482C9.50004 11.4482 10.4 12.5482 11.4 13.6482ZM10.6 5.24824C11 5.04824 11.4 4.94824 11.8 4.94824C12.6 4.94824 13.4 5.24824 13.9 5.74824C14.5 6.34824 14.9 7.14824 14.9 7.94824C14.9 8.54824 14.8 9.04824 14.5 9.54824C14.1759 10.1964 13.7205 10.7133 13.2402 11.2585C13.1277 11.3862 13.0139 11.5154 12.9 11.6482C12.8 11.7482 12.7 11.8732 12.6 11.9982C12.5 12.1232 12.4 12.2482 12.3 12.3482C12.2 12.5482 12 12.7482 11.9 12.8482C11.6334 12.5149 11.3556 12.1816 11.0778 11.8482C10.5223 11.1816 9.96671 10.5149 9.50004 9.84824C9.20004 9.54824 9.10004 9.14824 9.00004 8.74824C8.60004 7.34824 9.30004 5.84824 10.6 5.24824Z" fill="#434343"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.4 13.6482C11.5 13.7482 11.7 13.8482 11.9 13.8482C12.1 13.8482 12.3 13.7482 12.5 13.5482C12.6 13.4482 12.7 13.3232 12.8 13.1982C12.9 13.0732 13 12.9482 13.1 12.8482C13.2 12.6482 13.4 12.4482 13.6 12.2482C14.2 11.5482 14.8 10.7482 15.3 9.94824C15.7 9.34824 15.9 8.64824 15.9 7.94824C15.9 6.94824 15.5 5.94824 14.7 5.14824C13.6 4.04824 11.8 3.64824 10.3 4.34824C8.60004 5.14824 7.60004 7.04824 8.10004 8.84824C8.20004 9.44824 8.40004 9.84824 8.80004 10.3482C9.50004 11.4482 10.4 12.5482 11.4 13.6482ZM10.6 5.24824C11 5.04824 11.4 4.94824 11.8 4.94824C12.6 4.94824 13.4 5.24824 13.9 5.74824C14.5 6.34824 14.9 7.14824 14.9 7.94824C14.9 8.54824 14.8 9.04824 14.5 9.54824C14.1759 10.1964 13.7205 10.7133 13.2402 11.2585C13.1277 11.3862 13.0139 11.5154 12.9 11.6482C12.8 11.7482 12.7 11.8732 12.6 11.9982C12.5 12.1232 12.4 12.2482 12.3 12.3482C12.2 12.5482 12 12.7482 11.9 12.8482C11.6334 12.5149 11.3556 12.1816 11.0778 11.8482C10.5223 11.1816 9.96671 10.5149 9.50004 9.84824C9.20004 9.54824 9.10004 9.14824 9.00004 8.74824C8.60004 7.34824 9.30004 5.84824 10.6 5.24824Z" fill="#434343"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 8C10.5 7.17157 11.1716 6.5 12 6.5C12.8284 6.5 13.5 7.17157 13.5 8C13.5 8.82843 12.8284 9.5 12 9.5C11.1716 9.5 10.5 8.82843 10.5 8ZM12.5 8C12.5 7.72386 12.2761 7.5 12 7.5C11.7239 7.5 11.5 7.72386 11.5 8C11.5 8.27614 11.7239 8.5 12 8.5C12.2761 8.5 12.5 8.27614 12.5 8Z" fill="#434343"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="text">
                                        <p class="link">${area.name}</p>
                                        <p class="locality">Locality</p>
                                    </div>
                                </a>
                            </li>`;
                });
                areasContainer.html(html).show();
                areasTopContainer.html(html).show();
                areasBtmContainer.html(html).show();

                // Click to select area
                $('.area-item').on('click', function (e) {
                    e.preventDefault();
                    let areaSlug = $(this).data('slug'); // ✅ use slug instead of name
                    let params = new URLSearchParams(window.location.search);
                    params.set('category', selectedCategory);
                    params.set('city', citySlug); 
                    params.set('area', areaSlug);
                    window.location.href = '/properties?' + params.toString();
                });
            }
        });
    }
});


    //BHK on
    $(document).on("change", ".room-option", function () {
        let target = $($(this).data("target"));
        if ($(this).is(":checked")) {
            target.addClass("active");
        } else {
            target.removeClass("active");
        }
    });

    $(document).on("input", ".price, .size", function () {
        let key = $(this).data("title"); // e.g. 1_bhk
        let parentGroup = $("#heading_" + key); // parent checkbox group
        let priceVal = $(".price[data-title='" + key + "']").val().trim();
        let sizeVal  = $(".size[data-title='" + key + "']").val().trim();

        if (priceVal !== "" || sizeVal !== "") {
            parentGroup.addClass("active");
            $("#room_" + key).prop("checked", true); // ✅ also check the box automatically
        } else {
            parentGroup.removeClass("active");
            $("#room_" + key).prop("checked", false); // ✅ uncheck if both empty
        }
    });


     $("input[name='residence_types']").on("change", function (e) {
        e.preventDefault();   // stop form submission
        e.stopPropagation();  // stop bubbling if any parent is listening

        if ($(this).val() === "residential") {
            $(".residenceProperty").removeClass("d-none");
            $(".commercialProperty").addClass("d-none");
        } else {
            $(".residenceProperty").addClass("d-none");
            $(".commercialProperty").removeClass("d-none");
        }
    });








        
        $(".property-types .nav-link").on("click", function () {
            let value = $(this).data("value"); // residential or commercial
            $("#residence_types").val(value);
        });


       $("input[name='residence_types']").on("change", function (e) {
            e.preventDefault();   // stop form submission
            e.stopPropagation();  // stop bubbling if any parent is listening

            if ($(this).val() === "residential") {
                $(".residenceProperty").removeClass("d-none");
                $(".commercialProperty").addClass("d-none");
            } else {
                $(".residenceProperty").addClass("d-none");
                $(".commercialProperty").removeClass("d-none");
            }
        });

        //BHK on
        $(document).on("change", ".room-option", function () {
            let target = $($(this).data("target"));
            if ($(this).is(":checked")) {
                target.addClass("active");
                $(".child-wrapper").removeClass("d-none");
            } else {
                target.removeClass("active");
            }
        });

        $(document).on("input", ".price, .size", function () {
            let key = $(this).data("title"); // e.g. 1_bhk
            let parentGroup = $("#heading_" + key); // parent checkbox group
            let priceVal = $(".price[data-title='" + key + "']").val().trim();
            let sizeVal  = $(".size[data-title='" + key + "']").val().trim();

            if (priceVal !== "" || sizeVal !== "") {
                parentGroup.addClass("active");
                $("#room_" + key).prop("checked", true); // ✅ also check the box automatically
            } else {
                parentGroup.removeClass("active");
                $("#room_" + key).prop("checked", false); // ✅ uncheck if both empty
            }
        });

        $("#resetFiltersBtn").on("click", function () {
        // Uncheck all checkboxes
        $('input[name="area[]"]').prop("checked", false);

        // Optionally, submit the form to refresh filters
        // $("#filterForm").submit();
    });

    $('.rentBuy input[type="radio"]').on('change', function() {
        $('.rentBuy label').removeClass('activeTab');
        $(this).closest('label').addClass('activeTab');
        $('.searchHome').toggleClass('sellCover');
    });

    
    function initRangeSlider(config) {
        let {
            element,       // slider element selector
            labels,        // display labels
            values,        // real values
            minInput,      // hidden min input selector
            maxInput       // hidden max input selector
        } = config;

        let fromIndex = 0;
        let toIndex = labels.length - 1;

        let minVal = parseInt($(minInput).val());
        let maxVal = parseInt($(maxInput).val());

        if (!isNaN(minVal)) {
            let idx = values.indexOf(minVal);
            if (idx !== -1) fromIndex = idx;
        }
        if (!isNaN(maxVal)) {
            let idx = values.indexOf(maxVal);
            if (idx !== -1) toIndex = idx;
        }

        $(element).ionRangeSlider({
            type: "double",
            values: labels,
            from: fromIndex,
            to: toIndex,
            grid: true,
            skin: "flat",
            onFinish: function (data) {
                $(minInput).val(values[data.from]);
                $(maxInput).val(values[data.to]);
            }
        });
    }

    // ---- Price Slider ----
    initRangeSlider({
        element: "#priceRange",
        labels: ["0", "25L", "50L", "75L", "1Cr", "2Cr", "3Cr", "4Cr", "5Cr+"],
        values: [0, 2500000, 5000000, 7500000, 10000000, 20000000, 30000000, 40000000, 50000000],
        minInput: "#price_min",
        maxInput: "#price_max"
    });

    // ---- Size Slider ----
    initRangeSlider({
        element: "#sizeRange",
        labels: ["0", "500", "1000", "1500", "2000", "3000", "4000", "5000+"],
        values: [0, 500, 1000, 1500, 2000, 3000, 4000, 5000],
        minInput: "#size_min",
        maxInput: "#size_max"
    });


    
// List of filter groups and their button IDs
let filters = [
    { name: 'bathroom', buttonId: 'bathroomDropdown' },
    { name: 'room', buttonId: 'roomDropdown' },
    { name: 'property_type', buttonId: 'propertyTypeDropdown' }
];

// Attach change listener to all checkboxes in these groups
filters.forEach(f => {
    $(document).on('change', `input[name="${f.name}[]"]`, function () {
        toggleActiveClass(f.name, f.buttonId);
    });

    // Run once on page load to set initial state
    toggleActiveClass(f.name, f.buttonId);
});

//Main filters
$(document).on('change', 'input[name="saletype"], input[name="residence_types"],  input[name="posted_by"], input[name="construction"], input[name="age"], input[name="property_type[]"], input[name="room[]"], input[name="bathroom[]"], input[name="listed_type[]"], input[name="area[]"], input[name="amenities[]"], input[name="furnishing[]"], input[name="facing[]"]', function () {
    let params = new URLSearchParams(window.location.search);

    // Clear old params (so unchecked values don’t remain in URL)
    params.delete('saletype');
    params.delete('residence_types');
    params.delete('construction');
    params.delete('age');
    params.delete('property_type[]');
    params.delete('room[]');
    params.delete('bathroom[]');
    params.delete('listed_type[]');    
    params.delete('area[]');
    params.delete('facing[]');
    params.delete('amenities[]');
    params.delete('furnishing[]');
    params.delete('posted_by');

    // ✅ Single-select fields
    let saleTypeChecked = $('input[name="saletype"]:checked');
    if (saleTypeChecked.length) params.set('saletype', saleTypeChecked.val());

    let residenceTypeChecked = $('input[name="residence_types"]:checked');
    if (saleTypeChecked.length) params.set('residence_types', residenceTypeChecked.val());

    let constructionChecked = $('input[name="construction"]:checked');
    if (constructionChecked.length) params.set('construction', constructionChecked.val());

    let ageChecked = $('input[name="age"]:checked');
    if (ageChecked.length) params.set('age', ageChecked.val());

    //Search with users role
    let userChecked = $('input[name="posted_by"]:checked');
    if (userChecked.length) params.set('posted_by', userChecked.val());

    // ✅ Multi-select fields
    $('input[name="property_type[]"]:checked').each(function () {
        params.append('property_type[]', $(this).val());
    });

    $('input[name="room[]"]:checked').each(function () {
        params.append('room[]', $(this).val());
    });

    $('input[name="bathroom[]"]:checked').each(function () {
        params.append('bathroom[]', $(this).val());
    });

    $('input[name="listed_type[]"]:checked').each(function () {
        params.append('listed_type[]', $(this).val());
    });

    // ✅ FIXED: Area checkboxes (multi-select)
    $('input[name="area[]"]:checked').each(function () {
        params.append('area[]', $(this).val());
    });

    $('input[name="facing[]"]:checked').each(function () {
        params.append('facing[]', $(this).val());
    });

    $('input[name="amenities[]"]:checked').each(function () {
        params.append('amenities[]', $(this).val());
    });

    $('input[name="furnishing[]"]:checked').each(function () {
        params.append('furnishing[]', $(this).val());
    });

    $("#pageLoader").fadeIn(200);

    window.location.href = window.location.pathname + '?' + params.toString();
});



$('#applyFilters, #resetFilters').on('click', function () {
    var dropdown = bootstrap.Dropdown.getInstance($('#moreFiltersDropdown')[0]);
    if (dropdown) {
        dropdown.hide();
    }
});


//Toggle main header 
$(".toggleControl").on("click", function() {
    $(".control-header").toggleClass("expanded"); 
    $(".overlay").fadeToggle(400);
});

$(document).on("click", "#showAllAreasTop", function (e) {
    e.preventDefault();

    // count how many areas are inside
    let areaCount = $(".listing-areas-top .area-item").length;    

    $(".listing-areas-top").slideToggle(300, () => {
        if ($(".listing-areas-top").is(":visible")) {
            $("#showAllAreasTop").html(
                '<svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12H18" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Hide'
            );
        } else {
            if (areaCount > 1) {
                $("#showAllAreasTop").html(
                    `<svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12H18M12 6V18" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> +${areaCount - 1} more`
                );
            } else {
                $("#showAllAreasTop").html(
                    '<svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12H18M12 6V18" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Add'
                );
            }
        }
    });
});


$(document).on("click", "#showAllAreasBtm", function (e) {
    e.preventDefault();

    $(".hidden-areas-added-btm").toggleClass("show-areas-btm");

    $(".listing-areas-btm").slideToggle(300, () => {
        if ($(".listing-areas-btm").is(":visible")) {
            $("#showAllAreasBtm").html(
                'Hide <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12H18" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'
            );
        } else {
            $("#showAllAreasBtm").html(
                'Add <svg width="15px" height="15px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 12H18M12 6V18" stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'
            );
        }
    });
});


// Remove selected area on X click
$(document).on("click", ".remove-area", function (e) {
    e.preventDefault();
    let areaSlug = $(this).data("slug");

    let params = new URLSearchParams(window.location.search);
    let selectedAreas = params.getAll("area[]");

    // remove the clicked slug
    selectedAreas = selectedAreas.filter(slug => slug !== areaSlug);

    // reset query params
    params.delete("area[]");
    selectedAreas.forEach(slug => {
        params.append("area[]", slug);
    });

    // redirect with updated query string
    window.location.href = window.location.pathname + "?" + params.toString();
});


$(function() {
  $(".heart").on("click", function() {
    $(this).toggleClass("is-active");
  });
});


$('#city_inner').on('change', function () { 
    let cityID = $(this).val();
    let areasBtmContainer = $('#areas_dynamic');

    $('#area_old').addClass('hide_old_area');
    $(".listing-areas-btm").show();

    // Toggle .active class
    $('.flex-search').toggleClass('active', !!cityID);

    // Clear old list
    areasBtmContainer.empty().hide();

    if (cityID) {   // removed selectedCategory check
        $.ajax({
            url: '/get-areas/' + cityID,
            type: 'GET',
            dataType: 'json',   // ensure JSON
            success: function (data) {
                if (Array.isArray(data) && data.length > 0) {
                    let html = '';
                    data.forEach(function (area) {
                        html += `<li>
                                    <a href="#" class="custom-checkbox-label" data-id="${area.id}">
                                        ${area.name}
                                    </a>
                                 </li>`;
                    });
                    areasBtmContainer.html(html).show();

                    // Click to select area
                    $('.custom-checkbox-label').on('click', function (e) {
                        e.preventDefault();
                        let areaID = $(this).data('id');
                        let params = new URLSearchParams(window.location.search);
                        params.set('city', cityID);
                        params.set('area', areaID);
                        window.location.href = '/properties?' + params.toString();
                    });
                } else {
                    areasBtmContainer.html('<li>No areas found</li>').show();
                }
            },
            error: function () {
                areasBtmContainer.html('<li>Error loading areas</li>').show();
            }
        });
    }
});
