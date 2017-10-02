$(function(){
  clickOutsideMenu();

  // MENU
  // click no hamburguer icon
  $('.MenuTrigger').on('click', function(e){
    e.preventDefault();   

    if( $('.Menu').hasClass('Menu--open') ){
      closeMenu();
    } else{
      openMenu();
    }
  });

  // abre um sub menu
  $('.Menu--hasSub > a').on('click', function(e){
    e.preventDefault();

    $(this).siblings('.Menu-sub').addClass('Menu-sub--subOpen');
    $(this).parent().addClass('is-selected');
    $('.Menu').addClass('Menu--subOpen');
    $('.Bar').addClass('subOpen');
  });

  // volta ao menu principal
  $('.js-back').on('click', function(){
    $(this).parent().removeClass('Menu-sub--subOpen');
    $('.Menu--hasSub > a').parent().removeClass('is-selected');
    $('.Menu').removeClass('Menu--subOpen');
    $('.Bar').removeClass('is-expanded');
  });

  // SMOOTH SCROLL
  $('.js-scroll > a').on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== '') {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 100
      }, 800, function(){
    
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  // menu fixo ao scollar
  $(window).scroll(function(){
    var altura;

    if(checkWindowWidth() == 'mobile'){
      altura = 80;
    } else {
      altura = $(window).height() - ( $(window).height() * 0.5 );
    }
    
    if( $(this).scrollTop() >= altura ){
      $('.Bar').addClass('is-scrolling');
      $('.Header > .Menu').addClass('is-scrolling');
    } else{
      $('.Bar').removeClass('is-scrolling');
      $('.Header > .Menu').removeClass('is-scrolling');
    }
  });

  // slider
  $('.js-gallerySlider').slick({
    arrows: true,
    asNavFor: '.js-gallerySliderNav',
    autoplay: true,
    dots: false,
    mobileFirst: true,
    speed: 800,
    nextArrow: '<button type="button" class="Arrow__button Arrow__button--next"></button>',
    prevArrow: '<button type="button" class="Arrow__button Arrow__button--prev"></button>',
  });

  $('.js-gallerySliderNav').slick({
    arrows: false,
    asNavFor: '.js-gallerySlider',
    //centerMode: true,
    focusOnSelect: true,
    infinite: true,
    mobileFirst: true,
    slidesToScroll: 2,
    slidesToShow: 2,
    responsive: [
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true
        }
      },
      {
        breakpoint: 991,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          centerMode: true,
          vertical: true,
          verticalSwiping: true
        }
      }
    ]
  });

  $('.js-sliderContent').slick({
    arrows: false,
    autoplay: true,
    dots: false,
    mobileFirst: true,
    speed: 800
  });

  if( $('#instafeed').length ){
    console.log('asdasdasd')

    var feed = new Instafeed({
      get: 'user',
      userId: '2062634298',
      clientId: '9dd32bbb00284a19b83ebe8dbda91cb6',
      accessToken: '36490227.9dd32bb.408bfdd02c4f409d96d48cd18124f053'
    });
    feed.run();
  }
  
});

function closeMenu(){
  $('.Menu').removeClass('Menu--open');
  $('.Menu').removeClass('Menu--subOpen');
  $('#Header').removeClass('is-expanded');
  $('.Bar').removeClass('subOpen');
  $('.Menu-sub').removeClass('Menu-sub--subOpen');
  $('.MenuTrigger').removeClass('is-open');

  $('.Menu--hasSub').removeClass('is-selected');

  $('body').removeClass('overflowHidden');
}

function openMenu(){
  $('.MenuTrigger').addClass('is-open');
  $('.Menu').addClass('Menu--open');
  $('body').addClass('overflowHidden');
}

function viewport() {
  var e = window, a = 'inner';
  if (!('innerWidth' in window )) {
      a = 'client';
      e = document.documentElement || document.body;
  }
  return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
}

function checkWindowWidth(){
  var w = viewport().width;
  var size = '';
  if(w > 991){
    size = 'desktop';
  } else{
    size = 'mobile';
  }

  return size;
}

function clickOutsideMenu(){
  
  var x = checkWindowWidth();
  if(x == 'desktop'){
    $(document).on('mouseup', function (e){ 
      var elem = $('.Menu-sub');

      if (!elem.is(e.target) && elem.has(e.target).length === 0){
        closeMenu();
      }
    });
  } else{
    $(document).off('mouseup');
  }
}