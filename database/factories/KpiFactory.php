<?php
namespace Database\Factories;

use App\Models\Kpi;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class KpiFactory extends Factory
{
    protected $model = Kpi::class;

    public function definition()
    {
        $startDate = Carbon::now()->addDays($this->faker->numberBetween(1, 30));
        $endDate = $startDate->copy()->addMonth();
        $dateRange = $startDate->format('jS F Y') . ' to ' . $endDate->format('jS F Y');

        return [
            'title' => $this->faker->words(3, true),
            'partner_id' => PartnerFactory::new(),
            'review_period_range' => $dateRange,
        ];
    }
}
