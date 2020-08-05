@extends('layouts.app')
@section('title', $shop->shop_name. 'を紐づける')

@section('content')
店舗：「{{$shop->shop_name}}」と ユーザ：「{{$user->name}}」
<form action="/link_requests/{{$link_request->id}}/linkage" method="post">
  @csrf
  <div class="form-check my-4">
    <input class="form-check-input" type="radio" id="accept" name="accept" value="accept">
    <label class="form-check-label" for="accept">「{{$shop->shop_name}}」を紐づけます。</label>
  </div>
  <div class="form-check my-4">
    <input class="form-check-input" type="radio" id="reject" name="accept" value="reject" checked>
    <label class="form-check-label" for="reject">「{{$shop->shop_name}}」を拒否します。</label>
  </div>
  <div class="form-group">
    <label for="reason">{{__('validation.attributes.reason')}}:</label>
    <textarea rows="5" id="reason" name="reason" class="form-control @error('reason') is-invalid @enderror">{{old('reason')}}</textarea>
    @error('reason')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <input type="submit" value="送信する" class="btn btn-sm btn-danger">
</form>
@endsection