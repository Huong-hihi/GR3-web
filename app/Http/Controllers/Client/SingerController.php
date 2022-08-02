<?php

namespace App\Http\Controllers\Client;

use  App\Http\Controllers\Controller;
use App\Http\Models\Album;
use App\Http\Models\Category;
use App\Http\Models\Follow;
use App\Http\Models\Singer;
use App\Http\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class SingerController extends Controller
{
    private $category;
    private $album;
    private $song;
    private $singer;

    public function __construct(
        Category $category,
        Album $album,
        Song $song,
        Singer $singer
    )
    {
        $this->category = $category;
        $this->album = $album;
        $this->song = $song;
        $this->singer = $singer;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function detail(Request $request, $id)
    {
        $user = Auth::user();

        $singer = Singer::where('id', $id)->with(
            [
                'user',
                'songs',
                'follows' => function ($q) use ($user) {
                    if ($user) {
                        $q->where('user_id', $user->id);
                    } else {
                        $q->where('user_id', 0);
                    }
                }
            ])
            ->first();

        if (!$singer) return abort(404);

        return view('client.singer', compact('singer'));
    }

    public function album(Request $request, $id)
    {
        $singer = $this->singer::find($id, ['user']);
        $user = Auth::user();
        $categories = $this->category::orderBy('id','DESC')->get();

        $listSongs = [Song::where('singer_name', $singer->name)
            ->when($user, function($q) use ($user){
                $q->with('ratings');
            })
            ->with([
                'comments' => function($q) use ($user) {
                    $q->with('user', 'parent')
                        ->orderBy('created_at', 'DESC');
                },
            ])
            ->first()];
        $listRecommendSongs = [];
        $listSongsMyAlbumHash = [];

        $listComments = $listSongs[0]->comments;

        if ($user) {
            $listRecommendSongs = $this->song->handleGetRecommendSong();
            $listSongsMyAlbumHash = $this->album->getListSongsMyAlbumHash($user->album ? $user->album->id : null);
        }

        return view('client.track')->with(compact('categories','listSongs', 'listRecommendSongs', 'listSongsMyAlbumHash', 'listComments'));
    }

    public function search(Request $request)
    {
        $search = $request->all();

        if (!$request->q) return abort(404);

        $songs = $this->song->search($request->q);

        return view('client.search', compact('songs', 'search'));
    }
}
