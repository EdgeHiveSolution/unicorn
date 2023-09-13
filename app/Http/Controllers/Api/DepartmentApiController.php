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
use App\Mail\PatnerInvitation;
use Illuminate\Support\Facades\Log;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;






class DepartmentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */

    public function index()
    {
        // $queries = \DB::getQueryLog();
        // Log::info('SQL Queries:', ['queries' => $queries]);

        try {
            \DB::enableQueryLog();
            $departments = Department::with('members', 'partners')->get()->toArray();
            Log::info('Departments fetched from database:', ['departments' => $departments]);
            $queries = \DB::getQueryLog();
           Log::info('SQL Queries:', ['queries' => $queries]);
            
            return response()->json($departments, Response::HTTP_OK);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the database query
            Log::error('Error fetching departments:', ['error' => $e->getMessage()]);
            
            return response()->json(['error' => 'Failed to fetch departments'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

//     public function index()
// {
//     try {
//         \DB::enableQueryLog();
//         $departments = Department::with('members', 'partners')->get()->toArray();

//         $formattedPartners = collect($departments)->map(function ($department) {
//             $formattedPartners = $department['partners']->map(function ($partner) {
//                 $partner['formatted_created_at'] = Carbon::parse($partner['created_at'])->isoFormat('DD MMMM YYYY');
//                 return $partner;
//             });
//             $department['partners'] = $formattedPartners->toArray(); // Convert back to array
//             return $department;
//         });

//         Log::info('Departments fetched from the database:', ['departments' => $departments]);
//         $queries = \DB::getQueryLog();
//         Log::info('SQL Queries:', ['queries' => $queries]);

//         return response()->json($departments, Response::HTTP_OK); // Return the original $departments
//     } catch (\Exception $e) {
//         // Handle any exceptions that occur during the database query
//         Log::error('Error fetching departments:', ['error' => $e->getMessage()]);
        
//         return response()->json(['error' => 'Failed to fetch departments'], Response::HTTP_INTERNAL_SERVER_ERROR);
//     }
// }



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
        $registrationLink = url('/register?department_id=' . $department->id);
    
        // Check if the member already exists
        $existingMember = Member::where('email', trim($memberEmail))->first();
    
        if ($existingMember) {
            // Member exists, send the login URL
            Mail::to($existingMember->email)->queue(new MemberInvitation($existingMember, $request->name, $password, 'login'));
            $memberIds[] = $existingMember->id;
        } else {
            // Member is new, send the register URL
            Mail::to($memberEmail)->queue(new MemberInvitation(null, $request->name, null, 'register', $registrationLink));
        }
    }
    $department->members()->attach($memberIds);

    return response()->json([
        'success' => 'Department created successfully',
    ]);
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
