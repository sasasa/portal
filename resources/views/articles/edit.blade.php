@extends('layouts.app')
@section('title', '記事作成画面')

@section('content')
<form action="/articles/{{$article->id}}" method="post" class="mt-5" enctype='multipart/form-data'>
  @csrf
  @method('patch')
  <div class="form-group">
    <label for="article_title">{{__('validation.attributes.article_title')}}:</label>
    <input value="{{old('article_title', $article->article_title)}}" type="text" id="article_title" class="form-control @error('article_title') is-invalid @enderror" name="article_title">
    @error('article_title')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>

  <img src="/storage/{{$article->article_path}}">

  <div class="form-group">
    <label for="article_content">{{__('validation.attributes.article_content')}}:</label>
    <textarea rows="10" id="article_content" class="form-control @error('article_content') is-invalid @enderror" name="article_content">{{old('article_content', $article->article_content)}}</textarea>
    @error('article_content')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">編集</button>
</form>
@endsection
