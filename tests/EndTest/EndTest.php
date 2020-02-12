<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EndTest extends TestCase
{
    public function testEndDb()
    {
        Artisan::call('migrate:fresh');

        $this->assertDatabaseMissing('employees', [
            'name' => 'Abelhinha'
        ]);

        $this->assertDatabaseMissing('employees', [
            'name' => 'Abelhinhax'
        ]);


    }
}
