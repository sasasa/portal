@extends('layouts.app')
@section('title', $shop->shop_name. 'を紐づける')

@section('content')
店舗：「{{$shop->shop_name}}」と ユーザ：「{{$user->name}}」を紐づけるには下のボタンをクリックしてください。
<form action="/link_requests/{{$link_request->id}}/linkage" method="post">
  @csrf
  <div class="form-check my-4">
    <input class="form-check-input" type="checkbox" id="agreed" name="agreed">
    <label class="form-check-label" for="agreed">「{{$shop->shop_name}}」を紐づけます。</label>
  </div>
  <input type="submit" value="紐づける" class="btn btn-sm btn-success">
</form>
@endsection