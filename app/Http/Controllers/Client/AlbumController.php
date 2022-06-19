<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Models\Album;
use App\Http\Models\Category;
use App\Traits\File;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $category;
    private $album;


    public function __construct(Category $category,  Album $album)
    {
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
        $categories = $this->category::orderBy('id','DESC')->get();
        $album = $this->album::findOrFail($id)->with(['songs' => function($q) use ($user){
            if ($user) $q->with('ratings');
        }])->get();
        $listSongs = $album[0]->songs;

        return view('client.track')->with(compact('categories','listSongs'));
    }
}
