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
        // method 1
        // The action make return to response:view ,json, redirect,file
        // return view('dashborad',[
        //     'user' =>'Nivin Shabat',
        // ]);

        //method 2
        // $user='Nivin Shabat';
        // $title='store';
        // var_dump(compact('user','title'));
        // exit;
        // return view('dashborad',compact('user','title'));

        // method 3

        // $title='store';
        // $user=Auth::user();
        // return Response::view('Layouts.dashboard',[ // return obj of response
        //     'user' =>'nivin',
        //     'title' => $title,
        // ]);
    //     $user='nivin shabat';
    //     $title='store';
    //     //return view , json;redirect,view,file
    //     return view('Layouts.dashboard',compact('user','store'));
    }
}

