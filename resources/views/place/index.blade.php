@extends('layouts.app')
@section('title', "Place一覧")

@section('content')
<div>
  <h2>北海道・東北</h2>
<ul>
  <li><a href="p/北海道">北海道</a></li>
  <li><a href="p/青森県">青森県</a></li>
  <li><a href="p/岩手県">岩手県</a></li>
  <li><a href="p/宮城県">宮城県</a></li>
  <li><a href="p/秋田県">秋田県</a></li>
  <li><a href="p/山形県">山形県</a></li>
  <li><a href="p/福島県">福島県</a></li>
</ul>
</div>

<div>
  <h2>関東</h2>
<ul>
  <li><a href="p/茨城県">茨城県</a></li>
  <li><a href="p/栃木県">栃木県</a></li>
  <li><a href="p/群馬県">群馬県</a></li>
  <li><a href="p/埼玉県">埼玉県</a></li>
  <li><a href="p/千葉県">千葉県</a></li>
  <li><a href="p/東京都">東京都</a></li>
  <li><a href="p/神奈川県">神奈川県</a></li>
</ul>
</div>

<div>
  <h2>中部</h2>
<ul>
  <li><a href="p/新潟県">新潟県</a></li>
  <li><a href="p/富山県">富山県</a></li>
  <li><a href="p/石川県">石川県</a></li>
  <li><a href="p/福井県">福井県</a></li>
  <li><a href="p/山梨県">山梨県</a></li>
  <li><a href="p/長野県">長野県</a></li>
  <li><a href="p/岐阜県">岐阜県</a></li>
  <li><a href="p/静岡県">静岡県</a></li>
  <li><a href="p/愛知県">愛知県</a></li>
</ul>
</div>

<div>
  <h2>関西</h2>
<ul>
  <li><a href="p/三重県">三重県</a></li>
  <li><a href="p/滋賀県">滋賀県</a></li>
  <li><a href="p/京都府">京都府</a></li>
  <li><a href="p/大阪府">大阪府</a></li>
  <li><a href="p/兵庫県">兵庫県</a></li>
  <li><a href="p/奈良県">奈良県</a></li>
  <li><a href="p/和歌山県">和歌山県</a></li>
</ul>
</div>

<div>
  <h2>中国・四国</h2>
<ul>
  <li><a href="p/鳥取県">鳥取県</a></li>
  <li><a href="p/島根県">島根県</a></li>
  <li><a href="p/岡山県">岡山県</a></li>
  <li><a href="p/広島県">広島県</a></li>
  <li><a href="p/山口県">山口県</a></li>
  <li><a href="p/徳島県">徳島県</a></li>
  <li><a href="p/香川県">香川県</a></li>
  <li><a href="p/愛媛県">愛媛県</a></li>
  <li><a href="p/高知県">高知県</a></li>
</ul>
</div>

<div>
  <h2>九州・沖縄</h2>
<ul>
  <li><a href="p/福岡県">福岡県</a></li>
  <li><a href="p/佐賀県">佐賀県</a></li>
  <li><a href="p/長崎県">長崎県</a></li>
  <li><a href="p/熊本県">熊本県</a></li>
  <li><a href="p/大分県">大分県</a></li>
  <li><a href="p/宮崎県">宮崎県</a></li>
  <li><a href="p/鹿児島県">鹿児島県</a></li>
  <li><a href="p/沖縄県">沖縄県</a></li>
</ul>
</div>

<div>
  <h2>記事一覧（最新10件）</h2>
    <ul>
      @foreach ($articles as $article)
        <li>
          <a href="/articles/{{$article->id}}">{{$article->article_title}}</a>
        </li>
      @endforeach
    </ul>
</div>
@endsection
