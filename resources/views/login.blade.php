<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <title>Login -- DanielSink.dev</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <script src="{{ mix('/js/manifest.js') }}" defer></script>
        <script src="{{ mix('/js/vendor.js') }}" defer></script>
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100">
            <div class="flex flex-col bg-white shadow-md m-3 p-8 rounded-xl w-50 max-w-md">
                <div class="font-medium self-center text-2xl sm:text-3xl text-gray-800">
                    Welcome Back!
                </div>
                
                <div class="mt-6">
                    <form action="{{ route('login.action') }}" method="post">
                        @csrf
                        <div class="flex flex-col mb-5">
                            <div class="mb-4">
                                <label for="email" class="text-sm tracking-wide text-gray-600">E-Mail Address:</label>
                                <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required
                                    class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 w-full focus:outline-none focus:border-blue-400">
                                @error('email')
                                    <span class="text-sm text-red-300">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="password" class="text-sm tracking-wide text-gray-600">Password:</label>
                                <input type="password" name="password" placeholder="Enter your password" required
                                    class="text-sm placeholder-gray-500 mt-2 px-4 py-2 rounded-xl border border-gray-400 w-full focus:outline-none focus:border-blue-400">
                                @error('password')
                                    <span class="text-sm text-red-300">{{ $message }}</span>
                                @enderror                           
                            </div>

                            <div class="mb-6">
                                <input id="rememberme" type="checkbox" name="rememberme" value="1" @checked(old('rememberme'))> 
                                <span class="text-sm tracking-wide text-gray-600">Remember Me</span>
                            </div>

                            <div>
                                <button type="submit" class="py-2 items-center justify-center focus:outline-none text-white text-sm
                                        bg-blue-500 hover:bg-blue-600 rounded-xl w-full transition duration-150 ease-in">
                                    <span class="mr-2 uppercase">Sign In</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
