<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->insert([
            [
                'star' => 5,
                'accomodation_id' => 1,
                'user_id' => 4,
                'comment' => 'very good',
                'created_at' => '2023-07-04 00:00:00.000000',
            ],
            [
                'star' => 2,
                'accomodation_id' => 2,
                'user_id' => 4,
                'comment' => 'very bad',
                'created_at' => '2023-07-04 00:00:00.000000',
            ],
            [
                'star' => 4,
                'accomodation_id' => 3,
                'user_id' => 6,
                'comment' => 'good hospitality',
                'created_at' => '2023-07-04 00:00:00.000000',
            ],

            [
                'star' => 3,
                'accomodation_id' => 4,
                'user_id' => 8,
                'comment' => 'lumayan okee',
                'created_at' => '2023-07-04 00:00:00.000000',
            ],
            [
                'star' => 3,
                'accomodation_id' => 5,
                'user_id' => 7,
                'comment' => 'keren',
                'created_at' => '2023-07-04 00:00:00.000000',
            ],
            [
                'star' => 2,
                'accomodation_id' => 6,
                'user_id' => 8,
                'comment' => 'okee bang',
                'created_at' => '2023-07-04 00:00:00.000000',
            ],
            [
                'star' => 4,
                'accomodation_id' => 7,
                'user_id' => 4,
                'comment' => 'great experience',
                'created_at' => '2023-08-15 12:30:00.000000',
            ],
            [
                'star' => 5,
                'accomodation_id' => 12,
                'user_id' => 5,
                'comment' => 'fantastic view',
                'created_at' => '2023-08-16 10:45:00.000000',
            ],
            [
                'star' => 3,
                'accomodation_id' => 18,
                'user_id' => 7,
                'comment' => 'average stay',
                'created_at' => '2023-08-17 15:20:00.000000',
            ],
            [
                'star' => 5,
                'accomodation_id' => 23,
                'user_id' => 4,
                'comment' => 'excellent service',
                'created_at' => '2023-08-18 08:10:00.000000',
            ],
            [
                'star' => 4,
                'accomodation_id' => 29,
                'user_id' => 8,
                'comment' => 'lovely atmosphere',
                'created_at' => '2023-08-19 14:05:00.000000',
            ],
            [
                'star' => 2,
                'accomodation_id' => 5,
                'user_id' => 6,
                'comment' => 'disappointing',
                'created_at' => '2023-08-20 09:25:00.000000',
            ],
            [
                'star' => 4,
                'accomodation_id' => 14,
                'user_id' => 8,
                'comment' => 'pleasant stay',
                'created_at' => '2023-08-21 11:50:00.000000',
            ],
            [
                'star' => 3,
                'accomodation_id' => 21,
                'user_id' => 4,
                'comment' => 'could be better',
                'created_at' => '2023-08-22 13:15:00.000000',
            ],
            [
                'star' => 5,
                'accomodation_id' => 28,
                'user_id' => 5,
                'comment' => 'amazing stay',
                'created_at' => '2023-08-23 16:40:00.000000',
            ],
            [
                'star' => 4,
                'accomodation_id' => 6,
                'user_id' => 6,
                'comment' => 'comfortable rooms',
                'created_at' => '2023-08-24 17:55:00.000000',
            ],
            [
                'star' => 4,
                'accomodation_id' => 1,
                'user_id' => 8,
                'comment' => 'comfortable rooms',
                'created_at' => '2023-08-24 17:55:00.000000',
            ],
        ]);
    }
}