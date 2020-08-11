@extends('layouts.app')
@section('title', '店舗管理')

@section('content')
<h1>店舗管理</h1>
<form action="/shops" method="get" class="mb-5">
  @csrf
  <div class="form-group">
    <label for="shop_name">{{__('validation.attributes.shop_name')}}:</label>
    <input type="text" id="shop_name" name="shop_name" value="{{$shop_name}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="user_name">店舗ユーザーの{{__('validation.attributes.name')}}:</label>
    <input type="text" id="user_name" name="user_name" value="{{$user_name}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="user_email">店舗ユーザーの{{__('validation.attributes.email')}}:</label>
    <input type="text" id="user_email" name="user_email" value="{{$user_email}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="location">{{__('validation.attributes.location')}}:</label>
    <input type="text" id="location" name="location" value="{{$location}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="phone_number">{{__('validation.attributes.phone_number')}}:</label>
    <input type="text" id="phone_number" name="phone_number" value="{{$phone_number}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="shop_mail">店舗の{{__('validation.attributes.shop_mail')}}:</label>
    <input type="text" id="shop_mail" name="shop_mail" value="{{$shop_mail}}" class="form-control">
  </div>
  <input type="submit" value="検索" class="btn btn-primary">
</form>

<a class="btn btn-primary mb-2" href="/shops/create">新店舗を登録する</a>
<table class="table">
  @foreach ($shops as $shop)
  <tr>
    <th>{{__('validation.attributes.shop_name')}}</th>
    <td>
      <a href="/shops/{{$shop->id}}">{{ $shop->shop_name }}</a>
      <form action="/shops/{{$shop->id}}" method="post" class="inline_form">
        @csrf
        @method('delete')
        <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
    </form>
    </td>
  </tr>
  <tr>
    <th>店舗ユーザーの{{__('validation.attributes.name')}}</th>
    <td>
      @if ($shop->user)
        {{$shop->user->name}}({{$shop->user->email}})
      @else
        ※紐づいていません
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
  </tr>
  @endforeach
</table>
{{ $shops->appends(request()->input())->links() }}
@endsection

@section('script')
<script type="module">
$(function(){
    $(".btn-del").click(function() {
        if(confirm("本当に削除してもよろしいですか？")) {
        } else {
            //cancel
            event.preventDefault();
            return false;
        }
    });
});
</script>
@endsection