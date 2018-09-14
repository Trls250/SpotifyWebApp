/**********Home Slider******/
$('.bxslider').bxSlider({
            minSlides: 2,
            maxSlides: 2,
            slideWidth: 950,
             slideMargin: 20,
            speed: 5000,
            controls: true,
            auto: false,
            //autoControls: true,
            touchEnabled: true
            //pager: true 
        });
       
/**********Home Slider******/
/**********Menu Width******/
jQuery(function($){
    $('.navbar-toggle').click(function(){

      
    $('.navbar-collapse').toggleClass('right');
    $('body').toggleClass('test');
    //$('body').css('overflow','hidden');
        $('.navbar-toggle').toggleClass('indexcity');

    });
});
//if (window.matchMedia("(max-width: 767px)").matches){

        //var w = window.innerWidth;
//        var h = window.innerHeight;
        //alert(w);
//        $('#myNavbar').css('height',h);
//      }
//$(window).resize(function(){
//  if (window.matchMedia("(max-width: 767px)").matches){
        // var w = window.innerWidth;
//        var h = window.innerHeight;
        //alert(w);
//        $('.navbar-collapse.in').css('height',h);
//      }
//});
/**********Menu Width******/
/**********Google Map******/
var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
      var map1;
      function initMap() {
        map1 = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
/**********Google Map******/

/*******Modals********/
 // $('#login a').click(function(){
 //          event.preventDefault();
 //        });
 //        $('body').on('click','#loginid',function(){
 //          event.preventDefault();
 //         $('#signupmodal').modal('hide');   
 //        });
 //        $('body').on('click','#singid',function(){
 //          event.preventDefault();
 //         $('#loginmodal').modal('hide');   
 //        });
 //        $('body').on('click','#professionalss',function(){
 //          event.preventDefault();
 //         $('#signupmodal').modal('hide');   
 //        });
$('.profilelist ul li a').on('click', function() {
    var hh = $('.bottom-row').innerHeight();
    var ph = $('.profiledetail').innerHeight();
     // var offset_top = $('#'+id + '-section').offset().top;
    var scrollAnchor = $(this).attr('data-scroll'),
        scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top ;
    //         var offset_top = $('#'+id + '-section').offset().top;
         console.log(scrollPoint);
         if ($('.bottom-row').hasClass('fixed')) {
             scrollPoint = (scrollPoint - hh - ph + 50);
             //$( this ).addClass('active');
         } else {
             //var offset_top = $('#'+id + '-section').offset().top;
             hh = (hh * 2);
             scrollPoint = (scrollPoint - hh -ph + 50 );
             //$( this ).addClass('active');
         }
         //$('html,body').animate({scrollTop: (offset_top)}, 700);
    $('body,html').animate({
        scrollTop: scrollPoint
    }, 500);

    return false;

});
$(document).ready(function () {
    var w = ( $(".blog-imag").innerWidth());
        $('.blog-imag').css('height',w);
});         

$(window).scroll(function() {
    var windscroll = $(window).scrollTop();
    var hh = $('.bottom-row').innerHeight();
    var ph = $('.profiledetail').innerHeight();
    if (windscroll >= 100) {
        $('.wrapper section').each(function(i) {
            if ($(this).position().top <= windscroll - hh   ) {
                $('.profilelist ul li a.active').removeClass('active');
                $('.profilelist ul li a').eq(i).addClass('active');
            }
        });

    } else {
        $('.profilelist ul li a.active').removeClass('active');
        $('.profilelist ul li a:first').addClass('active');
    }

}).scroll();
/*******Modals********/
/*******Profile View********/

if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}
/*******Profile View********/           
$(window).scroll(function(){
  var scroll = $(window).scrollTop();
    
    if(scroll >= 300){

      $('.profiledetail').addClass('profile');
    }
    else{
        $('.profiledetail').removeClass('profile');
    }
});