<x-card cardClasses="mb-1 relative">
    <div class="flex items-center w-[75%] lg:w-[80%] xl:w-[85%] justify-between px-2">
        <p class="flex-1">{{$category->category_name}}</p>
        <div class="h-full top-0 absolute right-0 flex items-center">
            <div class="w-7 h-7 rounded-full mr-3 md:hidden"
                 style="background-color: {{$category->category_color}}" x-on:click="popover = true;">
                <x-color-picker class="z-10 md:hidden" style="opacity: 0; background-color: {{$category_color}}" wire:model="category_color"/>
            </div>
            <div class="w-7 h-7 rounded-full mr-3 hidden md:block"
                 style="background-color: {{$category->category_color}}" x-on:click="$wire.emit('updateTrigger',{{$category}}); $nextTick(() => { setTimeout(() => { update = !update }, 250); });">
                <x-color-picker class="z-10 md:hidden" style="opacity: 0" />
            </div>

            <x-button red class="w-[5%] h-[70%]" x-on:click="$wire.delete()"><i class="fa-solid fa-x"></i></x-button>
        </div>
    </div>
</x-card>
