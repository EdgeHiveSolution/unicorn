<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KpiMetric;
use App\Models\Kpi;

class KpiMetricsSeeder extends Seeder
{ public function run(): void
    {
        $kpis = Kpi::all();

        foreach ($kpis as $kpi) {
            $kpi->kpiMetrics()->saveMany(KpiMetric::factory(2)->make());
        }
    }
}