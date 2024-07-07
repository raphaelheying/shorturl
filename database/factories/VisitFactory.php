<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'link_id'     => Link::factory(),
            'ip_address'  => fake()->ipv4,
            'browser'     => fake()->word,
            'platform'    => fake()->word,
            'device'      => fake()->word,
            'device_type' => fake()->word,
            'agent'       => fake()->word,
        ];
    }
}
