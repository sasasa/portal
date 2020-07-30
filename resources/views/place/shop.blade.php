@extends('layouts.app')
@section('title', $prefecture. $district. 'の'. $shop->shop_name)

@section('content')

@include('components.shop_table')
@include('components.gmap')

<div class="mt-5">
<ul>
@forelse ($shop->evaluations as $evaluation)
  <li>{{$evaluation->word_of_mouth}}
  @if (Auth::id() == $evaluation->user_id)
    <form action="/evaluations/{{$evaluation->id}}" method="post">
      @csrf
      @method('delete')
      <input type="hidden" name="prefecture" value="{{$prefecture}}">
      <input type="hidden" name="district" value="{{$district}}">
      <input type="submit" value="削除する" class="btn btn-sm btn-danger">
    </form>
  @endif
  </li>
@empty
  <li>口コミは存在しません。</li>
@endforelse
</ul>
</div>
<form action="/evaluations" method="post" class="mt-5">
  @csrf
  <input type="hidden" name="prefecture" value="{{$prefecture}}">
  <input type="hidden" name="district" value="{{$district}}">
  <input type="hidden" name="shop_id" value="{{$shop->id}}">
  <div class="form-group">
    <label for="word_of_mouth">口コミ:</label>
    <textarea id="word_of_mouth" class="form-control @error('word_of_mouth') is-invalid @enderror" name="word_of_mouth">{{old('word_of_mouth')}}</textarea>
    @error('word_of_mouth')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">投稿</button>
</form>

<script type="text/javascript"><!--
  var e = document.querySelector('.is-invalid');
  if(e) {
    e.focus();
  }
  //-->
</script>
@endsection
