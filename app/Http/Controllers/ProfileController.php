<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editProfile(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.editProfile', compact('employee','companies'));
    }

    public function updateProfile(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        $user = User::findOrFail($employee->user_id);
        if ($request->firstname || $request->lastname) {
            $user->name = $request->firstname . ' ' . $request->lastname;
        }
        if ($request->email) {
            $user->email = $request->email;
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Employee updated successfully.');
    }

    public function editAdminProfile($admin)
    {
        return view('admin.profile');
    }

    public function updateAdminProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }

    public function editPassword(Request $request)
    {
        return view('auth.change-password');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verify the current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Password updated successfully!');
    }
}
