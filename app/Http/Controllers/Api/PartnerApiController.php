<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Member;
use App\Models\Partner;
use App\Mail\PartnerAdded;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\PartnerDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Util\PasswordGeneratorUtil;
use App\Mail\PatnerInvitation;
use App\Mail\PartnerLoginCredentials;
use App\Models\KpiMetric;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\UserRole;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class PartnerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $partners = Partner::with('departments', 'members','kpis.kpiMetrics.kpiMetricMembers.progress')->get();

        Log::info("Partner is:", ['partner'=>$partners]); 

        $formattedPartners = $partners->map(function ($partner) {
            $partner->formatted_created_at = Carbon::parse($partner->created_at)->isoFormat('DD MMMM YYYY');
            return $partner;
        });

        Log::info("Partners are :", ['partners'=>$formattedPartners]); 
        return $formattedPartners;

       
    }

    public function latest()
    {
        $partners = Partner::with('departments', 'members', 'kpis')
            ->latest('created_at')
            ->take(3)
            ->get();

        $formattedPartners = $partners->map(function ($partner) {
            $partner->formatted_created_at = Carbon::parse($partner->created_at)->isoFormat('DD MMMM YYYY');
            return $partner;
        });

        return $formattedPartners;
    }
     


//         public function store(Request $request)
        
//           {
//             Log::info('Test log message');
//             try {

//                 FacadesDB::beginTransaction();
//                 // Log the request data for debugging purposes
//                 Log::info('Request data:', ['data' => $request->all()]);
public function store(Request $request)
{
    Log::info('Test log message');
    try {
        DB::beginTransaction();

        // Log the request data for debugging purposes
        Log::info('Request data:', ['data' => $request->all()]);

        $members = json_decode($request->members);

        // Log the decoded members' data for debugging purposes
        Log::info('Members are:', ['data' => $members]);

        Log::info("Members are", ['Display' => $members]);

        // Log::info("This Member:", ['member'=> $members[0]['stdClass']]);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'country_id' => 'nullable|integer',
            'business_type' => 'nullable',
            'about' => 'required',
            'documents' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
        ]);

        // Store the logo file in the public/partners folder
        $logo_name = "";
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $file_name = strtolower($request->name) . "-logo" . time() . '.' . $logo->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/partners/logos/');
            $logo->move($destinationPath, $file_name);
            $logo_name = url('/uploads/partners/logos/') . '/' . $file_name;
        }

        $password_generator = new PasswordGeneratorUtil();
        $password = $password_generator->generatePassword();

        $partner = Partner::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo' => $logo_name,
            'country_id' => $request->country_id,
            'business_type' => $request->business_type,
            'about' => $request->about,
            'documents' => $request->documents,
            'password' => Hash::make($password),
            'is_active' => 1,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'user_role_id' => UserRole::where('name', 'Partner')->first()->id,
        ]);


        $partner->user_id = $user->id;
    
        $partner->save();

        $loginLink = url('/login'); // Adjust the login URL as needed

         // Send login credentials to the partner
         try {
            Mail::to($partner->email)->send(new PartnerLoginCredentials($partner, $loginLink, $password));
        } catch (\Exception $e) {
            // Log the error message
            Log::info('Error sending login credentials email to partner: ' . $e->getMessage());
        }


        // // Attach the partner to departments with specific roles
        // foreach ($members as $member) {
        //     // Check if a similar record already exists in the pivot table
        //     $existingRecord = DB::table('department_partner')
        //         ->where('department_id', $member->department_id)
        //         ->where('partner_id', $partner->id)
        //         ->where('role', $member->role)
        //         ->first();

        //     if (!$existingRecord) {
        //         // Attach the partner to the department
        //         $partner->departments()->attach($member->department_id, [
        //             'role' => $member->role,
        //         ]);
        //     }
        // }

        

        // Loop through the members and send them email invitations
        foreach ($members as $member) {


           $partner->departments()->attach($member->department_id, [
                    'role' => $member->role,
                ]);


        
            $existingMember = Member::where('email', $member->email)->first();
            $registrationLink = url('/register?partner_id=' . $partner->id);

            if ($existingMember) {
                // If the member already exists, send the login URL and associate with the partner's department
                try {
                    Log::info('Existing Member Email: ' . $existingMember->email);
                    Log::info('Department ID: ' . $member->department_id);
                    Mail::to($existingMember->email)->send(new PatnerInvitation($existingMember, $partner->name, $password, 'login'));
                    $existingMember->partners()->attach($partner->id, [
                        'department_id' => $existingMember->department_id,
                        'role' => $member->role,
                    ]);
                } catch (\Exception $e) {
                    // Log the error message
                    Log::info('Error sending email to existing member: ' . $e->getMessage());
                }
            } else {
                // If the member is new, send the register URL
                try {
                    // Send the registration link to the new member
                    Log::info('New Member Email: ' . $member->email);
                    Log::info('Department ID: ' . $member->department_id);
                    // Send the registration link to the new member
                    Mail::to($member->email)->send(new PatnerInvitation(null, $partner->name, null, 'register', $registrationLink));
                } catch (\Exception $e) {
                    // Log the error message
                    Log::info('Error sending email to new member: ' . $e->getMessage());
                }
            }
        }

        DB::commit();

        return response()->json([
            'success' => 'Partner created successfully',
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        // Log any exceptions that occur during the process
        Log::error('Error in store method:', ['message' => $e->getMessage()]);
        return response()->json([
            'error' => 'An error occurred while creating the partner.',
        ], 500);
    }
    
}

