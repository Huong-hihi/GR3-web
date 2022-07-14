@extends('client.master')

@section('content')
    <?php
        $data = [
            'listenSongURL' => route('client.song.listen'),
            'routeName' => \Request::route()->getName(),
            'apiCommentCreate' => route('api.comment.create'),
            'parameters' => \Route::current()->parameters
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
                @if(count($listRecommendSongs) > 0)
                <div class="recommend-list-songs-wrapper">
                    <div class="recommend-inner">
                        <h3>Có thể bạn thích nghe</h3>
                        <div class="recommend-list-songs">
                            <div class="inner">
                                <ul>
                                    @foreach($listRecommendSongs as $song)

                                        <li class="track-item" data="{{ json_encode() }}">
                                            <a href="{{ route('client.song.detail', ['id'=> $song->id])}}">
                                            <div class="recommend-song">
                                                <div class="recommend-song-image">
                                                    <img src="{{ $song->image }}" alt="">
                                                </div>
                                                <div class="recommend-infomation">
                                                    <span href="" class="recommend-song-name">{{ $song->name }}</span>
                                                    <span href="" class="recommend-singer">{{ $song->singer }}</span>
                                                </div>
                                                <div class="recommend-add-btn">
                                                    <i class='bx bx-plus-circle recommend-add-image'></i>
                                                    {{--                                                <i class='bx bx-list-check' ></i>--}}
                                                </div>
                                            </div>
                                            </a>
                                        </li>

                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="section-tv">
        <div class="comment-wrapper">
            <div class="comment-form">
                <textarea id="textarea"
                     tabindex="0"
                     style="white-space: pre"
                     data-text="Bạn có bình luận gì về bài hát này?" role="textbox" aria-multiline="true" spellcheck="false"></textarea>
                <div class="comment-note">
                    Nhấn shift + enter để gửi
                </div>
            </div>
            <div class="comment-list-wrapper">
                <ul>
                    @foreach($listComments as $comment)
                    <li>
                        <div class="inner">
                            <div class="comment-user-info">
                                <div class="comment-user-avatar" style="background-image: url('{{ $comment->user->avatar ?? asset('images/default-user-image.png') }}')"></div>
                                <span class="comment-user-name">{{ $comment->user->name }}</span>
                                <span class="comment-user-publish-time">{{ $comment->created_at }}</span>
                            </div>
                            <div class="comment-user-body">
                                {!! nl2br($comment->content) !!}
                            </div>
                            <span class="comment-reply">Reply</span>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        var dataPageTrack = JSON.parse($('#page-track').attr('data-page-track'));
    </script>
    <script src="{{ asset('js/audio.js') }}"></script>
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

            $(document).on('click', '.recommend-add-image', function (e) {
                e.preventDefault();
                if (!userId) {
                    window.location.href = '{{ route('login') }}';
                } else {
                    let songIdCurrent = $('#plList').attr('data-song-id-current');
                    changeAddTrackIcon('added');
                    $.ajax({
                        url: '{{ route('client.my-album.update') }}',
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            song_id: '' + songIdCurrent,
                            action: 'create'
                        },
                        success: function (data, textStatus, xhr) {
                            if (xhr.status === 200) {
                                changeAddTrackIcon('added')
                            }
                        },
                        error: function (e) {
                            changeAddTrackIcon('add');
                        }
                    })
                }
            })

            $('#plList').on('click', function() {
                let data = $(this).data('data-track');
            });

            $("#textarea").keypress(function(event) {
                if (event.keyCode === 13 && event.shiftKey) {
                    let self = $(this);
                    let content = self.val();
                    let url = dataPageTrack['apiCommentCreate'];
                    let data = {
                        content: content,
                        commentable_id: null,
                        commentable_type: null,

                    }

                    if(dataPageTrack['routeName'] === 'client.album.detail') {
                        data['commentable_id'] = dataPageTrack['parameters']['id'];
                        data['commentable_type'] = 'album';
                    }

                    if(dataPageTrack['routeName'] === 'client.song.detail') {
                        data['commentable_id'] = dataPageTrack['parameters']['id'];
                        data['commentable_type'] = 'song';
                    }

                    let result = callAjax(url, 'POST', data);
                    console.log(result);
                    let template = `
                    <li>
                        <div class="inner">
                            <div class="comment-user-info">
                                <div class="comment-user-avatar" style="background-image: url('{{ $comment->user->avatar ?? asset('images/default-user-image.png') }}')"></div>
                                <span class="comment-user-name">{{ $comment->user->name }}</span>
                                <span class="comment-user-publish-time">{{ $comment->created_at }}</span>
                            </div>
                            <div class="comment-user-body">
                                {!! nl2br($comment->content) !!}
                            </div>
                                    <span class="comment-reply">Reply</span>
                        </div>
                    </li>
                    `
                }
            });

        })
    </script>
@endsection
