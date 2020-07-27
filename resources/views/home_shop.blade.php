@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">店舗{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h2>現在の申請状況</h2>
                    <ul>
                        @forelse ($link_requests as $link_request)
                            <li>
                                <a href="/shops/{{$link_request->shop->id}}/link_requests/{{$link_request->id}}">{{$link_request->shop->shop_name}}
                                ({{$link_request->accept_flg ? '申請完了' : '申請中'}})
                                </a>
                            </li>
                        @empty
                            <li>現在、申請はありません。</li>
                        @endforelse
                    </ul>

                    <h2>管理対象の店舗</h2>
                    <ul>
                        @forelse ($shops as $shop)
                            <li>
                                <a href="/shops/{{$shop->id}}">{{$shop->shop_name}}
                                </a>
                            </li>
                        @empty
                            <li>現在、申請はありません。</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
