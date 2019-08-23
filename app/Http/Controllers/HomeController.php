<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        #$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (! Auth::check()) {
            return view('home-login-error');
        }
        $user = Auth::user();
        $date = time();

        if($user['token_exp_time'] + 3000 <= $date) { #期限切れ１０分前から更新可能
            $token = auth('api')->login($user);
            $user['token'] = $token;
            $user['token_exp_time'] = $date + 3600;
            $user->save();
        } else {
            $token = $user['token'];
        }
        $exp = $user['token_exp_time'];
        return view('home', compact('user','token','exp'));
    }
}
