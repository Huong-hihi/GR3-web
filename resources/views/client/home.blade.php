@extends('client.master')
@section('content')
    <div class="container fluid">
        @include('client.layouts.banner')
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
                    New song
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
                        </div>
                    @endforeach
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
                        </div>
                    @endforeach
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
                            </div>
                        @endforeach
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
                            </div>
                        @endforeach
                </div>
            </div>
        </div>

        <div class="section-tv" id="singer" style="display: none">
            <div class="section-wrapper">
                <div class="section-header">
                    <span>Singer</span>
                    <!-- <div class="btn-load-2">
                                  <span>load more</span>
                             </div> -->
                </div>

                <div class="Mucsics-slide row" id="tv-slider">
                    @foreach($singers as $singer)
                        <a href="{{route('client.singer.detail',[$singer->id])}}"
                           class="movie-item col-3-5  m-5 s-11 to-top show-on-scroll">
                            <div>
                                <img class="card-img-top" src="{{ $singer->user->avatar }}" width="100%">
                                <div class="movie-item-content">
                                    <div class="movie-item-title">
                                        {{ $singer->full_name }}
                                    </div>
                                </div>
                            </div>
                            <div class="movie-item-overlay">
                            </div>
                            <div class="movie-item-act">
                                <i class='bx bxs-right-arrow'></i>

                                <div>
                                    <i class='bx bxs-share-alt'></i>
                                    <i class='bx bxs-heart'></i>
                                    <i class='bx bx-plus-medical'></i>
                                </div>
                            </div>

                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
