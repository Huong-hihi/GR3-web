<?php

namespace App\Http\Controllers\Client;

use App\Http\Models\User;
use App\Traits\File;
use App\Http\Models\Song;
use App\Http\Models\Album;
use App\Http\Models\Category;
use Illuminate\Http\Request;
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


    public function __construct
    (
        Song $song,
        Category $category,
        Album $album)
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

        if ($user && $user->role == User::ROLE_ADMIN) return redirect()->route('admin.user.index');

        $categories = $this->category::orderBy('id','DESC')->paginate(3);
        $listSongs = [$this->song->where('id', $id)->with([
            'comments' => function($q) use ($user) {
                $q->with('user', 'parent')
                    ->orderBy('created_at', 'DESC');
            },
        ])->first()];
        $listSongsMyAlbumHash = [];
        $listRecommendSongs = [];
        $listComments = $listSongs[0]->comments;

        if ($user) {
            $listRecommendSongs = $this->song->handleGetRecommendSong();
            $album = $this->album->findAlbumByUserId($user->id);
            $listSongsMyAlbumHash = $album ? $this->album->getListSongsMyAlbumHash($album->id) : [];
        }

        return view('client.track')->with(compact('categories','listSongs', 'listRecommendSongs', 'listSongsMyAlbumHash', 'listComments'));
    }
}
