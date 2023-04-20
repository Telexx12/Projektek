<aside class="z-20 hidden w-1/5 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
    <div class="py-4 text-gray-500 dark:text-gray-400 fixed" style="width: inherit">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
            PersonalFinanceApp
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <span
                    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{Request::is('/') ? 'active' : 'hidden'}}"
                    aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                   href="{{route('dashboard')}}">
                    <i class="fa-solid fa-house"></i>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <span
                    class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg {{Request::is('accounts') || Request::is('account/*') ? 'active' : 'hidden'}}"
                    aria-hidden="true"></span>
                <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                   href="{{route('accounts')}}">
                    <i class="fa-solid fa-vault"></i>
                    <span class="ml-4">Accounts</span>
                </a>

            </li>
        </ul>
        <div class="px-6 my-6">
            <a href="/logout"
               class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple">
                Sign out
            </a>
        </div>
    </div>
</aside>

<div class="fixed md:hidden w-screen items-end justify-center" style="top:93%; left: 10%">
    <div class="mb-3 opacity-50 bg-gray-600 rounded-full w-3/4 flex justify-around text-white">
            <a class="flex-1 text-center pt-2 pb-1 flex flex-col items-center text-sm font-bold" href="{{route('dashboard')}}">
                <i class="fa-solid fa-house {{Request::is('/') ? 'text-[#818cf8]' : ''}}"></i>
                <span class="w-min {{Request::is('/') ? 'text-[#818cf8] border-b-[3px] border-[#818cf8]' : ''}}">Home</span>
            </a>
            <a class="flex-1 text-center pt-2 pb-1 flex flex-col items-center text-sm font-bold"  href="{{route('accounts')}}">
                 <i class="fa-solid fa-vault flex-1 text-center {{Request::is('accounts') ? 'text-[#818cf8]' : ''}}"></i>
                <span class="w-min {{Request::is('accounts') ? 'text-[#818cf8] border-b-[3px] border-[#818cf8]' : ''}}">Accounts</span>
            </a>
    </div>
</div>
