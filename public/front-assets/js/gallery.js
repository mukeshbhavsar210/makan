$(document).ready(function(){

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

$('.sidebar-gallery').slick({
    centerMode: true,
    centerPadding: '0',   // smaller padding
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    prevArrow: '<i class="icon-left-arrow right-arrow arrow"></i>',
    nextArrow: '<i class="icon-right-arrow left-arrow arrow"></i>',
    lazyLoad: 'progressive' 
});

$('.listing-gallery').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    dots: true,
    arrows: true,
});

$('.discoverProducts').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 1,
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