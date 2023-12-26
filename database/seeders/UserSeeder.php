<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'role' => 'OTA',
                'name' => 'Yelan Lee',
                'ota_name' => 'Yelan',
                'email' => 'Yelan@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '123894728934',
                'balance' => 0,
            ],
            [
                'role' => 'ADMIN',
                'name' => 'Pansong',
                'ota_name' => NULL,
                'email' => 'Pansong@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '123894728123',
                'balance' => 0,
            ],
            [
                'role' => 'OTA',
                'name' => 'Nupilet Kim',
                'ota_name' => 'Nupilet',
                'email' => 'nupilet@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '123894728934',
                'balance' => 0,
            ],
            [
                'role' => 'USER',
                'name' => 'Cromboloni',
                'ota_name' => NULL,
                'email' => 'cromboloni@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '1232222224',
                'balance' => 0,
            ],
            [
                'role' => 'USER',
                'name' => 'Pepo',
                'ota_name' => NULL,
                'email' => 'pepo@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '1230298224',
                'balance' => 0,
            ],
            [
                'role' => 'USER',
                'name' => 'Windah',
                'ota_name' => NULL,
                'email' => 'windah@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '1232297200',
                'balance' => 0,
            ],
            [
                'role' => 'USER',
                'name' => 'Penpen',
                'ota_name' => NULL,
                'email' => 'penpen@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '1872297200',
                'balance' => 0,
            ],
            [
                'role' => 'USER',
                'name' => 'Cicik',
                'ota_name' => NULL,
                'email' => 'cicik@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '9836297200',
                'balance' => 0,
            ],
            [
                'role' => 'OTA',
                'name' => 'Purina Jang',
                'ota_name' => 'Purina',
                'email' => 'Purina@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '1238908928934',
                'balance' => 0,
            ],
            [
                'role' => 'OTA',
                'name' => 'Jeksen Wang',
                'ota_name' => 'Jeksen',
                'email' => 'Jeksen@gmail.com',
                'password' => Hash::make('oke'),
                'phone_number' => '1236524728934',
                'balance' => 0,
            ],
        ]);
    }
}