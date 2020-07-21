@extends('layouts.app')
@section('title', $shop->shop_name. 'のブログ')

@section('content')
<h2>{{ $blog->blog_title }}</h2>
<img src="/storage/{{$blog->blog_path}}">

<p>
  {{ $blog->blog_content }}
</p>

@if (Auth::id() == $blog->user_id)
<form action="/shops/{{$shop->id}}/blogs/{{$blog->id}}" method="post">
  @csrf
  @method('delete')
  <input type="submit" value="削除する" class="btn btn-sm btn-danger">
</form>
@endif

@endsection

