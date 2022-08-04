<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Models\Album;
use App\Http\Models\Category;
use App\Http\Models\ListenLog;
use App\Http\Models\Singer;
use App\Http\Models\Song;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $album;
    private $song;
    private $listenLog;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Album $album, Song $song, ListenLog $listenLog)
    {
        $this->album = $album;
        $this->song = $song;
        $this->listenLog = $listenLog;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user && $user->role == User::ROLE_ADMIN) return redirect()->route('admin.user.index');

        $categories = Category::orderBy('id','DESC')->get();
        $songs = Song::orderBy('id','ASC')->with('singer')->paginate(8);
        $singers = Singer::orderBy('songs_count','DESC')->withCount('songs')->paginate(8);
        $albums = $this->album::getAlbumHasWith();
        $rankSongs = $this->listenLog
            ->select(
                'song_id',
                DB::raw('COUNT(*) as views')
            )
            ->with('song.singer')
            ->groupBy('song_id')
            ->orderBy('views', 'DESC')
            ->limit(10)
            ->get();

        return view('client.home', compact('categories','songs','singers', 'albums', 'rankSongs'));
    }

    public function search(Request $request)
    {
        $search = $request->all();

        if (!$request->q) return abort(404);

        $songs = $this->song->search($request->q);

        return view('client.search', compact('songs', 'search'));
    }

    public function category($id)
    {
        $songs = $this->song->getSongByCategory($id);

        return view('client.category', compact('songs'));
    }
}
