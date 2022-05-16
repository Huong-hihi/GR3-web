<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'parent_id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function parent()
    {
        return $this->HasOne('App\Http\Models\Category', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Http\Models\Category', 'parent_id', 'id');
    }

    public static function store($data) {
        return Category::create($data);
    }

    public static function find($id) {
        return Category::findOrFail($id);
    }

    public static function getAll() {
        return Category::with('parent')->get();
    }

    public static function getAllWithoutId($id) {
        return Category::with('parent')->where('id','!=', $id)->get();
    }
}
