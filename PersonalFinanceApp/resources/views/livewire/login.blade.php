<x-auth-forms>
    <x-slot:text>
        <h1 class="text-5xl font-bold text-left tracking-wide">Keep it special</h1>
        <p class="text-3xl my-4">Capture your personal memory in unique way, anywhere.</p>
    </x-slot:text>

    <form action="" class="md:w-full w-full px-4 lg:px-0 lg:mx-auto lg:w-2/3">
        <div class="pb-2 pt-4">
            <input type="email" name="email" id="email" placeholder="Email"
                   class="block w-full p-4 text-lg rounded-sm bg-black">
        </div>
        <div class="pb-2 pt-4">
            <input class="block w-full p-4 text-lg rounded-sm bg-black" type="password"
                   name="password"
                   id="password" placeholder="Password">
        </div>

        <div class="px-4 pb-2 pt-4">
            <button
                class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">
                sign in
            </button>
        </div>
        <div class="px-4 pb-2 pt-4">
            <a
                class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none"
                href="{{route('register')}}">
                Register
            </a>
        </div>
        <p class="py-2">or</p>

        <div class="pb-6 space-x-2">
            <button type="button"
                    class="text-white bg-[#050708] hover:bg-[#050708]/90 focus:ring-4 focus:outline-none focus:ring-[#050708]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#050708]/50 dark:hover:bg-[#050708]/30 mr-2 mb-2">
                <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                     data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                    <path fill="currentColor"
                          d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path>
                </svg>
                Sign in with Google
            </button>
        </div>
    </form>
</x-auth-forms>
