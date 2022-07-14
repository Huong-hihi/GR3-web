<?php

namespace App\Providers;

use App\Http\Models\Album;
use App\Http\Models\Comment;
use App\Http\Models\Song;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'song' => Song::class,
            'album' => Album::class,
            'comment' => Comment::class,
        ]);
    }
}
