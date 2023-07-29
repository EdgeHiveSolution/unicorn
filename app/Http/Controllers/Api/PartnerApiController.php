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
use App\Models\KpiMetric;
use Illuminate\Support\Facades\Log;


class PartnerApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $partners = Partner::with('departments', 'members','kpis','kpiMetrics')->get();

        $formattedPartners = $partners->map(function ($partner) {
            $partner->formatted_created_at = Carbon::parse($partner->created_at)->isoFormat('DD MMMM YYYY');
            return $partner;
        });

        return $formattedPartners;
    }

    public function latest()
    {
        $partners = Partner::with('departments', 'members,kpis')
            ->latest('created_at')
            ->take(3)
            ->get();

        $formattedPartners = $partners->map(function ($partner) {
            $partner->formatted_created_at = Carbon::parse($partner->created_at)->isoFormat('DD MMMM YYYY');
            return $partner;
        });

        return $formattedPartners;
    }

    public function store(Request $request)
    {
        $members =json_decode($request->members);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'country_id' => 'nullable|integer',
            'business_type' => 'nullable',
            'about' => 'required',
            'document_id' => 'nullable',

        ]);


        // Store the logo file in the public/partners folder
        $logo_name = "";
        if ($request->hasFile('logo')) {
            $this->validate($request, [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4048',
            ]);

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
        'document_id' => $request->documents,
        'password' => Hash::make($password),
        'is_active' => 1,
    ]);
    $password_generator = new PasswordGeneratorUtil();
        $password = $password_generator->generatePassword();


        foreach ($members as $member) {
            // Check if the member already exists
            $existingMember = Member::where('email', $member->email)->first();
        
            if ($existingMember) {
                // Member exists, send the login URL
                try {
                    Mail::to($existingMember->email)->send(new PatnerInvitation($existingMember, $password, 'login', $request->name));
                    $partner->members()->attach($existingMember->id, [
                        'department_id' => $member->department_id,
                        'role' => $member->role,
                    ]);
                } catch (\Exception $e) {
                    // Log the error message
                    Log::info('Error sending email to existing member: ' . $e->getMessage());
                }
            } else {
                // Member is new, send the register URL
                try {
                    Mail::to($member)->send(new PatnerInvitation(null, null, 'register', $request->name));
                    // Note: For new members, $member is an email string, not an object, so we can't access properties like $member->department_id directly.
                    // You might need to update this part accordingly based on your data structure.
                    $partner->members()->attach($newMember->id, [
                        'department_id' => $member->department_id,
                        'role' => $member->role,
                    ]);
                } catch (\Exception $e) {
                    // Log the error message
                    Log::info('Error sending email to new member: ' . $e->getMessage());
                }
            }
        }
    }


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


         $partnerId = $request->id;


         $partner = Partner::findOrFail($partnerId);


         if ($request->hasFile('logo')) {

             $logoFile = $request->file('logo');


             $logoFileName = time() . '_' . $logoFile->getClientOriginalName();


             $logoFile->storeAs('public/partner_logos', $logoFileName);


             $partner->logo = 'storage/partner_logos/' . $logoFileName;
         }

         // Update the partner model with the validated data (including the updated logo file URL, if applicable)
         $partner->update($validatedData);

         // Save the changes to the database
         $partner->save();

         // Return a response indicating the success of the update
         return response()->json(['message' => 'Partner updated successfully'], 200);
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
