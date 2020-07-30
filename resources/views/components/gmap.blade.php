<div id="my_map" style="width: 600px; height: 600px"></div>
<script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAP_KEY', 'apikey')}}&callback=initMapWithAddress" async defer></script>
<script>
  var _my_address = '{{$shop->location}}';
  var _my_name = '{{$shop->shop_name}}';
  function initMapWithAddress() {
      var opts = {
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
      };
      var my_google_map = new google.maps.Map(document.getElementById('my_map'), opts);
      var geocoder = new google.maps.Geocoder();
      geocoder.geocode(
        {
          'address': _my_address,
          'region': 'jp'
        },
        function(result, status) {
          if(status == google.maps.GeocoderStatus.OK) {
              var latlng = result[0].geometry.location;
              my_google_map.setCenter(latlng);
              var marker = new google.maps.Marker({
                position: latlng,
                map: my_google_map,
                title: _my_name,
                draggable: false
              });
          }
        }
      );
  }
</script>