<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KpiApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\UnitApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\MemberApiController;
use App\Http\Controllers\Api\MetricApiController;
use App\Http\Controllers\Api\CountryApiController;
use App\Http\Controllers\Api\PartnerApiController;
use App\Http\Controllers\Api\DepartmentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/partner-list',[PartnerApiController::class, 'index']);
Route::post('v1/partner-create',[PartnerApiController::class, 'store']);


Route::get('v1/department-list',[DepartmentApiController::class, 'index']);
Route::post('v1/department-create',[DepartmentApiController::class, 'store']);


Route::get('v1/unit-list',[UnitApiController::class, 'index']);
Route::post('v1/unit-create',[UnitApiController::class, 'store']);

Route::get('v1/metric-list',[MetricApiController::class, 'index']);
Route::post('v1/metric-create',[MetricApiController::class, 'store']);

Route::get('v1/member-list',[MemberApiController::class, 'index']);
Route::post('v1/member-create',[MemberApiController::class, 'store']);

Route::get('v1/kpi-list',[KpiApiController::class, 'index']);
Route::post('v1/kpi-create',[KpiApiController::class, 'store']);

Route::get('v1/user-list',[UserApiController::class, 'index']);
Route::get('v1/country-list',[CountryApiController::class, 'index']);
Route::get('v1/role-list',[RoleApiController::class, 'index']);


