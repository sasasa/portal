@extends('layouts.app')
@section('title', $article->article_title)

@section('content')
<h2>{{ $article->article_title }}</h2>
<img src="/storage/{{$article->article_path}}">

<p>
  {!! nl2br(e($article->article_content)) !!}
</p>

@endsection