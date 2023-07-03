<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryApiController extends Controller
{
    public function index()
    {
        return Country::all();
    }
}
