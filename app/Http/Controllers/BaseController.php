<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BaseController extends Controller
{

    /**
     * Get the guard to be used during authentication.
	 +
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard($role = null)
    {
        if ($role == null) {

            if (request()->segment(2) && in_array(request()->segment(2), ['admin'])) {
                $role = request()->segment(2);
            }

            $role = request()->segment(2);
        }

        return Auth::guard($role);
    }

}
