@extends('layouts.app')
@section('title', $shop->shop_name. 'を紐づける')

@section('content')
「{{$shop->shop_name}}」と現在のログインユーザーを紐づけるには利用規約に同意して下のボタンをクリックしてください。
<form action="/shops/{{$shop->id}}/linkage" method="post">
  @csrf
  <div class="form-group my-4">
    <label for="terms_of_use">利用規約:</label>
    <textarea rows="10" id="terms_of_use" class="form-control">第1条 (はじめに)
      1. この利用規約は、株式会社Glow up(以下「当社」)が本サイト上で提供する全てのサービス(以下「本サービス」)における利用条件を定めるものです。ユーザーのみなさま(以下「ユーザー」)には、本規約に従い本サービスをご利用いただきます。
      2. 本サービス内には、本規約以外に「ヘルプ」や各種ガイドラインにおいて、本サービスの利用方法や注意書きが提示されています。これらも本規約の一部を実質的に構成するものですので、合わせてお読みください。
      3. 当社が本サービスの利用促進のために提供するアプリケーションなどに関しては、本規約と合わせ、それぞれのアプリケーションの利用規約が適用されます。

    </textarea>
  </div>
  <div class="form-check my-4">
    <input class="form-check-input" type="checkbox" id="agreed" name="agreed">
    <label class="form-check-label" for="agreed">「{{$shop->shop_name}}」のオーナーであり、利用規約に同意する</label>
  </div>
  <input type="submit" value="紐づける" class="btn btn-sm btn-success">
</form>
@endsection