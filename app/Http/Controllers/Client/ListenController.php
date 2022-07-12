<?php

namespace App\Http\Controllers\Client;

use App\Http\Models\ListenLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ListenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $listenLog;


    public function __construct
    (
        ListenLog $listenLog
    )
    {
        $this->listenLog = $listenLog;
    }

    public function listen(Request $request)
    {
        $user = Auth::user();
//        $date = Carbon::now()->subHours(1);

        $response = [
            'message' => 'Error',
            'status' => 400
        ];

//        if (!$user) {
//            $response = [
//                'message' => 'unauthenticated',
//                'status' => 401
//            ];
//            return response($response, $response['status']);
//        }

        if (!$request->song_id) {
            $response = [
                'message' => 'Song ID is invalid',
                'status' => 403
            ];

            return response($response, $response['status']);
        }

//        $listen = $this->listenLog
//            ->where('user_id', $user->id)
//            ->where('song_id', $request->song_id)
//            ->where('created_at', '<', $date)
//            ->get();

        $this->listenLog->create([
            'user_id' => $user ? $user->id : 1,
            'song_id' => $request->song_id,
        ]);

        return response(['message' => 'success'], 200);
    }
}
