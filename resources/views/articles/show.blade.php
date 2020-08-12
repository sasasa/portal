@extends('layouts.app')
@section('title', $article->article_title)
@section('description', $article->article_title. "、整体に関する記事")

@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">home</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$article->article_title}}</li>
  </ol>
</nav>
<article>
  <h1>{{ $article->article_title }}</h1>
  <img src="/storage/{{$article->article_path}}">
  <p>
    {!! nl2br(e($article->article_content)) !!}
  </p>
</article>

@endsection