<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
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
    public function index()
    {
        $partners = Partner::latest()->cursorPaginate(5);

        $data = [
            'partners' => $partners,
        ];

        return view('partner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('partner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * onse
     */
    public function show(Partner $partner)
{
    $partner->load([
        'members',
        'kpis',
        'departments'
    ]);

    // Load kpiMetrics for each KPI
    $partner->kpis->load('kpiMetrics.kpiMetricMembers.progress');

    $data = [
        'partner' => $partner,
    ];

    return view('partner.show', $data);
}



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     *
     */
    public function edit(Partner $partner)
    {
        $data = ['partner'=> $partner];

        return view('partner.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $partner->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'about' => $request['about'],
            'members' => $request['members'],
        ]);

        return redirect('/partners')->with('success', 'Partner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect('/partners')->with('success', 'Partner deleted successfully');
    }
}
