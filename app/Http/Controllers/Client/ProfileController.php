<?php

namespace App\Http\Controllers\Client;

use App\Http\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;

class ProfileController extends Controller
{
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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

        return view('client.profile.index')->with(compact('user'));
    }

    public function update(UserUpdateRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();

        DB::beginTransaction();
        try {
            $this->user->updateUser($request, $user->id);
            DB::commit();

            return redirect()->back()->with('status', 'success');
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('status', 'false');
        }
    }
}
