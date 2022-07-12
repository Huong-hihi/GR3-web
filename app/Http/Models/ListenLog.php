<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ListenLog extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'listen_logs';

    protected $fillable = [
        'user_id', 'song_id', 'created_at', 'updated_at'
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
