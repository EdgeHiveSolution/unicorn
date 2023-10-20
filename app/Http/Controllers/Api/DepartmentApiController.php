<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use App\Models\Department;
use App\Models\DepartmentPartner;
use Illuminate\Http\Request;
use App\Mail\MemberInvitation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Util\PasswordGeneratorUtil;
use App\Mail\PatnerInvitation;
use App\Mail\MemberReactivateInvitation;
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
        Log::info('Members input:', ['members' => $request->input('members')]);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',
            'members' => 'nullable|string', // Allow nullable string for members
        ]);
    
        $department = Department::create([
            'name' => $request->name,
            'email' => $request->email,
            'about' => $request->about,
        ]);
    
        $membersString = $request->input('members', ''); // Get the members string from the request
        $membersArray = $membersString ? explode(',', $membersString) : []; // Split the string into an array if it's not empty
    
        if (!empty($membersArray)) {
            $memberIds = [];
            $password_generator = new PasswordGeneratorUtil();
            $password = $password_generator->generatePassword();
    
            foreach ($membersArray as $memberEmail) {
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
        }
    
        return response()->json([
            'success' => 'Department created successfully',
        ]);
    }
    


//      public function store(Request $request)
// {
//     $this->validate($request, [
//         'name' => 'required',
//         'email' => 'required|email',
//         'about' => 'required',
//         'members.*' =>'nullable|email',

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
   

//       foreach ($members as $memberEmail) {
//         $registrationLink = url('/register?department_id=' . $department->id);
    
//         // Check if the member already exists
//         $existingMember = Member::where('email', trim($memberEmail))->first();
    
//         if ($existingMember) {
//             // Member exists, send the login URL
//             Mail::to($existingMember->email)->queue(new MemberInvitation($existingMember, $request->name, $password, 'login'));
//             $memberIds[] = $existingMember->id;
//         } else {
//             // Member is new, send the register URL
//             Mail::to($memberEmail)->queue(new MemberInvitation(null, $request->name, null, 'register', $registrationLink));
//         }
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
        Log::info("Requests", ['requests' => $request->all()]);
    
        // Validate the request data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',
            'members' => 'sometimes|array',
            'members.*' => 'email',
        ]);
    
        // Find the department by its ID
        $department = Department::findOrFail($id);
    
        // Update department properties
        $department->name = $request->input('name');
        $department->email = $request->input('email');
        $department->about = $request->input('about');
        $department->save();
    
        // Update or add members
        $members = $request->input('members', []);
    
        Log::info('Members array:', ['members' => $members]);
        $password_generator = new PasswordGeneratorUtil();
    
        foreach ($members as $memberEmail) {
            // Check if the member already exists in the department
            $existingMemberInDepartment = $department->members()->where('email', trim($memberEmail))->first();
            
            if (!$existingMemberInDepartment) {
                // Member doesn't exist in the department
                $existingMember = Member::withTrashed()->where('email', trim($memberEmail))->first();
            
                if (!$existingMember) {
                    // Member doesn't exist in the system, send an invitation to register
                    $registrationLink = url('/register?department_id=' . $department->id);
                    $password = $password_generator->generatePassword(); // Generate a password
                    Mail::to($memberEmail)->queue(new MemberInvitation(null, $request->name, $password, 'register', $registrationLink));
                } else {
                    // Check if the member is soft-deleted (marked as deleted but not removed from the database)
                    if ($existingMember->trashed()) {
                        // Reactivate the soft-deleted member
                        $existingMember->restore();
                    }
            
                    // Send an invitation email with the 'login' type and include the password
                    $loginLink = url('/login');
                    $password = $password_generator->generatePassword(); // Generate a password
        
                    // Ensure that you pass a non-deleted instance of Member
                    Mail::to($existingMember->email)->queue(new MemberReactivateInvitation(
                        $existingMember,
                        $request->name,
                        $password,
                        'login',
                        null,
                        $loginLink
                    ));
                }
            }
        }
        
        return response()->json([
            'success' => 'Department updated successfully',
        ]);
    }
     


    //  public function update(Request $request, $id)
    //  {
    //      Log::info("Requests", ['requests' => $request->all()]);
    //      // Validate the request data
    //      $this->validate($request, [
    //          'name' => 'required',
    //          'email' => 'required|email',
    //          'about' => 'required',
    //          'members' => 'sometimes|array',
    //          'members.*' => 'email',
    //      ]);
     
    //      // Find the department by its ID
    //      $department = Department::findOrFail($id);
     
    //      // Update department properties
    //      $department->name = $request->input('name');
    //      $department->email = $request->input('email');
    //      $department->about = $request->input('about');
    //      $department->save();
     
    //      // Update or add members
    //      $members = $request->input('members', []);
     
    //      foreach ($members as $memberEmail) {
    //          // Check if the member already exists in the department
    //          $existingMemberInDepartment = $department->members()->where('email', trim($memberEmail))->first();
     
    //          if (!$existingMemberInDepartment) {
    //              // Member doesn't exist in the department, send emails to new members only
    //              $existingMember = Member::where('email', trim($memberEmail))->first();
     
    //              if (!$existingMember) {
    //                  $registrationLink = url('/register?department_id=' . $department->id);
    //                  Mail::to($memberEmail)->queue(new MemberInvitation(null, $request->name, null, 'register', $registrationLink));
    //              }
    //          }
    //      }
     
    //      return response()->json([
    //          'success' => 'Department updated successfully',
    //      ]);
    //  }
     


