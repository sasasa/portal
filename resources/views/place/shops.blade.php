@extends('layouts.app')
@section('title', $prefecture. $district. 'の整体院一覧')

@section('content')
<table class="table">
  @foreach ($shops as $shop)
  <tr>
    <th>{{__('validation.attributes.shop_name')}}</th>
    <td>
      <a href="/p/{{$prefecture}}/{{$district}}/{{$shop->id}}">{{ $shop->shop_name }}</a>
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
  </tr>
  @endforeach
</table>
{{ $shops->links() }}
@endsection
