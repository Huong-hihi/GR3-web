<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Song extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'musician', 'url', 'file_mp3', 'lyric','image', 'created_at', 'updated_at', 'deleted_at'
    ];

    public static function store($data)
    {
        return Song::create($data);
    }

    public static function find($id)
    {
        return Song::findOrFail($id);
    }

    public static function getAll()
    {
        return Song::all();
    }

    public static function getAllHasWith()
    {
        return Song::with('category')->get();
    }

    public function getFileMp3Attribute($attr): string
    {
        return 'audios/song/' . $attr;
    }

    public function getImageAttribute($attr): string
    {
        return '/images/song/' . $attr;
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_song');
    }

    public function ratings()
    {
        $user = Auth::user();
        return $this->hasMany(Rating::class, 'song_id', 'id')
            ->when($user, function ($q) use ($user) {
            $q->where('user_id', $user->id);
            })
            ->when(!$user, function ($q) {
            $q->where('user_id', 0);
        });
    }
}
