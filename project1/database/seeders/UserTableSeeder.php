<?php

namespace Database\Seeders;

use Faker\Provider\DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('users')->insert([
            [
                'name' => 'Nathan',
                'email' => Str::random(12).'@email.com',
                'password' => bcrypt('yourPassword'),
                'created_at' => Carbon::now(),
                'updated_at' => date("y-m-d H-i-s"),
            ],
            [
                'name' => 'David',
                'email' => Str::random(12).'@email.com',
                'password' => bcrypt('yourPassword'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Lisa',
                'email' => Str::random(12).'@email.com',
                'password' => bcrypt('yourPassword'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            ]);
    }
}
