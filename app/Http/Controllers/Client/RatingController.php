<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Models\Rating;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    use SoftDeletes;

    private $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function log($songId, Request $request)
    {
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


        $rating = $this->rating->updateOrCreate([
            'song_id' => $songId,
            'user_id' => $user->id,
        ], [
            'score' => $request->score
        ]);


        return response(['message' => 'success', 'score' => $rating->score], 200);

//        return view('admin.song.index', [
//            'songs' => $songs
//        ]);
    }
}
