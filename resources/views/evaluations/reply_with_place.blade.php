@extends('layouts.app')
@section('title', $shop->shop_name. 'の口コミへの返信')

@section('content')

  @if (Auth::user() && Auth::user()->role == 'shop' && Auth::user() == $shop->user)
    <h2>{{$evaluation->word_of_mouth}}</h2>
    @include('components.evaluation_post', [
      'prefecture' => $prefecture,
      'district' => $district,
      'parent_id' => $evaluation->id,
      'label' => '返信',
    ])
  @endif


@endsection
