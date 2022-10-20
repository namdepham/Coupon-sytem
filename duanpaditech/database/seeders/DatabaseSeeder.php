<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Admin 1',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('admin123'),
                'image' => 'https://via.placeholder.com/640x480.png/0011bb?text=dolorem',
            ]
        ]);
    }
}
