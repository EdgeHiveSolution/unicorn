<?php

namespace App\Http\Controllers;


use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $departments = Department::latest()->cursorPaginate(5);


        $data = [
            'departments' => $departments,

        ];


        return view('department.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'about' => 'required',

        ]);

        Department::create([
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
     * @param  \App\Models\Department  $department
     *
     */
    public function show(Department $department)
    {
        $data = ['department'=> $department];

        return view('department.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     *
     */
    public function edit(Department $department)
    {
        $data = ['department'=> $department];

        return view('department.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     *
     */
    public function update(Request $request, Department $department)
    {
        $department->update([
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
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {

        $department->delete();
        return redirect('/departments')->with('success', 'Department deleted successfully');

    }
}
