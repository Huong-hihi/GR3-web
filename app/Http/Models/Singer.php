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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'full_name', 'nickname', 'nation', 'prize', 'information', 'home_town', 'created_at', 'updated_at', 'deleted_at'];

    public static function store($request)
    {
        $data = $request->all();

        return Singer::create($data);
    }

    public function user()
    {
        return $this->belongsTo('App\Http\Models\User');
    }

    public static function find($id)
    {
        return User::findOrFail($id);
    }

    public static function findByUserID($userID)
    {
        return Singer::where('user_id', $userID)
        ->with('user')
        ->first();
    }

    public static function getAll() {
        return Singer::with('user')->get();
    }

    public static function updateSingerByUserID($request, $userID)
    {
        $data = $request->all();

        return Singer::where('user_id', $userID)->first()->update($data);
    }

    public static function deleteSingerByUserID($userID)
    {
        return User::find($userID)->delete();
    }
}