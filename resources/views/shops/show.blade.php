@extends('layouts.app')
@section('title', $shop->shop_name)

@section('content')

@include('components.shop_table')
@include('components.gmap')

<div class="mt-5">
  <ul>
    @forelse ($shop->evaluations as $evaluation)
      <li>{{$evaluation->word_of_mouth}}（{{$evaluation->format_date}}）
      @if (Auth::user() && Auth::user()->role == 'shop' && Auth::user() == $shop->user)
        <a href="/shops/{{$shop->id}}/{{$evaluation->id}}">返信を書く</a>
      @endif
      @if (Auth::user() && Auth::user()->role == 'admin' ||
          (Auth::user() && Auth::user()->role == 'shop' && Auth::user() == $evaluation->user) )
        <form action="/evaluations/{{$evaluation->id}}" method="post" class="inline_form">
          @csrf
          @method('delete')
          <input type="submit" value="削除する" class="btn btn-sm btn-danger">
        </form>
      @endif

      <ul>
        @foreach ($evaluation->children as $child_evaluation)
          <li>{{$child_evaluation->word_of_mouth}}（{{$child_evaluation->format_date}}）
            @if (Auth::user() && Auth::user()->role == 'admin' ||
            (Auth::user() && Auth::user()->role == 'shop' && Auth::user() == $shop->user) )
              <form action="/evaluations/{{$child_evaluation->id}}" method="post" class="inline_form">
                @csrf
                @method('delete')
                <input type="hidden" name="prefecture" value="">
                <input type="hidden" name="district" value="">
                <input type="submit" value="削除する" class="btn btn-sm btn-danger">
              </form>
            @endif
          </li>
        @endforeach
      </ul>
      </li>
    @empty
      <li>口コミは存在しません。</li>
    @endforelse
    </ul>
</div>
@if ( is_null(Auth::user()) ||
    (Auth::user() && Auth::user()->role == 'shop' && Auth::user() == $shop->user) )
@include('components.evaluation_post', [
  'prefecture' => '',
  'district' => '',
  'parent_id' => '',
  'label' => '口コミ',
])
@endif

<script type="text/javascript"><!--
  var e = document.querySelector('.is-invalid');
  if(e) {
    e.focus();
  }
  //-->
</script>
@endsection
