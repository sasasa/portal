@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザ{{__('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>書き込んだ口コミ</h3>
                    <ul>
                    @forelse ($evaluations as $evaluation)
                        <li>{{$evaluation->word_of_mouth}}
                            <a href="shops/{{$evaluation->shop->id}}">({{$evaluation->shop->shop_name}})</a>
                            ({{$evaluation->created_at}})</li>
                    @empty
                        <li>投稿した口コミは存在しません。</li>
                    @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
