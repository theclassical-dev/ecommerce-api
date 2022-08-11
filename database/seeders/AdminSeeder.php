<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'uuid' => 'ADF1B3',
            'name' => 'admin',
            'email'=>'admin@gmail.com',
            'Password' => bcrypt('test'),
        ]);
    }
}
