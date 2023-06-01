<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="containert py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Company Details
                </div>
                <div class="container">

                    <div class="card">
                        <div class="card-header">
                            <h5>Company : {{ $company->name }}</h5>
                        </div>
                        <div class="card-body">
                            @if ($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="100">
                            @else
                                <p>No logo available</p>
                            @endif
                            <br>
                            <h6>Employees:</h6>
                            <div class="table-responsive">
                                <table id="employees-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Full name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($company_employee->employees as $employee)
                                            <tr>
                                                <td>{{ $employee->firstname . ' ' . $employee->lastname }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>{{ $employee->phone }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" style="text-align: center">No employees</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
