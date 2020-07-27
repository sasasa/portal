@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">管理者{{ __('Dashboard') }}</div>

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
                                @if ($link_request->accept_flg)
                                    <form action="/shops/{{$link_request->shop->id}}/link_requests/{{$link_request->id}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="削除する" class="btn btn-sm btn-danger btn-del">
                                    </form>
                                @else
                                    <div>
                                        <a href="/link_requests/{{$link_request->id}}/linkage" class="btn btn-sm btn-primary">紐づける</a>
                                    </div>
                                @endif
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

@section('script')
<script type="module">
$(function(){
    $(".btn-del").click(function() {
        if(confirm("手元のPCに画像コピーを済ませましたか？")) {
            //そのままsubmit（削除）
        } else {
            //cancel
            event.preventDefault();
            return false;
        }
    });
});
</script>
@endsection
