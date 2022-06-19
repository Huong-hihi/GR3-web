<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Album extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
        'user_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'album_song');
    }

    public static function getAlbumHasWith()
    {
        return Album::with('songs')->paginate(3);
    }
}
