@extends('layouts.app')
@section('title', $prefecture)

@section('content')
<table class="table">
  <tr>
    <th>都道府県</th>
    <th>市区町村</th>
  </tr>
  @foreach ($places as $place)
    <tr>
      <td>{{ $place->prefecture }}</td>
      <td>
        <a href="/p/{{ $place->prefecture }}/{{ $place->district }}">{{ $place->district }}</a>
      </td>
    </tr>
  @endforeach
</table>
{{ $places->links() }}
@endsection
