@extends('client.master')

@section('content')
    <?php
        $data = [
            'listenSongURL' => route('client.song.listen')
        ];
    ?>
    <div class="section-tv" id="page-track" data-page-track="{{ json_encode($data) }}">
        <div class="section-inner">
            <div class="title">
                <h3></h3>
            </div>
            <div id="audio-player">
                <div class="column add-bottom">
                    <div id="mainwrap">
                        <div class="audio-player-box">
                            <div class="back-drop-song"></div>
                            <div id="nowPlay">
                                <span id="npAction">Paused...</span><span id="npTitle"></span>
                            </div>
                            <div id="audiowrap">
                                <div id="audio0">
                                    <audio id="audio1" preload controls>Your browser does not support HTML5 Audio! 😢
                                    </audio>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rating">
                        <h3>Bạn hãy đánh giá bài hát</h3>
                        <form
                            action="{{ route('client.rating.log', ['song_id' => '#song_id']) }}"
                            data-action="{{ route('client.rating.log', ['song_id' => '#song_id']) }}"
                            class="form-rating"
                            method="POST">
                            @csrf
                            <fieldset>
                            <span class="star-cb-group">
                              <input type="radio" id="rating-5" name="rating" value="5" class="rating-star"/><label
                                    for="rating-5">5</label>
                              <input type="radio" id="rating-4" name="rating" value="4" class="rating-star"/><label
                                    for="rating-4">4</label>
                              <input type="radio" id="rating-3" name="rating" value="3" class="rating-star"/><label
                                    for="rating-3">3</label>
                              <input type="radio" id="rating-2" name="rating" value="2" class="rating-star"/><label
                                    for="rating-2">2</label>
                              <input type="radio" id="rating-1" name="rating" value="1" class="rating-star"/><label
                                    for="rating-1">1</label>
                              <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear"/><label
                                    for="rating-0">0</label>
                            </span>
                            </fieldset>
                        </form>
                        <p style="display: none;">Bạn đã đánh giá <span class="rating-score"></span> sao</p>
                    </div>

                </div>
                <div class="audio-description">
                    <div class="lyric">
                        <h3>Lyric: </h3>
                        <span class="lyric-content">
                            {!! nl2br($listSongs[0]->lyric) !!}
                        </span>
                    </div>
                </div>
            </div>

            <div id="list-songs-wrapper">
                <div id="plwrap">
                    <ul id="plList" data-count-song="{{ count($listSongs) }}"
                        data-song-id-current="{{ $listSongs[0]->id }}">
                        <li class="list-track-name">
                            <div>
                                <h4>PLAY LIST</h4>
                                <p>{{ count($listSongs) }} track</p>
                            </div>
                        </li>
                        <div class="list-tracks-scroll">
                        @foreach($listSongs as $item)
                                <?php
                                    $songData['id'] = $item->id;
                                    $songData['ratingScore'] = isset($item->ratings[0]) ? $item->ratings[0]->score : 0;
                                    $songData['inMyAlbum'] = isset($listSongsMyAlbumHash[$item->id]) ? true : false;
                                ?>
                                <li
                                    data-song-information = "{{ json_encode($songData) }}"
                                    data-playlist-song-index="{{ $loop->index }}"
                                    data-song-url="{{ $item->file_mp3 }}"
                                    data-song-id="{{ $item->id }}"
                                    data-song-lyric="{!! nl2br($item->lyric) !!}"
                                    data-song-rating-score='{{ isset($item->ratings[0]) ? $item->ratings[0]->score : '0' }}'
                                >
                                    <div class="plItem">
                                        <div class="song-image-wrapper">
                                            <img class="song-image" src="{{ $item->image }}"/>
                                        </div>
                                        <span class="plTitle">{{ $item->name }}</span>

                                        <div class="plLength"></div>
                                    </div>
                                </li>
                            @endforeach
                        </div>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/audio-my-album.js') }}"></script>
    <script>
        $(function () {
            let backGroundImage = '{{ $listSongs[0]->image }}';

            $('.back-drop-song').attr('style', `background-image: url('${backGroundImage}')`);

            $(document).on('click', 'fieldset label', function (e) {
                e.preventDefault();
                if (!userId) {
                    window.location.href = '{{ route('login') }}';
                } else {
                    let form = $('.form-rating');
                    let url = form.attr('action');
                    let score = $(this).text();
                    $('.rating-star').prop('checked', false);
                    $('#rating-' + score).prop('checked', true)
                    $('.rating-score').text(score);
                    $('.rating-score').parent().fadeIn(100);
                    $.ajax({
                        url: url,
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            score: score
                        },
                        success: function (data, textStatus, xhr) {
                            if (xhr.status === 200) {
                                let songIdCurrent = $('#plList').attr('data-song-id-current');
                                $('[data-song-id="' + songIdCurrent + '"]').attr('data-song-rating-score', score)
                            }
                        },
                        error: function (e) {

                        }
                    })
                }
            })
        })
    </script>
@endsection
