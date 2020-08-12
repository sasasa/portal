@extends('layouts.app')
@section('title', $prefecture. "の整体院、一覧")
@section('description', $prefecture. "の整体院、一覧")

@section('content')
<h1>{{$prefecture}}の整体院、一覧</h1>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">home</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$prefecture}}の整体院、一覧</li>
  </ol>
</nav>

<table class="table">
  <tr>
    <th>都道府県</th>
    <th>市区町村</th>
  </tr>
  @foreach ($places as $place)
    <tr>
      <td>{{ $place->prefecture }}</td>
      <td>
        <h2 class="h6">
          <a href="/p/{{ $place->prefecture }}/{{ $place->district }}">{{ $place->district }}</a>
        </h2>
      </td>
    </tr>
  @endforeach
</table>
{{ $places->links() }}
@endsection
