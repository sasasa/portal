@extends('layouts.app')
@section('title', $shop->shop_name)

@section('content')
<table class="table">
  <tr>
    <th>{{__('validation.attributes.shop_name')}}</th>
    <td>
      {{ $shop->shop_name }}
      @if ( is_null($shop->user) )
        <a href="/shops/{{$shop->id}}/linkage">オーナー様はこちら</a>
      @endif
      @if ( Auth::check() && $shop->user == Auth::user() )
        <a href="/shops/{{$shop->id}}/edit">編集する</a>
      @endif
    </td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.location')}}</th>
    <td>{{ $shop->location }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.phone_number')}}</th>
    <td>{{ $shop->phone_number }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.shop_mail')}}</th>
    <td>{{ $shop->shop_mail }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.url')}}</th>
    <td>{{ $shop->url }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.description')}}</th>
    <td>{{ $shop->description }}</td>
  </tr>
  <tr>
    <th>記事一覧</th>
    <td>
      <ul>
        @forelse ($shop->blogs as $blog)
            <li>
              <a href="/shops/{{$shop->id}}/blogs/{{$blog->id}}">{{$blog->blog_title}}</a>
            </li>
        @empty
            <li>ブログは存在しません。</li>
        @endforelse
      </ul>
      <a href="/shops/{{$shop->id}}/blogs/create">記事を書く</a>
    </td>
  </tr>
</table>
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
<div class="mt-5">
  <ul>
    @forelse ($shop->evaluations as $evaluation)
      <li>{{$evaluation->word_of_mouth}}
      @if (Auth::id() == $evaluation->user_id)
        <form action="/evaluations/{{$evaluation->id}}" method="post">
          @csrf
          @method('delete')
          <input type="submit" value="削除する" class="btn btn-sm btn-danger">
        </form>
      @endif
      </li>
    @empty
      <li>口コミは存在しません。</li>
    @endforelse
    </ul>
</div>
<form action="/evaluations" method="post" class="mt-5">
  @csrf
  <input type="hidden" name="shop_id" value="{{$shop->id}}">
  <div class="form-group">
    <label for="word_of_mouth">口コミ:</label>
    <textarea id="word_of_mouth" class="form-control @error('word_of_mouth') is-invalid @enderror" name="word_of_mouth"></textarea>
    @error('word_of_mouth')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">投稿</button>
</form>

<script type="text/javascript"><!--
  var e = document.querySelector('.is-invalid');
  if(e) {
    e.focus();
  }
  //-->
</script>
@endsection
