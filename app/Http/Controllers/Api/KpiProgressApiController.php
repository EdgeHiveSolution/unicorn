<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpiProgressApiController extends Controller
{


    public function getOverallProgress(Request $request)

   {
    $progressData = DB::table('kpis')
        ->join('kpi_metrics', 'kpis.id', '=', 'kpi_metrics.kpi_id')
        ->join('kpi_metric_members', 'kpi_metrics.id', '=', 'kpi_metric_members.kpi_metric_id')
        ->join('progress', 'kpi_metric_members.id', '=', 'progress.kpi_metric_member_id')
        ->select(
            'kpis.id as kpi_id',
            'kpis.title as title',
            'kpis.review_period_range as review_period_range',
            DB::raw('SUM(progress.current_value) as current_value'),
            DB::raw('SUM(kpi_metric_members.target) as target')
        )
        ->groupBy('kpi_id', 'title', 'review_period_range')
        ->get();

    // Calculate progress percentage for each KPI
    $progressData->transform(function ($kpi) {
        $progressPercentage = ($kpi->current_value / $kpi->target) * 100;
        $kpi->progress_percentage = $progressPercentage;
        return $kpi;
    });

    return response()->json(['overall_progress' => $progressData]);
}


}

//     public function getOverallProgress(Request $request)
// {
   
//     $progressData = DB::table('kpis')
//         ->join('kpi_metrics', 'kpis.id', '=', 'kpi_metrics.kpi_id')
//         ->join('kpi_metric_members', 'kpi_metrics.id', '=', 'kpi_metric_members.kpi_metric_id')
//         ->join('progress', 'kpi_metric_members.id', '=', 'progress.kpi_metric_member_id')
//         ->select(
//             'kpis.id as kpi_id',
//             'kpis.title as title',
//             DB::raw('SUM(progress.current_value) as current_value'),
//             DB::raw('SUM(kpi_metric_members.target) as target')
//         )
//         ->groupBy('kpi_id', 'title')
//         ->get();

//     // Calculate progress percentage for each KPI
//     $progressData->transform(function ($kpi) {
//         $progressPercentage = ($kpi->current_value / $kpi->target) * 100;
//         $kpi->progress_percentage = $progressPercentage;
//         return $kpi;
//     });

//     // Extract labels based on review_period_range
//     foreach ($progressData as $item) {
//         $item->label = $this->generateLabel($item->kpi->review_period_range);
//     }

//     return response()->json(['overall_progress' => $progressData]);
// }

// private function generateLabel($reviewPeriodRange)

// {
//    // Extract start and end dates from review_period_range
//    $pattern = '/(\d{1,2})\w{2} (\w+) (\d{4})/';
//    preg_match_all($pattern, $reviewPeriodRange, $matches);

//    // Parse start date components
//    $startMonth = $matches[2][0];

//    // Generate labels based on the review period (e.g., month or year)
//    if (strpos($reviewPeriodRange, 'year') !== false) {
//        $startYear = $matches[3][0];
//        $endYear = $matches[3][1];
//        $labels = [];
//        $currentYear = $startYear;

//        while ($currentYear <= $endYear) {
//            $labels[] = Carbon::parse("1 $startMonth $currentYear")->format('M');
//            $currentYear++;
//        }

//        return $labels;
//    } elseif (strpos($reviewPeriodRange, 'month') !== false) {
//        $startDay = $matches[1][0];
//        $endDay = $matches[1][1];
//        $labels = [];
//        $currentDay = $startDay;

//        while ($currentDay <= $endDay) {
//            $labels[] = Carbon::parse("$currentDay $startMonth")->format('D');
//            $currentDay++;
//        }

//        return $labels;
//    }

//    return [];
// }



// }
