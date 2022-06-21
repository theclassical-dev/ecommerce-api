<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(1)->create();

        DB::table('users')->insert([
            'uuid' => Str::random(6),
            'firstName' => 'test',
            'lastName' => 'test',
            'userName' => 'test',
            'email'=>'test@gmail.com',
            'phone' => '00000',
            'Password' => bcrypt('test'),
            'updated_at'=>now('WAT'),
            'created_at'=>now('WAT'),
        ]);

        // DB::table('users')->insert([
        //     'firstName' =>  Str::random(10),
        //     'lastName' =>  Str::random(10),
        //     'userName' =>  Str::random(10),
        //     'email'=> Str::random(10).'@gmail.com',
        //     'phone' =>  Str::random(10),
        //     'Password' => bcrypt('test'),
        //     'updated_at'=>now('WAT'),
        //     'created_at'=>now('WAT'),
        // ]);

    }
}
