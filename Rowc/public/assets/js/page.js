// Document Ready
$(document).ready(function () {

    

});


// Start Equal Height
equalheight = function (container) {

    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;
    $(container).each(function () {

        $el = $(this);
        $($el).height('auto')
        topPostion = $el.position().top;

        if (currentRowStart != topPostion) {
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.height();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        }
        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });
}


// Window Resize
$(window).on("resize", function () {
    equalheight('class-name');
}).resize();


// Window Load
$(window).load(function (evt) {
    equalheight('class-name');
});


$('.selec2-fld').select2({
    width:100+'%',
    minimumResultsForSearch:6
});


//$('.date-filter-slider').slick({
//    centerMode: true,
//    centerPadding: '60px',
//    slidesToShow: 4,
//    prevArrow: '<div><button type="button" class="tc-twitter-arrows tc-arrow-prev"></button></div>',
//    nextArrow: '<div><button type="button" class="tc-twitter-arrows tc-arrow-next"></button></div>',
//    responsive: [
//        {
//            breakpoint: 768,
//            settings: {
//                arrows: false,
//                centerMode: true,
//                centerPadding: '40px',
//                slidesToShow: 3
//            }
//        },
//        {
//            breakpoint: 480,
//            settings: {
//                arrows: false,
//                centerMode: true,
//                centerPadding: '40px',
//                slidesToShow: 2
//            }
//        }
//    ]
//});


(function() {
    "use strict";

    var toggles = document.querySelectorAll(".c-hamburger");

    for (var i = toggles.length - 1; i >= 0; i--) {
        var toggle = toggles[i];
        toggleHandler(toggle);
    };
    function toggleHandler(toggle) {
        toggle.addEventListener("click", function(e) {
            e.preventDefault();
            (this.classList.contains("is-active") === true) ? this.classList.remove("is-active"): this.classList.add("is-active");
        });
    }

})();
// Start mobile Menu Show Hide
$(".mob-menu-click").click(function () {
    $('header .menu-section > .top-menu').toggleClass('menu-section-show');
    $('body').toggleClass('menu-section-overflow');
});



/****************************Login Register Popup*********************************/
function showRegisterForm(){
    $('.login-box').slideUp('300',function(){
        $('.register-box , .forget-box').slideDown('300');
        $('.forget-box').slideUp('300');
    });
    $('.error').removeClass('alert alert-danger').html('');

}
function showLoginForm(values){

    if(values == 1 || values == 2) {
        if(values == 2){
           $(".social-buttons").hide();
        }
        document.getElementById("is_login_register").value = values;
    }
    $('.register-box').slideUp('300',function(){
        $('.login-box').slideDown('300');
        $('.forget-box').slideUp('300');
    });
    //$('').slideUp('fast');
    $('.error').removeClass('alert alert-danger').html('');
}
function showForgetForm(){

    $('.login-box').slideUp('300',function(){
        $('.forget-box').slideDown('300');
    });
    //$('').slideUp('fast');
    $('.error').removeClass('alert alert-danger').html('');
}
function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');
    }, 230);
}
/*************************Login Register Popup close******************************/

//$('.floating-form .form-control').on('keyup ready change load',function() {
//    if ($(this).val().length > 0) {
//        $(this).parent().find('.float-label').addClass('float-it');
//        $(this).parent().addClass('current');
//    }
//    else {
//        $(this).parent().find('.float-label').removeClass('float-it');
//        $(this).parent().removeClass('current');
//    }
//});
//$('.floating-form .form-control').focusin(function() {
//    $(this).parent().find('.float-label').addClass('float-it');
//    $(this).parent().addClass('current');
//});
//$('.floating-form .form-control').focusout(function() {
//    $(this).parent().find('.float-label').removeClass('float-it');
//    $(this).parent().removeClass('current');
//});

    ////////////____Input Focus___//////////////////

$('.floating-form .form-control').focusin(function() {
    $(this).parent().addClass('focus');
});
$('.floating-form .form-control').focusout(function() {
    $('.floating-form .field ,.floating-form .field-half').removeClass('focus');
});
/// Input Kepress Filled  Focus
$('.floating-form .form-control').keyup(function() {
    if($(this).val().length > 0){
        $(this).parent().addClass('filled');
    }

    else{
        $(this).parent().removeClass('filled');
    }
});

/// Input Check Filled Focus
var $formControl = $('.floating-form .form-control');
var values = {};
var validate =    $formControl.each(function() {
    if($(this).val().length > 0){
        $(this).parent().addClass('filled');
    }
    else{
        $(this).parent().removeClass('filled');
    }
});

// Button switching



$(window).on('load resize', function(){
   if($(window).width() > 1024){
       $('.member-scroll').niceScroll({horizrailenabled:false});
       $('.nice-scroll').niceScroll({horizrailenabled:false});
       $('.button-checkbox-wrap').niceScroll({horizrailenabled:false});
   }
});

$(document).ready(function() {
    $('.have-child > a').click(function (event) {
        event.stopPropagation();
        $(".sub-menu").slideToggle("fast");
        $(this).toggleClass('active');
    });
    $(".sub-menu").on("click", function (event) {
        event.stopPropagation();
    });
    $(document).on("click", function () {
        $(".sub-menu").fadeOut();
        $('.have-child > a').removeClass('active');
    });
});
