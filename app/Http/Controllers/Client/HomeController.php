<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Models\Album;
use App\Http\Models\Category;
use App\Http\Models\Singer;
use App\Http\Models\Song;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $album;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Album $album)
    {
        $this->album = $album;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::orderBy('id','DESC')->get();
        $songs = Song::orderBy('id','DESC')->paginate(3);
        $singers = Singer::orderBy('id','DESC')->with('user')->paginate(3);
        $albums = $this->album::getAlbumHasWith();

        return view('client.home')->with(compact('categories','songs','singers', 'albums'));
    }
}
