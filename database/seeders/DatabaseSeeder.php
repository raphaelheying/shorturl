<?php

namespace Database\Seeders;

use App\Models\{Link, User, Visit};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            $user = User::factory()->create([
                'name'     => 'Raphael Heying',
                'email'    => 'raphael.h@hotmail.com',
                'password' => Hash::make('password'),
            ]);

            $links = Link::factory()->count(rand(30, 50))->create([
                'user_id' => $user->id,
            ]);

            $links->each(function ($link) {
                Visit::factory()->count(rand(0, 100))->create([
                    'link_id' => $link->id,
                ]);
            });

        }

    }
}
