<?php

namespace App\Http\Controllers\Client;

use App\Traits\File;
use App\Http\Models\Song;
use App\Http\Models\Album;
use App\Http\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class SongController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $song;
    private $category;
    private $album;


    public function __construct(Song $song, Category $category, Album $album)
    {
        $this->song = $song;
        $this->category = $category;
        $this->album = $album;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail($id)
    {
        $user = Auth::user();
        $categories = $this->category::orderBy('id','DESC')->paginate(3);
        $listSongs = [$this->song->find($id)];
        $listSongsMyAlbumHash = [];
        $listRecommendSongs = [];

        if ($user) {
            $listRecommendSongs = $this->song->handleGetRecommendSong();
            $album = $this->album->findAlbumByUserId($user->id);
            $listSongsMyAlbumHash = $this->album->getListSongsMyAlbumHash($album->id);
        }

        return view('client.track')->with(compact('categories','listSongs', 'listRecommendSongs', 'listSongsMyAlbumHash'));
    }
}
