<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Employee\CreateEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    public function store(CreateEmployeeRequest $request)
    {
        $employee = new Employee($request->validated());
        $employee->save();

        $user = new User();
        $user->name = $employee->firstname .' '. $employee->lastname;
        $user->email = $employee->email;
        $user->password = Hash::make(Str::random(8));
        if($user->save())
        {
            $employee->user_id = $user->id;
            $employee->update();
        }


        $response = Password::sendResetLink($request->only('email'));

        if ($response === Password::RESET_LINK_SENT) {
            return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully. Reset password link sent to employee email.');
        } else {
            return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function show(Employee $employee)
    {
        $employee->load('company');

        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee','companies'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route('employees.index', $employee->id)->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $user = User::findOrFail($employee->user_id);
        $user->delete();

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully.']);
    }
}
