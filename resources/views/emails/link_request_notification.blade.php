<!DOCTYPE html>
<html lang="ja">
<style>
  body {
    background-color: #fffacd;
  }
  h1 {
    font-size: 16px;
    color: #ff6666;
  }
  #button {
    width: 200px;
    text-align: center;
  }
  #button a {
    padding: 10px 20px;
    display: block;
    border: 1px solid #2a88bd;
    background-color: #FFFFFF;
    color: #2a88bd;
    text-decoration: none;
    box-shadow: 2px 2px 3px #f5deb3;
  }
  #button a:hover {
    background-color: #2a88bd;
    color: #FFFFFF;
  }
</style>
<body>
<p>
  {{ $link_request->request_name }}様
</p>
<h1>
  @if ( $link_request->is_accept() )
    申請を受理しました。
  @elseif ( $link_request->is_reject() )
    申請を受理できませんでした。
  @endif
</h1>
<p>
  @if ( $link_request->is_accept() )
    この度は申請いただきありがとうございました。
  @elseif ( $link_request->is_reject() )
    申し訳ございません。お手数おかけいたしますが再度申請いただきますようよろしくお願い申し上げます。
  @endif
</p>

@if ( $link_request->is_accept() )
<p id="button">
  <a href="{{env('APP_URL', 'http://localhost')}}/home_shop">ダッシュボード</a>
</p>
@elseif ( $link_request->is_reject() )
<p id="button">
  <a href="{{env('APP_URL', 'http://localhost')}}/shops/{{$link_request->shop->id}}/link_requests/{{$link_request->id}}">再申請する</a>
</p>
@endif

<hr>
<p>{{ config('app.name', '整体院ナビ') }}</p>
</body>
</html>