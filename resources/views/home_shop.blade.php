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

                    @if (!Auth::user()->is_shop_subscription_user())
                    <div class="mb-3">
                        @include('components.publicity')
                    </div>
                    @else
                    <div class="mb-3">
                        <h2>現在、有料会員に登録しています。</h2>
                        <ul>
                        <li>店舗の一覧で前の方に表示されます。</li>
                        <li>店舗の情報を編集できます。</li>
                        <li>店舗ブログを投稿できます。</li>
                        <li>店舗ブログを投稿すると前の方に表示されます。</li>
                        <li>口コミを入力できます。</li>
                        <li>口コミに返信できます。</li>
                        </ul>
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

                    <a href="/shops/create">店舗を新規登録する</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
