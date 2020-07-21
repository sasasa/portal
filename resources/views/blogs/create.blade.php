@extends('layouts.app')
@section('title', $shop->shop_name. 'のブログ作成画面')

@section('content')
<form action="/shops/{{$shop->id}}/blogs" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf
  <div class="form-group">
    <label for="blog_title">{{__('validation.attributes.blog_title')}}:</label>
    <input value="{{old('blog_title')}}" type="text" id="blog_title" class="form-control @error('blog_title') is-invalid @enderror" name="blog_title">
    @error('blog_title')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="upfile">{{__('validation.attributes.blog_path')}}:</label>
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
  <div class="form-group">
    <label for="blog_content">{{__('validation.attributes.blog_content')}}:</label>
    <textarea id="blog_content" class="form-control @error('blog_content') is-invalid @enderror" name="blog_content">{{old('blog_content')}}</textarea>
    @error('blog_content')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">投稿</button>
</form>
@endsection