public function fetchDepartmentMembers($departmentId)
{
    try {
        $department = Department::findOrFail($departmentId);

        // Retrieve a list of member_ids in the department_members pivot table
        $memberIdsInDepartment = $department->members()
            ->select('department_member.member_id')
            ->get()
            ->pluck('member_id'); // Extract member_id values into an array

        // Fetch the corresponding members' emails and names
        $members = Member::whereIn('id', $memberIdsInDepartment)
            ->select('id', 'email', 'name', 'is_active')
            ->get();


            Log::info("Returned Members:" .$members );

        return response()->json($members);
    } catch (\Exception $e) {
        // Handle any errors or exceptions as needed
        return response()->json(['error' => 'Failed to fetch department members'], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  public function destroy($id)
    //  {
    //      // Retrieve the department by ID from the database
    //      $department = Department::findOrFail($id);
     
    //      // Check if the department has any related partner records in the pivot table
    //      $hasRelatedPartners = DepartmentPartner::where('department_id', $department->id)->exists();
     
    //      if ($hasRelatedPartners) {
    //          // If there are related partners, deactivate the department
    //          $department->update(['is_active' => false]);
    //      } else {
    //          // If there are no related partners, delete the department
    //          $department->delete(); // Soft delete if you have implemented it
    //      }
     
    //      return response()->json(['message' => 'Department deleted or deactivated successfully'], 200);
    //  }


    public function destroy($id)
{
    // Retrieve the department by ID from the database (including soft deleted departments)
    $department = Department::withTrashed()->findOrFail($id);

    // Check if the department has any related partner records
    $hasRelatedPartners = $department->partners()->exists();

    if ($hasRelatedPartners) {
        // If there are related partners, deactivate the department
        $department->update(['is_active' => false]);
    } else {
        // If there are no related partners, delete the department
        $department->forceDelete(); // Use forceDelete to permanently delete
    }

    return response()->json(['message' => 'Department deleted or deactivated successfully'], 200);
}

     

//         public function destroy($id)
// {
//     // Retrieve the partner by ID from the database (including soft deleted partners)
//     $department= Department::withTrashed()->findOrFail($id);

//     // Handle the partner logo file deletion (if it exists)
   

//     $department->delete();


//     return response()->json(['message' => 'Department deleted successfully'], 200);
// }



    
}
