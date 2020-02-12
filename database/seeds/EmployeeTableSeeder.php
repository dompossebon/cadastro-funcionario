<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('employees')->insert([
            [
                'name' => 'ALEXANDRE POSSEBON',
                'email' => 'dompossebon@gmail.com',
                'phone' => '48998483347',
            ],
            [
                'name' => 'ANGELA MARIA',
                'email' => 'angela@gmail.com',
                'phone' => '48998483355',
            ],

        ]);
    }
}
