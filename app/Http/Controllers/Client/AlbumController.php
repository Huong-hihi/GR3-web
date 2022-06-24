<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Models\Album;
use App\Http\Models\AlbumSong;
use App\Http\Models\Category;
use App\Http\Models\Song;
use App\Traits\File;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $category;

    /**
     * @var Album
     */
    private $album;

    private $song;


    /**
     * @param Category $category
     * @param Album $album
     * @param Song $song
     */
    public function __construct(
        Category $category,
        Album $album,
        Song $song
    )
    {
        $this->category = $category;
        $this->album = $album;
        $this->song = $song;
    }

    /**
     * Show the application dashboard.
     * @param $id
     * @return Renderable
     */
    public function detail($id)
    {
        $user = Auth::user();
        $categories = $this->category::orderBy('id','DESC')->get();
        $album = $this->album::findOrFail($id)->with(['songs' => function($q) use ($user){
            if ($user) $q->with('ratings');
        }])->first();
        $listSongs = $album->songs;
        $listRecommendSongs = [];
        $listSongsMyAlbumHash = [];

        if ($user) {
            $listRecommendSongs = $this->song->handleGetRecommendSong();
            $listSongsMyAlbumHash = $this->album->getListSongsMyAlbumHash($album->id);
        }

        return view('client.track')->with(compact('categories','listSongs', 'listRecommendSongs', 'listSongsMyAlbumHash'));
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function myAlbumUpdate(Request $request)
    {
        $user = Auth::user();

        $response = [
            'message' => 'Error',
            'error' => true,
            'status' => 404
        ];

        if (!$user) {
            $response['status'] = 419;
            return response($response, $response['status']);
        }

        $myAlbum = $this->album->findAlbumByUserId($user->id);

        switch ($request->action) {
            case 'create' : {
                if (!$myAlbum) {
                    $request->merge(['user_id' => $user->id, 'name' => config('common.text.album-name-default')]);
                    $myAlbum = $this->album->createAlbum($request);
                }

                //add song
                $myAlbum = $this->album->findAlbum($myAlbum->id);
                $myAlbum->songs()->detach($request->song_id);
                $myAlbum->songs()->attach($request->song_id);
                break;
            }

            case 'delete' : {
                $myAlbum->songs()->detach($request->song_id);
                break;
            }

            default: {

            }
        }

        return response(['message' => 'success'], 200);
    }

    public function myAlbumIndex()
    {
        $user = Auth::user();
        $listSongs = $this->album->findAlbumByUserId($user->id)->songs;

        return view('client.my-album')->with(compact('listSongs'));
    }
}
