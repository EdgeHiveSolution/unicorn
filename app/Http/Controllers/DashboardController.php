<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Session;
use App\Models\Member;
use App\Models\MemberPartner;
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
         $loggeduser = Session::get('user');
         Log::info('Session User', ['user' => $loggeduser]);
     
         if ($loggeduser->user_role_id == 2) {
             
             $memberId = Member::where('user_id', $loggeduser->id)->value('id');
             Log::info('Member id is:' . $memberId);


             $partnerIds = MemberPartner::where('member_id', $memberId)->pluck('partner_id');
             Log::info('Partner ids:' . $partnerIds);
             
             
             $partners = Partner::whereIn('id', $partnerIds)->latest()->cursorPaginate(4);
         } else {
             
             $partners = [];
         }
     
         $data = [
             'partners' => $partners,
             'loggeduser' => $loggeduser
         ];

         
         
         return view('dashboard.index', ['data' => $data]);
     }

     
     
     
     /*public function index()
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
     }*/


}
