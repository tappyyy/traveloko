<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CitySeeder::class,
            CategorySeeder::class,
            AccomodationSeeder::class,
            UserSeeder::class,
            RecommendationSeeder::class,
            RatingSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
