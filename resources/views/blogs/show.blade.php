@extends('layouts.app')
@section('title', $shop->shop_name. 'のブログ')

@section('content')
<h2>{{ $blog->blog_title }}</h2>
<img src="/storage/{{$blog->blog_path}}">

<p>
  {{ $blog->blog_content }}
</p>



@endsection

