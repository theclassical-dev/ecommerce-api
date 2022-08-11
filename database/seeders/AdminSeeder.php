<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
