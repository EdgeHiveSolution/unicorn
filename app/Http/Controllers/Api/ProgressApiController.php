<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kpi;
use App\Models\KpiMetric;
use App\Models\Progress;
use App\Models\KpiMetricMember;
use Illuminate\Support\Facades\Log;



class ProgressApiController extends Controller

{

    public function store(Request $request)
{

    
    Log::info("You are in store function");

    $this->validate($request, [
        'title' => 'required',
        'value' => 'required|numeric',
        'notes' => 'nullable|string',
        'kpi_metric_member_id' => 'required|exists:kpi_metric_members,id', // Make sure the kpi_metric_id exists
    ]);

    // Find the corresponding KpiMetric based on the request parameters
    $kpiMetricMember = KpiMetricMember::findOrFail($request->kpi_metric_member_id);

    Log::info("kpi_metric_member_id is: ", ['kpi_metric_member_id'=>$request->kpi_metric_member_id]);

    // Create the progress update
    $progress = Progress::create([
        'title' => $request->title,
        'current_value' => $request->value,
        'target_value' => $kpiMetricMember->timely_value, // Use timely_value from KpiMetric
        'notes' => $request->notes,
        'kpi_metric_member_id' =>$kpiMetricMember ->id,
    ]);


    // Associate the progress with the KpiMetricMember
    $kpiMetricMember->progress()->save($progress);

    return response()->json([
        'success' => 'Progress update created successfully',
    ]);
}



    

}
