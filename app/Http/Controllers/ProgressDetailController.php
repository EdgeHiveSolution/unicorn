<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Progress;


class ProgressDetailController extends Controller


{

    public function show($id)
    {
        // Retrieve the Progress resource with the given $id and return it
        $progress = Progress::find($id);
    
        if (!$progress) {
            // Handle the case where the Progress resource was not found
            abort(404);
        }
    
        return view('progress.index', [
            'progress' => $progress,
        ]);
    }
    

}
