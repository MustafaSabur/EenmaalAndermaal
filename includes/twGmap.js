function initialize() {
        var mapCanvas = document.getElementById('twGmap');
        var mapOptions = {
          center: new google.maps.LatLng(51.988970, 5.949361),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
      }
      google.maps.event.addDomListener(window, 'load', initialize);