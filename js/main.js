jQuery(function ($) {
    'use strict',

    //#main-slider
	$(function () {
	    $('#main-slider.carousel').carousel({
	        interval: 8000
	    });
	});


    // accordian
    $('.accordion-toggle').on('click', function () {
        $(this).closest('.panel-group').children().each(function () {
            $(this).find('>.panel-heading').removeClass('active');
        });

        $(this).closest('.panel-heading').toggleClass('active');
    });

    //Initiat WOW JS
    new WOW().init();

    // portfolio filter
    $(window).load(function () {
        'use strict';
        var $portfolio_selectors = $('.portfolio-filter >li>a');
        var $portfolio = $('.portfolio-items');
        $portfolio.isotope({
            itemSelector: '.portfolio-item',
            layoutMode: 'fitRows'
            //,filter: '.proyectostopograficos'
        });

        $portfolio_selectors.on('click', function () {
            $portfolio_selectors.removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $portfolio.isotope({ filter: selector });
            return false;
        });
    });

    //goto top
    $('.gototop').click(function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $("body").offset().top
        }, 500);
    });

    //Pretty Photo
    $("a[rel^='prettyPhoto']").prettyPhoto({
        social_tools: false
    });

    $('.homepage').on('click', '.actionTraining', function () {

        $('#training-form').attr('action', '/control.aspx?Accion=' + $(this).attr('data'));

        $('.tituloTraining').removeClass('active');
        $('.tituloTraining.' + $(this).attr('data')).addClass('active');

        $('.training-form-group').removeClass('active');
        $('.training-form-group.' + $(this).attr('data')).addClass('active');
    });

    $("#file-upload").change(function(){
        readURL(this, "blah");
    });

    $("#blah").click(function(){
        $("#file-upload").click();
    });
    
    //ImageUpload
    $("#file-upload2").change(function(){
        readURL(this, "blah2");
    });

    $("#blah2").click(function(){
        $("#file-upload2").click();
    });

    $("#file-upload3").change(function(){
        readURL(this, "blah3");
    });

    $("#blah3").click(function(){
        $("#file-upload3").click();
    });

    //Raty
    $( ".raty" ).each(function() {
      $(this).raty({score:1, scoreName: $(this).attr("id"), path: '/expocruceros/images'});
    });

});

function readURL(input,blah) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#' + blah).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
