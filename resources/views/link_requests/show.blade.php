@extends('layouts.app')
@section('title', $shop->shop_name. 'の申請状況')

@section('content')
<h2><a href="/shops/{{$shop->id}}">{{ $shop->shop_name }}</a></h2>

@if ( $link_request->is_initial() )
<p>申請中です。もうしばらくお待ちください。</p>
@elseif ( $link_request->is_accept() )
<p>申請を受理しました。</p>
@elseif ( $link_request->is_reject() )
<p>申し訳ございません。申請を受理できませんでした。</p>
<p>{{$link_request->reason}}</p>
<p><a class="btn btn-primary" href="/shops/{{$shop->id}}/link_requests/{{$link_request->id}}/edit">再度、申請する</a></p>
@endif


<img src="/storage/{{$link_request->license_path}}">
<p>{{$link_request->request_name}}</p>
<p>{{$link_request->request_email}}</p>
<p>{{$link_request->request_tel}}</p>
<p>{{$link_request->request_address}}</p>

@endsection