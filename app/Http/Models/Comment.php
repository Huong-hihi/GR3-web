<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'comments';

    protected $fillable = [
        'user_id', 'commentable_id', 'commentable_type', 'content', 'parent_id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function parent()
    {
        return $this->HasOne(Comment::class, 'id', 'parent_id');
    }

    public function user()
    {
        return $this->HasOne(User::class, 'id', 'user_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
