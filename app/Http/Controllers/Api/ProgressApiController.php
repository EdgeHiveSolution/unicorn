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

    public function getProgressDetail($progressId) 

    {

        try {
            // Use Eloquent to retrieve the progress record by its ID
            $progress = Progress::findOrFail($progressId);
    
            // You can return the progress record as JSON or in any desired format
            return response()->json([
                'success' => true,
                'data' => $progress,
            ], 200);
        } catch (\Exception $e) {
            // Handle exceptions if the progress record is not found
            return response()->json([
                'success' => false,
                'message' => 'Progress record not found.',
            ], 404);
        }

        
    }



    public function store(Request $request)

    {

       

        Log::info("I need all requests here:", ["requests" =>$request->all()]);

        $this->validate($request, [
            'title' => 'required',
            'value' => 'required|numeric',
            'notes' => 'nullable|string',
            'kpi_metric_member_id' => 'required|exists:kpi_metric_members,id',
            'kpi_metric_id' => 'required|exists:kpi_metrics,id',
            'file.*' => 'nullable|mimes:jpeg,png,jpg,pdf|max:2048', // Define file validation rules
        ]);
    
        // Find the corresponding KpiMetricMember based on the request parameters
        $kpiMetricMember = KpiMetricMember::findOrFail($request->kpi_metric_member_id);
        $targetValue = $kpiMetricMember->timely_value;
    
        // Find the corresponding KpiMetric based on the request parameters
        $kpiMetric = KpiMetric::findOrFail($request->kpi_metric_id);
    
        // Set the target_value based on the total target from the KpiMetric
    
        // Create the progress update
        $progress = Progress::create([
            'title' => $request->title,
            'current_value' => $request->value,
            'target_value' => $targetValue,
            'notes' => $request->notes,
            'kpi_metric_id' => $request->kpi_metric_id,
            'kpi_metric_member_id' => $kpiMetricMember->id,
        ]);
    
        // Handle file uploads
        if ($request->hasFile('files')) {
            $filePaths = []; // Initialize an array to store file paths
    
            foreach ($request->file('files') as $uploadedFile) {
                $fileName = $uploadedFile->getClientOriginalName(); // Get the original file name
                $path = $uploadedFile->storeAs('ProgressUploads', $fileName, 'public'); // Store the file in the "ProgressUploads" folder
                $filePaths[] = $path; // Store the file path in the array

                Log::info('Uploaded file:', [
                    'original_name' => $fileName,
                    'stored_path' => $path,
                ]);
            }

            Log::info('File Paths:', ['paths' => $filePaths]);

    
            // Create ProgressFile records for each file path
            foreach ($filePaths as $path) {
                $progress->progressFiles()->create(['file_paths' => json_encode([$path])]);
            }
        }
    
        $kpiMetricMember->progress()->save($progress);
    
        return response()->json([
            'progress' => $progress
        ]);
    }
    


    // public function store(Request $request)
    
    // {
    //     $this->validate($request, [
    //         'title' => 'required',
    //         'value' => 'required|numeric',
    //         'notes' => 'nullable|string',
    //         'kpi_metric_member_id' => 'required|exists:kpi_metric_members,id',
    //         'kpi_metric_id' => 'required|exists:kpi_metrics,id'
    //     ]);
    
    //     // Find the corresponding KpiMetricMember based on the request parameters
    //     $kpiMetricMember = KpiMetricMember::findOrFail($request->kpi_metric_member_id);
    //     $targetValue = $kpiMetricMember->timely_value;
    
    //     // Find the corresponding KpiMetric based on the request parameters
    //     $kpiMetric = KpiMetric::findOrFail($request->kpi_metric_id);
    
    //     // Set the target_value based on the total target from the KpiMetric
       
    //     // Create the progress update
    //     $progress = Progress::create([
    //         'title' => $request->title,
    //         'current_value' => $request->value,
    //         'target_value' => $targetValue,
    //         'notes' => $request->notes,
    //         'kpi_metric_id' => $request->kpi_metric_id,
    //         'kpi_metric_member_id' => $kpiMetricMember->id,
    //     ]);
    
    //     // // Calculate the sum of current_value for progress updates with the same kpi_metric_id
    //     // $totalCurrentValue = Progress::where('kpi_metric_id', $request->kpi_metric_id)
    //     //                              ->sum('current_value');
    
    //     // // Update the sum of current_value for progress updates with the same kpi_metric_id
    //     // Progress::where('kpi_metric_id', $request->kpi_metric_id)
    //     //         ->update(['current_value' => $totalCurrentValue]);
    
    //     // Associate the progress with the KpiMetricMember
    //     $kpiMetricMember->progress()->save($progress);
    
    //     return response()->json([
    //         'progress' => $progress
    //     ]);
    // }




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
  
    
    public function getProgressForKpiMetric($kpimetricId, $kpiMetricMemberId) {
        // Find the specific KpiMetricMember based on kpi_metric_id and kpi_metric_member_id
        $kpiMetricMembers = KpiMetricMember::where('kpi_metric_id', $kpimetricId)
            ->where('id', $kpiMetricMemberId)
            ->with('kpiMetric', 'progress')
            ->get();
    
        $progressData = [];
    
        // Loop through the retrieved KpiMetricMember and retrieve its associated progress
        foreach ($kpiMetricMembers as $kpiMetricMember) {
            $progressData[] = [
                'kpi_metric_member' => $kpiMetricMember,
            ];
        }
    
        return response()->json([
            'progress_data' => $progressData
        ]);
    }
    

    // public function getProgressForKpiMetric($kpimetricId) {
    //     // Find all KpiMetricMembers associated with the given KpiMetric
    //     $kpiMetricMembers = KpiMetricMember::where('kpi_metric_id', $kpimetricId)->with('kpiMetric', 'progress')->get();
    
    //     $progressData = [];
    
    //     // Loop through each KpiMetricMember and retrieve its associated progress
    //     foreach ($kpiMetricMembers as $kpiMetricMember) {
    //         $progressData[] = [
    //             'kpi_metric_member' => $kpiMetricMember,
               
    //         ];
    //     }
    
    //     return response()->json([
    //         'progress_data' => $progressData
    //     ]);
    // }
    




    

}
