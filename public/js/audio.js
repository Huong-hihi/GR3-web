jQuery(function ($) {
    'use strict'
    var supportsAudio = !!document.createElement('audio').canPlayType;
    if (supportsAudio) {
        var player = new Plyr('#audio1', {
            controls: [
                'restart',
                'play',
                'progress',
                'current-time',
                'duration',
                'mute',
                'volume',
                'download'
            ]
        });
        // initialize playlist and controls
        var index = 0,
            playing = false,

            trackCount = $('#plList').attr('data-count-track'),
            npAction = $('#npAction'),
            npTitle = $('#npTitle'),
            audio = $('#audio1').on('play', function () {
                playing = true;
                npAction.text('Now Playing...');
            }).on('pause', function () {
                playing = false;
                npAction.text('Paused...');
            }).on('ended', function () {
                npAction.text('Paused...');
                if ((index + 1) < trackCount) {
                    index++;
                    loadTrack(index);
                    audio.play();
                } else {
                    audio.pause();
                    index = 0;
                    loadTrack(index);
                }
            }).get(0),
            btnPrev = $('#btnPrev').on('click', function () {
                if ((index - 1) > -1) {
                    index--;
                    loadTrack(index);
                    if (playing) {
                        audio.play();
                    }
                } else {
                    audio.pause();
                    index = 0;
                    loadTrack(index);
                }
            }),
            btnNext = $('#btnNext').on('click', function () {
                if ((index + 1) < trackCount) {
                    index++;
                    loadTrack(index);
                    if (playing) {
                        audio.play();
                    }
                } else {
                    audio.pause();
                    index = 0;
                    loadTrack(index);
                }
            }),
            li = $('#plList li:nth-child(n+2)').on('click', function () {
                var id = $(this).attr('data-track-id');
                if (id !== index) {
                    playTrack(id);
                }
            }),
            loadTrack = function (id) {
                let trackCurrent = $('[data-track-id="' + id + '"]')
                let songId = trackCurrent.attr('data-song-id');
                let songRatingScore = trackCurrent.attr('data-song-rating-score');
                let formRating = $('.form-rating');
                $('.rating-score').parent().css('display', 'none');
                $('#plList').attr('data-track-id-current', songId)
                formRating.attr('action', formRating.attr('data-action').replace('#song_id', songId));
                $('.rating-star').prop('checked', false);
                $('#rating-' + songRatingScore).prop('checked', true)

                $('.plSel').removeClass('plSel');
                trackCurrent.addClass('plSel');
                npTitle.text(trackCurrent.find('.plTitle').text());
                audio.src = window.location.protocol + "//" + window.location.host + '/' + trackCurrent.attr('data-track-url');
                $('.lyric-content').html(trackCurrent.attr('data-track-lyric'));
                updateDownload(id, audio.src);
            },
            updateDownload = function (id, source) {
                player.on('loadedmetadata', function () {
                    $('a[data-plyr="download"]').attr('href', source);
                });
            },
            playTrack = function (id) {
                loadTrack(id);
                audio.play();
            };
        loadTrack(index);
    } else {
        // no audio support
        $('.column').addClass('hidden');
        var noSupport = $('#audio1').text();
        $('.container').append('<p class="no-support">' + noSupport + '</p>');
    }
});
