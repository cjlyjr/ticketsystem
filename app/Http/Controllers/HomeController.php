<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $user_id=auth()->user()->id;
        $userid=User::find($user_id);
        if(!empty($userid))
        {
            return view('home')->with('posts',$userid->posts);
        }
        
       
    }
}
