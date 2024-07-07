<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LinkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'long_url'  => fake()->url,
            'short_url' => Str::random(7),
            'user_id'   => User::factory(),
        ];
    }
}
