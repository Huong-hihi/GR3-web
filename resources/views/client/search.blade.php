@extends('client.master')
@section('style', cxl_asset('css/core.css'))
@section('content')
    <div class="container fluid">
        @include('client.layouts.banner')
        <div class="section-tv">
            <div class="section-wrapper" id="section-wrapper" style="width: 100%">
                <div class="section-header">
                    Kết quả tìm kiếm cho từ khóa: "{{ $search['q'] }}"
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
                {{ $songs->appends(request()->query())->links('admin.pagination') }}
            </div>
        </div>
    </div>
@endsection
