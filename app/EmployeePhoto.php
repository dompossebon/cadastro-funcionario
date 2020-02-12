<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePhoto extends Model
{
    //
    protected $primaryKey = 'employee_id';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
