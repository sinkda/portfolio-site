<nav class="flex justify-around py-4 bg-white/80
            backdrop-blur-md shadow-md w-full
            fixed top-0 left-0 right-0 z-10">

    <!-- Logo Container -->
    <div class="flex items-center">
        <!-- Logo -->
        <a class="cursor-pointer">
            <h3 class="text-2xl font-medium text-blue-500">
                <img class="h-10 object-cover"
                    src="https://stackoverflow.design/assets/img/logos/so/logo-stackoverflow.svg" alt="Store Logo">
            </h3>
        </a>
    </div>

    <div class="hidden md:flex items-center space-x-6">
        <x-nav-link :href="route('home')" controller="HomeController">Home</x-nav-link>
        <x-nav-link :href="route('home')" controller="PortfolioController">Portfolio</x-nav-link>
        <x-nav-link :href="route('home')" controller="PostController">Blog</x-nav-link>
        <x-nav-link :href="route('home')" controller="ContactController">Contact</x-nav-link> 
    </div>
</nav>