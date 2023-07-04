<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Mail\MemberInvitation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PartnerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return Partner::with('departments', 'members')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        dd($request);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',
            'members' => 'required',
        ]);

        $partner = Partner::create([
            'name' => $request->name,
            'email' => $request->email,
            'about' => $request->about,
        ]);

        $members = explode(',', $request->members);
        foreach ($members as $memberEmail) {
            $member = Member::create([
                'partner_id' => $partner->id,
                'email' => trim($memberEmail),
            ]);

            // Send email to the member
            Mail::to($member->email)->send(new MemberInvitation($member));
        }

        return response()->json([
            'success' => 'Partner created successfully',
            'redirect' => '/dpartners',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
