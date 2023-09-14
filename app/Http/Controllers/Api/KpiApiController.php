<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Kpi;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;

class KpiApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Kpi::with('members','partners','departments','kpiMetrics')->get();
    }

    
    /**
     * Store a newly created resource in storage.
     */


     public function store(Request $request)
     
     {
         $this->validate($request, [
             'title' => 'required',
             'kpiOwner_id' => 'required',
             'partner_id' => 'required',
             'review_start_date' => 'required',
             'review_end_date' => 'required',
         ]);
     
         $start_date = Carbon::createFromFormat('Y-m-d', $request->review_start_date)->isoFormat('Do MMMM YYYY');
         $end_date = Carbon::createFromFormat('Y-m-d', $request->review_end_date)->isoFormat('Do MMMM YYYY');
     
         $date_range = $start_date . ' to ' . $end_date;
     
         $kpi = Kpi::create([
             'title' => $request->title,
             'kpiOwner_id' => $request->kpiOwner_id,
             'partner_id' => $request->partner_id,
             'review_period_range' => $date_range,
         ]);
     
         // Retrieve all members and associate them with the newly created KPI using the members() relationship
         $members = Member::all();
         $memberIds = $members->pluck('id')->toArray();
         $kpi->members()->attach($memberIds);
     
         $partner_id = $request->partner_id;
         $partner = Partner::findOrFail($partner_id);
         $partner->kpis()->save($kpi);
     
         return response()->json([
             'success' => 'KPI created successfully',
         ]);

     }

   
    //  public function store(Request $request)
    //  {
    //      $this->validate($request, [
    //          'title' => 'required',
    //          'kpiOwner_id' => 'required',
    //          'partner_id' => 'required',
    //          'review_start_date' => 'required',
    //          'review_end_date' => 'required',
    //      ]);
 
    //      $start_date = Carbon::createFromFormat('Y-m-d', $request->review_start_date)->isoFormat('Do MMMM YYYY');
    //      $end_date = Carbon::createFromFormat('Y-m-d', $request->review_end_date)->isoFormat('Do MMMM YYYY');
 
    //      $date_range = $start_date . ' to ' . $end_date;
 
    //      $kpi = Kpi::create([
    //         'title' => $request->title,
    //         'kpiOwner_id' => $request->kpiOwner_id,
    //         'partner_id' => $request->partner_id,
    //         'review_period_range' => $date_range,
    //      ]);
 
    //      $kpiOwner = Member::findOrFail($request->kpiOwner_id);
 
    //      // Associate the KPI owner (member) with the newly created KPI using the members() relationship
    //      $kpi->members()->attach($kpiOwner);
 
    //      $partner_id = $request->partner_id;
    //      $partner = Partner::findOrFail($partner_id);
    //      $partner->kpis()->save($kpi);
 
    //      return response()->json([
    //          'success' => 'KPI created successfully',
    //      ]);
    //  }
    // public function store(Request $request)
    //  {

    //     $this->validate($request, [
    //         'title' => 'required',
    //         'kpiOwner_id' => 'required',
    //         'partner_id' => 'required',
    //         'review_start_date' => 'required',
    //         'review_end_date' => 'required',
    //     ]);

    //     $start_date = Carbon::createFromFormat('Y-m-d', $request-> review_start_date,)->isoFormat('Do MMMM YYYY');
    //     $end_date = Carbon::createFromFormat('Y-m-d',  $request-> review_end_date)->isoFormat('Do MMMM YYYY');

    //     $date_range = $start_date . ' to ' . $end_date;

        //   $kpi =  Kpi::create([
        //     'title' => $request->title,
        //     'kpiOwner_id' => $request->kpiOwner_id,
        //     'partner_id' => $request->partner_id,
        //     'review_period_range' => $date_range,
        // ]);
    //     $partner_id = $request->partner_id;



    //             $partner = Partner::findOrFail($partner_id);
    //             $partner->kpis()->save($kpi);

    //     return response()->json([
    //         'success' => 'Kpi created successfully',

    //     ]);
    // }

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
