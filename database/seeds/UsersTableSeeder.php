<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'masaakisaeki@gmail.com',
            'password' => bcrypt('hogehoge'),
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        for($i = 0; $i < 100; $i++) {
            DB::table('users')->insert([
                'name' => 'shop'. strval($i),
                'email' => 'test'. strval($i). '@test.com',
                'password' => bcrypt('hogehoge'),
                'remember_token' => Str::random(10),
                'email_verified_at' => now(),
                'role' => 'shop',
            ]);
        }
    }
}
