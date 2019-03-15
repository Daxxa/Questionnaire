<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

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
        /*$client= new Role();
        $client->name = 'client';
        $client->display_name = 'User Client'; // optional
        $client->description  = 'User is allowed to create, edit, delete own pulls'; // optional
        $client->save();
        $user = User::all()->first();
        $user->attachRole(Role::all()->first());*/
        /*$createPoll = new Permission();
        $createPoll->name         = 'create-poll';
        $createPoll->display_name = 'Create Polls'; // optional
// Allow a user to...
        $createPoll->description  = 'create new polls'; // optional
        $createPoll->save();
        $client = Role::find(1);
        $client->attachPermission($createPoll);*/
        return view('home');

    }

}
