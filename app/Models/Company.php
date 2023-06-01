<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['name', 'address', 'email', 'logo', 'website'];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getCompaniesWithEmployees()
    {
        return $this->with('employees')->get();
    }
}
