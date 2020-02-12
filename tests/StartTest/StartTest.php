<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class StartTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testStartDb()
    {

        Artisan::call('db:seed');
//        Artisan::call('db:seed', [
//            '--class' => 'employee_photos'
//        ]);

        $this->assertDatabaseHas('employees', [
            'name' => 'ALEXANDRE POSSEBON'
        ]);

        $this->assertDatabaseHas('employees', [
            'name' => 'ANGELA MARIA'
        ]);


    }
}
