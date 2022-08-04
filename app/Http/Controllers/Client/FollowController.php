<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Models\Album;
use App\Http\Models\Category;
use App\Http\Models\Comment;
use App\Http\Models\Follow;
use App\Http\Models\Singer;
use App\Http\Models\Song;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Exception;

class FollowController extends Controller
{

    protected $follow;
    protected $singer;

    public function __construct(
        Follow $follow,
        Singer $singer
    )
    {
        $this->follow = $follow;
        $this->singer = $singer;
    }

    public function myFollow()
    {
        $user = Auth::user();

        if (!$user) return redirect()->route('login');

        $singerIds = Follow::where('user_id', $user->id)
            ->pluck('singer_id');
        $listSingers = Singer::whereIn('id', $singerIds)->get();

        return view('client.my-follow')->with(compact('listSingers'));
    }

    public function apiToggleFollow(Request $request)
    {
        try {
            $user = Auth::user();

            $response = [
                'message' => 'Error',
                'error' => true,
                'status' => 400
            ];

            if (!$user) {
                $response['status'] = 419;
                return response($response, $response['status']);
            }

            $storeFollow = [
                'user_id' => $user->id,
                'singer_id' => $request->singer_id
            ];

            $follow = Follow::where('user_id', $user->id)
                ->where('singer_id', $request->singer_id)
                ->first();

            if ($follow) {
                $follow->delete();
            } else {
                $follow = Follow::create($storeFollow);
            }

        } catch (Exception $exception) {
            return response(['message' => 'Error'], 404);
        }

        return response(['message' => 'success', 'follow' => $follow], 200);
    }
}
