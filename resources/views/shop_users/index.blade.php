@extends('layouts.app')
@section('title', '店舗ユーザー管理')

@section('content')
<h2>店舗ユーザー管理</h2>
<table class="table">
  <tr>
    <th>{{__('validation.attributes.name')}}</th>
    <th>{{__('validation.attributes.email')}}</th>
    <th>{{__('validation.attributes.is_subscription')}}</th>
    <th></th>
  </tr>
  @foreach ($shop_users as $shop_user)
  <tr>
    <td>{{$shop_user->name}}</td>
    <td>{{$shop_user->email}}</td>
    <td>{{$shop_user->is_subscription ? '定期契約中' : '未契約'}}</td>
    <td>
      <form action="/shop_users/{{$shop_user->id}}" method="post">
        @csrf
        @method('patch')
        <input type="submit" value="定期契約する" class="btn btn-sm btn-danger">
      </form>
    </td>
  </tr>
  @endforeach
</table>
{{ $shop_users->links() }}
@endsection
