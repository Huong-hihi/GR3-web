@extends('client.master')

@section('body-id', 'page-my-follow')

@section('content')
{{--    {{ dd($singer->toArray()) }}--}}
<div class="container fluid w-80p">
    <div class="follow-wrapper">
        <div class="inner">
            <ul class="list-singer">
                @foreach($listSingers as $singer)
                    <a href="{{ route('client.singer.detail', ['id' => $singer->id]) }}">
                        <li class="item">
                            <div class="singer-avatar">
                                <img src="{{ $singer->user->avatar }}" alt="" class="singer-image">
                            </div>
                            <p class="singer-name">{{ $singer->name }}</p>
                        </li>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>

    </script>
@endsection
