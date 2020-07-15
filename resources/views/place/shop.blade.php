@extends('layouts.base')
@section('title', $prefecture. $district)

@section('main')
<table class="table">
  <tr>
    <th>{{__('validation.attributes.shop_name')}}</th>
    <th>{{__('validation.attributes.location')}}</th>
    <th>{{__('validation.attributes.phone_number')}}</th>
    <th>{{__('validation.attributes.shop_mail')}}</th>
    <th>{{__('validation.attributes.url')}}</th>
    <th>{{__('validation.attributes.description')}}</th>
  </tr>
  <tr>
    <td>
      <a href="/p/{{$prefecture}}/{{$district}}/{{$shop->id}}">{{ $shop->shop_name }}</a>
    </td>
    <td>{{ $shop->location }}</td>
    <td>{{ $shop->phone_number }}</td>
    <td>{{ $shop->shop_mail }}</td>
    <td>{{ $shop->url }}</td>
    <td>{{ $shop->description }}</td>
  </tr>
</table>
<div id="my_map" style="width: 600px; height: 600px"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3qcyVunBTTj3KRyGA1LLQk7VG9PLEWn8&callback=initMapWithAddress" async defer></script>
<script>
  var _my_address = '{{$shop->location}}';
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
                title: latlng.toString(),
                draggable: false
              });
              google.maps.event.addListener(marker, 'dragend', function(event){
                  marker.setTitle(event.latLng.toString());
              });
          }
        }
      );
  }
</script>

@endsection
