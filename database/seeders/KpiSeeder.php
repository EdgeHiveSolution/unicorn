<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kpi;
use App\Models\Partner;

class KpiSeeder extends Seeder
{
    public function run(): void
    {
        $partners = Partner::all();

        foreach ($partners as $partner) {
            $partner->kpis()->saveMany(Kpi::factory(5)->make());
        }
    }
}