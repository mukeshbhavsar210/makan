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
    let areasDropdown = $('#areas');

    areasDropdown.html('<option value="">Loading...</option>');

    if (cityID && selectedCategory) {
        $.ajax({
            url: '/get-areas/' + cityID,
            type: 'GET',
            success: function (data) {
                areasDropdown.empty().append('<option value="">Areas</option>');
                $.each(data, function (key, area) {
                    areasDropdown.append('<option value="' + area.id + '">' + area.name + '</option>');
                });

                // Fire search when area selected
                areasDropdown.off('change').on('change', function () {
                    let areaID = $(this).val();
                    if (areaID) {
                        let params = new URLSearchParams(window.location.search);
                        params.set('category', selectedCategory);
                        params.set('city', cityID);
                        params.set('area', areaID);
                        window.location.href = '/properties?' + params.toString();
                    }
                });
            }
        });
    } else {
        areasDropdown.html('<option value="">Areas</option>');
    }
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

