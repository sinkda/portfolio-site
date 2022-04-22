<header class="bg-gray-700 text-white flex items-center justify-between">
    <div class="flex items-center p-2">
        <div class="flex ml-3 h-10">
            <a class="p-3 hover:bg-indigo-500 rounded-md lg:hidden" href="#" x-on:click.prevent="sidebarOpen = true">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>

    <div class="mr-6 relative" x-data="{accountShow: false}">
        <button type="button" x-on:click="accountShow = !accountShow"
                class="text-white bg-purple-600 hover:bg-purple-800 focus:outline-none font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center"> 
            <span>Account</span>
            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="accountShow" x-on:click.away="accountShow = false" class="absolute right-0 z-10 w-44 shadow-md" x-cloak>
            <ul class="py-1 text-sm text-gray-700">
                <li>
                    <a href="{{ route('admin.profile.show') }}" class="block py-2 px-4 bg-gray-600 hover:bg-indigo-800 text-white">Profile</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="w-full py-2 px-4 bg-gray-600 hover:bg-indigo-800 text-white text-left">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</header>