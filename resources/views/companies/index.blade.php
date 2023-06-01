<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Companies
                    <a href="{{ route('companies.create') }}" class="btn btn-primary">Create Company</a>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <td>{{ $loop->index + $companies->firstItem() }}</td>
                                    <td>
                                        <a href="{{ route('companies.show', $company->id) }}">
                                            <strong>{{ $company->name }}</strong>
                                        </a>
                                    </td>
                                    <td>{{ $company->address }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->website }}</td>
                                    <td>
                                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">
                                            Edit
                                        </a>
                                        <a href="{{ route('companies.destroy', $company->id) }}"
                                            class="btn btn-danger delete-button"
                                            data-company-id="{{ $company->id }}">Delete</a>
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
                <div class="d-flex justify-content-center">
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).attr('href');
            var companyId = $(this).data('company-id');

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
                            company_id: companyId
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
