<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Singer extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $table = 'singers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'full_name', 'nickname', 'nation', 'prize', 'image', 'information', 'home_town', 'created_at', 'updated_at', 'deleted_at'];

    public static function store($data)
    {
        return Singer::create($data);
    }

    public function songs()
    {
        return $this->hasMany(Song::class, 'singer_name', 'name');
    }

    public static function deleteSinger($id)
    {
        return Singer::where('id', $id)->delete();
    }

    public function follows()
    {
        return $this->belongsToMany('App\Http\Models\User', 'follows', 'singer_id', 'user_id');
    }

    public static function find($id)
    {
        return Singer::where('id', $id)->first();
    }

    public static function getAll() {
        return Singer::all();
    }

    public static function updateSinger($data, $id)
    {
        return Singer::where('id', $id)->first()->update($data);
    }

    public function getImageAttribute($attr): string
    {
        if (strpos($attr, 'http') !== false) return $attr;

        return '/images/singer/' . $attr;
    }
}
