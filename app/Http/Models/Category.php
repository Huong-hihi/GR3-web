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

    public static function store($data) {
        return Category::create($data);
    }

    public static function find($id) {
        return Category::findOrFail($id);
    }

    public static function getAll() {
        return Category::all();
    }
}
