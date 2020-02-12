<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable= ['name', 'email', 'phone', 'updated_at', 'created_at'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function getPhoneAttribute($value)
    {
        return '('.substr($value, 0, 2).')'.substr($value, 2, 5).'-'.substr($value, 7, 4);
    }

    public function  employeephoto()
    {
        return $this->hasMany(EmployeePhoto::class, 'employee_id');
    }
}
