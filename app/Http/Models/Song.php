<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Process;


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

    public static function getSongInIds($ids)
    {
        return Song::whereIn('id', $ids)->get();
    }

    public static function getAllHasWith()
    {
        return Song::with('category')->get();
    }

    public function singer()
    {
        return $this->belongsTo(Singer::class, 'musician', 'name');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function handleGetRecommendSong()
    {
        return [];
        $user = Auth::user();
        if (!$user) return [];

        $process = new Process(['C:\Users\HuongDT2\WorkSpace\mp3\test.py', $user->id]);
        $process->run();
        $result = $process->getOutput();
        $recommendResult = explode(' ', substr($result, 2, -1));
        return Song::getSongInIds($recommendResult);
    }

    public function getFileMp3Attribute($attr): string
    {
        if (strpos($attr, 'http') !== false) return $attr;

        return 'audios/song/' . $attr;
    }

    public function getImageAttribute($attr): string
    {
        if (strpos($attr, 'http') !== false) return $attr;

        return '/images/song/' . $attr;
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_song');
    }

    public function listen_logs()
    {
        return $this->hasMany(ListenLog::class);
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

    public static function search ($q)
    {
        return Song::where('name', 'like', '%' . $q . '%')
            ->orWhere('musician', 'like', '%' . $q . '%')
            ->with('singer')
            ->get();
    }
}
