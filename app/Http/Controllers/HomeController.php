<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Newsletter;
use App\Subgroup;
use App\Status;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $clientsCount = Client::count();
        $unsubscriptionsCount = Client::where('status_id', Status::where('name', 'Unsubscribed')->first()->id)->count();
        $subscriptionsCount = $clientsCount - $unsubscriptionsCount;
        $usersCount = User::count();

        $newsletterCount = Newsletter::count();
        return view('dashboard', ['unsubscriptionsCount' => $unsubscriptionsCount, 'clientsCount' => $clientsCount, 'subscriptionsCount' => $subscriptionsCount, 'newsletterCount' => $newsletterCount, 'usersCount' => $usersCount]);
    }

    public function showLogin()
{
    // show the form
    return View::make('login');
}

public function doLogin()
{
// process the form
}
}
