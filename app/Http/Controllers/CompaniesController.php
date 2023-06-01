<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use App\Mail\CompanyCreated;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CreateCompanyRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos', 'public');

            $validatedData['logo'] = $logoPath;
        }

        $company = Company::create($validatedData);

        // Rest of your logic to save the company
        Mail::to($request->email)->send(new CompanyCreated($company));
        Alert::success('Action successful!', 'Your message here');

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        $company_employee = Company::with('employees')->findOrFail($company->id);
        return view('companies.show', compact('company','company_employee'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($company->logo);
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos', 'public');

            $validatedData['logo'] = $logoPath;
        }

        $company->update($validatedData);

        // Rest of your logic to update the company


        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }


    public function destroy(Company $company)
    {

        $company = Company::findOrFail($company->id);

        // Delete File
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted successfully.']);
    }
}
