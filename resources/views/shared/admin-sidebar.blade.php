<nav class="absolute lg:relative lg:transform-none lg:opacity-100 z-10 w-64 h-screen text-white bg-gray-800 p-3 transform duration-200 ease-in-out"
    :class="{'translate-x-0': sidebarOpen, '-translate-x-full opacity-0': !sidebarOpen}">
    <div class="flex justify-between items-center">
        <a class="font-bold text-lg sm:text-xl p-2" href="{{ route('home') }}">
            {{ config('app.name') }}
        </a>
        <a class="p-4 hover:bg-indigo-800 hover:text-white rounded-md lg:hidden" href="#" x-on:click.prvent="sidebarOpen = false">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>

    <div class="mt-8">
        <a href="{{ route('admin.index') }}" class="flex items-center w-full p-4 hover:bg-indigo-800 rounded-md">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
            </svg>
            <span class="ml-4">Home</span>
        </a>

        <a href="{{ route('admin.index') }}" class="flex items-center w-full p-4 hover:bg-indigo-800 rounded-md">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path>
            </svg>
            <span class="ml-4">Projects</span>
        </a>

        <a href="{{ route('admin.messages.list') }}" class="flex items-center w-full p-4 hover:bg-indigo-800 rounded-md">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
            </svg>
            <span class="ml-4">Messages</span>
            @if($unread > 0)
                <span class="bg-purple-600 rounded-xl w-6 h-6 text-center ml-3">{{ $unread }}</span>
            @endif
        </a>
    </div>
</nav>
