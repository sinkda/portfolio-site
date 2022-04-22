@extends('admin')

@section('title', 'Projects')

@section('content')
<section class="flex flex-col md:flex-row w-full shadow-md rounded-xl bg-white p-8">
    <div class="w-full">
        <h2 class="text-xl font-bold mb-8">Projects</h2>

        @if(session('missing'))
            <div x-data="{showErrorMessage: true}" x-show="showErrorMessage" x-init="setInterval(() => showErrorMessage = false, 8000)" x-transition
                    class="relative flex flex-col rounded-xl w-full bg-red-200/75 p-6 mb-8 -mt-2 transition-all ease-out duration-200">
                <button x-on:click="showErrorMessage = false" class="absolute right-3 top-3 text-red-800 hover:text-red-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <h4 class="font-bold text-md text-red-800">Resource Error</h4>
                <p class="text-red-600">The project you tried to access does not exist. Try selecting a project from the table below.</p>
            </div>
        @endif

        @if(session('deleted'))
            <div x-data="{showDeleteMessage: true}" x-show="showDeleteMessage" x-init="setInterval(() => showDeleteMessage = false, 8000)" x-transition
                    class="relative flex flex-col rounded-xl w-full bg-red-200/75 p-6 mb-8 -mt-2 transition-all ease-out duration-200">
                <button x-on:click="showDeleteMessage = false" class="absolute right-3 top-3 text-green-800 hover:text-green-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <h4 class="font-bold text-md text-green-800">Project Deleted</h4>
                <p class="text-green-600">The Project <span class="font-semibold">[ {{ session('deleted') }} ]</span> has been successfully deleted.</p>
            </div>
        @endif

        <livewire:project-table />
    </div>
</section>
@endsection