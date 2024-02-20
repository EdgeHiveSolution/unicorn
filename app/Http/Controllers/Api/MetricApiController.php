<?php

namespace App\Http\Controllers\Api;

use App\Models\Metric;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Task;

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


        Log::info("the message for create log: ".$request);
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

        Log::info("the message for log: ".$request->name);
        /**$this->validate($request,[
            'name' => 'required|string',
            "unit" => 'required|string'
        ]);
**/
        $formData = $request->input();
        
      //  Log::info("the message for log: ".json_encode($formData));
        // Update the metric
        /**$metric->update([
            'name' => $request->name,
            'unit' => $request->unit,

        ]);**/

        $metric->find($request->id)->update([
           // 'completed' => $request->has('completed')
           'name' => $request->name,
            'unit' => $request->unit,
        ]);


        
        return response()->json(['success' => 'Metric updated successfully']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        // Find the metric by its ID
        $metric = Metric::find($request->id);

        if (!$metric) {
            return response()->json(['error' => 'Metric not found'], 404);
        }

        // Delete the metric
        $metric->delete();

        return response()->json(['success' => 'Metric deleted successfully']);
    }
}
