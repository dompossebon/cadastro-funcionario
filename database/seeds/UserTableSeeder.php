<?php

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
        //
        DB::table('users')->insert([
            [
                'name' => 'Possebon',
                'email' => 'dompossebon@gmail.com',
                'password' => bcrypt('88888888'),
            ],
            [
                'name' => 'Angela',
                'email' => 'angela@gmail.com',
                'password' => bcrypt('88888888'),
            ],

        ]);
    }
}
