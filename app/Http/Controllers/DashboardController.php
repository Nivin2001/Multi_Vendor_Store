<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        // all action not active expcept the user be auth
        $this->middleware(['auth'])->only   ('index');

    }
    // methods is actions

    public function index()
    {
        $user=Auth::user();


        $user='nivin shabat';
        $title='store';
        //return view , json;redirect,view,file
        return view('Layouts.dashboard',compact('user','title'));
    }
}

