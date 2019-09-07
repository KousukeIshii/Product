<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\GoogleUser;

class SpaController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return redirect('/login');
        }

        $authuser = Auth::user();
        $user = GoogleUser::find($authuser['id']);
        $date = time();

        if($user['token_exp_time'] - 600 <= $date) {
            $token = auth('api')->login($authuser);
            $user['token'] = $token;
            $user['token_exp_time'] = $date + 3600;
            $user->save();
        } else {
            $token = $user['token'];
        }

        return view('spa', compact('token'));
    }
}
