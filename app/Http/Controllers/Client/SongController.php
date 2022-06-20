<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Models\Category;
use App\Http\Models\Singer;
use App\Http\Models\Song;
use App\Traits\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $song;
    private $category;
    private $file;


    public function __construct(Song $song, Category $category, File $file)
    {
        $this->song = $song;
        $this->category = $category;
        $this->file = $file;
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
        $listSongsMyAlbum = $user ? $this->album->findAlbumByUserId($user->id)->songs : [];

        return view('client.track')->with(compact('categories','listSongs', 'listSongsMyAlbum'));
    }
}