//                 $members = json_decode($request->members);
        
//                 // Log the decoded members data for debugging purposes
//                 Log::info('Members are:', ['data' => $members]);

           
    
//             Log::info("Members are", ['Display' => $members]);
    
//             $request->validate([
//                 'name' => 'required',
//                 'email' => 'required|email',
//                 'phone' => 'nullable',
//                 'address' => 'nullable',
//                 'country_id' => 'nullable|integer',
//                 'business_type' => 'nullable',
//                 'about' => 'required',
//                 'documents' => 'nullable',
//                 'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4048',

//             ]);
    
//             // Store the logo file in the public/partners folder
//             $logo_name = "";
//             if ($request->hasFile('logo')) {
//                 $logo = $request->file('logo');
//                 $file_name = strtolower($request->name) . "-logo" . time() . '.' . $logo->getClientOriginalExtension();
//                 $destinationPath = public_path('/uploads/partners/logos/');
//                 $logo->move($destinationPath, $file_name);
//                 $logo_name = url('/uploads/partners/logos/') . '/' . $file_name;
//             }
    
//             $password_generator = new PasswordGeneratorUtil();
//             $password = $password_generator->generatePassword();
    
//             $partner = Partner::create([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'website' => $request->website,
//                 'phone' => $request->phone,
//                 'address' => $request->address,
//                 'logo' => $logo_name,
//                 'country_id' => $request->country_id,
//                 'business_type' => $request->business_type,
//                 'about' => $request->about,
//                 'documents' => $request->documents,
//                 'password' => Hash::make($password),
//                 'is_active' => 1,
//             ]);

//             $user = User::create([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'password' => Hash::make($password),
//                 'user_role_id' => UserRole::where('name', 'Partner')->first()->id,
//             ]);
            

//               $partner->user_id = $user->id;
//               $partner->save();


//            $loginLink = url('/login'); // Adjust the login URL as needed

            // Send login credentials to the partner
            // try {
            //     Mail::to($partner->email)->send(new PartnerLoginCredentials($partner, $loginLink, $password));
            // } catch (\Exception $e) {
            //     // Log the error message
            //     Log::info('Error sending login credentials email to partner: ' . $e->getMessage());
            // }

//             // Loop through the members and associate them with the partner and department
//         foreach ($members as $member) {


//     $partner->departments()->attach($member->department_id, [
//         'role' => $member->role,
//     ]);
    
    

//     $existingMember = Member::where('email', $member->email)->first();
            
//     $registrationLink = url('/register?partner_id=' . $partner->id);
//     if ($existingMember) {
//         // If the member already exists, send the login URL and associate with the partner's department
//         try {
//             Mail::to($existingMember->email)->send(new PatnerInvitation($existingMember, $partner->name, $password, 'login'));
            
           
//             $existingMember->partners()->attach($partner->id, [
//                 'department_id' => $existingMember->department_id,
//                 'role' => $member->role,
//             ]);
//         } catch (\Exception $e) {
//             // Log the error message
//             Log::info('Error sending email to existing member: ' . $e->getMessage());
//         }
//     } else {
//         // If the member is new, send the register URL and associate with the partner's department
//         try {

//             // Send the registration link to the new member
//             Mail::to($member->email)->send(new PatnerInvitation(null, $partner->name, null, 'register', $registrationLink));
            
        

            
//         } catch (\Exception $e) {
//             // Log the error message
//             Log::info('Error sending email to new member: ' . $e->getMessage());
//         }
//     }
// }

//           FacadesDB::commit();

//             return response()->json([
//                 'success' => 'Partner created successfully',
//             ]);



//         } catch (\Exception $e) {
//             FacadesDB::rollBack();
//             // Log any exceptions that occur during the process
//             Log::error('Error in store method:', ['message' => $e->getMessage()]);
//             return response()->json([
//                 'error' => 'An error occurred while creating the partner.',
//             ], 500);
//         }

//         }
    
    
   


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     public function update(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'string|max:255',
        'email' => 'email|max:255',
        'website' => 'string|max:255',
        'phone' => 'string|max:20',
        'address' => 'string|max:255',
        'business_type' => 'string|max:100',
        'about' => 'string|max:1000',
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $partner = Partner::findOrFail($request->id);

    if ($request->hasFile('logo')) {
        // Delete the old logo file (if it exists)
        Storage::delete($partner->logo);

        // Store the new logo file and update the partner's logo attribute
        $validatedData['logo'] = $request->file('logo')->store('public/partner_logos');
    }

    // Update the partner model with the validated data (including the updated logo file URL, if applicable)
    $partner->update($validatedData);

    // Return a response indicating the success of the update
    return response()->json(['message' => 'Partner updated successfully'], 200);
}


            public function getKpiAndKpiMetricsAndProgressForPartner($partnerId)  {

                $partner = Partner::with([
                    'kpis' => function ($query) {
                        $query->with(['kpiMetrics.kpiMetricMembers.progress']);
                    }
                ])->findOrFail($partnerId);

                return response()->json($partner);
            }





     public function destroy($id)
{
    // Retrieve the partner by ID from the database (including soft deleted partners)
    $partner = Partner::withTrashed()->findOrFail($id);

    // Handle the partner logo file deletion (if it exists)
    if (!empty($partner->logo)) {
        // Get the logo file name from the URL
        $logoFileName = basename($partner->logo);


        Storage::delete('public/partner_logos/' . $logoFileName);
    }


    $partner->delete();


    return response()->json(['message' => 'Partner deleted successfully'], 200);
}



}
