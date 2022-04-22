@extends('app')

@section('title', 'Contact Me')

@section('content')
{{-- About Section --}}
<section class="flex flex-col md:flex-row w-full shadow-md rounded-xl bg-white p-8">
    <div class="w-full">
        <form action="{{ route('message.store') }}" method="post">
            @csrf
            <div class="flex flex-col w-full space-y-6">
                <div>
                    <h2 class="text-xl font-bold">Contact Me</h2>
                </div>

                @if(session('success'))
                <div x-data="{showSuccessMessage: true}" x-show="showSuccessMessage" x-init="setInterval(() => showSuccessMessage = false, 8000)" x-transition
                     class="relative flex flex-col rounded-xl w-full bg-green-200/75 p-6">
                    <button x-on:click="showSuccessMessage = false" class="absolute right-3 top-3 text-green-800 hover:text-green-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <h4 class="font-bold text-md text-green-800">Message Sent!</h4>
                    <p class="text-green-600">Your message was successfully sent! Thanks for getting in touch with me. You should hear from me soon.</p>
                </div>
                @endif


                <div class="flex flex-col md:flex-row w-full md:space-x-6 space-y-6 md:space-y-0">
                    <div class="flex-grow flex flex-col">
                        <label for="name" class="text-sm tracking-wide text-gray-600">Name:</label>
                        <input type="text" name="name" placeholder="Enter your Name" value="{{ old('name') }}" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('name')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex-grow flex flex-col">
                        <label for="email" class="text-sm tracking-wide text-gray-600">E-Mail Address:</label>
                        <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('email')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="flex-grow flex flex-col">
                        <label for="subject" class="text-sm tracking-wide text-gray-600">Message Subject:</label>
                        <input type="text" name="subject" placeholder="Enter a Subject" value="{{ old('subject') }}" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400">
                        @error('subject')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="flex-grow flex flex-col">
                        <label for="message" class="text-sm tracking-wide text-gray-600">Message:</label>
                        <textarea name="message" placeholder="Enter a Message" required
                            class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 focus:outline-none focus:border-blue-400 h-32" >{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-sm text-red-300">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-col items-center">
                    <button type="submit" class="w-48 h-10 mb-6 text-white bg-blue-500 rounded-xl hover:bg-blue-600 transition duration-150 ease-in text-md focus:outline-none shadow-lg">Send Contact</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection