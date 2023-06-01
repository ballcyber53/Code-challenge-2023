<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Employees
                    <a href="{{ route('employees.create') }}" class="btn btn-primary">Create Employee</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>{{ $loop->index + $employees->firstItem() }}</td>
                                    <td>
                                        <a href="{{ route('employees.show', $employee->id) }}">
                                            <strong>
                                                {{ ($employee->firstname ?? '') . ' ' . ($employee->lastname ?? '') }}
                                            </strong>
                                        </a>
                                    </td>
                                    <td>{{ $employee->email ?? '' }}</td>
                                    <td>{{ $employee->phone ?? '' }}</td>
                                    <td>{{ $employee->company->name ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <a href="{{ route('employees.destroy', $employee->id) }}"
                                            class="btn btn-danger delete-button"
                                            data-employee-id="{{ $employee->id }}">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center">No data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $employees->links() }}

            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            var employeeId = $(this).data('employee-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this record!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to deleteUrl
                    $.ajax({
                        url: deleteUrl,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            _token: '{{ csrf_token() }}',
                            employee_id: employeeId
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response
                            Swal.fire('Error!', 'An error occurred while deleting the record.',
                                'error');
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
