<?php

namespace App\Http\Controllers\Util;

use App\Http\Controllers\Controller;
use App\Models\Metric;
use Illuminate\Http\Request;
use App\Models\Configuration;

class ConfigurationController extends Controller
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
        $metrics = Metric::latest()->cursorPaginate(3);


        $data = [
            'metrics' => $metrics,

        ];


        return view('configuration.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('configuration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',

        ]);

        Configuration::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'about' => $request['about'],
            'members' => $request['members'],
        ]);

        return redirect('/departments')->with('success', 'Department created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Configuration  $configuration
     *
     */
    public function show(Configuration $configuration)
    {
        $data = ['department'=> $configuration];

        return view('department.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Configuration  $configuration
     *
     */
    public function edit(Configuration $configuration)
    {
        $data = ['department'=> $configuration];

        return view('department.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configuration $configuration)
    {
        $configuration->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'about' => $request['about'],
            'members' => $request['members'],
        ]);

        return redirect('/departments')->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Configuration $configuration)
    {
        $configuration->delete();
        return redirect('/departments')->with('success', 'Department deleted successfully');
    }
}
