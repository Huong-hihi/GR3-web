<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AlbumSong extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'album_id', 'song_id'
    ];
}
