<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'username' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin'
            ],
            [
                'username' => 'leminh',
                'email' => 'leminh@gmail.com',
                'password' => bcrypt('leminh123'),
                'role' => 'user'
            ]
        ];
        DB::table('users')->insert($data);
    }
}
