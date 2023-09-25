<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\KpiMetric;
use App\Models\Progress;



class MemberApiController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $members = Member::all();

        Log::info("Members are:", ['members'=>$members]);

        return json_encode($members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    


    public function getKpisAndMetricsForMember($memberId)
{
    $member = Member::with(['departments', 'partners.kpis.kpiMetrics.kpiMetricMembers.progress'])
        ->findOrFail($memberId);

    return response()->json([
        'member' => $member,
    ]);
}


//     public function getKpisAndMetricsForMember($memberId)
// {
//     $member = Member::with(['departments', 'partners.kpis.kpiMetrics.kpiMetricMembers.progress'])
//         ->findOrFail($memberId);

//     // Extract KPIs and metrics from partners
//     $kpiMetrics = [];
//     $kpis = [];
//     $progressSummation = [];

//     foreach ($member->partners as $partner) {
//         foreach ($partner->kpis as $kpi) {
//             foreach ($kpi->kpiMetrics as $kpiMetric) {
//                 foreach ($kpiMetric->kpiMetricMembers as $kpiMetricMember) {
//                     $progress = $kpiMetricMember->progress;

//                     $progressSummation[$kpiMetricMember->id] = [
//                         'current_sum' => $progress->sum('current_value'),
//                         'target_sum' => $progress->sum('target_value'), // Assuming timely_value is the target
//                     ];

//                     $kpiMetrics[] = [
//                         'kpiMetric' => $kpiMetric,
//                         'progress' => $progress,
//                         'progress_sum' => $progressSummation[$kpiMetricMember->id],
//                     ];

//                     $kpis[] = $kpi;
//                 }
//             }
//         }
//     }

//     return response()->json([
//         'member' => $member,
//         'kpis' => $kpis,
//         'kpiMetrics' => $kpiMetrics,
//     ]);
// }


//     public function getKpisAndMetricsForMember($memberId)
     
//   {
//     $member = Member::with(['departments','partners'])->findOrFail($memberId);

//     // Get the KpiMetricMembers of the member
//     $kpiMetricMembers = $member->kpiMetricMembers;

//     // Calculate the summation of current_value and timely_value based on your conditions
//     $kpiMetrics = [];
//     $kpis = [];
//     $progressSummation = [];

//     foreach ($kpiMetricMembers as $kpiMetricMember) {
//         $kpiMetric = $kpiMetricMember->kpiMetric;
//         $progress = $kpiMetricMember->progress;
        
//         $progressSummation[$kpiMetricMember->id] = [
//             'current_sum' => $progress->sum('current_value'),
//             'target_sum' => $progress->sum('target_value') // Assuming timely_value is the target
//         ];

//         $kpiMetrics[] = [
//             'kpiMetric' =>  $kpiMetric,
//             'progress' =>   $progress,
//             'progress_sum' => $progressSummation[$kpiMetricMember->id],
//         ];

//         $kpis[] = $kpiMetric->kpi;
//     }

//     return response()->json([
//         'member' => $member,
//         'kpis' => $kpis,
//         'kpiMetrics' => $kpiMetrics,
//     ]);
// }



public function removeMemberFromList($memberId)

{
    try {
        // Check if the member has progress records
        $hasProgress = Progress::whereHas('kpiMetricMember.kpiMetric.kpi.members', function ($query) use ($memberId) {
            $query->where('members.id', $memberId);
        })->exists();

        if ($hasProgress) {
            // If the member has progress records, deactivate them
            $member = Member::findOrFail($memberId);
            $member->update(['is_active' => false]);
        } else {
            // If the member has no progress records, delete them
            Member::destroy($memberId);
        }

        return response()->json(['message' => 'Member removed successfully']);
    } catch (\Exception $e) {
        // Handle any errors or exceptions as needed
        return response()->json(['error' => 'Failed to remove member'], 500);
    }
}



public function removeMember($id)
{
    try {
        // Find and delete the member
        Member::destroy($id);

        return response()->json(['message' => 'Member removed successfully']);
    } catch (\Exception $e) {
        // Handle any errors or exceptions as needed
        return response()->json(['error' => 'Failed to remove member'], 500);
    }
}


//     public function getKpisAndMetricsForMember($memberId)
// {
//     $member = Member::with(['departments'])->findOrFail($memberId);
    
//     // Get the KpiMetricMembers of the member
//     $kpiMetricMembers = $member->kpiMetricMembers;

    
//     // Calculate the summation of current_value and target_value based on your conditions
//     // $progressSummation = [];
//     // foreach ($kpiMetricMembers as $kpiMetricMember) {
//     //     $progressSummation[$kpiMetricMember->id] = [
//     //         'current_sum' => $kpiMetricMember->progress->sum('current_value'),
//     //         'target_sum' => KpiMetric::where('id', $kpiMetricMember->kpi_metric_id)->sum('timely_value'),
//     //     ];
//     // }

//      $progressSummation = [];
//     foreach ($kpiMetricMembers as $kpiMetricMember) {
//         $progressSummation[$kpiMetricMember->id] = [
//             'current_sum' => $kpiMetricMember->progress->sum('current_value'),
//             //'target_sum' => $kpiMetricMember->progress->sum('target_value'),
//             'target_sum' => KpiMetric::where('id', $kpiMetricMember->kpi_metric_id)->sum('timely_value'),
//         ];
//     }



//     // Get the associated KpiMetrics and KPIs
//     $kpiMetrics = [];
//     $kpis = [];
//     foreach ($kpiMetricMembers as $kpiMetricMember) {
//         $kpiMetrics[] = [
//             'kpiMetric' => $kpiMetricMember->kpiMetric,
//             'progress' => $kpiMetricMember->progress,
//             'progress_sum' => $progressSummation[$kpiMetricMember->id],
//         ];
//         $kpis[] = $kpiMetricMember->kpiMetric->kpi;
//     }

//     return response()->json([
//         'member' => $member,
//         'kpis' => $kpis,
//         'kpiMetrics' => $kpiMetrics,
//     ]);
// }

    // public function getKpisAndMetricsForMember($memberId)
    // {
    

    //     $member = Member::with(['departments'])->findOrFail($memberId);
        
    //     // Get the KpiMetricMembers of the member
    //     $kpiMetricMembers = $member->kpiMetricMembers;
    
    //     // Get the associated KpiMetrics
    //     $kpiMetrics = [];
    //     foreach ($kpiMetricMembers as $kpiMetricMember) {
    //         $kpiMetrics[] = [
    //             'kpiMetric' => $kpiMetricMember->kpiMetric,
    //             'progress' => $kpiMetricMember->progress,
    //         ];
    //     }
    
    //     // Get the associated KPIs from KpiMetrics
    //     $kpis = [];
    //     foreach ($kpiMetrics as $kpiMetricData) {
    //         $kpis[] = $kpiMetricData['kpiMetric']->kpi;
    //     }

        
    
    //     return response()->json([
    //         'member' => $member,
    //         'kpis' => $kpis,
    //         'kpiMetrics' => $kpiMetrics,
    //     ]);
    // }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $member = Member::findOrFail($id);
      return response()->json($member);
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
