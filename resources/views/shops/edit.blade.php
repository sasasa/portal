@extends('layouts.app')
@section('title', $shop->shop_name. 'を編集する')

@section('content')
<form action="/shops/{{$shop->id}}" method="post">
  @csrf
  @method('patch')
  <div class="form-group">
    <label for="shop_name">{{__('validation.attributes.shop_name')}}:</label>
    <input type="text" id="shop_name" name="shop_name" value="{{old('shop_name', $shop->shop_name)}}" class="form-control @error('shop_name') is-invalid @enderror">
    @error('shop_name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="location">{{__('validation.attributes.location')}}:</label>
    <input type="text" id="location" name="location" value="{{old('location', $shop->location)}}" class="form-control @error('location') is-invalid @enderror">

    @error('location')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="phone_number">{{__('validation.attributes.phone_number')}}:</label>
    <input type="text" id="phone_number" name="phone_number" value="{{old('phone_number', $shop->phone_number)}}" class="form-control @error('phone_number') is-invalid @enderror">
    @error('phone_number')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="shop_mail">{{__('validation.attributes.shop_mail')}}:</label>
    <input type="text" id="shop_mail" name="shop_mail" value="{{old('shop_mail', $shop->shop_mail)}}" class="form-control @error('shop_mail') is-invalid @enderror">

    @error('shop_mail')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="url">{{__('validation.attributes.url')}}:</label>
    <input type="text" id="url" name="url" value="{{old('url', $shop->url)}}" class="form-control @error('url') is-invalid @enderror">
    @error('url')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <div class="form-group">
    <label for="description">{{__('validation.attributes.description')}}:</label>
    <textarea rows="5" id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{old('description', $shop->description)}}</textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <input type="submit" value="編集する" class="btn btn-sm btn-primary">
</form>
@endsection