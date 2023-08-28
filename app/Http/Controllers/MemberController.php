<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\Partner;

 class MemberController extends Controller
    {
        
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    // public function index()

    // {
    //     $members = Member::latest()->cursorPaginate(5);


    //     $data = [
    //         'members' => $members,

    //     ];


    //     return view('member.index', $data);
    // }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    // public function create()
    // {
    //     return view('progress.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
  


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     *
     */
    // public function show()
    // {
    //     $partners = Partner::latest()->cursorPaginate(4);

    //     $data = [
    //         'partners' => $partners,
    //     ];
    //     return view('member.show',  ['data'=> $data]);
    // }


        public function show(Member $member)

        {
            return view('member.show', ['member' => $member]);
        }

//     public function show($memberId)
// {
//     $member = Member::findOrFail($memberId); // Fetch the specific member by ID

//     return view('member.show', ['member'=>$member]);
// }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     *
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     *
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
}
