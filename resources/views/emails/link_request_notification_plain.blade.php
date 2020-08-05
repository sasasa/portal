{{ $link_request->request_name }}様

@if ( $link_request->is_accept() )
  申請を受理しました。
@elseif ( $link_request->is_reject() )
  申請を受理できませんでした。
@endif

@if ( $link_request->is_accept() )
  この度は申請いただきありがとうございました。
@elseif ( $link_request->is_reject() )
  申し訳ございません。お手数おかけいたしますが再度申請いただきますようよろしくお願い申し上げます。
@endif

@if ( $link_request->is_accept() )
{{env('APP_URL', 'http://localhost')}}/home_shop
@elseif ( $link_request->is_reject() )
{{env('APP_URL', 'http://localhost')}}/shops/{{$link_request->shop->id}}/link_requests/{{$link_request->id}}
@endif

-----------------------------
整体院ナビ