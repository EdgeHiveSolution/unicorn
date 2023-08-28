<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;



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
    

        $member = Member::with(['departments'])->findOrFail($memberId);
        
        // Get the KpiMetricMembers of the member
        $kpiMetricMembers = $member->kpiMetricMembers;
    
        // Get the associated KpiMetrics
        $kpiMetrics = [];
        foreach ($kpiMetricMembers as $kpiMetricMember) {
            $kpiMetrics[] = [
                'kpiMetric' => $kpiMetricMember->kpiMetric,
                'progress' => $kpiMetricMember->progress,
            ];
        }
    
        // Get the associated KPIs from KpiMetrics
        $kpis = [];
        foreach ($kpiMetrics as $kpiMetricData) {
            $kpis[] = $kpiMetricData['kpiMetric']->kpi;
        }

        
    
        return response()->json([
            'member' => $member,
            'kpis' => $kpis,
            'kpiMetrics' => $kpiMetrics,
        ]);
    }
    

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
