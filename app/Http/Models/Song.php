<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

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

    public static function store($data) {
        return Song::create($data);
    }

    public static function find($id) {
        return Song::findOrFail($id);
    }

    public static function getAll() {
        return Song::all();
    }
}
