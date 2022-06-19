<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Rating extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'song_id', 'score', 'created_at', 'updated_at', 'deleted_at'
    ];

    public static function store($data)
    {
        return Rating::create($data);
    }

    public static function find($id)
    {
        return Rating::findOrFail($id);
    }

    public static function getAll()
    {
        return Rating::all();
    }


//    public function albums()
//    {
//        return $this->belongsToMany(Album::class, 'album_song');
//    }
}
