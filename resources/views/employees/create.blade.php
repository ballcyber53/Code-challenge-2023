<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Create Employee
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="container">
                    <form action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        <div class="mb-3 mt-3">
                            <label for="first_name">First name</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="last_name">Last name</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="form-control" required>
                                <option value="">Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" maxlength="10" minlength="10" name="phone" id="phone"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Create</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancel</a>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
