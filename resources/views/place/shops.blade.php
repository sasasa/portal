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
  @foreach ($shops as $shop)
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
  @endforeach
</table>
{{ $shops->links() }}
@endsection
