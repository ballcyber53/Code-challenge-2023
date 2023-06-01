<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Edit Profile
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

                    <form method="POST" action="{{ route('profile.updatePassword', Auth::id()) }}">
                        @csrf
                        @method('PUT')

                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" id="current_password" required>

                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" required>

                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>

                        <button type="submit">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
s
