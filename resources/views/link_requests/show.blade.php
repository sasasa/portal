@extends('layouts.app')
@section('title', $shop->shop_name. 'の申請状況')

@section('content')
<h2><a href="/shops/{{$shop->id}}">{{ $shop->shop_name }}</a></h2>

<p>{{$link_request->accept_flg ? '申請が完了しました。' : '申請中です。もうしばらくお待ちください。'}}</p>

<img src="/storage/{{$link_request->license_path}}">
<p>{{$link_request->request_name}}</p>
<p>{{$link_request->request_email}}</p>
<p>{{$link_request->request_tel}}</p>
<p>{{$link_request->request_address}}</p>

@endsection