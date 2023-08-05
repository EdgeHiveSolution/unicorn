<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kpi;
use App\Models\KpiMetric;
use App\Models\Progress;


class ProgressApiController extends Controller

{

    public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required',
        'value' => 'required|numeric',
        'notes' => 'nullable|string',
        'kpi_metric_id' => 'required|exists:kpi_metrics,id', // Make sure the kpi_metric_id exists
    ]);

    // Find the corresponding KpiMetric based on the request parameters
    $kpiMetric = KpiMetric::findOrFail($request->kpi_metric_id);

    
    // Create the progress update
    $progress = Progress::create([
        'title' => $request->title,
        'current_value' => $request->value,
        'target_value' => $kpiMetric->timely_value, // Use timely_value from KpiMetric
        'notes' => $request->notes,
        'kpi_metric_id' => $kpiMetric->id,
    ]);


    // Associate the progress with the KpiMetric
    $kpiMetric->progress()->save($progress);

    return response()->json([
        'success' => 'Progress update created successfully',
    ]);
}



    

}
