<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use Illuminate\Http\Request;

class MetricController extends Controller
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
        $metrics = Metric::all();


        $data = [
            'metrics' => $metrics,

        ];


        return view('metric.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('metric.create');
    }

   
    /**
     * Display the specified resource.
     */
    public function show(Metric $metric)
    {
        $data = ['metric'=> $metric];

        return view('metric.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metric $metric)
    {
        $data = ['metric'=> $metric];

        return view('metric.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Metric $metric)
    {
        dump("metric 1:".$metric);
        $metric->update([
            'name' => $request['name'],
            'unit' => $request['unit'],

        ]);

        return redirect('/configurations')->with('success', 'Metric updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Metric $metric)
    {
        $metric->delete();
        return redirect('/configurations')->with('success', 'Metric type deleted successfully');
    }
}
