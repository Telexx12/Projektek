<x-master>
    <div class="flex bg-gray-50 dark:bg-gray-900 min-h-[100vh]" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-navbar/>

        <div class="w-full md:w-4/5">
            {{$slot}}
        </div>
    </div>
</x-master>
