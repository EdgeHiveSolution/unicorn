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
