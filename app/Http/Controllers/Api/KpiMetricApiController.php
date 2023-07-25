<?php

namespace App\Http\Controllers\Api;

use App\Models\Kpi;
use App\Models\Partner;
use App\Models\KpiMetric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KpiMetricApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required',
        'type' => 'required',
        'response_period' => 'required',
        'kpi_id' => 'required',
        'partner_id' => 'required',
        'on_track_value' => 'required',
        'off_track_min' => 'required',
        'off_track_max' => 'required',
        'at_risk_min' => 'required',
        'at_risk_max' => 'required',
    ]);

    $kpiMetric = KpiMetric::create([
        'title' => $request->title,
        'type' => $request->type,
        'response_period' => $request->response_period,
        'kpi_id' => $request->kpi_id,
        'partner_id' => $request->partner_id,
        'on_track_value' => $request->on_track_value,
        'off_track_min' => $request->off_track_min,
        'off_track_max' => $request->off_track_max,
        'at_risk_min' => $request->at_risk_min,
        'at_risk_max' => $request->at_risk_max,
    ]);


    $partner = Partner::findOrFail($request->partner_id);

    
    $partner->kpiMetrics()->save($kpiMetric);


     $kpi_id = $request->kpi_id;
     $kpi = Kpi::findOrFail($kpi_id);
     $kpi->kpiMetrics()->save($kpiMetric);
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
