function changeAddTrackIcon(status) {
    let addSong = $('#add-song-to-playlist');

    if (status === 'added') {
        addSong.removeClass('bxs-plus-square');
        addSong.addClass('bx-check-double');
        addSong.parents('.item').addClass('pointer-event-none');
    } else if(status === 'add') {
        addSong.removeClass('bx-check-double');
        addSong.parents('.item').removeClass('pointer-event-none');
        addSong.addClass('bxs-plus-square');
    }
}

function callAjax(url,method = 'POST', data) {
    $.ajax({
        url: url,
        method: method,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function (data, textStatus, xhr) {
            return [data, textStatus, xhr];
        },
        error: function (e) {
            return e;
        }
    })
}
