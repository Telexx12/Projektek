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
                Register
            </button>
        </div>
        <h2 class="text-2xl">
            Already have an account?
            <a href="{{route('login')}}">Sign in</a>
        </h2>
    </form>
</x-auth-forms>

