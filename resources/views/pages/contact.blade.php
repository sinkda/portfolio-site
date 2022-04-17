@extends('app')

@section('title', 'Contact Me')

@section('content')
{{-- About Section --}}
<section class="flex flex-col md:flex-row w-full shadow-md rounded-xl bg-white p-8">
    <div class="w-full">
        <form action="{{ route('contact.store') }}" method="post">
            @csrf
            <div class="flex flex-col w-full space-y-6">
                <div>
                    <h2 class="text-xl font-bold">Contact Me</h2>
                </div>

                <div class="flex flex-col md:flex-row w-full md:space-x-6 space-y-6 md:space-y-0">
                    <div class="flex-grow flex flex-col">
                        <label for="name" class="text-sm tracking-wide text-gray-600">Name:</label>
                        <input type="name" name="name" placeholder="Enter your Name" value="{{ old('name') }}" required
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
                        <input type="subject" name="subject" placeholder="Enter a Subject" value="{{ old('subject') }}" required
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