<?php

namespace App\Http\View\Composers;

use App\Http\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserComposer
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = Auth::user();

        $global = [
            'user' => $user
        ];

        $view->with('global', $global);
    }
}
