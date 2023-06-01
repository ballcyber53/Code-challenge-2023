<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = ['firstname', 'lastname', 'company_id', 'email', 'phone'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getEmployeesWithCompany()
    {
        return $this->with('company')->get();
    }
}
