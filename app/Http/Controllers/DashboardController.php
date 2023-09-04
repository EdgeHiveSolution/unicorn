<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
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
        $loggeduser= Session::get('user');
        Log::info('Session User', ['user'=> $loggeduser]);
       // dd($loggeduser);

        $partners = Partner::latest()->cursorPaginate(4);

        $data = [
            'partners' => $partners,
            'loggeduser' => $loggeduser
        ];
        return view('dashboard.index', ['data'=> $data]);
    }
}
