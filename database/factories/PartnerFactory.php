<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    protected $model = Partner::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'country_id' => 1, // Change this as needed
            'business_type' => $this->faker->word,
            'password' => bcrypt('password'), // Change this to your password hashing logic
            'about' => $this->faker->sentence,
            // ... other fields
        ];
    }
}
