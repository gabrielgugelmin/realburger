$(function(){
  //clickOutsideMenu();

  // MENU
  // click no hamburguer icon
  $('.MenuTrigger').on('click', function(e){
    e.preventDefault();   

    if( $('.Menu').hasClass('is-open') ){
      closeMenu();
    } else{
      openMenu();
    }
  });

  // AJUSTA O TAMANHO DO BANNER
	wH = $(window).height();

	$('.js-fullHeight').css({height: wH});

	$(window).resize(function() {
    wH = $(window).height();
		$('.js-fullHeight').css({height: wH});			    
	});

  $(window).scroll(function(){
    
    if( $(this).scrollTop() >= wH ){
      $('.Header').addClass('is-scrolling');
    } else{
    	$('.Header').removeClass('is-scrolling');
    }


    // muda cor do menu
    var scrollTop     = $(window).scrollTop(),
    elementOffset = $('.About').offset().top,
    elementHeight = $('.About').outerHeight() - 1;

/*    if( scrollTop >= elementOffset && scrollTop <= (elementOffset + elementHeight) ){
      $('.MenuTrigger').addClass('is-blue');
    } else{
      $('.MenuTrigger').removeClass('is-blue');
    }*/
  });


  // SMOOTH SCROLL
  $('.js-scroll').on('click', function(event) {
    $('.Menu').removeClass('is-open');
    $('.MenuTrigger').removeClass('is-open');
    $('.js-openContact').removeClass('is-visible');
    $('body').removeClass('overflowHidden');

    if (this.hash !== '') {
      //event.preventDefault();
      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top - 100
      }, 800, function(){
      });
    } // End if
  });

  // ANYONE
  $('.js-sliderAnyone').slick({
    autoplay: true,
    autoplaySpeed: 1200,
    dots: false,
    draggable: false,
    fade: true,
    pauseOnFocus: false,
    pauseOnHover: false,
    speed: 10
  });


  // CONTACT
  $('.js-openContact').on('click', function(){
    $('.Contact__overlay').addClass('is-open');
    $('body').addClass('overflowHidden');
  });

  $('.Contact__close').on('click', function(){
    $('.Contact__overlay').removeClass('is-open');
    $('body').removeClass('overflowHidden');
  });


  // FORM
  $('.Form').submit(function(e){
    e.preventDefault();
    form = $(this);

    var qtdErro = 0;

    $(this).find('[data-validate=true]').each(function() {
    	$(this).removeClass('error');
			var value = $.trim( $(this).find('input, textarea').val() );

			if(!value.length > 0){
				$(this).addClass('error');
				qtdErro++;
			}
		});

		if(qtdErro == 0){

      var url = document.location.origin;

      var values = {
        nome: $('.Form [name=input_nome]').val(),
        telefone: $('.Form [name=input_telefone]').val(),
        idade: $('.Form [name=input_idade]').val(),
        data: $('.Form [name=input_data]').val(),
        email: $('.Form [name=input_email]').val(),
        mensagem: $('.Form [name=input_mensagem]').val()
      }

      return $.ajax({
        type: "POST",
        url: url + "/sendEmail.php",
        data: values,
        success: function (data) {
          var result = $.parseJSON(data);
  
          // Exibe a modal com as informações
          $('.Popup').find('h3').text(result.titulo);
          $('.Popup').find('p').html(result.corpo);
          $('.Popup').addClass('open');

          // Limpa o form
          $('.Form').find('input, textarea').val('');

          var google_conversion_id = 852644769;
          var google_conversion_language = "en";
          var google_conversion_format = "3";
          var google_conversion_color = "ffffff";
          var google_conversion_label = "vnndCLCGpnEQoafJlgM";
          var google_conversion_value = 1.00;
          var google_conversion_currency = "BRL";
          var google_remarketing_only = false;
          
          if (100) {
              google_conversion_value = 1;
          }
          $.getScript( "http://www.googleadservices.com/pagead/conversion.js" );
        }
      });
		}

	});

  $('.Popup__close').on('click', function(){
    $('.Popup').removeClass('open');
    $('.Contact__overlay').removeClass('is-open');
    $('body').removeClass('overflowHidden');
  });

  // MASK
  $('.js-phone').mask('(99) 09999-9999', {placeholder: "(99) 99999-9999"});

  // MAPS

  function initialize() {

    // Define the overlay, derived from google.maps.OverlayView
    function Label(opt_options) {
      // Initialization
      this.setValues(opt_options);

      // Label specific
      var span = this.span_ = document.createElement('span');
      span.id = "MapSpan";

      var div = this.div_ = document.createElement('div');
      div.appendChild(span);
      div.style.cssText = 'position: absolute; display: none';
    };

    Label.prototype = new google.maps.OverlayView;

    // Implement onAdd
    Label.prototype.onAdd = function() {
      var pane = this.getPanes().overlayLayer;
      pane.appendChild(this.div_);

      // Ensures the label is redrawn if the text or position is changed.
      var me = this;
      this.listeners_ = [
        google.maps.event.addListener(this, 'position_changed',
            function() { me.draw(); }),
        google.maps.event.addListener(this, 'text_changed',
            function() { me.draw(); })
      ];
    };

    // Implement onRemove
    Label.prototype.onRemove = function() {
      this.div_.parentNode.removeChild(this.div_);

      // Label is removed from the map, stop updating its position/text.
      for (var i = 0, I = this.listeners_.length; i < I; ++i) {
        google.maps.event.removeListener(this.listeners_[i]);
      }
    };

    // Implement draw
    Label.prototype.draw = function() {
      var projection = this.getProjection();
      var position = projection.fromLatLngToDivPixel(this.get('position'));

      var div = this.div_;
      div.style.left = position.x + 'px';
      div.style.top = position.y + 'px';
      div.style.display = 'block';

      this.span_.innerHTML = 'Ortodontia<br>Dr. Sérgio Kubitski';
    };

    var chicago = new google.maps.LatLng(-25.429198, -49.290121);
    var myOptions = {
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: chicago,
        mapTypeControl: false,
        scrollwheel: false,
        styles: [
                {
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#f5f5f5"
                    }
                  ]
                },
                {
                  "elementType": "labels.icon",
                  "stylers": [
                    {
                      "visibility": "off"
                    }
                  ]
                },
                {
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#616161"
                    }
                  ]
                },
                {
                  "elementType": "labels.text.stroke",
                  "stylers": [
                    {
                      "color": "#f5f5f5"
                    }
                  ]
                },
                {
                  "featureType": "administrative.land_parcel",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#bdbdbd"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#eeeeee"
                    }
                  ]
                },
                {
                  "featureType": "poi",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#757575"
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#e5e5e5"
                    }
                  ]
                },
                {
                  "featureType": "poi.park",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#9e9e9e"
                    }
                  ]
                },
                {
                  "featureType": "road",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#ffffff"
                    }
                  ]
                },
                {
                  "featureType": "road.arterial",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#757575"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#dadada"
                    }
                  ]
                },
                {
                  "featureType": "road.highway",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#616161"
                    }
                  ]
                },
                {
                  "featureType": "road.local",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#9e9e9e"
                    }
                  ]
                },
                {
                  "featureType": "transit.line",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#e5e5e5"
                    }
                  ]
                },
                {
                  "featureType": "transit.station",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#eeeeee"
                    }
                  ]
                },
                {
                  "featureType": "water",
                  "elementType": "geometry",
                  "stylers": [
                    {
                      "color": "#c9c9c9"
                    }
                  ]
                },
                {
                  "featureType": "water",
                  "elementType": "labels.text.fill",
                  "stylers": [
                    {
                      "color": "#9e9e9e"
                    }
                  ]
                }
              ]
    };
    
    map = new google.maps.Map(document.getElementById("map"), myOptions);
    pixelOffset = new google.maps.Size(100,140);

    markerMuseu = new google.maps.Marker({
      position: new google.maps.LatLng(-25.429198, -49.290121),
      map: map,
      title: 'Ortodontia Dr. Sérgio Kubitski',
      pixelOffset: new google.maps.Size(100,140)
    });

    var contentString = '<div class="InfoWindow">'+
      '<a href="https://goo.gl/maps/GJzwjcy8Hw42" target="_blank">' +
      '<h1 class="InfoWindow__title">Dr. Sérgio Kubitski, Invisalign Doctor</h1>'+
      '<div class="InfoWindow__content">'+
      '<p>R. Padre Anchieta, 1104 - Mercês, Curitiba - PR, 80410-020</p>'+
      '<p>(41) 3336.5455</p>'+
      '</div>'+
      '</a>' +
      '</div>';

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });

    var label = new Label({
       map: map
     });
     label.bindTo('position', markerMuseu, 'position');
     label.bindTo('text', markerMuseu, 'position');
    

    markerMuseu.addListener('click', function() {
      infowindow.open(map, markerMuseu);
    });
  }

  if( $('#map').length ){
    initialize();
  }
});

function closeMenu(){
  $('.Menu').removeClass('is-open');
  $('.MenuTrigger').removeClass('is-open');
  $('body').removeClass('overflowHidden');
  $('.Header__button').removeClass('is-visible');
}

function openMenu(){
  $('.MenuTrigger').addClass('is-open');
  $('.Menu').addClass('is-open');
  $('body').addClass('overflowHidden');
  $('.Header__button').addClass('is-visible');
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

  $(document).on('mouseup', function (e){ 
    var elem = $('.Menu');

    if (!elem.is(e.target) && elem.has(e.target).length === 0){
      closeMenu();
    }
  });
}

