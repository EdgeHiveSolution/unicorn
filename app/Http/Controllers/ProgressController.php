<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Progress;

class ProgressController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     *
     */
    // public function index()

    // {
    //     $progress = Progress::latest()->cursorPaginate(5);


    //     $data = [
    //         'progress' => $progress,

    //     ];


    //     return view('progress.index', $data);
    // }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    // public function create()
    // {
    //     return view('progress.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
  


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     *
     */
    // public function show(Progress $progress)
    // {
    //     return view('progress.show',['progress'=> $progress]);
    // }


    public function show(Progress $progress)
{
    // Fetch the associated KpiMetricMember
    $kpiMetricMember = $progress->kpiMetricMember;

    // Load the KpiMetrics and their related KPIs
    $kpiMetricMember->load('kpiMetric.kpi');

    return view('progress.show', [
        'progress' => $progress,
        'kpiMetricMember' => $kpiMetricMember,
    ]);
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     *
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     *
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
   
}
