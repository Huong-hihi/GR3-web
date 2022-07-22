<?php

namespace App\Http\Controllers\Client;

use App\Http\Models\Album;
use App\Http\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(
       Comment $comment
    )
    {
        $this->comment = $comment;
    }

    public function apiCreate(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $response = [
            'message' => 'Error',
            'status' => 400
        ];

        if (!$user) {
            $response = [
                'message' => 'unauthenticated',
                'status' => 401
            ];
            return response($response, $response['status']);
        }

        if (!$data['content'] || !$data['commentable_id'] || !$data['commentable_type']) {
            $response = [
                'message' => 'Data is invalid',
                'status' => 403
            ];

            return response($response, $response['status']);
        }

        $data['user_id'] = $user->id;

        $commentStore = $this->comment->create($data);


        $comment = $this->comment->where('id', $commentStore->id)->with('user', 'parent')->first();

        return response(['message' => $comment], 200);
    }

}
