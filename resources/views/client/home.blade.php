@extends('client.master')
@section('content')
    <div class="container fluid">
        @include('client.layouts.banner')
        <div class="container-main">
            <div class="main-list">
                <div class="section-tv" id="trending">
                    <div class="section-wrapper" id="section-wrapper">
                        <div class="section-header">
                            Album
                        </div>
                        <div class="items">
                            @foreach($albums as $album)
                                <div class="item">
                                    <a href="{{route('client.album.detail',[$album->id])}}"
                                       class="">
                                        <div class="image-thumbnail">
                                            <img src="{{ $album->songs[0]->image }}">
                                            <div class="icon-play-hover">
                                                <div class="back-ground">
                                                </div>
                                                <div class="icon-play">
                                                    <i class='bx bxs-right-arrow'></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="movie-item-content">
                                            <span>{{$album->name}}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="section-tv" id="new-song">
                    <div class="section-wrapper" id="section-wrapper">
                        <div class="section-header">
                            Bài hát mới
                        </div>
                        <div class="items">
                            @foreach($songs as $song)
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
                                    <a href="{{ $song->singer ? route('client.singer.detail', ['id' => $song->singer->id]) : '#' }}">
                                        <span class="song-singer-name">{{ $song->singer_name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="section-tv" id="singer">
                    <div class="section-wrapper">
                        <div class="section-header">
                            Ca Sĩ
                        </div>
                        <div class="items">
                            @foreach($singers as $singer)
                                <div class="item">
                                    <a href="{{route('client.singer.detail',[$singer->id])}}"
                                       class="">
                                        <div class="image-thumbnail">
                                            <div class="icon-play-hover">
                                                <div class="back-ground">
                                                </div>
                                                <div class="icon-play">
                                                    <i class='bx bxs-right-arrow'></i>
                                                </div>
                                            </div>
                                            <img src="{{ $singer->image }}">
                                        </div>
                                        <div class="movie-item-content">
                                            <span>{{ $singer->name }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-ranking">
                <div class="inner">
{{--                    <div class="ranking-header">--}}
{{--                        <h3>Ranking</h3>--}}
{{--                    </div>--}}
                    <div class="section-header">
                        Xếp hạng bài hát
                    </div>
                    <div class="ranking-list">
                        <div class="list-item">
                            @foreach($rankSongs as $rank)
                                <div class="item {{ $loop->index == 0 ? 'rank-1' : '' }}">
                                    <div class="rank-number">
                                        <span class="number">{{ $loop->index + 1 }}</span>
                                        <div class="border-bottom"></div>
                                    </div>
                                    <div class="song-wrap-content">
                                        <a href="{{ route('client.song.detail', ['id' => $rank->song->id]) }}">
                                            <div class="song-image" style="background-image: url({{ $rank->song->image }})">
                                                <div class="back-blade" style="display: none"></div>
                                            </div>
                                        </a>
                                        <div class="song-info">
                                            <a href="{{ route('client.song.detail', ['id' => $rank->song->id]) }}">
                                                <p class="song-name">{{ $rank->song->name }}</p>
                                            </a>
                                            <a class="singer-name"
                                               href="{{ $rank->song->singer ? route('client.singer.detail', ['id' => $rank->song->singer->id]) : '#' }}">
                                                {{ $rank->song->singer_name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
