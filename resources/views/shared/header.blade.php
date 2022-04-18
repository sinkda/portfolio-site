<nav x-data="{ mobileNavOpen: false }" class="flex flex-wrap md:flex-nowrap justify-around py-4 bg-white shadow-md w-full fixed top-0 left-0 right-0 z-10">

    <div class="flex items-center">
        <a class="cursor-pointer" href="{{ route('home') }}">
            <img class="h-10 object-cover" src="https://stackoverflow.design/assets/img/logos/so/logo-stackoverflow.svg" alt="Store Logo">
        </a>
    </div>

    <div class="flex md:hidden items-center" x-on:click="mobileNavOpen = !mobileNavOpen" x-on:click.away="mobileNavOpen = false">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </div>

    <div class="hidden ml-7 md:ml-0 mt-6 md:mt-0 md:flex w-full md:w-fit items-center space-y-2 md:space-y-0 md:space-x-6" x-bind:class="{'hidden': !mobileNavOpen}">
        <x-nav-link :href="route('home')" controller="HomeController">Home</x-nav-link>
        <x-nav-link :href="route('home')" controller="PortfolioController">Portfolio</x-nav-link>
      {{--  <x-nav-link :href="route('home')" controller="PostController">Blog</x-nav-link> --}}
        <x-nav-link :href="route('message.index')" controller="MessageController">Contact Me</x-nav-link> 
    </div>
</nav>