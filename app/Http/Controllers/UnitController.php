<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
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
        $units = Unit::all();


        $data = [
            'units' => $units,

        ];


        return view('unit.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'data_type' => 'required',


        ]);

        Unit::create([
            'name' => $request['name'],
            'data_type' => $request['data_type'],

        ]);

        return redirect('/metrics/create')->with('success', 'Standard unit created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        $data = ['unit'=> $unit];

        return view('unit.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $data = ['unit'=> $unit];

        return view('unit.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'about' => $request['about'],
            'members' => $request['members'],
        ]);

        return redirect('/metrics/create')->with('success', 'Standard unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect('/metrics/create')->with('success', 'Standard unit deleted successfully');
    }
}
