@extends('admin')

@section('title')
Profile For: {{ $user->name }}
@endsection

@section('content')
<section class="flex flex-col md:flex-row w-full shadow-md rounded-xl bg-white p-8">
    <div class="w-full">
        <form action="{{ route('admin.profile.update') }}" method="post">
            @csrf
            @method('put')

            <div class="flex flex-col w-full space-y-6">
                <div>
                    <h2 class="text-xl font-bold">Profile for {{ $user->name }}</h2>
                </div>

                @if(session('success'))
                <div x-data="{showSuccessMessage: true}" x-show="showSuccessMessage" x-init="setInterval(() => showSuccessMessage = false, 8000)" x-transition
                     class="relative flex flex-col rounded-xl w-full bg-green-200/75 p-6">
                    <button x-on:click="showSuccessMessage = false" class="absolute right-3 top-3 text-green-800 hover:text-green-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <h4 class="font-bold text-md text-green-800">Profile Updated!</h4>
                    <p class="text-green-600">Your profile was successfully updated!</p>
                </div>
                @endif

                <div>
                    <p class="text-gray-700 text-md">
                        To change your password below, first enter in your current password. Then enter and confirm your new password. Note, the password must meet the following criteria:
                    </p>
                    <ul class="mt-4 list-disc md:ml-10 text-md">
                        <li>Must be at least 10 characters long</li>
                        <li>Must contain at least one lowercase character</li>
                        <li>Must contain at least one uppercase character</li>
                        <li>Must contain at least one number</li>
                        <li>Must contain at least one symbol</li>
                    </ul>
                </div>

                <div>
                    <div class="flex-grow flex flex-col">
                        <label for="name" class="text-sm tracking-wide text-gray-600">Your Name:</label>
                        <input type="text" name="name" placeholder="Your Name" value="{{ old('name', $user)}}" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('name')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex-grow flex flex-col">
                        <label for="email" class="text-sm tracking-wide text-gray-600">Your Email Address:</label>
                        <input type="email" name="email" placeholder="Your Email Address" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('email')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex-grow flex flex-col">
                        <label for="current_password" class="text-sm tracking-wide text-gray-600">Current Password:</label>
                        <input type="password" name="current_password" placeholder="Your Current Password" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('current_password')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex-grow flex flex-col">
                        <label for="new_password" class="text-sm tracking-wide text-gray-600">New Password:</label>
                        <input type="password" name="new_password" placeholder="New Password Password" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('new_password')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="flex-grow flex flex-col">
                        <label for="new_password_confirmation" class="text-sm tracking-wide text-gray-600">Confirm your New Password:</label>
                        <input type="password" name="new_password_confirmation" placeholder="Confirm your New Password" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('new_password_confirmation')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                <div class="flex justify-end mt-4">
                    <button type="submit" class="w-48 h-10 mb-6 text-white bg-blue-500 rounded-xl hover:bg-blue-600 transition duration-150 ease-in text-md focus:outline-none shadow-lg">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection