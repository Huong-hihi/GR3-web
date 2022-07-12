@extends('client.master')

@section('body-id', 'page-singer')

@section('content')
<div class="container fluid w-80p">
    <div class="section-tv" id="singer-box-head">
        <div class="section-inner">
            <div class="singer-information">
                <h1 class="singer-name">{{ $singer->name }}</h1>
                <div class="content">
                <span style="white-space: pre-line">
                    <b>Tên thật:</b> {{ $singer->full_name }}
                    <b>Nghệ danh:</b> {{ $singer->nickname }}
                    <b>Quê quán:</b> {{ $singer->home_town }}
                    <b>Quốc gia:</b> {{ $singer->nation }}
                    <b>Giải thưởng:</b>
                    {{ $singer->prize }}
                </span>
                </div>
            </div>
            <div class="singer-box-right">
                <div class="singer-avatar" style="background-image: url({{ $singer->user->avatar }})"></div>
                <div class="action">
                    <a class="action-btn play-all" href="{{ route('client.singer.album', ['id' => $singer->id]) }}">PLAY ALL <i class='bx bxs-playlist' ></i></a>
                    <div class="action-btn follow">FOLLOW <i class='bx bxs-heart' ></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-tv" id="singer-list-songs">
        <div class="section-inner">
            {{--        <div class="section-header">--}}
            {{--            New song--}}
            {{--        </div>--}}
            <div class="items">
                @foreach($singer->songs as $song)
                    <div class="item">
                        <a href="{{route('client.song.detail',[$song->id])}}"
                           class="">
                            <div class="image-thumbnail">
                                <div class="icon-play-hover">
                                    <div class="back-ground">
                                    </div>
                                    <div class="icon-play">
                                        <i class='bx bxs-right-arrow'></i>
                                    </div>
                                </div>
                                <img src="{{ $song->image }}">
                            </div>
                            <div class="movie-item-content">
                                <span>{{ $song->name }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
{{--    <script src="{{ asset('js/audio.js') }}"></script>--}}
    <script>
        $(function () {

        })
    </script>
@endsection
