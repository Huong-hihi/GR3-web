<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserController extends Controller
{
    use SoftDeletes;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->getAll();
        return view('admin.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->user->store($request);
            DB::commit();

            return redirect()->route('admin.user.index')->with('status', 'success');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.user.index')->with('status', 'false');
        }
    }

    public function edit($id)
    {
        $user = $this->user->find($id);

        if ($user->role == User::ROLE_USER)
            return view('admin.user.edit', ['user' => $user]);

        return abort(404);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->user->updateUser($request, $id);
            DB::commit();

            return redirect()->route('admin.user.index')->with('status', 'success');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->route('admin.user.index')->with('status', 'false');
        }
    }

    public function delete($id)
    {
        $this->user->deleteUser($id);

        return redirect()->route('admin.user.index');
    }

}
