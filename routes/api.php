<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KpiApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\UnitApiController;
use App\Http\Controllers\Api\AdminApiController;
use App\Http\Controllers\Api\MemberApiController;
use App\Http\Controllers\Api\MetricApiController;
use App\Http\Controllers\Api\CountryApiController;
use App\Http\Controllers\Api\PartnerApiController;
use App\Http\Controllers\Api\DepartmentApiController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('v1/partner-list',[PartnerApiController::class, 'index']);
Route::get('v1/partner-new',[PartnerApiController::class, 'latest']);
Route::post('v1/partner-create',[PartnerApiController::class, 'store']);
Route::patch('v1/partner-update',[PartnerApiController::class, 'update']);
Route::delete('v1/partner-delete/{id}',[PartnerApiController::class, 'destroy']);


Route::get('v1/department-list',[DepartmentApiController::class, 'index']);
Route::post('v1/department-create',[DepartmentApiController::class, 'store']);
Route::patch('v1/department-update',[DepartmentApiController::class, 'update']);
Route::delete('v1/department-delete',[DepartmentApiController::class, 'destroy']);


Route::get('v1/unit-list',[UnitApiController::class, 'index']);
Route::post('v1/unit-create',[UnitApiController::class, 'store']);
Route::patch('v1/unit-update',[UnitApiController::class, 'update']);
Route::delete('v1/unit-delete',[UnitApiController::class, 'destroy']);

Route::get('v1/metric-list',[MetricApiController::class, 'index']);
Route::post('v1/metric-create',[MetricApiController::class, 'store']);
Route::patch('v1/metric-update',[MetricApiController::class, 'update']);
Route::delete('v1/metric-delete',[MetricApiController::class, 'destroy']);

Route::get('v1/member-list',[MemberApiController::class, 'index']);
Route::post('v1/member-create',[MemberApiController::class, 'store']);
Route::patch('v1/member-update',[MemberApiController::class, 'update']);
Route::delete('v1/member-delete',[MemberApiController::class, 'destroy']);

Route::get('v1/kpi-list',[KpiApiController::class, 'index']);
Route::post('v1/kpi-create',[KpiApiController::class, 'store']);
Route::patch('v1/kpi-update',[KpiApiController::class, 'update']);
Route::delete('v1/kpi-delete',[KpiApiController::class, 'destroy']);

Route::get('v1/admin-list',[AdminApiController::class, 'index']);
Route::post('v1/admin-create',[AdminApiController::class, 'store']);
Route::patch('v1/admin-update',[AdminApiController::class, 'update']);
Route::delete('v1/admin-delete',[AdminApiController::class, 'destroy']);


Route::get('v1/country-list',[CountryApiController::class, 'index']);
Route::get('v1/role-list',[RoleApiController::class, 'index']);


