<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'name' => 'Jakarta',
                'country' => 'Indonesia',
                'province' => 'DKI Jakarta'
            ],
            [
                'name' => 'Bogor',
                'country' => 'Indonesia',
                'province' => 'Jawa Barat'
            ],
            [
                'name' => 'Bandung',
                'country' => 'Indonesia',
                'province' => 'Jawa Barat'
            ],
            [
                'name' => 'Yogyakarta',
                'country' => 'Indonesia',
                'province' => 'DI Yogyakarta'
            ],
            [
                'name' => 'Denpasar',
                'country' => 'Indonesia',
                'province' => 'Bali'
            ],
        ]);
    }
}