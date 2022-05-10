<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\User;
use App\Http\Models\Singer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class SingerController extends Controller
{
    use SoftDeletes;

    private $singer;
    private $user;

    public function __construct(Singer $singer, User $user)
    {
        $this->singer = $singer;
        $this->user = $user;
    }

    public function index()
    {
        $singers = $this->singer->getAll();
        return view('admin.singer.index', [
            'singers' => $singers
        ]);
    }

    public function create()
    {
        return view('admin.singer.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $userCreated = $this->user->store($request);
            $request->merge(['user_id' => $userCreated->id]);
            $this->singer->store($request);

            DB::commit();

            return redirect()->route('admin.singer.index')->with('status', 'success');

        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.singer.index')->with('status', 'false');
        }
    }

    public function edit($userID)
    {
        $singer = $this->singer->findByUserID($userID);

        if ($singer->user->role == User::ROLE_SINGER)
            return view('admin.singer.edit', ['singer' => $singer]);

        return abort(404);
    }

    public function update(Request $request, $userID)
    {
        DB::beginTransaction();
        try {
            $this->user->updateUser($request, $userID);
            $this->singer->updateSingerByUserID($request, $userID);

            DB::commit();

            return redirect()->route('admin.singer.index')->with('status', 'success');

        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.singer.index')->with('status', 'false');
        }
    }

    public function delete($userID)
    {
        $this->user->deleteUser($userID);
        $this->singer->deleteSingerByUserID($userID);

        return redirect()->route('admin.singer.index');
    }

}
