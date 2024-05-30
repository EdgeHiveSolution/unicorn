<?php
namespace Database\Factories;

use App\Models\KpiMetric;
use Illuminate\Database\Eloquent\Factories\Factory;

class KpiMetricFactory extends Factory
{
    protected $model = KpiMetric::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'type' => $this->faker->randomElement(['count', 'currency', 'time']),
            'response_period' => $this->faker->randomElement(['weekly', 'monthly', 'quarterly']),
            'target' => $this->faker->numberBetween(100000, 500000),
            'on_track_value' => $this->faker->numberBetween(60, 100),
            'off_track_min' => 0,
            'off_track_max' => $this->faker->numberBetween(20, 40),
            'at_risk_min' => $this->faker->numberBetween(41, 59),
            'at_risk_max' => $this->faker->numberBetween(59, 80),
        ];
    }
}
