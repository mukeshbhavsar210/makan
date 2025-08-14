$(document).ready(function(){
    
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 1500);        
    
   

    $('.carousalHome').slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: true,
        autoplay: true,
        autoplaySpeed: 2000,
        cssEase: 'linear',
        prevArrow:'<i class="icon-left-arrow right-arrow arrow"></i>',
        nextArrow:'<i class="icon-right-arrow left-arrow arrow"></i>',
        arrows: true
      });

      $('.propertyMedia').slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: true,
        autoplay: true,
        autoplaySpeed: 1000,
        cssEase: 'linear',
        arrows: false
      });


    $('.discoverProducts').slick({
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow:'<i class="icon-left-arrow right-arrow arrow"></i>',
        nextArrow:'<i class="icon-right-arrow left-arrow arrow"></i>',
    });

    $('.meetDeveloprs').slick({
        lazyLoad: 'ondemand',
        centerMode: true,
        centerPadding: '50px',
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        prevArrow:'<i class="icon-left-arrow right-arrow arrow"></i>',
        nextArrow:'<i class="icon-right-arrow left-arrow arrow"></i>',
    });

    $(".responsive").slick({
        centerMode: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        prevArrow:'<i class="icon-left-arrow right-arrow arrow"></i>',
        nextArrow:'<i class="icon-right-arrow left-arrow arrow"></i>',
        responsive: [{
            breakpoint: 1200,
            settings: {
                centerMode: false,
                centerPadding: '0px',
                slidesToShow: 5,
                slidesToScroll: 1,
                
            }
        },{
            breakpoint: 1300,
            settings: {
                 centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },{
            breakpoint: 1200,
            settings: {
                 centerMode: false,
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        },{
            breakpoint: 1024,
            settings: {
                 centerMode: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },{
            breakpoint: 992,
            settings: {
                 centerMode: false,
                slidesToShow: 2,
                slidesToScroll: 1,
            }
        },{
            breakpoint: 576,
            settings: {
                 centerMode: false,
                slidesToShow: 1,
                slidesToScroll: 1,      
            }
        }] 
    });
   
});


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
    let areasContainer = $('#areas');
    let searchInput = $('#keyword');

    // Add or remove .active class on city select
    if (cityID) {
        $('.flex-search').addClass('active');
    } else {
        $('.flex-search').removeClass('active');
    }

    // Clear old list
    areasContainer.empty().hide();

    if (cityID && selectedCategory) {
        $.ajax({
            url: '/get-areas/' + cityID,
            type: 'GET',
            success: function (data) {
                let html = '';
                data.forEach(function (area) {
                    html += `<li>
                                <a href="#" class="area-item" data-id="${area.id}">
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

                // Click to select area
                $('.area-item').on('click', function () {
                    let areaID = $(this).data('id');
                    let params = new URLSearchParams(window.location.search);
                    params.set('category', selectedCategory);
                    params.set('city', cityID);
                    params.set('area', areaID);
                    window.location.href = '/properties?' + params.toString();
                });
            }
        });
    }
});


// $('.rentBuy input[type="radio"]').on('change', function() {
//     $('.rentBuy label').removeClass('activeTab');
//     $(this).closest('label').addClass('activeTab');
//     $(this).closest('body').toggleClass('sellCover');
// });


$('.rentBuy input[type="radio"]').on('change', function() {
    $('.rentBuy label').removeClass('activeTab');
    $(this).closest('label').addClass('activeTab');
    $('.searchHome').toggleClass('sellCover');

    // Get label text
    // let labelText = $(this).closest('label').text().trim().toLowerCase();

    // if (labelText === 'buy') {
    //     window.location.href = '/';
    // } else if (labelText === 'rent') {
    //     window.location.href = '/rent';
    // }
});




$(document).ready(function () {
   let priceLabels = ["0", "50L", "1Cr", "2Cr", "3Cr", "4Cr", "5Cr+"];
    let priceValues = [0, 5000000, 10000000, 20000000, 30000000, 40000000, 50000000];

    let fromIndex = 0;
    let toIndex = 6;

    let minVal = parseInt($("#price_min").val());
    let maxVal = parseInt($("#price_max").val());

    if (!isNaN(minVal)) {
        let idx = priceValues.indexOf(minVal);
        if (idx !== -1) fromIndex = idx;
    }
    if (!isNaN(maxVal)) {
        let idx = priceValues.indexOf(maxVal);
        if (idx !== -1) toIndex = idx;
    }

    let slider = $("#priceRange").ionRangeSlider({
        type: "double",
        values: priceLabels,
        from: fromIndex,
        to: toIndex,
        grid: true,
        skin: "round",
        onFinish: function (data) {
            $("#price_min").val(priceValues[data.from]);
            $("#price_max").val(priceValues[data.to]);
        }
    }).data("ionRangeSlider");

    // Reset Button Click
    $("#resetPriceRange").on("click", function () {
        // Reset hidden inputs
        $("#price_min").val("");
        $("#price_max").val("");

        // Reset slider visually
        slider.update({
            from: 0,
            to: priceLabels.length - 1
        });
        $("#filterForm").submit();
    });



    function toggleActiveClass(name, buttonId) {
        let anyChecked = $(`input[name="${name}[]"]:checked`).length > 0;
        $(`#${buttonId}`).toggleClass('activeFilter', anyChecked);
    }

    // List of filter groups and their button IDs
    let filters = [
        { name: 'bathroom', buttonId: 'bathroomDropdown' },
        { name: 'room', buttonId: 'roomDropdown' },
        { name: 'type', buttonId: 'typeDropdown' }
    ];

    // Attach change listener to all checkboxes in these groups
    filters.forEach(f => {
        $(document).on('change', `input[name="${f.name}[]"]`, function () {
            toggleActiveClass(f.name, f.buttonId);
        });

        // Run once on page load to set initial state
        toggleActiveClass(f.name, f.buttonId);
    });

});



$(document).on('change', 'input[name="type[]"], input[name="room[]"], input[name="bathroom[]"], input[name="areas[]"]', function () {
    let params = new URLSearchParams(window.location.search);

    // Clear old params
    params.delete('type[]');
    params.delete('room[]');
    params.delete('bathroom[]');
    params.delete('areas[]');

    // Add Property Type values
    $('input[name="type[]"]:checked').each(function () {
        params.append('type[]', $(this).val());
    });

    // Add BHK Type values
    $('input[name="room[]"]:checked').each(function () {
        params.append('room[]', $(this).val());
    });

    // Add Bathrooms values
    $('input[name="bathroom[]"]:checked').each(function () {
        params.append('bathroom[]', $(this).val());
    });

    // Add Areas values
    $('input[name="areas[]"]:checked').each(function () {
        params.append('areas[]', $(this).val());
    });

    // Reload page with updated params
    window.location.href = window.location.pathname + '?' + params.toString();
});

