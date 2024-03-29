<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Mail\MemberInvitation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;




class DepartmentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return Department::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',
            'members' => 'required',
        ]);

        $department = Department::create([
            'name' => $request->name,
            'email' => $request->email,
            'about' => $request->about,
        ]);

        $members = explode(',', $request->members);
        foreach ($members as $memberEmail) {
            $member = Member::create([
                'department_id' => $department->id,
                'email' => trim($memberEmail),
            ]);

            Mail::to($member->email)->send(new MemberInvitation($member));

        }

        return response()->json([
            'success' => 'Department created successfully',
            'redirect' => '/departments',
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
