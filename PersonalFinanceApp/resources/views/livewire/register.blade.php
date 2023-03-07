<x-auth-forms>
    <x-slot:text>
        <h1 class="text-5xl font-bold text-left tracking-wide">Keep it special</h1>
        <p class="text-3xl my-4">Capture your personal memory in unique way, anywhere.</p>
    </x-slot:text>

    <form wire:submit.prevent="submit" class="md:w-full w-full px-4 lg:px-0 lg:mx-auto lg:w-2/3">
        <div class="pb-2 pt-4">
            <x-input placeholder="Email"
                     wire:model="email"
                     class="block w-full p-4 text-lg rounded-sm bg-black"/>
        </div>
        <div class="pb-2 pt-4">
            <x-input placeholder="Username"
                     wire:model="username"
                     class="block p-4  bg-black"
                     type="text"
                     />
        </div>
        <div class="pb-2 pt-4">
            <x-input placeholder="Password"
                     wire:model="password"
                     class="block w-full p-4 text-lg rounded-sm bg-black"
                     type="password"/>
        </div>
        <div class="pb-2 pt-4 text-2xl">
            <x-input placeholder="Password Confirmation"
                     wire:model="password_confirmation"
                     class="block w-full p-4 text-3xl bg-black"
                     type="password"/>
        </div>

        <div class="px-4 pb-2 pt-4">
            <button
                class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none"
                type="submit">

                Register
            </button>
        </div>
        <h2 class="text-2xl">
            Already have an account?
            <a class="text-blue-700" href="{{route('login')}}">Sign in</a>
        </h2>
    </form>
</x-auth-forms>

