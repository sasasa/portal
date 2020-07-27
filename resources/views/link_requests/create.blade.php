@extends('layouts.app')
@section('title', $shop->shop_name. 'のオーナー申請')

@section('content')
<h1>{{$shop->shop_name}}のオーナー申請</h1>
<form action="/shops/{{$shop->id}}/link_requests" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf

  <div class="form-group">
    <label for="request_name">{{__('validation.attributes.request_name')}}:</label>
    <input value="{{old('request_name', Auth::user()->name)}}" type="text" id="request_name" class="form-control @error('request_name') is-invalid @enderror" name="request_name">
    @error('request_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  
  <div class="form-group">
    <label for="request_email">{{__('validation.attributes.request_email')}}:</label>
    <input value="{{old('request_email', Auth::user()->email)}}" type="text" id="request_email" class="form-control @error('request_email') is-invalid @enderror" name="request_email">
    @error('request_email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="request_tel">{{__('validation.attributes.request_tel')}}:</label>
    <input value="{{old('request_tel', $shop->phone_number)}}" type="text" id="request_tel" class="form-control @error('request_tel') is-invalid @enderror" name="request_tel">
    @error('request_tel')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>


  <div class="form-group">
    <label for="request_address">{{__('validation.attributes.request_address')}}:</label>
    <input value="{{old('request_address', $shop->location)}}" type="text" id="request_address" class="form-control @error('request_address') is-invalid @enderror" name="request_address">
    @error('request_address')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>


  <div class="form-group">
    <label for="upfile">{{__('validation.attributes.license_path')}}:</label>
    <input type="file" id="upfile" class="form-control-file @error('upfile') is-invalid @enderror" name="upfile">
    @error('upfile')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    @if (session('error'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ session('error') }}</strong>
    </span>
    @endif
  </div>

  <button type="submit" class="btn btn-primary">投稿</button>
</form>
@endsection