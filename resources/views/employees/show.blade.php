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
                    Employee Details
                </div>
                <div class="container">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $employee->company->logo) }}"
                                        alt="{{ $employee->company->name }} Logo" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title h2">{{ $employee->firstname . ' ' . $employee->lastname }}
                                    </h5>
                                    <p class="card-text">
                                        <strong>Company:</strong> {{ $employee->company->name }}
                                    </p>
                                    <p class="card-text">
                                        <strong>Email:</strong> {{ $employee->email }}
                                    </p>
                                    <p class="card-text">
                                        <strong>Phone:</strong> {{ $employee->phone }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
