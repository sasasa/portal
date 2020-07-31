@extends('layouts.app')
@section('title', '記事一覧')

@section('content')
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
{{ $articles->links() }}
@endsection