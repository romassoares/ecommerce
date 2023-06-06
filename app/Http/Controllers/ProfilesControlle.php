<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfilesControlle extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', ['user' => $user]);
    }
}
