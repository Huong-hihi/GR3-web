<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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

    public static function createAlbum($request)
    {
        $data = $request->only('user_id', 'name');
        if (!$request->name) $data['name'] = config('common.text.album-name-default');

        return Album::create($data);
    }

    public static function findAlbum($id)
    {
        return Album::find($id);
    }

    public static function findAlbumByUserId($userId)
    {
        return Album::where('user_id', $userId)->first();
    }

    public static function getListSongsMyAlbumHash($albumId): array
    {
        $songsHash = [];
        $songs = DB::table('album_song')
            ->where('album_id', $albumId)
            ->pluck('song_id');

        foreach ($songs as $key => $song) {
            $songsHash[$song] = $key;
        }

        return $songsHash;
    }
}
