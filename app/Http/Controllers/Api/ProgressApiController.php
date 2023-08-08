<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kpi;
use App\Models\KpiMetric;
use App\Models\Progress;
use App\Models\KpiMetricMember;


class ProgressApiController extends Controller
{

    public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required',
        'value' => 'required|numeric',
        'notes' => 'nullable|string',
        'kpi_metric_member_id' => 'required|exists:kpi_metric_members,id',
        'kpi_id' => 'required|exists:kpis,id',
        'kpi_metric_id' => 'required|exists:kpi_metrics,id'
    ]);

    // Find the corresponding KpiMetricMember based on the request parameters
    $kpiMetricMember = KpiMetricMember::findOrFail($request->kpi_metric_member_id);

    // Set the target_value based on the timely_value of the KpiMetricMember
    $targetValue = $kpiMetricMember->timely_value;

    // Create the progress update
    $progress = Progress::create([
        'title' => $request->title,
        'current_value' => $request->value,
        'target_value' => $targetValue,
        'notes' => $request->notes,
        'kpi_id' =>$request->kpi_id,
        'kpi_metric_id'=>$request->kpi_metric_id,
        'kpi_metric_member_id' =>$kpiMetricMember->id,
    ]);

    // Associate the progress with the KpiMetricMember
    $kpiMetricMember->progress()->save($progress);

    return response()->json([
        'success' => 'Progress update created successfully',
    ]);
}

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'title' => 'required',
    //         'value' => 'required|numeric',
    //         'notes' => 'nullable|string',
    //         'kpi_metric_id' => 'required|exists:kpi_metrics,id',
    //     ]);
    
    //     // Find the corresponding KpiMetric based on the request parameters
    //     $kpiMetric = KpiMetric::findOrFail($request->kpi_metric_id);
    
    //     // Set the target_value based on the timely_value of the KpiMetric
    //     $targetValue = $kpiMetric->timely_value;
    
    //     // Create the progress update
    //     $progress = Progress::create([
    //         'title' => $request->title,
    //         'current_value' => $request->value,
    //         'target_value' => $targetValue,
    //         'notes' => $request->notes,
    //         'kpi_metric_id' => $kpiMetric->id,
    //     ]);
    
    //     // Associate the progress with the KpiMetric
    //     $kpiMetric->progress()->save($progress);
    
    //     return response()->json([
    //         'success' => 'Progress update created successfully',
    //     ]);
    // }
    





    

}