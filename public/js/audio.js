jQuery(function ($) {
    'use strict'
    var supportsAudio = !!document.createElement('audio').canPlayType;
    $('#plList').data('data-track', {});

    if (supportsAudio) {
        let controls = `
            <div class="plyr__controls">
                <button class="plyr__controls__item plyr__control" type="button" data-plyr="restart">
                    <svg aria-hidden="true" focusable="false">
                        <use xlink:href="#plyr-restart"></use>
                    </svg>
                    <span class="plyr__sr-only">Restart</span>
                </button>
                <div class="plyr__controls__item plyr__progress__container">
                    <div class="plyr__progress">
                        <input data-plyr="seek"
                        type="range" min="0" max="100"
                        step="0.01" value="0" autocomplete="off"
                        role="slider" aria-label="Seek" aria-valuemin="0"
                        aria-valuemax="306.834286" aria-valuenow="0"
                        id="plyr-seek-3004" aria-valuetext="00:00 of 00:00"
                        style="--value:0%;">
                        <progress class="plyr__progress__buffer" min="0" max="100" value="0" role="progressbar" aria-hidden="true">% buffered</progress>
                        <span class="plyr__tooltip">00:00</span>
                    </div>
                </div>
                <div class="plyr__controls__item plyr__time--current plyr__time" aria-label="Current time">
                    00:00
                </div>
                <div class="plyr__controls__item plyr__time--duration plyr__time" aria-label="Duration">
                    05:06
                </div>
                <div class="plyr__controls__item plyr__volume">
                    <button type="button" class="plyr__control" data-plyr="mute">
                        <svg class="icon--pressed" aria-hidden="true" focusable="false">
                            <use xlink:href="#plyr-muted"></use>
                        </svg>
                        <svg class="icon--not-pressed" aria-hidden="true" focusable="false">
                            <use xlink:href="#plyr-volume"></use>
                        </svg>
                        <span class="label--pressed plyr__sr-only">Unmute</span>
                        <span class="label--not-pressed plyr__sr-only">Mute</span>
                    </button>
                    <input data-plyr="volume" type="range" min="0" max="1" step="0.05" value="1"
                           autocomplete="off" role="slider" aria-label="Volume" aria-valuemin="0"
                           aria-valuemax="100" aria-valuenow="45" id="plyr-volume-3004"
                           aria-valuetext="45.0%" style="--value:45%;">
                </div>

            </div>
            <div class="group-controls-playlist">
                <button class="plyr__controls__item plyr__control">
                    <div id="btnPrev" class="btn-pre-next"><i class='bx bx-skip-previous-circle' ></i></div>
                </button>

                <button class="plyr__controls__item plyr__control play-pause" type="button" data-plyr="play"
                        aria-label="Play">
                    <svg class="icon--pressed" aria-hidden="true" focusable="false">
                        <use xlink:href="#plyr-pause"></use>
                    </svg>
                    <svg class="icon--not-pressed" aria-hidden="true" focusable="false">
                        <use xlink:href="#plyr-play"></use>
                    </svg>
                    <span class="label--pressed plyr__sr-only">Pause</span><span
                        class="label--not-pressed plyr__sr-only">Play</span>
                </button>

                <button class="plyr__controls__item plyr__control">
                    <div id="btnNext" class="btn-pre-next"><i class='bx bx-skip-next-circle' ></i></div>
                </button>

                <div class="group-track-action">
                    <div class="item">
                        <a class="song-download"
                        href="http://192.168.1.144/audios/song/20220529075023.mp3" target="_blank" download=""
                        data-plyr="download">
                            <i class='bx bx-cloud-download' aria-hidden="true" focusable="false"><use xlink:href="#plyr-download"></use></i>
                            <span class="plyr__sr-only">Download</span>
                        </a>
                    </div>
                    <div class="item">
                        <i class="bx bxs-plus-square recommend-add-image" id="add-song-to-playlist"></i>
                    </div>
                </div>
            </div>`;

        var player = new Plyr('#audio1', {
            controls
        });

        // initialize playlist and controls
        var index = 0, playing = false,

            songCount = $('#plList').attr('data-count-song'), npAction = $('#npAction'), npTitle = $('#npTitle'),
            audio = $('#audio1').on('play', function () {
                playing = true;
                npAction.text('Now Playing...');
            }).on('pause', function () {
                playing = false;
                npAction.text('Paused...');
            }).on('ended', function () {
                npAction.text('Paused...');
                if ((index + 1) < songCount) {
                    index++;
                    loadSong(index);
                    audio.play();
                } else {
                    audio.pause();
                    index = 0;
                    loadSong(index);
                }
            }).get(0), btnPrev = $('#btnPrev').on('click', function () {
                if ((index - 1) > -1) {
                    index--;
                    loadSong(index);
                    if (playing) {
                        audio.play();
                    }
                } else {
                    audio.pause();
                    index = 0;
                    loadSong(index);
                }
            }), btnNext = $('#btnNext').on('click', function () {
                if ((index + 1) < songCount) {
                    index++;
                    loadSong(index);
                    if (playing) {
                        audio.play();
                    }
                } else {
                    audio.pause();
                    index = 0;
                    loadSong(index);
                }
            }), li = $('#plList li:nth-child(n+1)').on('click', function () {
                var id = $(this).attr('data-playlist-song-index');
                var self = $(this);
                if (id !== index) {
                    playSong(id, self);
                }
            }), loadSong = function (id, self) {
                let songCurrent = $('[data-playlist-song-index="' + id + '"]')
                let songId = songCurrent.attr('data-song-id');
                let songRatingScore = songCurrent.attr('data-song-rating-score');
                let formRating = $('.form-rating');
                $('.rating-score').parent().css('display', 'none');
                $('#plList').attr('data-song-id-current', songId)
                changeDataTrackPl('song-id-current', songId);
                formRating.attr('action', formRating.attr('data-action').replace('#song_id', songId));
                $('.rating-star').prop('checked', false);
                $('#rating-' + songRatingScore).prop('checked', true)

                $('.plSel').removeClass('plSel');
                songCurrent.addClass('plSel');
                npTitle.text(songCurrent.find('.plTitle').text());
                audio.src = window.location.protocol + "//" + window.location.host + '/' + songCurrent.attr('data-song-url');
                $('.lyric-content').html(songCurrent.attr('data-song-lyric'));

                let songInformation = JSON.parse(self.attr('data-song-information')) ?? {};
                changeAddTrackIcon(songInformation['inMyAlbum'] ? 'added' : 'add');
                songInformation['inMyAlbum'] = true;
                self.attr('data-song-information', JSON.stringify(songInformation));

                callAjax(dataPageTrack['listenSongURL'],'POST',{song_id: songId});


                updateDownload(id, audio.src);
            }, updateDownload = function (id, source) {
                player.on('loadedmetadata', function () {
                    $('a[data-plyr="download"]').attr('href', source);
                });
            }, playSong = function (id, self) {
                loadSong(id, self);
                audio.play();
            };
        loadSong(index, $('#plList li:eq(1)'));
    } else {
        // no audio support
        $('.column').addClass('hidden');
        var noSupport = $('#audio1').text();
        $('.container').append('<p class="no-support">' + noSupport + '</p>');
    }

    function changeDataTrackPl(key, value) {
        let dataPL = $('#plList').data('data-track');
        $('#plList').data('data-track', {...dataPL, [key]: value});
    }
});
