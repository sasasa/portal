@extends('layouts.app')
@section('title', '記事管理')

@section('content')
<h1>記事管理</h1>
<form action="/articles" method="get" class="mb-5">
  @csrf
  <div class="form-group">
    <label for="article_title">{{__('validation.attributes.article_title')}}:</label>
    <input type="text" id="article_title" name="article_title" value="{{$article_title}}" class="form-control">
  </div>

  <div class="form-group">
    <label for="article_content">{{__('validation.attributes.article_content')}}:</label>
    <input type="text" id="article_content" name="article_content" value="{{$article_content}}" class="form-control">
  </div>
  <input type="submit" value="検索" class="btn btn-primary">
</form>

<a href="/articles/create" class="btn btn-primary mb-1">記事を書く</a>
<table class="table">
  <tr>
    <th>{{__('validation.attributes.article_title')}}</th>
    <th></th>
    <th></th>
  </tr>
  @foreach ($articles as $article)
    <tr>
      <td>
        <a href="/articles/{{$article->id}}">{{ $article->article_title }}</a>
      </td>
      <td>
        <a href="/articles/{{$article->id}}/edit" class="btn btn-sm btn-primary">編集する</a>
      </td>
      <td>
        <form action="/articles/{{$article->id}}" method="post">
          @csrf
          @method('delete')
          <input type="submit" value="削除する" class="btn btn-sm btn-danger">
        </form>
      </td>
    </tr>
  @endforeach
</table>
{{ $articles->appends(request()->input())->links() }}
@endsection