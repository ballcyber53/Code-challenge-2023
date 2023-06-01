<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];


    protected $fillable = ['firstname', 'lastname', 'user_id', 'company_id', 'email', 'phone'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getEmployeesWithCompany()
    {
        return $this->with('company')->get();
    }

    public function user() {
        return $this->belongsTo(User::class);
   }
}
