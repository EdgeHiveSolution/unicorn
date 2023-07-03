<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleApiController extends Controller
{
    public function index()
    {
        return Role::all();
    }
}
