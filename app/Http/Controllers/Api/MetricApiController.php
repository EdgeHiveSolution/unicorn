<?php

namespace App\Http\Controllers\Api;

use App\Models\Metric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MetricApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Metric::all();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'unit' => 'required',

        ]);



        Metric::create([
            'name' => $request->name,
            'unit' => $request->unit,

        ]);

        return response()->json([
            'success' => 'Metric type created successfully',
            'redirect' => '/configurations'
        ]);
    }


   public function update(Request $request, Metric $metric)
    {

       

        // Update the metric
        $metric->update([
            'name' => $request->name,
            'unit' => $request->unit,

        ]);

        // Return a success message
        return response()->json(['success' => 'Metric updated successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
