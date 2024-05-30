<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KpiProgressApiController extends Controller
{



    public function getOverallProgress(Request $request, $partnerId)
    {
        // Modify the query to include joins and aggregate data
        $progressData = DB::table('kpis')
            ->join('kpi_metrics', 'kpis.id', '=', 'kpi_metrics.kpi_id')
            ->join('kpi_metric_members', 'kpi_metrics.id', '=', 'kpi_metric_members.kpi_metric_id')
            ->join('progress', 'kpi_metric_members.id', '=', 'progress.kpi_metric_member_id')
            ->where('kpis.partner_id', $partnerId) // Filter progress for a specific partner
            ->select(
                DB::raw('EXTRACT(MONTH FROM progress.created_at) as month'),
                DB::raw('SUM(progress.current_value) as current_value'),
                DB::raw('SUM(DISTINCT kpi_metrics.target) as target_value'),
                DB::raw('MAX(kpi_metrics.on_track_value) as on_track_value'),
                DB::raw('MIN(kpi_metrics.off_track_min) as off_track_min'),
                DB::raw('MAX(kpi_metrics.off_track_max) as off_track_max'),
                DB::raw('MIN(kpi_metrics.at_risk_min) as at_risk_min'),
                DB::raw('MAX(kpi_metrics.at_risk_max) as at_risk_max'),
                DB::raw('DAY(progress.created_at) as day'),
                DB::raw('MONTH(progress.created_at) as month_created'),
                DB::raw('YEAR(progress.created_at) as year_created')

            )
            ->groupBy('month', 'day', 'month_created', 'year_created')
            ->get();

        // Calculate progress percentage for each month
        $progressData->transform(function ($monthData) {
            $progressPercentage = ($monthData->current_value / $monthData->target_value) * 100;
            $monthData->progress_percentage = $progressPercentage;
            return $monthData;
        });

        return response()->json(['overall_progress' => $progressData]);
    }
//     public function getOverallProgress(Request $request)
// {
//     // Modify the query to include joins and aggregate data
//     $progressData = DB::table('kpis')
//         ->join('kpi_metrics', 'kpis.id', '=', 'kpi_metrics.kpi_id')
//         ->join('kpi_metric_members', 'kpi_metrics.id', '=', 'kpi_metric_members.kpi_metric_id')
//         ->join('progress', 'kpi_metric_members.id', '=', 'progress.kpi_metric_member_id')
//         ->select(
//             DB::raw('EXTRACT(MONTH FROM progress.created_at) as month'),
//             DB::raw('SUM(progress.current_value) as current_value'),
//             DB::raw('SUM(kpi_metric_members.target) as target_value')
//         )
//         ->groupBy('month')
//         ->get();

//     // Calculate progress percentage for each month
//     $progressData->transform(function ($monthData) {
//         $progressPercentage = ($monthData->current_value / $monthData->target_value) * 100;
//         $monthData->progress_percentage = $progressPercentage;
//         return $monthData;
//     });

//     return response()->json(['overall_progress' => $progressData]);
// }


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
