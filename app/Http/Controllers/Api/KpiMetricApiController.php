<?php

namespace App\Http\Controllers\Api;

use App\Models\Kpi;
use App\Models\Partner;
use App\Models\KpiMetric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\KpiMetricMember;
use App\Models\Metric;

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
    Log::info("You are in store method"); 

    Log::info('Raw Request Data: ' . $request->getContent());
    $members = json_decode($request->input('members'), true);
    Log::info("Received members data: " . json_encode($members));




    $this->validate($request, [
        'title' => 'required',
        'type' => 'required',
        'metric_id' => 'required',
        'response_period' => 'required',
        'kpi_id' => 'required',
        'on_track_value' => 'required',
        'off_track_min' => 'required',
        'off_track_max' => 'required',
        'at_risk_min' => 'required',
        'at_risk_max' => 'required',
        //'members' => 'required|array', // Add validation for members array
        'members.targets.*.memberID' => 'required|exists:members,id', // Validate each member ID
        'members.targets.*.memberTarget' => 'required|numeric',
        
    ]);

   

  

    $kpi = Kpi::findOrFail($request->kpi_id);


  // Extract start and end dates from review_period_range
        $pattern = '/(\d{1,2})\w{2} (\w+) (\d{4})/';
        preg_match_all($pattern, $kpi->review_period_range, $matches);
        
        // Parse start date components
        $startDay = $matches[1][0];
        $startMonth = $matches[2][0];
        $startYear = $matches[3][0];
        $startMonthNumeric = array_search($startMonth, [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ]) + 1;
        
        // Parse end date components
        $endDay = $matches[1][1];
        $endMonth = $matches[2][1];
        $endYear = $matches[3][1];
        $endMonthNumeric = array_search($endMonth, [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ]) + 1;
        
        // Create Carbon instances for start and end dates
        $start_date = Carbon::create($startYear, $startMonthNumeric, $startDay, 0, 0, 0);
        $end_date = Carbon::create($endYear, $endMonthNumeric, $endDay, 0, 0, 0);
        
        $daysDifference = $end_date->diffInDays($start_date);

        Log::info("Days difference is:", ['Day difference'=> $daysDifference]);
        
        $totalTarget = 0; // Initialize total target sum
        $totalTimelyValue = 0; // Initialize total timely value sum
    
        // Loop through members and calculate total target and timely value
        foreach ($members['targets'] as $member) {
            $individualTarget = $member['memberTarget']; // Get the individual target provided by the user
    
            // Calculate the timely value based on the response period and individual target
            if ($request->response_period === 'weekly') {
                $timelyValue = $individualTarget / ($daysDifference / 7);
            } elseif ($request->response_period === 'monthly') {
                $timelyValue = $individualTarget / ($daysDifference / 30);
            } elseif ($request->response_period === 'quarterly') {
                $timelyValue = $individualTarget / ($daysDifference / 90);
            } else {
                $timelyValue = 0; // Set a default value if response period is not recognized
            }

            

            // Sum up the target values for all members
            $totalTarget += $individualTarget;
            // Sum up the timely values for all members
            $totalTimelyValue += $timelyValue;
        }
    
        // Create KpiMetric with total target and timely value
        $kpiMetric = KpiMetric::create([
            'title' => $request->title,
            'type' => $request->type,
            'response_period' => $request->response_period,
            'kpi_id' => $request->kpi_id,
            'metric_id' =>$request->metric_id,
            'target' => $totalTarget, 
            'timely_value' => $totalTimelyValue, 
            'on_track_value' => $request->on_track_value,
            'off_track_min' => $request->off_track_min,
            'off_track_max' => $request->off_track_max,
            'at_risk_min' => $request->at_risk_min,
            'at_risk_max' => $request->at_risk_max,
        ]);
    
        $kpiMetricMembers = [];

        // Loop through members and create KpiMetricMember entries
        foreach ($members['targets'] as $member) {
            $individualTarget = $member['memberTarget']; // Get the individual target provided by the user
    
            // Calculate the timely value based on the response period and individual target
            if ($request->response_period === 'weekly') {
                $timelyValue = $individualTarget / ($daysDifference / 7);
            } elseif ($request->response_period === 'monthly') {
                $timelyValue = $individualTarget / ($daysDifference / 30);
            } elseif ($request->response_period === 'quarterly') {
                $timelyValue = $individualTarget / ($daysDifference / 90);
            } else {
                $timelyValue = 0; // Set a default value if response period is not recognized
            }


                    // Log individual values for this member
            Log::info('Individual Target and Timely Value', [
                'Member ID' => $member['memberID'],
                'Individual Target' => $individualTarget,
                'Timely Value' => $timelyValue,
            ]);

       
    
            $kpiMetricMember = KpiMetricMember::create([
                'kpi_metric_id' => $kpiMetric->id,
                'member_id' => $member['memberID'],
                'target' => $individualTarget,
                'timely_value' => $timelyValue,
            ]);

            $kpiMetricMembers[] = $kpiMetricMember; // Collect the created KPI metric members

        }


    $kpi = Kpi::findOrFail($request->kpi_id);
    $partner = $kpi->partner;
    
    // Associate the KPI Metric with the KPI and Partner
    $partner->kpis()->save($kpi);
    

    
    return response()->json([
      'kpi_metric_members' => [$kpiMetricMembers]
    ], 200);

   

}






    //  public function store(Request $request)

    //  {
    //     $this->validate($request, [
    //         'title' => 'required',
    //         'type' => 'required',
    //         'response_period' => 'required',
    //         'kpi_id' => 'required',
    //         'target' => 'required',
    //         'on_track_value' => 'required',
    //         'off_track_min' => 'required',
    //         'off_track_max' => 'required',
    //         'at_risk_min' => 'required',
    //         'at_risk_max' => 'required',
    //     ]);

    //     $kpi = Kpi::findOrFail($request->kpi_id);

    //     // Extract start and end dates from review_period_range
    //     $pattern = '/(\d{1,2})\w{2} (\w+) (\d{4})/';
    //     preg_match_all($pattern, $kpi->review_period_range, $matches);
        
    //     // Parse start date components
    //     $startDay = $matches[1][0];
    //     $startMonth = $matches[2][0];
    //     $startYear = $matches[3][0];
    //     $startMonthNumeric = array_search($startMonth, [
    //         'January', 'February', 'March', 'April', 'May', 'June',
    //         'July', 'August', 'September', 'October', 'November', 'December'
    //     ]) + 1;
        
    //     // Parse end date components
    //     $endDay = $matches[1][1];
    //     $endMonth = $matches[2][1];
    //     $endYear = $matches[3][1];
    //     $endMonthNumeric = array_search($endMonth, [
    //         'January', 'February', 'March', 'April', 'May', 'June',
    //         'July', 'August', 'September', 'October', 'November', 'December'
    //     ]) + 1;
        
    //     // Create Carbon instances for start and end dates
    //     $start_date = Carbon::create($startYear, $startMonthNumeric, $startDay, 0, 0, 0);
    //     $end_date = Carbon::create($endYear, $endMonthNumeric, $endDay, 0, 0, 0);
        
    //     $daysDifference = $end_date->diffInDays($start_date);
        
        
        

        
    //             // Calculate timely value based on response period
    //             if ($request->response_period === 'weekly') {
    //                 $timely_value = $request->target / ($daysDifference / 7);
    //             } elseif ($request->response_period === 'monthly') {
    //                 $timely_value = $request->target / ($daysDifference / 30);
    //             } elseif ($request->response_period === 'quarterly') {
    //                 $timely_value = $request->target / ($daysDifference / 90);
    //             } else {
    //                 $timely_value = 0; // Set a default value if response period is not recognized
    //             }


    //     // Create KpiMetric
    //     $kpiMetric = KpiMetric::create([
    //         'title' => $request->title,
    //         'type' => $request->type,
    //         'response_period' => $request->response_period,
    //         'kpi_id' => $request->kpi_id,
    //         'target' => $request->target,
    //         'timely_value' => $timely_value,
    //         'on_track_value' => $request->on_track_value,
    //         'off_track_min' => $request->off_track_min,
    //         'off_track_max' => $request->off_track_max,
    //         'at_risk_min' => $request->at_risk_min,
    //         'at_risk_max' => $request->at_risk_max,
    //     ]);

        
    //     $kpi = Kpi::findOrFail($request->kpi_id);
    //     $partner = $kpi->partner;
        
    //     // Associate the KPI Metric with the KPI and Partner
    //     $kpiMetric->kpi()->associate($kpi);
    //     $kpiMetric->save();
        
    //     $partner->kpis()->save($kpi);

    //     return response()->json([
    //         'success' => 'Kpi metric created successfully',
    //     ]);

    // }


    
public function getKpiMetricsByMetricId(Request $request, $metricId)
{
    try {
        // Find the Metric by its ID
        $metric = Metric::findOrFail($metricId);

        // Load the KpiMetrics relationship and its nested relationships
        $metric->load('kpiMetric.kpi.kpiMetrics.kpiMetricMembers.progress');

        // Load relationships related to the Partner model
        $metric->kpiMetric->kpi->partner->load(['departments', 'members']);

        // Return the Metric along with its KpiMetrics and related data, including Partners
        return response()->json([
            'metric' => $metric,
        ], 200);
    } catch (\Exception $e) {
        // Handle any exceptions that occur during the process
        Log::error('Error fetching KpiMetrics:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Failed to fetch KpiMetrics'], 500);
    }
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
