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
        $partners = Partner::with('departments', 'members')->get();

        $formattedPartners = $partners->map(function ($partner) {
            $partner->formatted_created_at = Carbon::parse($partner->created_at)->isoFormat('DD MMMM YYYY');
            return $partner;
        });

        return $formattedPartners;
    }

    public function latest()
    {
        $partners = Partner::with('departments', 'members')
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
    ]);

    foreach ($members as $member) {
        // Create the member using the email
        $newMember = Member::firstOrCreate(['email' => $member->email]);

        // Fill the values in the pivot table (member_partner)
        $partner->members()->attach($newMember->id, [
            'department_id' => $member->department_id,
            'role' => $member->role,
        ]);
    }




        return response()->json([
            'success' => 'Partner created successfully',
          
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
