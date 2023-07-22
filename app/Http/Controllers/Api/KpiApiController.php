<?php

namespace App\Http\Controllers\Api;

use App\Models\Kpi;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KpiApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Kpi::with('members','partners','departments')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'member_id' => 'required',
           // 'review_period_range' => 'required',
        ]);


          $kpi =  Kpi::create([
            'title' => $request->title,
            'member_id' => $request->member_id,
            'review_period_range' => $request->review_period,
        ]);
        $partner_id = $request->partner_id;


           // Associate the KPI with the partner
                $partner = Partner::findOrFail($partner_id);
                $partner->kpis()->save($kpi);

        return response()->json([
            'success' => 'Kpi created successfully',

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
