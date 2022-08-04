<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    const ROLE_ADMIN = 1;
    const ROLE_SINGER = 2;
    const ROLE_USER = 3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar', 'token', 'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function album()
    {
        if ($this->role == $this::ROLE_ADMIN) return $this->hasMany(Album::class);

        return $this->HasOne(Album::class, 'user_id', 'id');
    }

    public static function find($id)
    {
        return User::findOrFail($id);
    }

    public static function deleteUser($id)
    {
        return User::find($id)->delete();
    }

    public static function getAll()
    {
        return User::all()->where('role', User::ROLE_USER);
    }

    public function getAvatarAttribute($value)
    {
        if (strpos($value, 'http') !== false) return $value;

        return $value ? cxl_asset('images/avatar/' . $value) : null;
    }

    public static function store($request)
    {
        $data = $request->all();
        $data['role'] = User::ROLE_USER;
        $data['token'] = Str::random(12);
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('avatar')) {
            $file= $request->file('avatar');
            $filename= date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/avatar'), $filename);
            $data['avatar']= $filename;
        }

        return User::create($data);
    }

    public static function updateUser($request, $id)
    {
        $data = $request->all();

        $user = User::find($id);
//dd($id == Auth::user()->id);
        if ($user && ($user->role == User::ROLE_ADMIN || $id == Auth::user()->id)) {
            if ($request->hasFile('avatar')) {
                $file= $request->file('avatar');
                $filename= date('YmdHis') . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/avatar'), $filename);
                $data['avatar']= $filename;
            }

            if ($data['password'] == null) unset($data['password']);
//dd($data);
            return $user->update($data);
        }

        return false;
    }

}
