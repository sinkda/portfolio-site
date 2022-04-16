@extends('app')

@section('title', 'Home')

@section('content')
{{-- About Section --}}
<section class="flex flex-col md:flex-row w-full shadow-md rounded-xl bg-white p-4">
    <div class="flex flex-col items-center md:pr-6">
        <img src="./img/avatar.png" alt="Pixel Me" class="w-52">
    </div>

    <div class="flex-1 py-4 md:py-0 flex flex-col items-center space-y-3">
        <h2 class="text-xl font-bold">
            About Me
        </h2>
        <p class="flex-1">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus excepturi sapiente ipsum earum explicabo libero vero consectetur ut exercitationem, asperiores modi autem totam sit velit id dolore rerum natus officiis nihil, eum laborum culpa facilis vel deleniti! Expedita, laboriosam similique cumque cum minus eos debitis quibusdam facilis distinctio at est vitae odit ipsam hic veritatis mollitia voluptatem asperiores? Fugit consequatur dicta in perspiciatis, perferendis animi voluptas iusto autem minus voluptatum quis alias unde, culpa cum quo facilis ipsa accusantium corrupti, asperiores iste eaque velit dolorem delectus! Adipisci enim numquam soluta nulla quasi vitae ad cupiditate, qui voluptatum, corrupti labore quos!
        </p>

        <a href="{{ route('home') }}" class="w-48 h-12 mb-6 text-white bg-blue-500 rounded-xl hover:bg-blue-600 transition duration-150 ease-in text-md focus:outline-none shadow-lg">
            <span class="m-3 flex flex-col items-center">View My Work</span>
        </a>
    </div>
</section>
@endsection