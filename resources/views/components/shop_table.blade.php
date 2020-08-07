<table class="table">
  <tr>
    <th>{{__('validation.attributes.shop_name')}}</th>
    <td>
      {{ $shop->shop_name }}
      @if ( is_null($shop->user) && is_null($shop->link_request) )
        <a href="/shops/{{$shop->id}}/link_requests/create">オーナー様はこちら</a>
      @endif
      @if ((Auth::check() && $shop->user == Auth::user()) ||
          ( Auth::user() && Auth::user()->role == 'admin' ))
        <a href="/shops/{{$shop->id}}/edit">編集する</a>
      @endif
    </td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.location')}}</th>
    <td>{{ $shop->location }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.phone_number')}}</th>
    <td>{{ $shop->phone_number }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.shop_mail')}}</th>
    <td>{{ $shop->shop_mail }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.url')}}</th>
    <td>{{ $shop->url }}</td>
  </tr>
  <tr>
    <th>{{__('validation.attributes.description')}}</th>
    <td>{{ $shop->description }}</td>
  </tr>
  <tr>
    <th>記事一覧</th>
    <td>
      <ul>
      @forelse ($shop->blogs as $blog)
          <li>
            <a href="/shops/{{$shop->id}}/blogs/{{$blog->id}}">{{$blog->blog_title}}</a>
          </li>
      @empty
          <li>ブログは存在しません。</li>
      @endforelse
      </ul>
      @if ( Auth::check() && $shop->user == Auth::user() )
        <a href="/shops/{{$shop->id}}/blogs/create">記事を書く</a>
      @endif
    </td>
  </tr>
</table>