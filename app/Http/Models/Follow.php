<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Follow extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'follows';

    protected $fillable = ['user_id', 'singer_id', 'created_at', 'updated_at'];

    public function singer()
    {
        return $this->belongsTo(Singer::class, 'singer_id', 'id');
    }

}
