<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Mail\MemberInvitation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Util\PasswordGeneratorUtil;





class DepartmentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return Department::with('members','partners')->get();
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
             'members.*' => 'email',
         ]);
     
         $department = Department::create([
             'name' => $request->name,
             'email' => $request->email,
             'about' => $request->about,
         ]);
     
         $members = explode(',', $request->members);
         $memberIds = [];
         $password_generator = new PasswordGeneratorUtil();
         $password = $password_generator->generatePassword();
         foreach ($members as $memberEmail) {
             // Check if the member already exists
             $existingMember = Member::where('email', trim($memberEmail))->first();
     
             if ($existingMember) {
                 // Member exists, send the login URL
                  Mail::to($existingMember->email)->queue(new MemberInvitation($existingMember, $request->name, $password, 'login'));
             } else {
                 // Member is new, send the register URL
                  Mail::to($memberEmail)->queue(new MemberInvitation(null, $request->name, null, 'register'));
             }
         }
     
         $department->members()->attach($memberIds);
     
         return response()->json([
             'success' => 'Department created successfully',
         ]);
     }
     






    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'about' => 'required',
    //         'members.*' => 'exists:members,email',
    //     ]);

    //     $department = Department::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'about' => $request->about,
    //     ]);

    //     $members = explode(',', $request->members);
    //     $memberIds = [];
    //     $password_generator = new PasswordGeneratorUtil();
    //     $password = $password_generator->generatePassword();
    //     foreach ($members as $memberEmail) {
    //         $member = Member::create([
    //             'email' => trim($memberEmail),
    //             'password' => Hash::make($password),
    //             'is_active' => 1,
    //         ]);
    //         $memberIds[] = $member->id;



    //       //  Mail::to($member->email)->queue(new MemberInvitation($member, $request->name, $password));
    //     }

        
    //     $department->members()->attach($memberIds);

    //     return response()->json([
    //         'success' => 'Department created successfully',
    //     ]);
    // }







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
