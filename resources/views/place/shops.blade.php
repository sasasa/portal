@extends('layouts.app')
@section('title', $prefecture. $district. 'の整体院、一覧')
@section('description', $prefecture. $district. 'の整体院、一覧')

@section('content')
<h1>{{$prefecture}}{{$district}}の整体院、一覧</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">home</a></li>
    <li class="breadcrumb-item"><a href="/p/{{$prefecture}}">{{$prefecture}}の整体院、一覧</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$prefecture}}{{$district}}の整体院、一覧</li>
  </ol>
</nav>
<table class="table">
@foreach ($shops as $shop)
  <tr>
    <th>{{__('validation.attributes.shop_name')}}</th>
    <td>
      <h2 class="h6">
        <a href="/p/{{$prefecture}}/{{$district}}/{{$shop->id}}">{{ $shop->shop_name }}</a>
      </h2>
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
