<x-master>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900 h-screen" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <x-navbar/>

        <div class="w-100 md:w-4/5">
            {{$slot}}
        </div>
    </div>
</x-master>
