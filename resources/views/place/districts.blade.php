@extends('layouts.base')
@section('title', $prefecture)

@section('main')
<table class="table">
  <tr>
    <th>都道府県</th>
    <th>市区町村</th>
  </tr>
  @foreach ($places as $place)
    <tr>
      <td>{{ $place->prefecture }}</td>
      <td>{{ $place->district }}</td>
    </tr>
  @endforeach
</table>
{{ $places->links() }}
@endsection
