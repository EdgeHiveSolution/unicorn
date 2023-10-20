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
use App\Http\Controllers\Api\KpiMetricApiController;
use App\Http\Controllers\Api\DepartmentApiController;
use App\Http\Controllers\Api\ProgressApiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\KpiProgressApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\ProgressChatApiController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthApiController::class, 'login']);

Route::get('v1/partner-list',[PartnerApiController::class, 'index']);
Route::get('v1/partner-new',[PartnerApiController::class, 'latest']);
Route::post('v1/partner-create',[PartnerApiController::class, 'store']);
Route::get('v1/partners/{partnerId}/kpis-and-metrics', [PartnerApiController::class, 'getKpiAndKpiMetricsAndProgressForPartner']);
Route::patch('v1/partner-update/{id}',[PartnerApiController::class, 'update']);
Route::delete('v1/partner-delete/{id}',[PartnerApiController::class, 'destroy']);
Route::get('v1/partner-members/{partnerId}', [PartnerApiController::class, 'fetchPartnerMembers']);



Route::get('v1/department-list',[DepartmentApiController::class, 'index']);
Route::post('v1/department-create',[DepartmentApiController::class, 'store']);
Route::patch('v1/department-update/{id}', [DepartmentApiController::class, 'update']);
Route::delete('v1/department-delete/{id}',[DepartmentApiController::class, 'destroy']);

Route::get('v1/department-members/{departmentId}', [DepartmentApiController::class, 'fetchDepartmentMembers']);



Route::get('v1/standardUnit-list',[UnitApiController::class, 'index']);
Route::post('v1/standardUnit-create',[UnitApiController::class, 'store']);
Route::patch('v1/unit-update',[UnitApiController::class, 'update']);

Route::delete('v1/metric-delete', [MetricApiController::class, 'destroy']);

Route::post('v1/progress', [ProgressApiController::class, 'store']);
// Route::get('v1/kpimetrics/{kpimetricId}/progress/{kpiMetricMemberId}', [ProgressApiController::class, 'getProgressForKpiMetric']);
Route::get('v1/kpimetrics/{kpimetricId}/progress/{memberId}', [ProgressApiController::class, 'getProgressForKpiMetric']);

Route::get('v1/kpimetrics/{kpimetricId}/progress', [ProgressApiController::class, 'getKpiMetricProgressDetail']);

Route::get('v1/progress/{progressId}', [ProgressApiController::class, 'getProgressDetail']);


Route::get('v1/metric-list',[MetricApiController::class, 'index']);
Route::post('v1/metric-create',[MetricApiController::class, 'store']);
Route::patch('v1/metric-update',[MetricApiController::class, 'update']);
Route::delete('v1/metric-delete',[MetricApiController::class, 'destroy']);

Route::get('v1/member-list',[MemberApiController::class, 'index']);
//Route::get('v1/members/{id}', [MemberApiController::class, 'show']);
Route::get('v1/members/{memberId}/kpis-and-metrics', [MemberApiController::class, 'getKpisAndMetricsForMember']);
Route::post('v1/member-create',[MemberApiController::class, 'store']);
Route::patch('v1/member-update',[MemberApiController::class, 'update']);
Route::delete('v1/member-delete',[MemberApiController::class, 'destroy']);
Route::get('v1/member-progress-records/{memberId}', [MemberApiController::class, 'removeMemberFromList']);
Route::delete('v1/remove-member/{id}', [MemberApiController::class, 'removeMember']);

Route::get('v1/members/{partnerId}', [MemberApiController::class, 'getMembersByPartner']);




Route::get('v1/kpi-list',[KpiApiController::class, 'index']);
Route::post('v1/kpi-create',[KpiApiController::class, 'store']);
Route::patch('v1/kpi-update',[KpiApiController::class, 'update']);
Route::delete('v1/kpi-delete',[KpiApiController::class, 'destroy']);

Route::get('v1/kpiMetric-list',[KpiMetricApiController::class, 'index']);
Route::post('v1/kpiMetric-create',[KpiMetricApiController::class, 'store']);
Route::patch('v1/kpiMetric-update',[KpiMetricApiController::class, 'update']);
Route::delete('v1/kpiMetric-delete',[KpiMetricApiController::class, 'destroy']);

Route::get('v1/kpi-metrics/{metricId}', [KpiMetricApiController::class, 'getKpiMetricsByMetricId']);

Route::get('v1/admin-list',[AdminApiController::class, 'index']);
Route::post('v1/admin-create',[AdminApiController::class, 'store']);
Route::patch('v1/admin-update',[AdminApiController::class, 'update']);
Route::delete('v1/admin-delete',[AdminApiController::class, 'destroy']);


Route::get('v1/country-list',[CountryApiController::class, 'index']);
Route::get('v1/role-list',[RoleApiController::class, 'index']);

Route::get('v1/user', [UserController::class, 'getUserWithRelatedData']);
Route::get('v1/users/{user}', [UserController::class, 'show']);

Route::get('v1/kpi-progress/{partnerId}', [KpiProgressApiController::class, 'getOverallProgress']);



Route::put('v1/profile/{id}', [ProfileApiController::class, 'updateProfile']);

// Create a new progress chat message
Route::post('v1/progress-chats', [ProgressChatApiController::class, 'store']);

Route::get('v1/progress-chats/{progress}', [ProgressChatApiController::class, 'getComments']);


// Update a progress chat message
Route::put('/progress-chats/{progressChat}', [ProgressChatApiController::class, 'update']);

Route::delete('/progress-chats/{progressChat}', [ProgressChatApiController::class, 'destroy']);

Route::get('v1/progress-chats/{progress}', [ProgressChatApiController::class, 'index']);




